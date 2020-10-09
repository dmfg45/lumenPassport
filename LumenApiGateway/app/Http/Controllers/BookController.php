<?php

namespace App\Http\Controllers;

use App\Book;
use App\Services\AuthorService;
use App\Services\BooksService;
use App\Traits\ApiResponser;
//use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    public $bookService;

    /**
     * The service to consume the books microservice
     * @var BooksService
     */

    public $authorService;

    /**
     * The service to consume the books microservice
     * @var AuthorService
     */

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BooksService $bookService, AuthorService $authorService)
    {
       $this->bookService = $bookService;
       $this->authorService = $authorService;
    }

    /**
     * Return List of books
     * @return Illuminate\Http\Response
     */

    public function index(){
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Return List of books
     * @return Illuminate\Http\Response
     */

    public function store(Request $request){

        $this->authorService->obtainAuthor($request->author_id);

        return $this->successResponse($this->bookService->createBooks($request->all(), Response::HTTP_CREATED));

    }

    
    /**
     * Shows List of books
     * @return Illuminate\Http\Response
     */

    public function show($book){
        return $this->successResponse($this->bookService->obtainBook($book));

    }

    /**
     * Shows List of books
     * @return Illuminate\Http\Response
     */

    public function update(Request $request,$book){
        return $this->successResponse($this->bookService->editBook($request->all(), $book));
    }


    /**
     * Shows List of books
     * @return Illuminate\Http\Response
     */

    public function destroy($book)
    {
        return $this->successResponse($this->bookService->deleteBook($book));
    }

    //
}
