<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\services\AuthorService;
use App\services\BookService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BooksController extends Controller
{
    use ApiResponser;

    /**
     * @var BookService
     */
    public $bookService;

    /**
     * @var AuthorService
     */
    public $authorService;

    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * @return \Illuminate\Http\Response
     * @return  \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->authorService->showAuthor($request->author_id);
        return $this->successResponse($this->bookService->createBook($request->all(),Response::HTTP_CREATED));
    }

    /**
     *
     * @return  Illuminate\Http\Response
     */
    public function show($book)
    {
        return $this->successResponse($this->bookService->showBook($book));
    }

    /**
     *
     * @return  Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        return $this->successResponse($this->bookService->editBook($request->all(),$book));
    }

    /**
     *
     * @return  Illuminate\Http\Response
     */
    public function destroy($book)
    {
        return $this->successResponse($this->bookService->deleteBook($book));
    }

}
