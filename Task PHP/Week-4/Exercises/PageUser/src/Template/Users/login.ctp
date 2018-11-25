<div class="col-5 m-auto form-control">
	<h1 class="text-center">WELCOME</h1>
	<form action=<?= $this->request->here ?> method="post">
		<div class="form-group">
			<legend>Email:</legend>
			<input type="text" class="form-control" name="email" placeholder="Please, input your email..">
			<?php
				if (isset($txtEmail['_empty'])) {
					echo "<p class='alert-danger'>".$txtEmail['_empty']."</p>";
				}
				if (isset($txtEmail['email'])) {
					echo "<p class='alert-danger'>".$txtEmail['email']."</p>";
				}
			?>
		</div>
		<div class="form-group">
			<legend>Password:</legend>
			<input type="password" class="form-control" name="password" placeholder="Please, input your password..">
			<?php
				if (isset($txtPass['_empty'])) {
					echo "<p class='alert-danger'>".$txtPass['_empty']."</p>";
				}
				if (isset($txtPass['minLength'])) {
					echo "<p class='alert-danger'>".$txtPass['minLength']."</p>";
				}
			?>
		</div>
		<p>You don't have an account? <a class="alert-link" href=<?= $this->request->base.'/register' ?> >Sign up</a></p>
		<input type="submit" class="btn btn-primary" name="btnSignin" value="Sign in">
	</form>
</div>
