<style>
    form  { display: table;      }
    p     { display: table-row;  }
    label { display: table-cell; }
    input { display: table-cell; }  
</style>
<div class = "alert alert-primary">
    Registrate para dar examen
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

<form method = "POST" action = "<?php echo site_url('Registro/registrar');?>">
    <div class = "form-row">
        <div class = "form-group col-md-4">
            <label for = "question_id">Nombre</label>
            <input type = "text" min = "1" class = "from-control" id = "Nombre" name = "nombre" value="<?php echo set_value('nombre') ?>">
        </div>
        <div class = "form-group col-md-8">
            <label for = "question">Correo</label>
            <input type = "email"  class = "from-control" id = "Mail" name = "correo" value= "<?php echo set_value('correo') ?>">
        </div>
        <div class = "form-group col-md-6">
            <label for = "choice1">Clave</label>
            <input type = "password"  class = "from-control" id = "contra" name = "clave" value="<?php echo set_value('clave')?>">
        </div>
    </div>
    <br />
    <button type = "submit" class = "btn btn-primary">Registrar</button>
    <a href="<?php echo site_url('autentificar/logout');?>" class = "btn btn-outline-primary">inicio</a>

</form>