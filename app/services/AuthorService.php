<?php


namespace App\services;


use App\Traits\ConsumesExternalService;

class AuthorService
{
    use ConsumesExternalService;

    /**
     * The base Uri to consume the authors service
     * @var string
     */
    public $baseUri;

    /**
     * @var string \Laravel\Lumen\Application|mixed
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    /**
     * @return string
     */
    public function obtainAuthors(){
        return $this->performRequest('GET','/authors');
    }

    /**
     * @param $author
     * @return string
     */
    public function showAuthor($author){
        return $this->performRequest('GET',"/authors/{$author}");
    }

    /**
     * @param $data
     * @return string
     */
    public function createAuthor($data){
        return $this->performRequest('POST',"/authors",$data);
    }

    /**
     * @param $data
     * @param $author
     * @return string
     */
    public function editAuthor($data, $author){
        return $this->performRequest('PUT',"/authors/{$author}",$data);
    }

    /**
     * @param $author
     * @return string
     */
    public function deleteAuthor($author){
        return $this->performRequest('DELETE',"/authors/{$author}");
    }

}
