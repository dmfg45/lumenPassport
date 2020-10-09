<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BooksService{
    use ConsumesExternalService;

    /**
     * The base uri to consume the books service
     * @var string
     */

     public $baseUri;

      /**
     * The base uri to consume the books service
     * @var string
     */

     public $secret;
     
     public function __construct()
     {

        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
     }

      /** @return string */

      public function obtainBooks()
      {
         return $this->performRequest('GET', '/books');
 
      }
 
      /** @return string */
 
      public function createBooks($data)
      {
          return $this->performRequest('POST', '/books', $data);
      }
 
      /** @return string */
 
      public function obtainBook($book)
      {
          return $this->performRequest('GET', "/books/{$book}");
      }
 
      public function editBook($data, $book)
      {
          return $this->performRequest('PUT',"/books/{$book}/", $data);
      }
 
      public function deleteBook($book)
      {
          return $this->performRequest('DELETE', "/books/{$book}");
      }

}