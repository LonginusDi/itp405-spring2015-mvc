<?php

use App\Models\DvdQuery;
use App\Models\Label;
use App\Models\Sound;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Format;
use App\Models\Dvd;
use App\Services\RottenTomatoes;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('/dvds/search', 'DvdController@search');

Route::get('/dvds', 'DvdController@results');

Route::post('/dvds/review', 'DvdController@createReview');

Route::get('/dvds/create', 'DvdController@create');

Route::get('/dvds/{id}', function($id){
	$dvds = (new DvdQuery())->getDetails($id);
	$reviews = (new DvdQuery())->getReviews($id);
	$review_ratings = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
	$check = 0;

	if(!empty($dvds)){

		// if(Cache::has("details-$name")){
		// 	$jsonString = Cache::get("details-$name");
		// }else{
		// 	$url_name = urlencode($name);

		// 	$url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=hd2fth8jtze43bku43bvxju9&q=$url_name";
		// 	$jsonString = file_get_contents($url);
		// 	Cache::put("details-$name", $jsonString, 60);
		// }
		
		// $detailsData = json_decode($jsonString)->movies;
		
		$name = array_values($dvds)[0]->title;
		$detailsData = RottenTomatoes::search($name);

		if(!empty($detailsData)){

			$details = array_values($detailsData)[0]->title;

			foreach ($detailsData as $movie){
				if($movie->title == $name){
					$details = $movie;
					$check = 1;
				}
			}

			return view('review', [
				'id' => $id,
				'dvds' => $dvds,
				'review_ratings' => $review_ratings,
				'reviews' => $reviews,
				'details' => $details,
				'check' => $check
			]);
		}

		return view('review', [
			'id' => $id,
			'dvds' => $dvds,
			'review_ratings' => $review_ratings,
			'reviews' => $reviews,
			'check' => $check
		]);
	}

	return view('review', [
		'id' => $id,
		'dvds' => $dvds,
		'review_ratings' => $review_ratings,
		'reviews' => $reviews,
		'check' => $check
	]);
});

Route::post('/dvds', 'DvdController@createDvd');

Route::get('/genres/{name}/dvds', function($name){

	$genre = Genre::where('genre_name', '=', $name)->first()->pluck('id');

	$dvds = Dvd::with('genre', 'rating', 'label')
		->where('genre_id', '=', $genre)
		// ->where('rating_id', '=', 'rating.id')
		// ->where('label_id', '=', 'label.id')
		->get();

	return view('genre',[
		'dvds' => $dvds,
		'genre_name' => $name
	]);

});
