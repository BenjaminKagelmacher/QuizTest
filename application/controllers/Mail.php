<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Quiz_m'); 
        $this->load->helper('form');

        $CI = & get_instance();
        $CI->load->library('email');
        $CI->email->initialize($this->config());

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

    //Comentado uno de los intentos enviar email
    private function config(){
        $config = array(
            'protocol' =>  'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' =>  465,
            'smtp_user' => 'quiztestcuenta@gmail.com',
            'smtp_pass' => 'quiztest',
            'mailtype' =>  'html',
            'charset' =>   'iso-8859-1',
            'wordwrap' => true

        );

        return $config;
    }
    
    public function email(){
        
        
        $this->load->library('email', $this->config());
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
                $this->load->library('email', $this->config());
                $this->email->set_newline("\r\n");
                $this->email->from('quiztestcuenta@gmail.com', 'Benja');
                $this->email->to($Revisar->correo);
                $this->email->subject('Recupera tu clave'); 
                $this->email->message( $this->load->view('recuperar',['clave' => $Revisar->clave],true));
                if (!$this->email->send()) {
                    $data['message'] = 'Ups! Algo fallo';
                }
                else {
                    $data['message'] = 'Se envio';
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