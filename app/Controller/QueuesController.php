<?php
App::uses('AppController', 'Controller');
/**
 * Queues Controller
 *
 * @property Queue $Queue
 */
class QueuesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'update', 'cancel', 'enqueue', 'merchant_add', 'login', 'logout', 'poll', 'ping', 'fulfill', 'qrcode', 'update_estimate'); 
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Queue->recursive = 0;
        $this->set('queues', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Queue->exists($id)) {
            throw new NotFoundException(__('Invalid queue'));
        }
        $options = array('conditions' => array('Queue.' . $this->Queue->primaryKey => $id));
        $this->set('queue', $this->Queue->find('first', $options));
    }

    public function ping() {

        $params = $this->request->params['named'];
        $output = array();        
        if (isset($params['queueID'])) {

            $queueID = $params['queueID'];
        }

        if (empty($queueID)) {
            $output["Error"] = "queueID parameter not provided. "; $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return; 
        }

        $queue = $this->Queue->findById($queueID);

        if (empty($queue)) {
            $output["Error"] = "queueID was invalid or not found. "; $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return; 
        } else {

            $now = date('Y-m-d H:i:s'); 
            if ($queue["Queue"]["firstpinged"] == '0000-00-00 00:00:00') {
                $queue["Queue"]["firstpinged"] = $now;
            }

            $queue["Queue"]["pinged"] = $now;
            if ($this->Queue->save($queue)) {
                $output["Success"] = 200;
            } else {
                $output["Error"] = "Could not save queue";
            }
        }

        $this->response->type('json');
        $output = $queue;
        $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json');  
    }

    // Poll by queue id or customer id
    public function poll() {

        $params = $this->request->params['named'];
        $output = array();        

        if ($GLOBALS["SiteMode"] == "Merchant") {

            $user = $this->Auth->user();
            // In merchant mode, show all queues
            if (isset($params['merchantID'])) {
                $merchantID = $params['merchantID'];
            } else if (isset($user) && !empty($user["merchant_id"])) {
                $merchantID = $user["merchant_id"];
            }

            if ($merchantID) {

                $output = $this->getMerchantIdDetails($merchantID);
            } else {
                $output["Error"] = "Must be logged in as merchant. ";
            }
        }
        else {
            // In customer mode, show for one queue
            if (isset($params['queueID'])) {

                $queueID = $params['queueID'];
                $output = $this->getQueueIdDetails($queueID);
            } else if (isset($params['userID'])) {

                $userID = $params['userID'];
                $queue = $this->Queue->find('first', array('conditions' => array("Queue.user_id" => $userID, "Queue.cancelled = '0000-00-00 00:00:00' and Queue.fulfilled = '0000-00-00 00:00:00'"), 'recursive' => 0, 'order' => array('Queue.id DESC')));

                if (empty($queue)) {

                    $output["Error"] = "Could not find any queues for that user id. ";
                } else {
                    $queueID = $queue["Queue"]["id"];
                    $output = $this->getQueueIdDetails($queueID);
                }
            } else {

                $output["Error"] = "No userID or queueID parameter provided!";
            }
        }

        $this->response->type('json');
        $now = date('Y-m-d H:i:s'); 
        $output["Now"] = $now;
        $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json');  
    }

    // Enqueue
    public function enqueue() {

        $output = array();

        $user = $this->Auth->user();
        $params = $this->request->params['named'];

        $name = $params['name'];
        $seats = $params['seats'];
        $options = "";
        if (isset($params['options'])) {
            $options = $params['options'];
        }

        if (!isset($seats)) { 
            $output["Error"] = "'seats' parameter not provided. "; $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return; 
        }

        // In merchant mode, popualte the merchant id
        if (isset($params['merchantID'])) {
            $merchantID = $params['merchantID'];
        } else if (isset($user) && !empty($user["merchant_id"]) && $GLOBALS["SiteMode"] == "Merchant") {
            $merchantID = $user["merchant_id"];
        } else {
            $output["Error"] = "merchantID parameter not provided and you are not logged on to the merchant terminal. "; $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return; 
        }

        if (isset($name)) {

            // Name was provided, create a new user
            $this->loadModel('User');
            $this->User->create();
            $user = array();
            $lastID = $this->Queue->lastID();
            $user["User"]["username"] = uniqid('Guest_'.($lastID+1), true);
            $user["User"]["password"] = md5(uniqid('j74fh29834298', true));
            if (empty($name)) { $name = "Guest ".($lastID+1); }
            $user["User"]["fullname"] = $name;

            if ($this->User->save($user)) {

                $userID = $this->User->getInsertID();
                $output["userID"] = $userID;

            } else {

                $output["Error"] = "Could not save user!";
            }
        } else {
            // No name provided, try to get name from user

            $user = $this->Auth->user();
            $userID = $user["id"];
        }

        if (!isset($userID) || empty($userID)) { 
            $output["Error"] = "'name' parameter not provided, and user is not logged on. Cannot proceed to add queue. "; $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return; 
        }

        // Now add the queue
        $this->Queue->create();
        $queue = array();
        $queue["Queue"]["user_id"] = $userID;
        $queue["Queue"]["seats"] = $seats;
        $queue["Queue"]["optiontags"] = $options;
        $queue["Queue"]["merchant_id"] = $merchantID;

        $this->loadModel('Merchant');
        $this->Merchant->recursive = 1;
        $merchant = $this->Merchant->findById($merchantID);

        $estimatedwait = (count($merchant["WaitingQueue"])+1) * $merchant["Merchant"]["estimatedwaitpertablesecs"];
        if (!isset($merchant) || empty($merchant)) { $output["Error"] = "merchant id not found. "; $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return; }
        $queue["Queue"]["estimatedwaitsecs"] = $estimatedwait;
        $queue["Queue"]["estimatedwaittill"] = date('Y-m-d H:i:s', strtotime('+'.$estimatedwait.' seconds'));
        if ($this->Queue->save($queue)) {

            $queueID = $this->Queue->getInsertID();
            $output = array_merge($output, $this->getQueueIdDetails($queueID));
        } else {
            $output["Error"] = "Could not save queue!";
        }

        $this->response->type('json');
        $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json');
    }

    // Customer updates queue
    public function update() {

        $output = array();

        $params = $this->request->params['named'];
        $queueID = $params['queueID'];

        if (!isset($queueID)) {
            $output["Error"] = "queueID not specified!";
        }

        $queue = $this->Queue->findById($queueID);

        if (!isset($queue) || empty($queue)) {
            $output["Error"] = "Could not find queue! "; $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return; 
        }

        if (isset($params["seats"])) {
            $queue["Queue"]["seats"] = $params["seats"];
        }

        if (isset($params["options"])) {
            $queue["Queue"]["optiontags"] = $params["options"];
        }

        if (isset($params["name"])) {
            $queue["User"]["fullname"] = $params["name"];
        }

        if ($this->Queue->save($queue)) {
            $output["Success"] = 200;
            $this->loadModel("User");
            if ($this->User->save($queue)) {
                $output["Success"] = 200;
            } else {
                $output["Error"] = "Could not save user";
            }
        } else {
            $output["Error"] = "Could not save queue";
        }

        $this->response->type('json');
        $output = $this->getQueueIdDetails($queueID);

        $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json');  
    }

    public function fulfill() {
        $params = $this->request->params['named'];

        $queueID = $params["queueID"];
        if (!isset($queueID)) {
            $output["Error"] = "queueID not specified!";
        }

        $queue = $this->Queue->findById($queueID);

        if ($queue["Queue"]["fulfilled"] != '0000-00-00 00:00:00') {
            // already filled
            $output["Success"] = 200;
            $output["Verbose"] = "Queue had been fulfilled already";
        } else {

            if ($queue["Queue"]["cancelled"] == '0000-00-00 00:00:00') {
                $queue["Queue"]["fulfilled"] = date('Y-m-d H:i:s');

                if ($this->Queue->save($queue)) {
                    $output["Success"] = 200;
                    $this->updateActiveQueues($queue["Queue"]["merchant_id"]);
                } else {
                    $output["Error"] = "Could not save queue";
                }
            } else {
                $output["Error"] = "Queue was already cancelled.";
            }
        }

        $this->response->type('json');
        $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json');
    }

    public function cancel() {
        $params = $this->request->params['named'];

        $queueID = $params["queueID"];
        if (!isset($queueID)) {
            $output["Error"] = "queueID not specified!";
        }

        $queue = $this->Queue->findById($queueID);

        if ($queue["Queue"]["cancelled"] != '0000-00-00 00:00:00') {
            // already cancelled
            $output["Success"] = 200;
            $output["Verbose"] = "Queue had been cancelled already";
        } else {

            $queue["Queue"]["cancelled"] = date('Y-m-d H:i:s');

            if ($this->Queue->save($queue)) {
                $output["Success"] = 200;
                $this->updateActiveQueues($queue["Queue"]["merchant_id"]);
            } else {
                $output["Error"] = "Could not save queue";
            }
        }

        $this->response->type('json');
        $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json');
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Queue->create();
            if ($this->Queue->save($this->request->data)) {
                $this->Session->setFlash(__('The queue has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The queue could not be saved. Please, try again.'));
            }
        }
        $users = $this->Queue->User->find('list');
        $merchants = $this->Queue->Merchant->find('list');
        $this->set(compact('users', 'merchants'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Queue->exists($id)) {
            throw new NotFoundException(__('Invalid queue'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Queue->save($this->request->data)) {
                $this->Session->setFlash(__('The queue has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The queue could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Queue.' . $this->Queue->primaryKey => $id));
            $this->request->data = $this->Queue->find('first', $options);
        }
        $users = $this->Queue->User->find('list');
        $merchants = $this->Queue->Merchant->find('list');
        $this->set(compact('users', 'merchants'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Queue->id = $id;
        if (!$this->Queue->exists()) {
            throw new NotFoundException(__('Invalid queue'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Queue->delete()) {
            $this->Session->setFlash(__('Queue deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Queue was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function updateActiveQueues($merchantID) {

        if (empty($merchantID)) { return; }
        $this->loadModel("Merchant");
        $merchant = $this->Merchant->find('first', array('conditions' => array("Merchant.id" => $merchantID), 'recursive' => 1));
        unset($merchant["Merchant"]["imageurl"]);

        $now = date('Y-m-d H:i:s');
        for ($i=0; $i < count($merchant["WaitingQueue"]); $i++) {

            $merchant["WaitingQueue"][$i]["estimatedwaittill"] = date('Y-m-d H:i:s', strtotime('+'.($i+1)*$merchant["Merchant"]["estimatedwaitpertablesecs"].' seconds'));
        }
        
        if ($this->Merchant->saveAll($merchant)) {
        } else {
        }
    }

    public function getQueueIdDetails($id) {

        $output = array();
        $queue = $this->Queue->findById($id);

        $numberAhead = $this->Queue->find('count', array('conditions' => array("Queue.id < $id", 'Merchant.id' => $queue["Merchant"]["id"], "Queue.cancelled = '0000-00-00 00:00:00' and Queue.fulfilled = '0000-00-00 00:00:00'")));

        $output = $this->buildOutputQueueData($queue);
        $output["Queue"]["position"] = $numberAhead;

        return $output;
    }

    public function getMerchantIdDetails($merchantID) {

        $this->loadModel("Merchant");
        $merchant = $this->Merchant->find('first', array('conditions' => array("Merchant.id" => $merchantID), 'recursive' => 2));

        $output = array();
        $output["Merchant"] = $this->buildMerchantData($merchant["Merchant"]);
        $output["WaitingQueue"] = array();
        foreach ($merchant["WaitingQueue"] as $waitingqueue) {

            $tempqueueobj = array();
            $tempqueueobj["User"] = $waitingqueue["User"];
            unset($waitingqueue["Merchant"]);
            unset($waitingqueue["User"]);
            $tempqueueobj["Queue"] = $waitingqueue;

            array_push($output["WaitingQueue"], $this->buildOutputQueueData($tempqueueobj));
        }

        return $output;
    }

    public function buildOutputQueueData($queue) {
        $output = array();

        $output["Queue"]["id"] = $queue["Queue"]["id"];
        $output["Queue"]["seats"] = $queue["Queue"]["seats"];
        $datetill = $queue["Queue"]["estimatedwaittill"];
        $now = date('Y-m-d H:i:s');
        $secondsleft = strtotime($datetill) - strtotime($now);
        if ($secondsleft < 60) { $secondsleft = 60; }

        $output["Queue"]["estimatedwaitsecs"] = $secondsleft;
        $output["Queue"]["options"] = $queue["Queue"]["optiontags"];
        $output["Queue"]["cancelled"] = $queue["Queue"]["cancelled"] != '0000-00-00 00:00:00' ? $queue["Queue"]["cancelled"] : false;
        $output["Queue"]["created"] = $queue["Queue"]["created"];
        $output["Queue"]["pinged"] = $queue["Queue"]["pinged"] != '0000-00-00 00:00:00' ? $queue["Queue"]["pinged"] : false;
        $output["Queue"]["firstpinged"] = $queue["Queue"]["firstpinged"] != '0000-00-00 00:00:00' ? $queue["Queue"]["firstpinged"] : false;
        $output["Queue"]["fulfilled"] = $queue["Queue"]["fulfilled"] != '0000-00-00 00:00:00' ? $queue["Queue"]["fulfilled"] : false;
        $output["User"]["id"] = $queue["User"]["id"];
        $output["User"]["fullname"] = $queue["User"]["fullname"];
        $output["User"]["username"] = $queue["User"]["username"];

        if (isset($queue["Merchant"])) {
            $output["Merchant"] = $this->buildMerchantData($queue["Merchant"]);
        }

        return $output;
    }

    public function buildMerchantData($merchant) {

        $output = array();
        $output["id"] = $merchant["id"];
        $output["facebookid"] = $merchant["facebookid"];
        $output["name"] = $merchant["name"];
        $output["imageurl"] = $merchant["imageurl"];
        $output["options"] = $merchant["tableoptions"];
        $output["address"] = $merchant["address"];
        $output["phonenumber"] = $merchant["phonenumber"];
        $output["website"] = $merchant["website"];

        return $output;
    }
}
