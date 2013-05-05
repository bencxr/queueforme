<?php
/**
 * QueueFixture
 *
 */
class QueueFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'merchant_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'seats' => array('type' => 'integer', 'null' => false, 'default' => null),
		'optiontags' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 120, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'estimatedwaitsecs' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cancelled' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'pinged' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'fulfilled' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'merchant_id' => 1,
			'seats' => 1,
			'optiontags' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-28 05:01:11',
			'modified' => '2013-04-28 05:01:11',
			'estimatedwaitsecs' => 'Lorem ip',
			'cancelled' => '2013-04-28 05:01:11',
			'pinged' => '2013-04-28 05:01:11',
			'fulfilled' => '2013-04-28 05:01:11'
		),
	);

}
