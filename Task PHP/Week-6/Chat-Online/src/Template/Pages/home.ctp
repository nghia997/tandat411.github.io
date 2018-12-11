<h2 class="text-center font-weight-bold badge-danger p-2">List item</h2>
<div class="modal-content flex-row">
  <div class="card-deck-wrapper col-md-12">
    <div class="card-deck">
    <?php foreach ($items as $row) { ?>
      <div class="card">
        <?= $this->Html->image($row->image, ['alt' => $row->name, 'class' => 'img-thumbnail w-100 h-50']) ?>
        <div class="card-block">
          <h4 class="card-title text-center"><?= $row->name; ?></h4>
          <p class="card-text">Description: <?= $row->description ?></p>
          <p class="card-text">Price: <?= $row->price ?></p>
          <?= $this->Html->link('CONTACT', 
              ['controller' => 'Pages', 'action' => 'room/' . $row->id]
          ) ?>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</div>
