<div class="col-5 m-auto form-control">
  <h1 class="text-center">SIGN UP</h1>
  <?= $this->Form->create(null, ['type' => 'post', 'url' => ['action' => 'postRegister']]) ?>
    <div class="form-row">
      <legend>Username:</legend>
      <?= $this->Form->text('txtName', [
	    	'class' => 'form-control', 
	    	'placeholder' => 'Please, enter your name..'
      ]) ?>
	  <?= (isset($txtName['_empty'])) ? "<p class='alert-danger'>" . $txtName['_empty'] . "</p>" : '';?>
    </div>
    <div class="form-row">
        <legend>Email:</legend>
        <?= $this->Form->text('email', [
	    	'class' => 'form-control', 
	    	'placeholder' => 'Please, enter your email..'
      	]) ?>
		<?= (isset($email['_empty'])) ? "<p class='alert-danger'>" . $email['_empty'] . "</p>" : ''; ?>
		<?= (isset($email['email'])) ? "<p class='alert-danger'>" . $email['email'] . "</p>" : ''; ?>
		<?= (isset($email['unique'])) ? "<p class='alert-danger'>" . $email['unique'] . "</p>" : ''; ?>
    </div>
    <div class="form-row">
      <div class="col-md-6">
        <legend>Password:</legend>
        <?= $this->Form->text('txtPass', [
        	'type' => 'password',
	    	'class' => 'form-control', 
	    	'placeholder' => 'Please, enter your password..'
      	]) ?>

		<?= (isset($txtPass['_empty'])) ? "<p class='alert-danger'>" . $txtPass['_empty'] . "</p>" : ''; ?>
		<?= (isset($txtPass['minLength'])) ? "<p class='alert-danger'>" . $txtPass['minLength'] . "</p>" : ''; ?>
		<?= (isset($txtPass['compare'])) ? "<p class='alert-danger'>" . $txtPass['compare'] . "</p>" : ''; ?>
      </div>
      <div class="col-md-6">
        <legend>Confirm password:</legend>
        <?= $this->Form->text('txtConfirmPass', [
			    'type' => 'password',
	        'class' => 'form-control', 
	        'placeholder' => 'Please, enter your confirm your password..'
      	]) ?>

		<?= (isset($txtConfirmPass['_empty'])) ? "<p class='alert-danger'>" . $txtConfirmPass['_empty'] . "</p>" : ''; ?>
		<?= (isset($txtConfirmPass['minLength'])) ? "<p class='alert-danger'>" . $txtConfirmPass['minLength'] . "</p>" : ''; ?>
      </div>
    </div>
    <div class="g-recaptcha" data-sitekey="6LeaWoIUAAAAAE9kwK5K82tq3WGfBlWtJ4izM1HO"></div>
    <?= $this->Form->button('Sign up', ['class' => 'btn btn-primary mt-2']) ?>
  <?= $this->Form->end() ?>
</div>
