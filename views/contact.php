<?php $this->title = 'Contact'; ?>

<form action="/contact" method="post">
    <h1>form title is: <?php echo $title; ?></h1>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">First name</label>
        <input type="text" name="first_name" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Last name</label>
        <input type="text" name="last_name" class="form-control">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Submit</button>
    </div>

</form>
