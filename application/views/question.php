<div class="alert alert-dark">
  Pregunta <?php echo $question->Question_id?> de <?php echo $count_questions?>
</div>
<p class="font-weight-bolder"> <?php echo $question->Question_text ?> </p>

<form method="post" action="<?php echo site_url('quiz/process'); ?>">
    <?php foreach ($choices as $Key => $choice): ?> 
        <div class="from-check">
            <input class = "from-check-input" type="radio" name="choice_text" id = "choice<?php echo $Key +1 ?>" value = "<?php echo $choice->Choices_id ?>">
            <label class="from-check-label" for = "choice<?php echo $Key +1 ?>">
                <?php echo $choice->Choice_text ?>
            </label>
        </div>
    <?php endforeach ?>
    <input type="hidden" name="question_id" value="<?php echo $question->Question_id?>">
  <input type="submit" value="Enviar" class="btn btn-primary mt-3">
</form>
<a href="<?php echo site_url('autentificar/logout');?>" class = "btn btn-outline-primary">Cerrar sesion</a>