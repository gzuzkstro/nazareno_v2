<?php
class UsuariosController extends AppController {
    function login() {
        $this->layout = 'login';
        
        if($this->request->is('post')) {
            if ($this->Auth->login()) {
                //return $this->redirect($this->Auth->redirectUrl());
                $this->redirect('/');
            } else {
                unset($this->request->data['Usuario']['password']);
                $this->Session->setFlash('Usuario o contraseña incorrecta', 'default', array(), 'auth');
            }
        }
    }
    
    function logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    function index() {
        if(!parent::isAdmin())
            throw new NotFoundException('La página no existe.');
        $this->set('usuarios', $this->Usuario->find('all'));
    }
    
    function agregar() {
        if(!parent::isAdmin())
            throw new NotFoundException('La página no existe.');
        
        if($this->request->is('post')) {
            $this->Usuario->create();
            
            $pwd = $this->request->data('Usuario.password');
            $this->request->data['Usuario']['password'] = Security::hash($this->request->data('Usuario.password'), 'sha1', true);
            
            if($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash('Usuario registrado con éxito<br><br><b>Usuario:</b> '.$this->request->data('Usuario.usuario').'<br><b>Contraseña:</b> '.$pwd, 'default', array(), 'good');
                return $this->redirect(array('action' => 'index'));
            }
            $this->request->data['Usuario']['password'] = '';
            $this->Session->setFlash('Ocurrió un error registrando el usuario', 'default', array(), 'bad');
        }
    }
    
    function modificar($id = null) {
        if(!parent::isAdmin() || $id == null)
            throw new NotFoundException('La página no existe.');
        
        $this->Usuario->validator()->remove('usuario');
        
        $this->Usuario->id = $id;
        
        if($this->request->is('put')) {
            if($this->request->data('Usuario.password')) {
                // El usuario cambió la contraseña
                $pwd = $this->request->data('Usuario.password');
                $this->request->data['Usuario']['password'] = Security::hash($this->request->data['Usuario']['password'], 'sha1', true);
            } else {
                // El usuario no cambió la contraseña.
                $this->Usuario->validator()->remove('password');   
            }
            
            if($this->Usuario->save($this->request->data)) {
                $msg = 'Usuario modificado con éxito';
                
                if(isset($pwd))
                    $msg .= '<br>Nueva contraseña: '.$pwd;
                
                $this->Session->setFlash($msg, 'default', array(), 'good');
            } else {
                $this->Session->setFlash('Error modificando el usuario', 'default', array(), 'bad');
            }
        } else {
            $this->Usuario->validator()->remove('password');
        }
    
        $this->request->data = $this->Usuario->read();
        unset($this->request->data['Usuario']['password']);
        
        $this->render('agregar');
    }
    
    function eliminar($id = null) {
        if(!parent::isAdmin() || $id == null)
            throw new NotFoundException('La página no existe.');
        $this->Usuario->delete($id);
        $this->Session->setFlash('Usuario eliminado con éxito', 'default', array(), 'good');
        $this->redirect(array('action' => 'index'));
    }
}
?>