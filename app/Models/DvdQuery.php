<?php namespace App\Models;

use DB;

class DvdQuery{

	public function searchGenre(){
		return DB::table('genres')->get();

		// $query = DB::table('songs')
		// ->join('artists', 'artists.id', '=', 'songs.artists_id')
		// ->join('genres', 'genres.id', '=', 'songs.genre_id');

		// if ($term) {
		// 	$query->where('title', 'LIKE', '%' . $request->input('song_title') . '%');
		// }
		
		// $query->orderBy('artist_name', 'asc');

		// return $query->get();
	}

	public function searchRating(){
		return DB::table('ratings')->get();
	}

	public function search($title, $genre, $rating){
		$query = DB::table('dvds')
		->join('genres', 'genres.id', '=', 'dvds.genre_id')
		->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
		->join('formats', 'formats.id', '=', 'dvds.format_id')
		->join('labels', 'labels.id', '=', 'dvds.label_id')
		->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
		->where('title', 'LIKE', '%' . $title . '%');

		if($genre){
			$query->where('genre_id', '=', $genre);
		}

		if($rating){
			$query->where('rating_id', '=', $rating);
		}


		// ->select('genres.*', 'genres.genre_name')
		// ->select('ratings.*', 'ratings.rating_name')
		// ->select('labels.*', 'labels.label_name')
		// ->select('sounds.*', 'sounds.sound_name')
		// ->select('formats.*', 'formats.format_name')
		$query->select('dvds.*', 'dvds.id', 'title', 'ratings.rating_name', 'genres.genre_name', 'labels.label_name', 'sounds.sound_name', 'formats.format_name');

		$query->orderBy('title', 'asc');

		return $query->get();
	}

	public function getGenreName($genre){
		if($genre){
			return DB::table('genres')
			->where('id', '=', $genre)
			->pluck('genre_name');
		}else{
			return "N/A";
		}
	}

	public function getRatingName($rating){
		if($rating){
			return DB::table('ratings')
			->where('id', '=', $rating)
			->pluck('rating_name');
		}else{
			return "N/A";
		}
	}

	public function getDetails($id){
		$query = DB::table('dvds')
		->join('genres', 'genres.id', '=', 'dvds.genre_id')
		->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
		->join('formats', 'formats.id', '=', 'dvds.format_id')
		->join('labels', 'labels.id', '=', 'dvds.label_id')
		->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
		->where('dvds.id', '=', $id);


		// $query->select('dvds.*', 'dvds.id', 'title', 'ratings.rating_name', 'genres.genre_name', 'labels.label_name', 'sounds.sound_name', 'formats.format_name');


		return $query->get();
	}

	public function getReviews($id){
		$query = DB::table('reviews')
		->where('dvd_id', '=', $id);

		return $query->get();
	}
	public static function validate($input){

		return \Validator::make($input,[
			'review_rating' => 'required|numeric',
			'review_title' => 'required|min:5',
			'review_description' => 'required|min:20',
			'dvd_id' => 'required|integer'
 		]);
	}

	public static function create($data){
		return DB::table('reviews')->insert($data);
	}


}