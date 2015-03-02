<!doctype html>
<html>
<head>
	<title>DVD Insert Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	
	<div class="container col-md-6">
		@foreach ($errors->all() as $errorMessage)
			<p class="bg-danger" style="margin-top:20px;"> {{ $errorMessage }} </p>
		@endforeach

		@if (Session::has('success'))
			<p class="bg-success" style="margin-top:20px;"> {{ Session::get('success') }}</p>
		@endif

		<h3>Insert a DVD:</h3>
		<form role="form" action="/dvds/" method="post">

			<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

			<div class="form-group">
				<label>Title</label>
				<input name="title" class="form-control" value="<?php echo Request::old('title')?>">
			</div>

			<div class="form-group">
				<label>Label</label>
				<select class="form-control" name="label">
					<?php foreach ($labels as $label) : ?>
						<?php if ($label->id == Request::old('label')) : ?>
							<option value="<?php echo $label->id ?>" selected>  
								<?php echo $label->label_name ?>
							</option>
						<?php else : ?>
							<option value="<?php echo $label->id ?>">  
								<?php echo $label->label_name ?>
							</option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label>Sound</label>
				<select class="form-control" name="sound">
					<?php foreach ($sounds as $sound) : ?>
						<?php if ($sound->id == Request::old('sound')) : ?>
							<option value="<?php echo $sound->id ?>" selected>  
								<?php echo $sound->sound_name ?>
							</option>
						<?php else : ?>
							<option value="<?php echo $sound->id ?>">  
								<?php echo $sound->sound_name ?>
							</option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label>Genre</label>
				<select class="form-control" name="genre">
					<?php foreach ($genres as $genre) : ?>
						<?php if ($genre->id == Request::old('genre')) : ?>
							<option value="<?php echo $genre->id ?>" selected>  
								<?php echo $genre->genre_name ?>
							</option>
						<?php else : ?>
							<option value="<?php echo $genre->id ?>">  
								<?php echo $genre->genre_name ?>
							</option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label>Rating</label>
				<select class="form-control" name="rating">
					<?php foreach ($ratings as $rating) : ?>
						<?php if ($rating->id == Request::old('rating')) : ?>
							<option value="<?php echo $rating->id ?>" selected>  
								<?php echo $rating->rating_name ?>
							</option>
						<?php else : ?>
							<option value="<?php echo $rating->id ?>">  
								<?php echo $rating->rating_name ?>
							</option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>
			
			<div class="form-group">
				<label>Format</label>
				<select class="form-control" name="format">
					<?php foreach ($formats as $format) : ?>
						<?php if ($format->id == Request::old('format')) : ?>
							<option value="<?php echo $format->id ?>" selected>  
								<?php echo $format->format_name ?>
							</option>
						<?php else : ?>
							<option value="<?php echo $format->id ?>">  
								<?php echo $format->format_name ?>
							</option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group"><input class="btn btn-primary btn-block" type="submit" value="search"></div>
		</form>
	</div>

</body>
</html>