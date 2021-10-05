<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Quiz_m'); 
        $this->load->helper('form');

        

    }


    public function template(){
        
        $this->load->view('template.html','',true);
    }
    
    private function validacion_login(){
        $variabledata = $this->session->userdata('userdata');
        $get_usuario = $this->Quiz_m->get_user($variabledata);
        if(empty($variabledata)){
            redirect('Autentificar/login');
            
        }

        return $get_usuario;
    }
    private function verificarA(){
        $login = $this->validacion_login();
        if($login->tipo_usuario != "A"){
            redirect('Autentificar/login');
        }
    }


    
    public function email(){
        
        
        $this->load->library('email', $this->config->load('emaildata'));
        $this->email->set_newline("\r\n");
        $this->email->from('Email@gmail.com', 'Benja');
        $this->email->to('quiztestcuenta@gmail.com');
        $this->email->subject('Puntaje');  
        $this->email->message( $this->load->view('template','',true));
        if (!$this->email->send()) {
          show_error($this->email->print_debugger()); }
        else {
          echo 'Your e-mail has been sent!';
        }

        $data['subview']='final';
        $this->load->view('Quiz_layout',$data); 
      
        
    }

    public function restpsw(){

        $rules = $this->Quiz_m->rulesRec;
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run()==true){
            $mail = $this->input->post(null);
            $Revisar = $this->Quiz_m->get_user($mail['Usuario']);
            if(!is_null($Revisar)){

                $coreo = $Revisar->correo;
                $asunto = 'Recupera tu clave';
                $mensaje = $this->load->view('recuperar',['clave' => $Revisar->clave],true);
                
               
               if (correo($coreo,$asunto,$mensaje)) {
                    $data['message'] = 'Se envio';
                }
                else {
                    $data['message'] = 'Ups! Algo fallo';
                }
            }
            else{
               $data['message'] = 'Correo invalido';
            }
        }

        $data['subview']='ingresamail';
        $this->load->view('Quiz_layout',$data);

        
    }


}