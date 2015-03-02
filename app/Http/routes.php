<?php

use App\Models\Label;
use App\Models\Sound;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Format;
use App\Models\Dvd;
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

// Route::get('/dvds/{id}', 'DvdController@review');

Route::get('/dvds/create', 'DvdController@create');

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
