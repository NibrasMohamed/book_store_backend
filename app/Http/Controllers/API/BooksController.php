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
    public function index(Request $request)
    {
        try {
            $data = $this->repository->books($request->search);

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
            
            if(isset($request->cover_image)){
                $cover = $this->repository->storeBookCover($request->cover_image,  str_replace(' ', '', $request->name));
            }else{
                $cover = null;
            }

            $book = [
                'name' => $request->name,
                'description' => $request->description,
                'published_date' => $request->published_date,
                'author_id' => $request->author_id,
                'image_path' => $cover
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
