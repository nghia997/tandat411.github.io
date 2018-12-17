<?= $this->Form->input('js-data-gold', ['type' => 'hidden', 'value' => json_encode($dataGold)]); ?>
<?= $this->Form->input('js-data-euro', ['type' => 'hidden', 'value' => json_encode($dataEuro)]); ?>
<?= $this->Form->input('js-data-gbp', ['type' => 'hidden', 'value' => json_encode($dataGBP)]); ?>
<?= $this->Form->input('js-data-yen', ['type' => 'hidden', 'value' => json_encode($dataYen)]); ?>
<?= $this->Form->input('js-data-usd', ['type' => 'hidden', 'value' => json_encode($dataUSD)]); ?>
<?= $this->Form->input('js-data-btc', ['type' => 'hidden', 'value' => json_encode($dataBTC)]); ?>

<div class="d-flex">
	<ul class="list-chart">
		<li id="js-chart-gold"></li>
		<li id="js-chart-currency"></li>
		<li id="js-chart-bitcoin"></li>
	</ul>
	<div>
		<h1 class='text-center'>List currency to day</h1>
		<table class='table table-hover table-dark'>
			<tr class='text-warning text-uppercase font-weight-bold'>
				<td>currency name</td>
				<td>buy</td>
				<td>transfer</td>
				<td>sell</td>
			</tr>
			<?php
			// Run loop for to get every single record
			foreach ($listCurrency as $item) {
				echo "<tr>";
				echo "<td>$item->name</td>";
				echo "<td>". number_format($item->buy) . " VNĐ</td>";
				if (!empty($item->buy_transfer_type)) {
					echo "<td>". number_format($item->buy_transfer_type) . " VNĐ</td>";
				} else {
					echo "<td></td>";
				}
				echo "<td>". number_format($item->sell) . " VNĐ</td>";
				echo "</tr>";
			} 
			?>
		</table>
	</div>
</div>

<?= $this->Html->script('canvasjs.min.js') ?>
<?= $this->Html->script('currency-chart.js') ?>
