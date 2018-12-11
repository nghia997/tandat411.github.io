<div class="col-5 m-auto form-control">
  <h1 class="text-center">SIGN UP</h1>
	<?= $this->Form->create(null, [
		'type' => 'POST',
		'url' => ['controller' => 'Pages', 'action' => 'postRegister']
	]) ?>
    <div class="form-group">
      <legend>Username:</legend>
		<?= $this->Form->text('txtName', [
			'class' => 'form-control',
			'placeholder' => 'Please, input your name..'
		]); ?>
    <?= (isset($txtName['_empty'])) ? "<p class='alert-danger'>" . $txtName['_empty'] . "</p>" : ''; ?>
    </div>
    <div class="form-group">
      <legend>Address:</legend>
		<?= $this->Form->text('txtAddress', [
			'class' => 'form-control',
			'placeholder' => 'Please, input your address..'
		]); ?>
		<?= (isset($txtAddress['_empty'])) ? "<p class='alert-danger'>" . $txtAddress['_empty'] . "</p>" : ''; ?>
    </div>
    <div class="form-row">
      <div class="col-md-6">
        <legend>Email:</legend>
        <?= $this->Form->text('email', [
      			'class' => 'form-control',
      			'placeholder' => 'Please, input your email..'
        ]); ?>
		    <?= (isset($email['_empty'])) ? "<p class='alert-danger'>" . $email['_empty'] . "</p>" : ''; ?>
        <?= (isset($email['email'])) ? "<p class='alert-danger'>" . $email['email'] . "</p>" : ''; ?>
		    <?= (isset($email['unique'])) ? "<p class='alert-danger'>" . $email['unique'] . "</p>" : ''; ?>
      </div>
      <div class="col-md-6">
        <legend>Phone number:</legend>
        <?= $this->Form->text('txtPhone', [
      			'class' => 'form-control',
      			'placeholder' => 'Please, input your phone number..'
        ]); ?>
		    <?= (isset($txtPhone['_empty'])) ? "<p class='alert-danger'>" . $txtPhone['_empty'] . "</p>" : ''; ?>
        <?= (isset($txtPhone['numeric'])) ? "<p class='alert-danger'>" . $txtPhone['numeric'] . "</p>" : ''; ?>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-6">
        <legend>Password:</legend>
        <?= $this->Form->text('txtPass', [
            'type' => 'password',
      			'class' => 'form-control',
      			'placeholder' => 'Please, input your password..'
        ]); ?>
		    <?= (isset($txtPass['_empty'])) ? "<p class='alert-danger'>" . $txtPass['_empty'] . "</p>" : ''; ?>
        <?= (isset($txtPass['minLength'])) ? "<p class='alert-danger'>" . $txtPass['minLength'] . "</p>" : ''; ?>
		    <?= (isset($txtPass['compare'])) ? "<p class='alert-danger'>" . $txtPass['compare'] . "</p>" : ''; ?>
      </div>
      <div class="col-md-6">
        <legend>Confirm password:</legend>
        <?= $this->Form->text('txtConfirmPass', [
            'type' => 'password',
      			'class' => 'form-control',
      			'placeholder' => 'Please, confirm your password..'
        ]); ?>
		    <?= (isset($txtConfirmPass['_empty'])) ? "<p class='alert-danger'>" . $txtConfirmPass['_empty'] . "</p>" : ''; ?>
        <?= (isset($txtConfirmPass['minLength'])) ? "<p class='alert-danger'>" . $txtConfirmPass['minLength'] . "</p>" : ''; ?>
      </div>
    </div>
    <?= $this->Form->button('Sign up', [
      	'name' => 'btnSignup',
  		  'class' => 'btn btn-primary'
    ]) ?>
	<?= $this->Form->end() ?>
</div>