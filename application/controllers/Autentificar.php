<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentificar extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Quiz_m'); 
    }

    public function login(){
        $data['subview']='login';
        $this->load->view('Quiz_layout',$data);
        $rules = $this->Quiz_m->ruleslog;
        $this->form_validation->set_rules($rules);
        
        if($this->form_validation->run()==true){
            $usuario = $this->input->post(null);
            $get_usuario = $this->Quiz_m->get_user($usuario['Usuario']);
            if($usuario['Usuario'] == $get_usuario->correo && $usuario['Clave'] == $get_usuario->clave){
                $this->session->set_userdata('userdata',$get_usuario->correo);
               if($get_usuario->tipo_usuario == 'A'){
                    redirect('Quiz/add');
               }
               if($get_usuario->tipo_usuario == 'E'){
                    redirect('Quiz/index');
               }

            }
            else{
               $data['mensaje'] = 'Login fallido'; 
            }

        }



    }

    public function logout(){
        $this->session->unset_userdata('userdata');
        redirect('autentificar/login');
    }


}