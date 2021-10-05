<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function correo($correo,$asunto,$mensaje){
    $CI = & get_instance();
    $CI->config->load('email',true);
    $config = $CI->config->item('emaildata','email');
    $CI->load->library('email',$config);
    $CI->email->set_newline("\r\n");
    $CI->email->from('quiztestcuenta@gmail.com', 'Benja');
    $CI->email->to($correo);
    $CI->email->subject($asunto); 
    $CI->email->message($mensaje);
    return $CI->email->send();
    
}

function validacion_login($tipo = null){
    $CI = & get_instance();
    $CI->load->model('Quiz_m');
    $variabledata = $CI->session->userdata('userdata');
    $get_usuario = $CI->Quiz_m->get_user($variabledata);
    if(empty($variabledata)){
        redirect('Autentificar/login');
        
    }

    return $get_usuario;
}

function verificarE(){
    $login = validacion_login();
    if($login->tipo_usuario != "E"){
        redirect('Autentificar/login');
    }
}

function verificarA(){
    $login = validacion_login();
    if($login->tipo_usuario != "A"){
        redirect('Autentificar/login');
    }
}

 function _example_output($output = null)
{
    $CI = & get_instance();
    $CI->load->view('example.php',(array)$output);
}
