<?php include VIEWS_LAYOUT . 'header.php'; ?>

<div class="container">
	<form action="/user/auth" method="POST">
		
		<h1>Log In</h1>	

		<label for="username">Username</label>
		<input value="" type="text" id="username" name="username" />
	    
		<label for="password">Password</label>
		<input value="" type="password" id="password" name="password" />
		
		<?php if(isset($error)) { ?>
			<label class="error">
				Invalid username or password
			</label>
		<?php } ?>
		
		<input type="submit" name="loginForm" value="Log In" />

		<small><a href="/user/signup">Create an account</a></small>
	</form>
</div>

<?php include VIEWS_LAYOUT . 'footer.php'; ?>