<?php
class ConfiguracionController extends AppController {
	public $uses = 'Configuracion';

	function index() {
		if(!parent::isAdmin())
			throw new NotFoundException('La página no existe');
		if($this->request->is('post')) {
			if($this->Configuracion->saveMany($this->request->data)) {
				$this->Session->setFlash('Configuracion guardada con éxito', 'default', array(), 'good');
			}
		}

		$this->set('params', $this->Configuracion->find('all'));
	}
}
?>