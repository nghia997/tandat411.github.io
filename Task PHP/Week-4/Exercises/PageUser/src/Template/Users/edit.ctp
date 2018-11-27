<div class="card">
  <h1 class="card-header">
	Edit user: <?= $user->name ?>
  </h1>
  <div class="card flex-row">
    <img class="col-md-4" src=<?= $this->Url->build("/uploads/$user->avatar") ?> alt="avatar">
    <div class="col-md-8">
      <form action=<?= $this->request->here ?> method="post" enctype="multipart/form-data">
        <div class="form-group">
          <legend>Avatar:</legend>
          <input type="file" class="form-control" name="txtAvatar">
  		    <?php
  				if (isset($txtAvatar['wrongExtension'])) {
  					echo "<p class='alert-danger'>".$txtAvatar['wrongExtension']."</p>";
  				}
  			  ?>
        </div>
        <div class="form-row">
          <div class="col-md-9">
            <legend>Username:</legend>
            <input type="text" class="form-control" name="txtName" placeholder="Please, input your name.." value=<?= $user->name ?>>
      			<?php
    				if (isset($txtName['_empty'])) {
    					echo "<p class='alert-danger'>".$txtName['_empty']."</p>";
    				}
      			?>
          </div>
          <div class="col-md-3">
            <legend>Sex:</legend>
            <select class="custom-select" name="txtSex">
              <option value="male" <?= ($user->sex == 'male') ? 'selected' : '' ?>>Male</option>
              <option value="female" <?= ($user->sex == 'female') ? 'selected' : '' ?>>Female</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <legend>Address:</legend>
          <input type="text" class="form-control" name="txtAddress" placeholder="Please, input your address.." value=<?= $user->address ?>>
    			<?php
  				if (isset($txtAddress['_empty'])) {
  					echo "<p class='alert-danger'>".$txtAddress['_empty']."</p>";
  				}
    			?>
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <legend>Email:</legend>
            <input type="text" class="form-control" name="txtEmail" placeholder="Please, input your email.." value=<?= $user->email ?>>
      			<?php
    				if (isset($txtEmail['_empty'])) {
    					echo "<p class='alert-danger'>" . $txtEmail['_empty'] . "</p>";
    				}
    				if (isset($txtEmail['email'])) {
    					echo "<p class='alert-danger'>" . $txtEmail['email'] . "</p>";
    				}
    				if (isset($txtEmail['existEmail'])) {
    					echo "<p class='alert-danger'>" . $txtEmail['existEmail'] . "</p>";
    				}
      			?>
          </div>
          <div class="col-md-6">
            <legend>Phone number:</legend>
            <input type="text" class="form-control" name="txtPhone" placeholder="Please, input your phone number.." value=<?= $user->phone ?>>
      			<?php
    				if (isset($txtPhone['_empty'])) {
    					echo "<p class='alert-danger'>".$txtPhone['_empty']."</p>";
    				}
    				if (isset($txtPhone['numeric'])) {
    					echo "<p class='alert-danger'>".$txtPhone['numeric']."</p>";
    				}
      			?>
          </div>
        </div>
        <input type="submit" class="btn btn-primary" id="btnSignup" value="Save">
      </form>
    </div>
  </div>
</div>
