<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Http\Request;

class AuthorController extends BaseAPIController
{
    private $repository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->repository = $authorRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $authors = $this->repository->getAuthors();

            return $this->successResponse($authors, 'success', 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $author = [
                'name' => $request->name,
                'user_id' => $request->user_id
            ];

            $data = $this->repository->createAuthor($author);

            return $this->successResponse($data, 'success', 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
