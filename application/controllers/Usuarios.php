<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Quiz_m');
        //$this->load->library('email', $this->config->load('emaildata'));
    }

  

    public function usuarios(){
        verificarA();
        $crud = new grocery_CRUD();
        $crud->set_table('usuario');
        //$crud->set_Subject('usuario', 'usuarios');
        $crud->columns(['id_usuario','nombre','correo','clave','tipo_usuario']);
        $crud->add_action('Recuperar clave', '', 'Quiz/sendwithid','ui-icon-plus');
        //$crud->add_action('Recuperar clave','','','',array($this,'sendwithid'));
        $output = $crud->render();
        _example_output($output);
        

    }

    public function sendwithid($primary_key){

        $usuario = $this->Quiz_m->get_userid($primary_key);
        $status = false;
        if(!is_null($usuario)){

            $status = correo($usuario->correo,'Recupera tu clave',$this->load->view('recuperar',['clave' => $usuario->clave],true));

        }

        $data['subview']='Enviarrecuperacion';
        $data['status'] = $status;
        $this->load->view('Quiz_layout',$data); 
       /* var_dump($primary_key,$usuario);
        die();*/
  
    }

}