<style>
    form  { display: table;      }
    p     { display: table-row;  }
    label { display: table-cell; }
    input { display: table-cell; }  
</style>
<div class = "alert alert-primary">
    Ingrese sessiopn para agregar
</div>

<form method = "POST" action = "<?php echo site_url('autentificar/login');?>">
    <div class = "form-row">
        <div class = "form-group col-md-4">
            <label for = "question_id">Usuario</label>
            <input type = "text"  class = "from-control" id = "usuario" name = "Usuario" value="<?php echo set_value('Usuario')?>">
        </div>
        <div class = "form-group col-md-8">
            <label for = "question">Clave</label>
            <input type = "password"  class = "from-control" id = "clave" name = "Clave" value= "<?php echo set_value('Clave')?>">
        </div>

    </div>
    <br />
    <button type = "submit" class = "btn btn-primary">Login</button>
    <a href="<?php echo site_url('Registro/registrar');?>" class = "btn btn-outline-primary">Registrate</a>
    <br />
    <a href="<?php echo base_url('mail/restpsw');?>" >Olvidaste tu contraseña ?</a>
</form>