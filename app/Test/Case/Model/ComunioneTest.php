<?php
App::uses('Comunione', 'Model');

/**
 * Comunione Test Case
 *
 */
class ComunioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comunione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comunione = ClassRegistry::init('Comunione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comunione);

		parent::tearDown();
	}

}
