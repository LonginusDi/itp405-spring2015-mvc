<!doctype html>
<html>
<head>
	<title>{{ $genre_name }}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
	<div style="padding-left:0.5em;">
		<h1>{{ $genre_name }}</h1>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Title</th>
				<th>Rating</th>
				<th>Genre</th>
				<th>Label</th>				
			</tr>
		</thead>
		<tbody>
			@foreach ($dvds as $dvd)
			<tr>
				<td>{{ $dvd->title }}</td>
				<td>{{ $dvd->rating->rating_name }}</td>
				<td>{{ $dvd->genre->genre_name }}</td>
				<td>{{ $dvd->label->label_name }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>


	
	
</body>
</html>