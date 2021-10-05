<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_m extends CI_Model{

    public $rules = array(
        'question' => array(
            'field' => 'Question_id',
            'label' => 'Numero',
            'rules' => 'trim|required'
        ),
        'question_text' => array(
            'field' => 'Question_text',
            'label' => 'Pregunta',
            'rules' => 'trim|required'
        ),
        'choices' => array(
            'field' => 'choices[]',
            'label' => 'Alternativa',
            'rules' => 'trim|required'
        ),
        'is_correct' => array(
            'field' => 'Is_Correct',
            'label' => 'Respuesta',
            'rules' => 'trim|required'
        )
    );

    public $ruleslog = array(
        'Usuario' => array(
            'field' => 'Usuario',
            'label' => 'Text',
            'rules' => 'trim|required'
        ),
        'Clave' => array(
            'field' => 'Clave',
            'label' => 'Contraseña',
            'rules' => 'trim|required'
        ),
    );

    public $rulesReg = array(
        'Nombre' => array(
            'field' => 'nombre',
            'label' => 'Name',
            'rules' => 'trim|required'
        ),
        'Mail' => array(
            'field' => 'correo',
            'label' => 'correo',
            'rules' => 'trim|required'
        ),
        'Clave' => array(
            'field' => 'clave',
            'label' => 'clave',
            'rules' => 'trim|required'
        ),
    );

    
    public $rulesRec = array(
        'Mail' => array(
            'field' => 'Usuario',
            'label' => 'correo',
            'rules' => 'trim|required' 
            
        ),
    );

    public $rulesid = array(
        'Mail' => array(
            'field' => 'Usuario',
            'label' => 'number',
            'rules' => 'trim|required' 
            
        ),
    );


    public function get_count_questions(){
        return $this->db->count_all('questions');
    }

    public function get_count_choicess(){
        return $this->db->count_all('choices');
    }

    public function get_question($question_id){
        $this->db->where('Question_id',$question_id);
        return $this->db->get('questions')->row();
    }

    public function get_choices($question_id){
        $this->db->where('Question_id',$question_id);
        return $this->db->get('choices')->result();
    }

    public function get_correct_choice($question_id){
        $this->db->where(['Question_id' => $question_id, 'Is_Correct' => 1]);
        return $this->db->get('choices')->row();
    }

    public function save_question($text){
        $data = ['Question_text' => $text];
        $result = $this->db->insert('questions', $data);
        $id = $this->db->insert_id();
        return $id;

    }

    public function save_choices($data){
        $result = $this->db->insert('choices', $data);
        $id = $this->db->insert_id();
        return $id;


    }

    public function array_from_post($fields){
        $data = [];

        foreach ($fields as $Value){
            $data[$Value] = $this->input->post($Value);
        }

        return $data;

    }

    public function get_user($user){
        $this->db->where('correo',$user);
        return $this->db->get('usuario')->row();
    }

    public function insertusuario($data){
        $this->db->insert('usuario',$data);
        return true;
    }

    public function get_userid($user){
        $this->db->where('id_usuario',$user);
        return $this->db->get('usuario')->row();
    }

    
}