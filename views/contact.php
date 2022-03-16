<?php
    /** @var  \app\models\ContactForm $model */
?>
<?php $this->title = 'Contact'; ?>

<?php $form = app\core\Forms\From::open('/contact', 'POST')?>
<?php echo $form->field($model, 'name')->type('text'); ?>
<?php echo $form->field($model, 'email')->type('email'); ?>
<?php echo $form->field($model, 'body')->type('text'); ?>
<div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</div>
<?php $form->close(); ?>
