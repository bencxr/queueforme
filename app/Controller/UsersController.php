<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'merchant_add', 'login', 'logout');
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect("/");
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }


    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        if ($GLOBALS["SiteMode"] == "Merchant") {
            $this->redirect(array('action' => 'merchant_add'));
        }
        if ($this->request->is('post')) {
            $this->User->create();

            if (isset($this->request->data['User']['password'])) {
                $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
            }

            if (!isset($this->request->data['User']['signupsource'])) {
                $this->request->data['User']['signupsource'] = "CustomerWebsite";
            }

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Thank you for signing up!'));
                $id = $this->User->getInsertID();
                $this->request->data['User']['id'] = $id;
                $this->Auth->login($this->request->data['User']);
                $this->redirect("/");
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function merchant_add() {
        if ($this->request->is('post')) {
            $this->User->create();

            if (isset($this->request->data['User']['password'])) {
                $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
            }

            if (!isset($this->request->data['User']['signupsource'])) {
                $this->request->data['User']['signupsource'] = "MerchantWebsite";
            }

            if ($this->User->saveAll($this->request->data)) {
                $this->Session->setFlash(__('Thank you for signing up!'));
                $id = $this->User->getInsertID();
                $this->request->data['User']['id'] = $id;
                $this->request->data['User']['merchant_id'] = $id;
                $this->Auth->login($this->request->data['User']);
                $this->redirect("/");
            } else {
                // $this->Session->setFlash(__('The user could not be saved. Please, try again.'));exit;
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
            if (isset($this->request->data['User']['password'])) {
                $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
            }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $merchants = $this->User->Merchant->find('list');
        $this->set(compact('merchants'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
