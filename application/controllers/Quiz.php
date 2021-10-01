<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Quiz_m');
    }

    private function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}

    private function validacion_login(){
        $variabledata = $this->session->userdata('userdata');
        $get_usuario = $this->Quiz_m->get_user($variabledata);
        if(empty($variabledata)){
            redirect('Autentificar/login');
            
        }

        return $get_usuario;
    }

    private function verificarE(){
        $login = $this->validacion_login();
        if($login->tipo_usuario != "E"){
            redirect('Autentificar/login');
        }
    }

    private function verificarA(){
        $login = $this->validacion_login();
        if($login->tipo_usuario != "A"){
            redirect('Autentificar/login');
        }
    }


    public function index(){
        $login = $this->verificarE();
        $data['count_questions'] = $this->Quiz_m->get_count_questions();
        $data['subview']='index';
        $this->load->view('Quiz_layout',$data);
        
    }

    public function question($question_id){
        $this->verificarE();
        $data['question'] = $this->Quiz_m->get_question($question_id);
        $data['choices'] = $this->Quiz_m->get_choices($question_id);
        $data['count_questions'] = $this->Quiz_m->get_count_questions();
        $data['subview']='question';
        $this->load->view('Quiz_layout',$data);  
    }
    public function process(){
        $this->verificarE();
        if(!$this->session->userdata('score')){
            $this->session->userdata('score',0);
        }

        $question_id = $this->input->post('question_id',true);
        $selectedchoicec = $this->input->post('choice_text',true);
        $next_question = $question_id + 1;
        $aux = $this->input->post(null,true);

        $row = $this->Quiz_m->get_correct_choice($question_id);
        $correct_choise = $row->Choice_id;

      

        if($selectedchoicec == $correct_choise){
            $resultadofinal1 = $this->session->score++;
        }

        $total = $this->Quiz_m->get_count_questions();

        if($question_id == $total){
            redirect('quiz/final');
        }
        else{
            redirect('quiz/question/'.$next_question);
        }

    }

    public function final(){ 
        $this->verificarE();
        redirect('Mail/email');
        $this->session->sess_destroy();
    }

    public function add(){
        $this->verificarA();
        $choices = $this->Quiz_m->get_count_choicess();
        $rules = $this->Quiz_m->rules;
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()==true){
            $question_data = $this->input->post(null);
            if(!empty($question_data)){
                $id = $this->Quiz_m->save_question($question_data['Question_text']);
                foreach ($question_data['choices'] as $key => $value) {

                    if ($question_data['Is_Correct'] == $key + 1)
                      $is_correct = 1;
                    else
                      $is_correct = 0;
          
                    $choices_data = [ 'Question_id' => $id,
                                      'Is_Correct' => $is_correct,
                                      'Choice_text' => $value
                                    ];
          
                    if ($this->Quiz_m->save_choices($choices_data))
                      continue;
                  }

                $this->session->flashdata('msg','Pregunta insertada correctamente');
                redirect('quiz/add','refresh');
            }
        }

        print_r($this->input->post('choices'));
        print_r($this->input->post('Is_Correct'));

        $data['count_questions'] = $this->Quiz_m->get_count_questions();

        $data['subview']='add';
        $this->load->view('Quiz_layout',$data); 
    }

    

    public function usuarios(){
        $this->verificarA();
        $crud = new grocery_CRUD();
        $crud->set_table('usuario');
        //$crud->set_Subject('usuario', 'usuarios');
        $crud->columns(['id_usuario','nombre','correo','clave','tipo_usuario']);
        $output = $crud->render();

        $this->_example_output($output);

    }




}