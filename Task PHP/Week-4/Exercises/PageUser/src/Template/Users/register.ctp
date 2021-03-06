<div class="col-5 m-auto form-control">
  <h1 class="text-center">SIGN UP</h1>
  <form action=<?= $this->request->here ?> method="post" enctype="multipart/form-data">
    <div class="form-group">
      <legend>Avatar:</legend>
	  <input type="file" class="form-control" name="txtAvatar">
	    <?php
	    // Check validate data empty
		if (isset($txtAvatar['_empty'])) {
			echo "<p class='alert-danger'>".$txtAvatar['_empty']."</p>";
		}
		// Check validate extension of file upload
		if (isset($txtAvatar['wrongExtension'])) {
			echo "<p class='alert-danger'>".$txtAvatar['wrongExtension']."</p>";
		}
		?>
    </div>
    <div class="form-row">
      <div class="col-md-9">
        <legend>Username:</legend>
        <input type="text" class="form-control" name="txtName" placeholder="Please, input your name..">
		<?php
		// Check validate data empty
		if (isset($txtName['_empty'])) {
			echo "<p class='alert-danger'>".$txtName['_empty']."</p>";
		}
		?>
      </div>
      <div class="col-md-3">
        <legend>Sex:</legend>
        <select class="custom-select" name="txtSex">
          <option value="male" selected>Male</option>
          <option value="female">Female</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <legend>Address:</legend>
      <input type="text" class="form-control" name="txtAddress" placeholder="Please, input your address..">
		<?php
		// Check validate data empty
		if (isset($txtAddress['_empty'])) {
			echo "<p class='alert-danger'>".$txtAddress['_empty']."</p>";
		}
		?>
    </div>
    <div class="form-row">
      <div class="col-md-6">
        <legend>Email:</legend>
        <input type="text" class="form-control" name="txtEmail" placeholder="Please, input your email..">
		<?php
		// Check validate data empty
		if (isset($txtEmail['_empty'])) {
			echo "<p class='alert-danger'>".$txtEmail['_empty']."</p>";
		}
		// Check validate email format
		if (isset($txtEmail['email'])) {
			echo "<p class='alert-danger'>".$txtEmail['email']."</p>";
		}
		// Check validate email unique
		if (isset($txtEmail['existEmail'])) {
			echo "<p class='alert-danger'>" . $txtEmail['existEmail'] . "</p>";
		}
		?>
      </div>
      <div class="col-md-6">
        <legend>Phone number:</legend>
        <input type="text" class="form-control" name="txtPhone" placeholder="Please, input your phone number..">
		<?php
		// Check validate data empty
		if (isset($txtPhone['_empty'])) {
			echo "<p class='alert-danger'>".$txtPhone['_empty']."</p>";
		}
		// Check validate data number
		if (isset($txtPhone['numeric'])) {
			echo "<p class='alert-danger'>".$txtPhone['numeric']."</p>";
		}
		?>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-6">
        <legend>Password:</legend>
        <input type="password" class="form-control" name="txtPass" placeholder="Please, input your password..">
		<?php
		// Check validate data empty
		if (isset($txtPass['_empty'])) {
			echo "<p class='alert-danger'>".$txtPass['_empty']."</p>";
		}
		// Check validate data min length
		if (isset($txtPass['minLength'])) {
			echo "<p class='alert-danger'>".$txtPass['minLength']."</p>";
		}
		// Check validate password compare
		if (isset($txtPass['compare'])) {
			echo "<p class='alert-danger'>".$txtPass['compare']."</p>";
		}
		?>
      </div>
      <div class="col-md-6">
        <legend>Confirm password:</legend>
        <input type="password" class="form-control" name="txtConfirmPass" placeholder="Please, confirm your password..">
		<?php
		// Check validate data empty
		if (isset($txtConfirmPass['_empty'])) {
			echo "<p class='alert-danger'>".$txtConfirmPass['_empty']."</p>";
		}
		// Check validate data min length
		if (isset($txtConfirmPass['minLength'])) {
			echo "<p class='alert-danger'>".$txtConfirmPass['minLength']."</p>";
		}
		?>
      </div>
    </div>
    <input type="submit" class="btn btn-primary" name="btnSignup" value="Sign up">
  </form>
</div>