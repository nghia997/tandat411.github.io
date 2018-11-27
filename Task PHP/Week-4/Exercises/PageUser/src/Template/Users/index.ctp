<!-- MENU BAR -->
<nav class="navbar navbar-expand-lg">
  <ul class="nav navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link alert-link" href="<?= $this->url->build('/Users/login') ?>">Sign in</a>
    </li>
    <li class="nav-item">
      <a class="nav-link alert-link" href="<?= $this->url->build('/Users/register') ?>"> Sign up</a>
    </li>
  </ul>
  <!-- SORT DATA -->
  <div class="dropdown show mr-3">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by</a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <p class="dropdown-item">
        <?php echo $this->Paginator->sort("id", "No sort");?>
      </p>
      <p class="dropdown-item">
        <?php echo $this->Paginator->sort("name", "Sort by Name");?>
      </p>
      <p class="dropdown-item">
        <?php echo $this->Paginator->sort("sex", "Sort by Sex");?>
      </p>
      <p class="dropdown-item">
        <?php echo $this->Paginator->sort("email", "Sort by Email");?>
      </p>
      <p class="dropdown-item">
        <?php echo $this->Paginator->sort("first_login_time", "Sort by First Login");?>
      </p>
      <p class="dropdown-item">
        <?php echo $this->Paginator->sort("last_login_time", "Sort by Last Login");?>
      </p>
      <p class="dropdown-item">
        <?php echo $this->Paginator->sort("num_of_login", "Sort by Times Login");?>
      </p>
    </div>
  </div>
  <!-- SEARCH DATA -->
  <form class="form-inline" action=<?= $this->request->here ?> method="post">
    <input class="form-control mt-3" type="text" name="txtSearch" placeholder="Input your keyword..">
    <button class="btn btn-success-outline ml-2" type="submit" name="btnSearch">Search</button>
    <?php
    if (isset($txtSearch['_empty'])) {
    	echo "<script> alert('".$txtSearch['_empty']."'); </script>";
    }
	  ?>
  </form>
</nav>

<!-- SHOW DATA -->
<?php
// Check list user has data or not
if ($users == null) {
	echo "<h1 class='text-center'>No data to show</h1>";
} else {

	echo "<table class='table table-hover table-dark'>";
	echo "<tr class='text-warning text-uppercase font-weight-bold'>";
	// Run loop foreach to get all fields of table
	foreach ($users[0] as $key => $value) {
		echo "<td>$key</td>";
	}
	echo "<th colspan='3'>ACTION</th>";
	echo "</tr>";
	// Run loop for to get every single record
	for ($i = 0; $i < count($users); $i++) {
		echo "<tr class='text-light'>";
		// Run loop foreach to get value of field on table
		foreach ($users[$i] as $item) {
			echo "<td>$item</td>";
		}

		echo "<td>
				<a href=" . $this->request->base . "/info/" . $users[$i]['id'] . ">Detail</a>
			  </td>";
		echo "<td>".
			$this->Html->link('Delete',
			['action' => 'delete', 'id' => $users[$i]['id']],
        		['confirm' => 'Are you sure you want to delete this user?'])
			  ."</td>";
		echo "<td>
				<a href=" . $this->request->base . "/edit/" . $users[$i]['id'] . ">Edit</a>
			  </td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>

<!-- PAGINATION -->
<div class="float-right">
  <ul class="pagination">
	<?php
	echo $this->Paginator->prev('« Previous ', ['class' => 'disabled']);
	echo $this->Paginator->numbers();
	echo $this->Paginator->next('Next »', ['class' => 'disabled']);
	?>
  </ul>
  <p class="text-right clearfix">
	<?= " Page ". $this->Paginator->counter('{{page}}/{{pages}}, show {{current}} of {{count}} users') ?>
  </p>
</div>

