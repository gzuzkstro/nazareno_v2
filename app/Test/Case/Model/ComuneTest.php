<?php
App::uses('Comune', 'Model');

/**
 * Comune Test Case
 *
 */
class ComuneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comune',
		'app.comunion'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comune = ClassRegistry::init('Comune');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comune);

		parent::tearDown();
	}

}
