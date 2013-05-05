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
        $this->Auth->allow('queuefront', 'info', 'qrcode', 'settings', 'wix', 'associatewix');
    }

    public function settings() {

        $this->layout = 'wix';
    }
    
    public function wix() {

        $this->layout = 'wix';
        $merchant = $this->Merchant->find('first', array('conditions' => array('Merchant.wixid' => $_GET["compId"]), 'recursive' => 0));

        if (empty($merchant)) {
            echo "Please set up your shortname in the app settings!";
            exit;
        }
        $this->redirect("http://queuefor.me/".$merchant["Merchant"]["shortname"]);
    }

    public function associatewix() {


        $params = $this->request->params['named'];
        $shortname = $params['shortname']; 

        $wixid = $params['compId'];

        $merchant = $this->Merchant->find('first', array('conditions' => array('Merchant.shortname' => $shortname), 'recursive' => 0));
        $merchant["Merchant"]["wixid"] = $wixid;
        unset($merchant["Merchant"]["imageurl"]);

        if ($this->Merchant->save($merchant)) {
            $output["Success"] = 200;
        } else {
             $output["Error"] = "Could not save merchant";
        }
        
        $this->layout = 'ajax'; $this->set('content', $output); $this->render('/General/Json');
        $this->response->type('json');
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
        $merchantData["yelpaddress"] = $merchant["Merchant"]["yelpaddress"];

        $merchantData["imageurl"] = $merchant["Merchant"]["imageurl"];

        // if imageurl was a http, then it's ok, else prepend http
        if (strpos($merchantData["imageurl"], "http") === false) {
            $merchantData["imageurl"] = "http://".$_SERVER['HTTP_HOST'].$merchantData["imageurl"];
        }

        $merchantData["options"] = $merchant["Merchant"]["tableoptions"];
        $merchantData["address"] = $merchant["Merchant"]["address"];
        $merchantData["website"] = $merchant["Merchant"]["website"];
        $merchantData["phonenumber"] = $merchant["Merchant"]["phonenumber"];
        $address = str_replace("<br>", "", $merchantData["address"]);
        $address = str_replace("<br/>", "", $address);
        $gmapsgeocodeURL = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
        $locationData = json_decode(file_get_contents($gmapsgeocodeURL));
        $locationData = $locationData->results;

        if (count($locationData) > 0) {
            $locationData = $locationData[0]->geometry;
            $merchantLocation = $locationData->location;
        } else {
            $merchantLocation = '{"lat":37.4035994,"lng":-122.009992}';
        }
        $this->set('merchantJson', json_encode($merchantData));
        $this->set('merchantLocationJson', json_encode($merchantLocation));
        $this->set('merchantID', $merchantData["id"]);
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
