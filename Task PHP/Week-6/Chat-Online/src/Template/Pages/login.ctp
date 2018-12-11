<div class="col-5 m-auto form-control">
  <h1 class="text-center">WELCOME</h1>
	<?= $this->Form->create('Pages', [
		'type' => 'POST',
		'url' => ['controller' => 'Pages', 'action' => 'postLogin']
	]) ?>
    <div class="form-group">
      <legend>Email:</legend>
		<?= $this->Form->text('email', [
			'class' => 'form-control',
			'placeholder' => 'Please, input your email..'
		]) ?>
		<?= (isset($email['_empty'])) ? "<p class='alert-danger'>" . $email['_empty'] . "</p>" : ''; ?>
		<?= (isset($email['email'])) ? "<p class='alert-danger'>" . $email['email'] . "</p>" : '';
		?>
    </div>
    <div class="form-group">
      <legend>Password:</legend>
		<?= $this->Form->text('password', [
			'class' => 'form-control',
			'type' => 'password',
			'placeholder' => 'Please, input your password..'
		]) ?>
		<?= (isset($password['_empty'])) ? "<p class='alert-danger'>" . $password['_empty'] . "</p>" : ''; ?>
		<?= (isset($password['minLength'])) ? "<p class='alert-danger'>" . $password['minLength'] . "</p>" : ''; ?>
    </div>
    <p>You don't have an account? 
    	<?= $this->Html->link('Sign up', 
	    	['controller' => 'Pages', 'action' => 'register'], 
	    	['class' => 'alert-link']) 
    	?>	
    </p>
    <?= $this->Form->button('Sign in', [
		'class' => 'btn btn-primary',
		'name' => 'btnSignin'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
