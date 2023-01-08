<?php 
/**
 * @var $model App\User */
?>
<div class="p-2">
    <h1>Login</h1>
    <div class="p-3">
        <?php $form= \App\Core\Form\Form::begin('',"post"); ?>
            <?php echo $form->field($model,'email')->emailField() ?>
            <?php echo $form->field($model,'password')->passwordField() ?>    
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php echo \App\Core\Form\Form::end(); ?>
    </div>
</div>