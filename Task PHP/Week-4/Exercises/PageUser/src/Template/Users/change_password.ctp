<div class="col-5 m-auto form-control">
  <h1 class="text-center">Change your password</h1>
  <form action=<?= $this->request->here ?> method="post">
    <div class="form-group">
      <legend>Current password:</legend>
      <input type="password" class="form-control" name="txtOldPass" placeholder="Please, input your email..">
		<?php
		if (isset($txtOldPass['_empty'])) {
			echo "<p class='alert-danger'>".$txtOldPass['_empty']."</p>";
		}
		if (isset($txtOldPass['minLength'])) {
			echo "<p class='alert-danger'>".$txtOldPass['minLength']."</p>";
		}
		if (isset($txtOldPass['compare'])) {
			echo "<p class='alert-danger'>".$txtOldPass['compare']."</p>";
		}
		?>
    </div>
    <div class="form-group">
      <legend>New password:</legend>
      <input type="password" class="form-control" name="txtNewPass" placeholder="Please, input your password..">
		<?php
		if (isset($txtNewPass['_empty'])) {
			echo "<p class='alert-danger'>".$txtNewPass['_empty']."</p>";
		}
		if (isset($txtNewPass['minLength'])) {
			echo "<p class='alert-danger'>".$txtNewPass['minLength']."</p>";
		}
		if (isset($txtNewPass['compare'])) {
			echo "<p class='alert-danger'>".$txtNewPass['compare']."</p>";
		}
		?>
    </div>
    <div class="form-group">
      <legend>Confirm:</legend>
      <input type="password" class="form-control" name="txtConfirmPass" placeholder="Please, confirm your password..">
		<?php
		if (isset($txtConfirmPass['_empty'])) {
			echo "<p class='alert-danger'>".$txtConfirmPass['_empty']."</p>";
		}
		if (isset($txtConfirmPass['minLength'])) {
			echo "<p class='alert-danger'>".$txtConfirmPass['minLength']."</p>";
		}
		?>
    </div>
    <input type="submit" class="btn btn-primary" name="btnChangePass" value="Change">
  </form>
</div>