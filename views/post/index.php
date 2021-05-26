<?php include VIEWS_LAYOUT . 'header.php'; ?>

<div class="container">

	<nav>
		<a href="#">Welcome <?php echo $user ?? ''; ?></a>
		<a href="/user/logout" class="button-link logout">Log out</a>
	</nav>
	
	
	<form action="/post/filter" method="POST" class="margin-top">
		<h1>Messages</h1>	

		<input value="<?php echo $formData['searchFilter'] ?? ''; ?>" placeholder="Search" type="text" id="searchFilter" name="searchFilter" />
		
		<input value="<?php echo $formData['dateFilter'] ?? ''; ?>" placeholder="date" type="text" id="dateFilter" name="dateFilter" />

		<input type="submit" name="submitFilter" value="Filter" />

		<small><a href="/post/index">Restore filter</a></small>
	</form>

	<div class="main margin-top">
		<?php if(isset($posts) && count($posts) > 0) { ?>
			<ul id="menu">
				<?php foreach ($posts as $post) { ?> 
					<li>
						<label><?php echo $post["date"]; ?></label>
						<label><?php echo $post["post"]; ?></label>
						<label></label><strong>By: <?php echo $post["username"]; ?></strong></label>
					</li>
				<?php } ?> 
			</ul>
		<?php } else { ?>
			No posts to show
		<?php }  ?>
	</div>

	<form action="/post/create" method="POST" class="margin-top">

		<label for="post">Write a Comment</label>
		<input value="<?php echo $formData['post'] ?? ''; ?>" type="text" id="post" name="post" />
		
		<?php if(isset($errors["post"])) { ?>
			<label class="error">
				<?php echo $errors['post']; ?>
			</label>
		<?php } ?>
		
		<input type="submit" name="submitPost" value="Submit" />

		<?php if (isset($saveError)){ ?>
			<h2>Error saving data. Please try again.</h2>
		<?php } ?>
	</form>
</div>

<?php include VIEWS_LAYOUT . 'footer.php'; ?>