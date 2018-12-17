<div class="col-md-3 m-auto">
	<h3>Login to Social</h3>
	<!-- <a class="btn btn-outline-primary" href="<?= $this->Instagram->getAuthUrl() ?>&scope=public_content">
		<i class="fab fa-instagram"></i> Log in with <b>Instagram</b>
	</a> -->
	<a class="btn btn-outline-primary" href=<?= $url ?>>
		<i class="fab fa-instagram"></i> Log in with <b>Instagram</b>
	</a>
	<!-- <?= $this->Html->link("
		<i class='fab fa-instagram'></i> Log in with <b>Instagram</b>", 
		['controller' => 'Instagram', 'action' => 'callback'],
		['class' => 'btn btn-outline-primary']
	) ?> -->
</div>
