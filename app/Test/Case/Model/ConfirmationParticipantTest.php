<?php
App::uses('ConfirmationParticipant', 'Model');

/**
 * ConfirmationParticipant Test Case
 *
 */
class ConfirmationParticipantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.confirmation_participant',
		'app.confirmation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ConfirmationParticipant = ClassRegistry::init('ConfirmationParticipant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ConfirmationParticipant);

		parent::tearDown();
	}

}
