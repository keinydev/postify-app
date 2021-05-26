<?php include VIEWS_LAYOUT . 'header.php'; ?>

<div class="container">
	<form action="/user/create" method="POST">
		
		<h1>Create an account</h1>	

		<label for="username">Username</label>
		<input value="<?php if(isset($formData)) echo $formData['username']; ?>" type="text" id="username" name="username" />

		<?php if(isset($errors["username"])) { ?>
			<label class="error">
				<?php echo $errors['username']; ?>
			</label>
		<?php } ?>

		<label for="phone">Phone</label>
		<input value="<?php if(isset($formData)) echo $formData['phone']; ?>" type="text" id="phone" name="phone" />

		<?php if(isset($errors["phone"])) { ?>
			<label class="error">
				<?php echo $errors['phone']; ?>
			</label>
		<?php } ?>
		
		<label for="email">Email</label>
		<input value="<?php if(isset($formData)) echo $formData['email']; ?>" type="text" id="email" name="email" />

		<?php if(isset($errors["email"])) { ?>
			<label class="error">
				<?php echo $errors['email']; ?>
			</label>
		<?php } ?>
	    
		<label for="password">Password</label>
		<input value="<?php if(isset($formData)) echo $formData['password']; ?>" type="password" id="password" name="password" />
		
		<?php if(isset($errors["password"])) { ?>
			<label class="error">
				<?php echo $errors['password']; ?>
			</label>
		<?php } ?>
		
		<input type="submit" name="signUpForm" value="Submit" />

		<?php if (isset($saveError)){ ?>
			<h2>Error saving data. Please try again.</h2>
		<?php } ?>

		<small><a href="/user/login">Log In</a></small>
	</form>
</div>

<?php include VIEWS_LAYOUT . 'footer.php'; ?>