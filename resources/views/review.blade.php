<!doctype html>
<html>
<head>
	<title>DVD Detail Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container col-md-6">
		<table class="table table-striped">
			<h3>Details</h3>
			<?php foreach ($dvds as $dvd) : ?>
				<tr>
					<th>Title</th>
					<td><?php echo $dvd->title ?></td>
				</tr>
				<tr>
					<th>Rating</th>				
					<td><?php echo $dvd->rating_name ?></td>
				</tr>
				<tr>
					<th>Genre</th>
					<td><?php echo $dvd->genre_name ?></td>
				</tr>
				<tr>
					<th>Label</th>
					<td><?php echo $dvd->label_name ?></td>
				</tr>
				<tr>			
					<th>Sound</th>
					<td><?php echo $dvd->sound_name ?></td>
				</tr>
				<tr>
					<th>Format</th>
					<td><?php echo $dvd->format_name ?></td>
				</tr>
				<tr>
					<th>Release Date</th>
					<td><?php echo $dvd->release_date ?></td>
				</tr>

				@if ($check === 1)
				<tr>
					<th>Critic Score</th>
					<td><?php echo $details->ratings->critics_score; ?></td>
				</tr>	
				<tr>
					<th>Audience Score</th>
					<td><?php echo $details->ratings->audience_score; ?></td>
				</tr>
				<tr>
					<th>Poster</th>
					<td><img src="<?php echo $details->posters->thumbnail; ?>"></td>
				</tr>	
				<tr>
					<th>Runtime</th>
					<td><?php echo $details->runtime; ?></td>
				</tr>
				<tr>
					<th>Abridged Cast</th>
					<td>
						@foreach ($details->abridged_cast as $cast)
							<?php echo $cast->name; ?>:
							@if (isset($cast->characters))
								<?php echo array_values($cast->characters)[0]; ?>
							@endif
							<br />
						@endforeach
					</td>
				</tr>
				@endif
			<?php endforeach ?>
		</table>

		<br/>

		<h3>Reviews</h3>

		<table class="table">

			<?php foreach ($reviews as $review) : ?>

				<tr>
					<th>Title</th>
					<td><?php echo $review->title ?></td>
				</tr>
				<tr>
					<th>Rating</th>				
					<td><?php echo $review->rating ?></td>
				</tr>
				<tr>
					<th>Description</th>
					<td><?php echo $review->description ?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>

			<?php endforeach ?>


		</table>	
	</div>
	<div class="container col-md-6">
		@foreach ($errors->all() as $errorMessage)
			<p class="text-danger"> {{ $errorMessage }} </p>
		@endforeach

		@if (Session::has('success'))
			<p class="text-success"> {{ Session::get('success') }}</p>
		@endif
		<h3>Add a review:</h3>
		<form role="form" action="/dvds/review" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
			<input type="hidden" name="dvd_id" value="<?php echo $id ?>">

			<div class="form-group">
				<label>Rating</label>
				<select class="form-control" name="review_rating">
					<?php foreach ($review_ratings as $review_rating) : ?>
						<?php if ($review_rating == Request::old('review_rating')) : ?>
							<option value="<?php echo $review_rating ?>" selected>  
								<?php echo $review_rating ?>
							</option>
						<?php else : ?>
							<option value="<?php echo $review_rating ?>">  
								<?php echo $review_rating ?>
							</option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label>Title</label>
				<input name="review_title" class="form-control" value="<?php echo Request::old('review_title')?>">
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea name="review_description" class="form-control"><?php echo Request::old('review_description')?></textarea>
			</div>
			<div class="form-group"><input class="btn btn-primary btn-block" type="submit" value="search"></div>
		</form>
	</div>

</body>
</html>