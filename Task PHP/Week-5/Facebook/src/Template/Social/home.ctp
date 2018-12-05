
<h1>List post</h1>
<?= $this->Form->create('PostSocial',[
	'type'=>'POST',
	'url'=>[
		'controller'=>'Social',
		'action'=>'postHome'
	]
]) ?>
<p>Search by Name: </p>
<div class="form-inline">
	<?= $this->Form->text('txtSearchPostByName', [
		'class' => 'form-control', 
		'placeholder' => 'Search by name..'
	]) ?>
	<?= $this->Form->button('Search', [
		'class' => 'btn btn-success-outline ml-1 mb-3',
		'name' => 'btnSearchPostByName',
	]) ?>
</div>
<p>Search by Num of likes: </p>
<div class="form-inline">
	<?= $this->Form->text('txtSearchPostByLike', [
		'class' => 'form-control', 
		'placeholder' => 'Search by Number of likes..'
	]) ?>
	<?= $this->Form->button('Search', [
		'class' => 'btn btn-success-outline ml-1 mb-3',
		'name' => 'btnSearchPostByLike',
	]) ?>
</div>
<p>Search by Date: </p>
<div class="form-inline">
	<p>From:</p>
	<?= $this->Form->text('txtSearchPostFromDate', [
		'class' => 'form-control ml-2 mr-2',
		'type' => 'date',
		'placeholder' => 'Search from date..'
	]) ?>
	<p>- To:</p>
	<?= $this->Form->text('txtSearchPostToDate', [
		'class' => 'form-control ml-2',
		'type' => 'date',
		'placeholder' => 'Search to date..'
	]) ?>
	<?= $this->Form->button('Search', [
		'class' => 'btn btn-success-outline ml-1 mb-3',
		'name' => 'btnSearchPostByDate',
	]) ?>
</div>
<?= $this->Form->end() ?>
<?php
// Check list post has data or not
 if (isset($posts) && $posts != null) {
	echo "<table class='table table-hover table-dark'>";
	echo "<tr class='text-warning text-uppercase font-weight-bold'>";
	// Run loop to get all field in table 'post_social'
	foreach ($columns as $field) {
		echo "<th>{$field}</th>";
	}
	echo "</tr>";
	// Run loop to get every row in table 'post_social'
	foreach ($posts as $row) {
		echo "<tr>";
		echo "<td>{$row->post_id}</td>";
		echo "<td>{$row->name}</td>";
		echo "<td>{$row->created_date}</td>";
		echo "<td>{$row->num_of_like}</td>";
		echo "<td>{$row->account_id}</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "
	<div class='float-right'>
	  <ul class='pagination'>
		{$this->Paginator->prev('« Previous ', ['class' => 'disabled'])}
		{$this->Paginator->numbers()}
		{$this->Paginator->next('Next »', ['class' => 'disabled'])}
	  </ul>
	  <p class='text-right clearfix'>
		 Page {$this->Paginator->counter('{{page}}/{{pages}}, show {{current}} of {{count}} posts')}
	  </p>
	</div>";
} else {
	echo '<h3>The list post no data to show</h3>';
}
?>

