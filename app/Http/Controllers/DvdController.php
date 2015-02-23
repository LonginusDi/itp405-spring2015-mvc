<?php namespace App\Http\Controllers;

use App\Models\DvdQuery;
use Illuminate\Http\Request;

class DvdController extends Controller {

	public function search()
	{
		$query = new DvdQuery;
		$genres = $query->searchGenre();
		$ratings = $query->searchRating();

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

	public function review($id)
	{
		$dvds = (new DvdQuery())->getDetails($id);
		$reviews = (new DvdQuery())->getReviews($id);
		$review_ratings = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');

		return view('review', [
			'id' => $id,
			'dvds' => $dvds,
			'review_ratings' => $review_ratings,
			'reviews' => $reviews
		]);
	}

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


}
