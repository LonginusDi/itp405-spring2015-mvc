<?php namespace App\Http\Controllers;

use App\Models\DvdQuery;
use Illuminate\Http\Request;

use App\Models\Label;
use App\Models\Sound;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Format;
use App\Models\Dvd;


class DvdController extends Controller {

	public function search()
	{
		$query = new DvdQuery;
		$ratings = $query->searchRating();

		$genres = Genre::all();

		return view('search', [
			'genres' => $genres,
			'ratings' => $ratings
		]);
	}

	public function results(Request $request)
	{
		$queryTitle = $request->input('dvd_title');
		$queryGenre = $request->input('genre');
		$queryRating = $request->input('rating');
		$dvds = (new DvdQuery())->search($queryTitle, $queryGenre, $queryRating);
		// dd($songs);

		$genre_name = (new DvdQuery())->getGenreName($queryGenre);
		$rating_name = (new DvdQuery())->getRatingName($queryRating);


		return view('results', [
			'dvd_title' => $queryTitle,
			'genre' => $genre_name,
			'rating' => $rating_name,
			'dvds' => $dvds
		]);
	}

	// public function review($id)
	// {
	// 	$dvds = (new DvdQuery())->getDetails($id);
	// 	$reviews = (new DvdQuery())->getReviews($id);
	// 	$review_ratings = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');

	// 	return view('review', [
	// 		'id' => $id,
	// 		'dvds' => $dvds,
	// 		'review_ratings' => $review_ratings,
	// 		'reviews' => $reviews
	// 	]);
	// }

	public function createReview(Request $request){

		$validation = DvdQuery::validate($request->all());
		$dvd_id = $request->input('dvd_id');

 		if($validation->passes()){
 			DvdQuery::create([
 				'rating' => $request->input('review_rating'),
 				'title' => $request->input('review_title'),
 				'description' => $request->input('review_description'),
 				'dvd_id' => $request->input('dvd_id')

 			]);

 			return redirect('/dvds/' . $dvd_id)->with('success', 'Review successfully saved');

 		}else{
 			return redirect('/dvds/' . $dvd_id)
 				->withInput()
 				->withErrors($validation);
 		}
	}

	public function create(){
		$labels = Label::all();
		$sounds = Sound::all();
		$genres = Genre::all();
		$ratings = Rating::all();
		$formats = Format::all();

		return view('create', [
			'labels' => $labels,
			'sounds' => $sounds,
			'genres' => $genres,
			'ratings' => $ratings,
			'formats' => $formats
		]);

	}

	public function createDvd(Request $request){

		$validation = \Validator::make($request->all(),[
			'title' => 'required'
 		]);

 		if($validation->passes()){

 			$dvd = new Dvd();

			$dvd->title = $request->input('title');
			$dvd->label_id = $request->input('label');
			$dvd->sound_id = $request->input('sound');
			$dvd->genre_id = $request->input('genre');
			$dvd->rating_id = $request->input('rating');
			$dvd->format_id = $request->input('format');

			$dvd->save();

			return redirect('/dvds/create')->with('success', 'Dvd successfully inserted');

		}else{
			return redirect('/dvds/create')
				->withInput()
				->withErrors($validation);
		}
	}
}
