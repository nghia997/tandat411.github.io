<?php $user = $this->request->getSession()->read('Auth.User'); ?>
<?= $this->Form->input('js-from', ['type' => 'hidden', 'value' => 'shop']) ?>
<nav class="navbar badge-danger">
  <h2 class="font-weight-bold d-block">Chat group</h2>
  <ul class="list-inline">
    <li class="list-inline-item"><?= $user['name'] ?></li>
    <li class="list-inline-item">
      <i class="fa fa-power-off"></i>
    <?= $this->Html->link('Logout', 
      ['controller' => 'Pages', 'action' => 'logout'],
      ['class' => 'font-weight-bold text-light']
    ) ?>
    </li>
  </ul>
</nav>
<div class="modal-content flex-row">
  <div class="col-md-4">
    <h4>GROUP</h4>
    <ul id="js-list-group">
      <?php foreach($groups as $group) { ?>
      <li class="border alert-info p-2">
        <?= $this->Form->input('js-group-id', ['type' => 'hidden', 'value' => $group->id]) ?>
        <i class="fas fa-comments"></i> Room [<?= $group->room_id ?>]
      </li>
      <?php } ?>
    </ul>
  </div>
  <div class="col-md-8 modal-content height-500" id="js-group">
    <h4>MESSAGE</h4>
    <h1 class="text-center"><i class="fas fa-comments"></i></h1>
    <h3 class="text-center text-info">Choose a room to start chat!</h3>
  </div>
</div>

<!-- SCRIPT -->
<?= $this->Html->script('jquery-3.3.1.min.js') ?>
<?= $this->Html->script('group-chat.js') ?>