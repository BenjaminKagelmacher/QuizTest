
    <?php if($status){ ?>
            <div class = "alert alert-success">
                Enviado exitosamente
            </div>

    <?php } else{ ?>
        <div class = "alert alert-warning">
                No se envio el mensaje
            </div>
    <?php }?>

    <a href="<?php echo site_url('Quiz/usuarios');?>" class = "btn btn-outline-primary">Volver</a>
