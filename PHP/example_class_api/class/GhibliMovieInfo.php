<?php

Class GhibliMovieInfo {

    private $api = 'http://studio-ghibli-films-api.herokuapp.com/api';
    private $arrays;
    private $keys;
    

    public function __construct()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api,
            CURLOPT_POST => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => 0,
            CURLOPT_TIMEOUT => 1
        ]);
        $data = curl_exec($curl);
        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return null;
        }
        $this->arrays = json_decode($data, true);
        $this->keys =  array_keys($this->arrays);
    }
    
    public function get_ghibli_api_info() : array
    {
        return $this->arrays;
    }

    public function get_movie_count() : array
    {
        return $this->keys;
    }
    
    /**
     * get_movies_title_list
     *
     * @return array
     */

    public function get_movies_title_list() : array
    {
        for ($i=0; $i < sizeof($this->keys); $i++) { 
            $list[] = $this->arrays[$this->keys[$i]]['title'];
        }
        return $list;
    }
    
    /**
     * get_movie_unique_info
     *
     * @param  string $name
     * @param  mixed $info is not always a string it can also be an array.
     */
    
    public function get_movie_unique_info(string $name, string $info)
    {
        $movieName = $this->arrays[$name];
        switch($info)
        {
            case 'title' :
                return $movieName['title'];
                break;
            case 'poster' :
                return $movieName['poster'];
                break;
            case 'genre' :
                return $movieName['genre'];
                break;
            case 'rating' :
                return $movieName['rating'];
                break;
            case 'release' :
                return $movieName['release'];
                break;
            case 'director' :
                return $movieName['director'];
                break;
            case 'screenwriters' :
                return $movieName['screenwriters'];
                break;
            case 'music' :
                return $movieName['music'];
                break;
            case 'runtimeMinutes' :
                return $movieName['runtimeMinutes'];
                break;
            case 'budgetUSD' :
                return $movieName['budgetUSD'];
                break;
            case 'boxOfficeUSD' :
                return $movieName['boxOfficeUSD'];
                break;
            case 'character' :
                foreach ($movieName['character'] as $value) {
                    return $value;
                }
                break;
            case 'awards' :
                return $movieName['awards'];
                break;
            case 'synopsis' :
                return $movieName['synopsis'];
                break;
            case 'reviews' :
                return $movieName['reviews'];
                break;
            case 'producers' :
                return $movieName['producers'];
                break;
        }
    }
}

