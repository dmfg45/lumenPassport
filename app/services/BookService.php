<?php


namespace App\services;


use App\Traits\ConsumesExternalService;

class BookService
{
    use ConsumesExternalService;

    /**
     * The base Uri to consume the books service
     * @var string
     */
    public $baseUri;

    /**
     * @var string \Laravel\Lumen\Application|mixed
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * @return string
     */
    public function obtainBooks(){
        return $this->performRequest('GET','/books');
    }

    /**
     * @param $book
     * @return string
     */
    public function showBook($book){
        return $this->performRequest('GET',"/books/{$book}");
    }

    /**
     * @param $data
     * @return string
     */
    public function createBook($data){
        return $this->performRequest('POST',"/books",$data);
    }

    /**
     * @param $data
     * @param $book
     * @return string
     */
    public function editBook($data, $book){
        return $this->performRequest('PUT',"/books/{$book}",$data);
    }

    /**
     * @param $book
     * @return string
     */
    public function deleteBook($book){
        return $this->performRequest('DELETE',"/books/{$book}");
    }

}
