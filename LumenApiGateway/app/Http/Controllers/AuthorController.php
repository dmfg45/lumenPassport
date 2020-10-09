<?php

namespace App\Http\Controllers;

use App\Author;
use App\Services\AuthorService;
use App\Traits\ApiResponser;
//use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponser;

    public $authorService;

    /**
     * The service to consume the authors microservice
     * @var AuthorService
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return List of Authors
     * @return Illuminate\Http\Response
     */

    public function index(){
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * Return List of Authors
     * @return Illuminate\Http\Response
     */

    public function store(Request $request){

        return $this->successResponse($this->authorService->createAuhtors($request->all(), Response::HTTP_CREATED));

    }

    
    /**
     * Shows List of Authors
     * @return Illuminate\Http\Response
     */

    public function show($author){
        return $this->successResponse($this->authorService->obtainAuthor($author));

    }

    /**
     * Shows List of Authors
     * @return Illuminate\Http\Response
     */

    public function update(Request $request,$author){
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }


    /**
     * Shows List of Authors
     * @return Illuminate\Http\Response
     */

    public function destroy($author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }


    //
}
