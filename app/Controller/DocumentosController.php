<?php
class DocumentosController extends AppController {
	public $uses = array();
        private $valid_ext = 'csv|xls|xlsx|doc|docx|pdf|jpg|png|gif|bmp|txt'; // Extensiones aceptadas

	function index($cat = 'bautizos') {
		$dr = opendir('../webroot/documents/' . $cat);
		$files = array();

		if($dr !== FALSE) {
			while(($file = readdir($dr)) !== FALSE) {
				if($file != '.' && $file != '..' && !preg_match('/^readme(\.(.+))?/i', $file) && !preg_match('/^\.(.+)$/', $file))
					$files[] = $file;
			}

			closedir($dr);
		}

        $this->set('cat', $cat);
		$this->set('files', $files);
	}

	function eliminar($cat, $f) {
		if(!parent::isAdmin()) {
			throw new NotFoundException('La página no existe');
		}


		if(unlink('../webroot/documents/' . $cat . '/' . $f))
			$this->Session->setFlash('Se ha eliminado el documento con éxito', 'default', array(), 'good');
		else
			$this->Session->setFlash('Ocurrió un error eliminando el documento', 'default', array(), 'bad');

		$this->redirect('/documentos/index/' . $cat);
	}

	function rename($cat) {
		if(!parent::isAdmin()) {
			return;
		}

		$this->layout = 'ajax';
		$old = $this->request->data('old');
		$new = $this->request->data('new');

		if(preg_match('/\.('.$this->valid_ext.')$/i', $new) && rename('../webroot/documents/'.$cat.'/'.$old, '../webroot/documents/'.$cat.'/'.$new))
			$this->set('name', $new);
		else
			$this->set('name', $old);
	}

	function subir($cat) {
		if(!parent::isAdmin()) {
			return;
		}

		$MAX_SIZE = 5; // Tamaño en megabytes (MB)
		$nombre = $_FILES['documento']['name'];
		$src = $_FILES['documento']['tmp_name'];
		$dst = '../webroot/documents/' . $cat . '/' . $nombre;
		$size = $_FILES['documento']['size'];

		if($size > ($MAX_SIZE*1048576)) {
			$this->Session->setFlash('El tamaño del archivo debe ser menor o igual a '.$MAX_SIZE.' MB', 'default', array(), 'bad');
		} elseif (!preg_match('/\.('.$this->valid_ext.')$/i', $nombre)) {
			$this->Session->setFlash('Formato inválido', 'default', array(), 'bad');
		} elseif(file_exists($dst)) {
			$this->Session->setFlash('El archivo ya existe', 'default', array(), 'bad');
		} else {
			$dst = preg_replace('/[^(\x20-\x7F)]*/','', $dst);
			move_uploaded_file($src, $dst);
			$this->Session->setFlash('Se ha subido el archivo con éxito', 'default', array(), 'good');
		}

		$this->redirect('/documentos/index/' . $cat);
	}
}
?>