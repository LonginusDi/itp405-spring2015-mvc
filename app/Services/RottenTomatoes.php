<?php namespace App\Services;

use Cache;

class RottenTomatoes{

	public static function search($dvd_title){

		if(Cache::has("details-$dvd_title")){
			$jsonString = Cache::get("details-$dvd_title");
		}else{
			$url_name = urlencode($dvd_title);

			$url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=hd2fth8jtze43bku43bvxju9&q=$url_name";
			$jsonString = file_get_contents($url);
			Cache::put("details-$dvd_title", $jsonString, 60);
		}
		
		return json_decode($jsonString)->movies;
		
	}
}
?>