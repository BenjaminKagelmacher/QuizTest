<h2>Examen de todo</h2>
<p>Es un test de elecciones multiples</p>
<ul>
    <li><strong>Número de proguntas: </strong><?php echo $count_questions?></li>
    <li><strong>Tipo: </strong>Elecciones multiples</li>
    <li><strong>Tiempo estimado: </strong> <?php echo $count_questions* 0.5?> minuto(s) por pregunta</li>
</ul> 
<a href="<?php echo site_url('Quiz/question/1');?>" class = "btn btn-outline-primary">Empezar</a>
<a href="<?php echo site_url('autentificar/logout');?>" class = "btn btn-outline-primary">Cerrar sesion</a>
