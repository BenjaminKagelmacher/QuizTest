<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Quiz_m'); 
    }

    public function registrar(){

        $rules = $this->Quiz_m->rulesReg;
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()==true){
            $userdata = $this->input->post(null);
            if(!empty($userdata)){
                $insertdata = ['nombre'=>$userdata['nombre'],
                               'correo'=>$userdata['correo'],
                               'clave'=>$userdata['clave'],
                               'tipo_usuario'=>'E'];
            }

            if($this->Quiz_m->insertusuario($insertdata) == true){
                redirect('Autentificar/login');
            }
            else{
                redirect('Registro/registrar','refresh');
                var_dump($userdata);
                die();
            }
        }

        $data['subview']='registrar';
        $this->load->view('Quiz_layout',$data);
    }
}