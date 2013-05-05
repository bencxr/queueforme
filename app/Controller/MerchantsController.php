<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Queues');

/**
 * Merchants Controller
 *
 * @property Merchant $Merchant
 */
class MerchantsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('queuefront', 'info', 'qrcode');
    }

    public function qrcode() {

        $params = $this->request->params['named'];
        $user = $this->Auth->user();

	if (isset($params['merchantID'])) {
		$merchantID = $params['merchantID'];
        } else if (isset($user) && !empty($user["merchant_id"])) {
                $merchantID = $user["merchant_id"];
	}

            if ($merchantID) {
		$merchant = $this->Merchant->findById($merchantID);
		$shortname = $merchant["Merchant"]["shortname"];
		$address = "http://queuefor.me/".$shortname."/";

		$this->response->type('png');
		App::import('Vendor', 'phpqrcode/qrlib');
		QRcode::png($address, '', 'H', 8, 2);
        	$this->layout = 'ajax'; $this->render('/General/Json', false);  
            } else {
            	$output["Error"] = "merchantID was invalid or not found. "; $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return; 
            }

        $this->response->type('json');
    }

    public function info($shortname = null) {
        if ($shortname == null) {

            $output["Error"] = "shortname required";
            $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return; 
        }
        
        $merchant = $this->Merchant->find('first', array('conditions' => array('Merchant.shortname' => $shortname), 'recursive' => 0));
        $merchantData["id"] = $merchant["Merchant"]["id"];
        $merchantData["name"] = $merchant["Merchant"]["name"];
        $merchantData["facebookid"] = $merchant["Merchant"]["facebookid"];

        $merchantData["imageurl"] = $merchant["Merchant"]["imageurl"];

        // if imageurl was a http, then it's ok, else prepend http
        if (strpos($merchantData["imageurl"], "http") === false) {
            $merchantData["imageurl"] = "http://".$_SERVER['HTTP_HOST'].$merchantData["imageurl"];
        }

        $merchantData["options"] = $merchant["Merchant"]["tableoptions"];
        $merchantData["address"] = $merchant["Merchant"]["address"];
        $merchantData["website"] = $merchant["Merchant"]["website"];
        $merchantData["phonenumber"] = $merchant["Merchant"]["phonenumber"];
        $output["Merchant"] = $merchantData;
        $this->set('merchant_json', json_encode($merchantData));
        $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json');
        $this->response->type('json');
    }

    /**
     * interface method
     *
     * @return void
     */
    public function queuefront($shortname = null) {

        if ($shortname == null && isset($this->request->params["shortname"])) {          $shortname = $this->request->params["shortname"];
        }
        if (empty($shortname)) {

            $output["Error"] = "shortname required";
            $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return;
        }

        $merchant = $this->Merchant->find('first', array('conditions' => array('Merchant.shortname' => $shortname), 'recursive' => 0));

        if ($merchant == null) {
            $output["Error"] = "no merchant found for that shortname";
            $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json'); return;
        }

        $merchantData["id"] = $merchant["Merchant"]["id"];
        $merchantData["name"] = $merchant["Merchant"]["name"];
        $merchantData["facebookid"] = $merchant["Merchant"]["facebookid"];

        $merchantData["imageurl"] = $merchant["Merchant"]["imageurl"];

        // if imageurl was a http, then it's ok, else prepend http
        if (strpos($merchantData["imageurl"], "http") === false) {
            $merchantData["imageurl"] = "http://".$_SERVER['HTTP_HOST'].$merchantData["imageurl"];
        }

        $merchantData["options"] = $merchant["Merchant"]["tableoptions"];
        $merchantData["address"] = $merchant["Merchant"]["address"];
        $merchantData["website"] = $merchant["Merchant"]["website"];
        $merchantData["phonenumber"] = $merchant["Merchant"]["phonenumber"];
        $this->set('merchant_json', json_encode($merchantData));
        $this->layout = 'ajax';
    }

    /**
     * interface method
     *
     * @return void
     */
    public function poe_interface() {

        $user = $this->Auth->user();
        if (isset($user) && !empty($user["merchant_id"])) {
            $merchantID = $user["merchant_id"];
        }

        $Queues = new QueuesController;
        $Queues->constructClasses();
        $merchantData = $Queues->getMerchantIdDetails($merchantID);

        $this->set('merchant_json', json_encode($merchantData));
        $this->layout = 'ajax';
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Merchant->recursive = 0;
        $this->set('merchants', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Merchant->exists($id)) {
            throw new NotFoundException(__('Invalid merchant'));
        }
        $options = array('conditions' => array('Merchant.' . $this->Merchant->primaryKey => $id));
        $this->set('merchant', $this->Merchant->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Merchant->create();
            if ($this->Merchant->save($this->request->data)) {
                $this->Session->setFlash(__('The merchant has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The merchant could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Merchant->exists($id)) {
            throw new NotFoundException(__('Invalid merchant'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Merchant->save($this->request->data, true)) {
                $this->Session->setFlash(__('The merchant has been saved'));
                // $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The merchant could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Merchant.' . $this->Merchant->primaryKey => $id));
            $this->request->data = $this->Merchant->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Merchant->id = $id;
        if (!$this->Merchant->exists()) {
            throw new NotFoundException(__('Invalid merchant'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Merchant->delete()) {
            $this->Session->setFlash(__('Merchant deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Merchant was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
