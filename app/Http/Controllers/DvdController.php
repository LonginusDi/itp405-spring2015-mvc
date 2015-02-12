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

}
