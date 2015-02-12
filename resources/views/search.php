<!doctype html>
<html>
<head>
	<title>DVD Search</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container col-md-6">
		<h1>DVD Search</h1>
		<form role="form" action="/dvds" method="get">
			<div class="form-group">
				<label for="dvd_title">Title: </label>
				<input type="text" name="dvd_title" class="form-control">
			</div>
			<div class="form-group">
				<label for="genre">Genre: </label>
				<select name="genre" class="form-control">
					<option value="">All</option>
					<?php foreach($genres as $genre) : ?>
					<option value="<?php echo $genre->id ?>">
						<?php echo $genre->genre_name ?>
					</option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label for="genre">Rating: </label>
				<select name="rating" class="form-control">
					<option value="">All</option>
					<?php foreach($ratings as $rating) : ?>
					<option value="<?php echo $rating->id ?>">
						<?php echo $rating->rating_name ?>
					</option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group"><input class="btn btn-primary btn-block" type="submit" value="search"></div>
		</form>
	</div>
</body>
</html>