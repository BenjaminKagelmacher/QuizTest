<style>
    form  { display: table;      }
    p     { display: table-row;  }
    label { display: table-cell; }
    input { display: table-cell; }  
</style>
<div class = "alert alert-primary">
    Ingresa tu mail para enviar el correo de recuperacion
</div>

<form method = "POST" action = "<?php echo base_url('Mail/restpsw');?>">
    <div class = "form-row">
        <div class = "form-group col-md-4">
            <label for = "question_id">Email</label>
            <input type = "email"  class = "from-control" id = "usuario" name = "Usuario" value="">
        </div>

        <?php if(!empty($message)){ ?>
            <div class = "alert alert-warning">
                <?php echo $message ?>
            </div>
        <?php } ?>

    </div>
    <br />
    <button type = "submit" class = "btn btn-primary">Enviar</button>
</form>