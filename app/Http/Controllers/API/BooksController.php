<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BooksController extends BaseAPIController
{
    private $repository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->repository = $bookRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->repository->all();

            return $this->successResponse($data, 'success', 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
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
            $book = [
                'name' => $request->name,
                'published_date' => $request->published_date,
                'author_id' => $request->author_id,
            ];
            $data = $this->repository->create($book);

            return $this->successResponse($data, 'success', 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            
            $data = $this->repository->find($id);

            return $this->successResponse($data, 'success', 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }
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
        try {
            $book = [
                'name' => $request->name,
                'published_date' => $request->published_date,
                'author_id' => $request->author_id,
            ];
            
            $data = $this->repository->update($book, $id);

            return $this->successResponse($data, 'Succesfully Updated', 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = $this->repository->delete($id);

            return $this->successResponse($data, 'Succesfully Deleted', 200);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }
    }
}