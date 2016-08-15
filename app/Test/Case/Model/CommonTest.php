<?php
App::uses('Common', 'Model');

/**
 * Common Test Case
 *
 */
class CommonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.common',
		'app.communion'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Common = ClassRegistry::init('Common');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Common);

		parent::tearDown();
	}

}
