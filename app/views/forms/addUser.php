<div class="col-md-4">
    <h1>Add new user</h1>

    <form method="post" action="<?php echo ROOT ?>home/store">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastName" class="form-control" id="lastname" placeholder="Enter your last name">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Enter your address">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone number">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

        <?php if($errors) {?>
        <div class="col-md-3 mb-3">
            <div class="invalid-feedback">
                Please fill all fields.
            </div>
        </div>
        <?php } ?>
    </form>
</div>
