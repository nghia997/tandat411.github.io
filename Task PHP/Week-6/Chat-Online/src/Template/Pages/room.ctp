<?= $this->Form->input('js-room', ['type' => 'hidden', 'value' => $roomId]) ?>
<?= $this->Form->input('js-item', ['type' => 'hidden', 'value' => $item->id]) ?>
<?= $this->Form->input('js-client', ['type' => 'hidden', 'value' => $client['id']]) ?>
<?= $this->Form->input('js-from', ['type' => 'hidden', 'value' => 'client']) ?>
<nav class="navbar badge-danger">
  <h2 class="font-weight-bold d-block">ROOM: <?= $roomId ?></h2>
  <ul class="list-inline">
    <li class="list-inline-item"><?= $client['name'] ?></li>
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
  <div class="col-md-8 modal-content height-500">
    <h4 class="text-center"><?= $item->name ?></h4>
    <div id="js-history" class="show-message">
      <?php 
      foreach ($chats as $row) {
        if ($row->message_from == 'client') {
          echo "<div class='text-right border-top'>";
          echo "<span class='text-info'>" . $client['name'] . "</span></br>";
          echo "<p class='btn btn-primary'>" . $row->message . "</p></br>";
          echo '</div>';
        } 
        if ($row->message_from == 'shop') {
          echo "<hr><div>";
          echo "<span class='text-info'>" . $shop->name . "</span></br>";
          echo "<p class='btn btn-danger'>" . $row->message . "</p></br>";
          echo '</div>';
        }
      }
      ?>
    </div>
    <div class="modal-content mb-2 box-message">
      <nav class="navbar bg-warning">
        <p>Send messages</p>
        <?= $this->Form->button("<i class='fa fa-paper-plane'></i> Send", 
        ['class' => 'btn btn-primary font-weight-bold', 'id' => 'js-btn-send']) ?>
      </nav>
      <?= $this->Form->textarea('txtMessage', ['id' => 'js-message']) ?>
    </div>
  </div>
</div>

<!-- SCRIPT -->
<?= $this->Html->script('jquery-3.3.1.min.js') ?>
<?= $this->Html->script('chat.js') ?>