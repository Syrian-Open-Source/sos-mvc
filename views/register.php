<?php $this->title = 'Register'; ?>

<?php $form = \app\core\Forms\From::begin('/register', 'post') ?>
<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Submit</button>
    </div>
<?php echo $form->end(); ?>
