
<h1>List post</h1>
<form action=<?= $this->request->here ?> method="post">
	<p>Search by Name: </p>
	<div class="form-inline">
		<input class="form-control" type="text" name="txtSearchPostByName" 
		placeholder="Search by name..">
		<button class="btn btn-success-outline ml-1 mb-3" type="submit" 
		name="btnSearchPostByName">
			Search
		</button>
	</div>
	<p>Search by Num of likes: </p>
	<div class="form-inline">
		<input class="form-control" type="text" name="txtSearchPostByLike" 
		placeholder="Search by Number of likes..">
		<button class="btn btn-success-outline ml-1 mb-3" type="submit" 
		name="btnSearchPostByLike">
			Search
		</button>
	</div>
	<p>Search by Date: </p>
	<div class="form-inline">
		<p>From:</p>
		<input class="form-control ml-2 mr-2" type="date" name="txtSearchPostFromDate" 
		placeholder="Search from date..">
		<p>- To:</p>
		<input class="form-control ml-2" type="date" name="txtSearchPostToDate" 
		placeholder="Search to date..">
		<button class="btn btn-success-outline ml-1 mb-3" type="submit" 
		name="btnSearchPostByDate">
			Search
		</button>
	</div>
</form>

<?php
// Check list post has data or not
if (isset($posts) && $posts != null) {
	$listPaginate = $posts;
	echo "<table class='table table-hover table-dark'>";
	echo "<tr class='text-warning text-uppercase font-weight-bold'>";
	// Run loop to get all field in table 'post_social'
	foreach ($posts[0] as $key => $value) {
		echo "<th>{$key}</th>";
	}
	echo "</tr>";
	// Run loop to get every row in table 'post_social'
	foreach ($posts as $row) {
		echo "<tr>";
		// Run loop to get every value on single row
		foreach ($row as $item) {
			echo "<td>{$item}</td>";
		}
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

