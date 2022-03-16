<?php $this->title = 'Login'; ?>

<?php $form = \app\core\Forms\Form::open('/login', 'post') ?>
<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</div>
<?php echo $form->close(); ?>
