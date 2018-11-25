<div class="col-5 card m-auto">
	<img class="card-img-top" src="../uploads/<?= $user['avatar'] ?>" alt="Avatar">
	<div class="card-block">
		<h4 class="card-title">Infomation</h4>
        <ul class="list-group m-0">
			<li class="list-group-item">
				<span>Username: </span>
				<b><?= $user['name'] ?></b>
			</li>
			<li class="list-group-item">
				<span>Sex:</span>
				<b><?= $user['sex'] ?></b>
			</li>
			<li class="list-group-item">
				<span>Email: </span>
				<b><?= $user['email'] ?></b>
			</li>
		</ul>
		<ul class="list-inline m-0 mt-1">
			<li class="list-inline-item">
				<a href="<?= $this->request->base ?>"><i class="fa fa-arrow-left"></i>Back</a>
			</li>
		</ul>
	</div>
</div>