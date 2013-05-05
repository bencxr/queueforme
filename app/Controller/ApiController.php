<?php

App::uses('AppController', 'Controller');

class ApiController extends AppController {
   public $viewClass = 'Json';

	public function enqueue() {
		$output = array();

		$params = $this->request->params['named'];
		$merchantID = $params['merchantID'];
		$name = $params['name'];
		$seats = $params['seats'];
		$options = $params['options'];

		if (isset($name)) {

			// Name was provided, create a new user
			$this->loadModel('User');
			$this->User->create();
			$user = array();
			$user["User"]["username"] = uniqid('Guest_', true);
			$user["User"]["password"] = md5(uniqid('j74fh29834298', true));
			$user["User"]["fullname"] = $name;

			if ($this->User->save($user)) {

				$userID = $this->User->getInsertID();
				$output["userID"] = $userID;
			} else {

				$output["Error"] = "Could not save user!";
			}
		}

		$this->set('_serialize', json_encode($output));
	}
}

?>
