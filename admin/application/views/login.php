<div class="row">
	<div class="large-6 columns">
		<h2>Login</h2>
		<?php if($error == 1) { ?>
			<p>Username dan password anda tidak cocok</p>
		<?php } ?>

		<form action="<?=base_url()?>users/login" method="post">
			<p><input type="text" name="username" placeholder="Username"></p>
			<p><input type="password" name="password" placeholder="Password"></p>
			<p><input type="submit" value="Login"></p>
		</form>		
	</div>

	<div class="large-6 columns">
		
	</div>
</div>
