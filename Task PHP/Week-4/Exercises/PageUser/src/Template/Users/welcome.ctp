<?php $user = $_SESSION['Auth']['User'] ?>
<div class="card col-4 m-auto">
  <img class="card-img-top" src="uploads/<?= $user['avatar'] ?>" alt="Avatar">
  <div class="card-block">
    <h4 class="card-title">WELLCOME</h4>
    <p class="card-text"><?= $user['name'] ?></p>
    <div class="list-group">
      <a href=<?= $this->request->base.'/change-password' ?> class="list-group-item">
				Change password
      </a>
      <a href=<?= $this->request->base.'/edit/'.$user['id'] ?> class="list-group-item">Update</a>
      <a href=<?= $this->request->base.'/logout' ?> class="list-group-item">Sign out</a>
    </div>
  </div>
</div>