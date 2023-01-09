<?php

/** @var App\Core\View $this*/
/** @var App\Models\ContactForm $model*/

use App\Core\Form\Form;
use App\Core\Form\TextareaField;

$this->title = 'Contact';
?>
<h1>Contact</h1>

<?php $form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model, 'body') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>