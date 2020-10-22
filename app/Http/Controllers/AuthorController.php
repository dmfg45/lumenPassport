<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\services\AuthorService;
use App\Traits\ApiResponser;
use \Illuminate\Http\Response;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * @var AuthorService
     *
     */
    public $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     *
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
       return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * @return \Illuminate\Http\Response
     * @return  \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all(),Response::HTTP_CREATED));
    }

    /**
     *
     * @return  Illuminate\Http\Response
     */
    public function show($author)
    {
        return $this->successResponse($this->authorService->showAuthor($author));
    }

    /**
     *
     * @return  Illuminate\Http\Response
     */
    public function update(Request $request, $author)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(),$author));
    }

    /**
     *
     * @return  Illuminate\Http\Response
     */
    public function destroy($author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }

}
