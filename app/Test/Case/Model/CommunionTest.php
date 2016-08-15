<?php
App::uses('Communion', 'Model');

/**
 * Communion Test Case
 *
 */
class CommunionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.communion',
		'app.common'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Communion = ClassRegistry::init('Communion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Communion);

		parent::tearDown();
	}

}
