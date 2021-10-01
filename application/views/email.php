<style>
    form  { display: table;      }
    p     { display: table-row;  }
    label { display: table-cell; }
    input { display: table-cell; }  
</style>
<div class = "alert alert-primary">
    Enviar email
</div>


<form method = "POST" action = "<?php echo site_url('Mail/template');?>">
    <div class = "form-row">

        <div class = "form-group col-md-8">
            <label for = "question">Correo Destinatario</label>
            <input type = "email"  class = "from-control" id = "Mail" name = "correo" value= "<?php echo set_value('correo') ?>">
        </div>
        <div class = "form-group col-md-8">
            <label for = "question">Correo de quien recibe</label>
            <input type = "email"  class = "from-control" id = "Mail" name = "correo" value= "<?php echo set_value('correo') ?>">
        </div>
        <div class = "form-group col-md-4">
            <label for = "question_id">Mensaje</label>
            <input type = "text" min = "1" class = "from-control" id = "Nombre" name = "nombre" value="<?php echo set_value('nombre') ?>">
        </div>
    </div>
    <br />
    <button type = "submit" class = "btn btn-primary">Enviar</button>
    <a href="<?php echo site_url('autentificar/logout');?>" class = "btn btn-outline-primary">Cerrar session</a>

</form>
