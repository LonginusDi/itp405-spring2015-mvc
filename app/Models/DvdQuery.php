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


}