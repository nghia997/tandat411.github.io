<?= $this->Form->input('js-data-radar', ['type' => 'hidden', 'value' => $dataRadar]) ?>
<?= $this->Form->input('js-data-bar', ['type' => 'hidden', 'value' => $dataBar]) ?>
<?= $this->Form->input('js-data-pie', ['type' => 'hidden', 'value' => $dataPie]) ?>
<h1 class="text-center">Charts</h1>
<canvas id="js-radar-chart"></canvas>
<canvas id="js-pie-chart"></canvas>
<canvas id="js-bar-chart"></canvas>

<!-- SCRIPT -->
<?= $this->Html->script('jquery-3.3.1.min.js') ?>
<?= $this->Html->script('Chart.js') ?>
<?= $this->Html->script('chartjs-plugin-labels.min.js') ?>
<?= $this->Html->script('action.js') ?>
