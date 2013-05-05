<?php
App::uses('AppModel', 'Model');
/**
 * Merchant Model
 *
 * @property Queue $Queue
 * @property User $User
 */
class Merchant extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'shortname' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create'
            ),
        ),
        'address' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'phonenumber' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'WaitingQueue' => array(
            'className' => 'Queue',
            'foreignKey' => 'merchant_id',
            'dependent' => false,
            'conditions' => "WaitingQueue.cancelled = '0000-00-00 00:00:00' and WaitingQueue.fulfilled = '0000-00-00 00:00:00' ",
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'merchant_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public $actsAs = array(
        'Uploader.Attachment' => array(
            'imageurl' => array(
                'nameCallback' => '',
                'append' => '',
                'prepend' => '',
                'tempDir' => TMP,
                'uploadDir' => '',
                'dbColumn' => 'imageurl',
                'metaColumns' => array(),
                'defaultPath' => '',
                'overwrite' => true,
                'stopSave' => true,
                'allowEmpty' => true,
                'transforms' => array(
                    'imageurl' => array(
                        'method' => 'crop',
                        'self' => true,
                        'width' => 400,
                        'height' => 100,
                        'dbColumn' => 'imageurl',
                        'aspect' => false,
                        'expand' => true,
                        'mode' => 'width'
                    )
                ),
                'transport' => array()
            )
        )
    );
}
