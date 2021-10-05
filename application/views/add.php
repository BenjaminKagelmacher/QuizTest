<style>
    form  { display: table;      }
    p     { display: table-row;  }
    label { display: table-cell; }
    input { display: table-cell; }  
</style>
<div class = "alert alert-primary">
    Agregar una pregunta
</div>
<?php if ($this->session->flashdata('msg')): ?>
  <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    <?= $this->session->flashdata('msg') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif ?>
<?php if(validation_errors()) { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo validation_errors('<li>', '</li>'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<form method = "POST" action = "<?php echo site_url('quiz/add');?>">
    <div class = "form-row">
        <div class = "form-group col-md-4">
            <label for = "question_id">Numero de pregunta</label>
            <input type = "number" min = "1" class = "from-control" id = "question_id" name = "Question_id" value="<?php echo set_value('Question_id', $count_questions + 1 ) ?>">
        </div>
        <div class = "form-group col-md-8">
            <label for = "question">pregunta</label>
            <input type = "text"  class = "from-control" id = "Question" name = "Question_text" value= "<?php echo set_value('Question_text') ?>">
        </div>
        <div class = "form-group col-md-6">
            <label for = "choice1">Alternativa 1</label>
            <input type = "text"  class = "from-control" id = "choice1" name = "choices[]" value="<?php echo set_value('choices[]')?>">
        </div>
        <div class = "form-group col-md-6">
            <label for = "choice2">Alternativa 2</label>
            <input type = "text"  class = "from-control" id = "choice2" name = "choices[]" value="<?php echo set_value('choices[]')?>">
        </div>
        <div class = "form-group col-md-6">
            <label for = "choice3">Alternativa 3</label>
            <input type = "text"  class = "from-control" id = "choice3" name = "choices[]" value="<?php echo set_value('choices[]')?>">
        </div>
        <div class = "form-group col-md-6">
            <label for = "choice4">Alternativa 4</label>
            <input type = "text"  class = "from-control" id = "choice4" name = "choices[]" value="<?php echo set_value('choices[]')?>">
        </div>
        <div class = "form-group col-md-6">
            <label for = "choice5">Alternativa 5</label>
            <input type = "text"  class = "from-control" id = "choice5" name = "choices[]" value="<?php echo set_value('choices[]')?>">
        </div>
        <div class = "form-group col-md-6">
            <label for = "Is_Correct">Numero de respuesta correcta</label>
            <input type = "number" min = "1" class = "from-control" id = "is_correct" name = "Is_Correct" value="<?php echo set_value('Is_Correct')?>">
        </div>
    </div>
    <br />
    <button type = "submit" class = "btn btn-primary">Agregar pregunta</button>
    <a href="<?php echo site_url('Usuarios/usuarios');?>" class = "btn btn-outline-primary">Agregar Usuarios</a>
    <a href="<?php echo site_url('autentificar/logout');?>" class = "btn btn-outline-primary">Cerrar sesion</a>
    <a href="<?php echo site_url('Mail/sendwithid');?>" class = "btn btn-outline-primary">Enviar mail</a>
</form>