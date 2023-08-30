<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository{
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function books($search){
        $books = Book::join('authors', 'authors.id', 'books.author_id')
                ->select(
                    'books.name',
                    'authors.name as author',
                    'books.published_date',
                    'books.description',
                    'books.image_path',
                )->where('authors.status', '=', 1);
        if ($search != '') {
            $books->where(function($query) use ($search){
                $query->where('books.name','like', '%'.$search.'%');
                $query->orWhere('authors.name','like', '%'.$search.'%');
            });
        }

        $books = $books->get();

        return $books;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $book = $this->model->find($id);
        if ($book) {
            $book->update($data);
            return $book;
        }
        return null; // Book not found
    }

    public function delete($id)
    {
        $book = $this->model->find($id);
        if ($book) {
            $book->delete();
            return true; // Book deleted
        }
        return false; // Book not found
    }

    public function storeBookCover($file, $fileName = "cover", $filePath = '/covers')
    {
        // Ensure the file is an image
        if ($file->isValid() && strpos($file->getMimeType(), 'image/') === 0) {
            // Get the original file extension
            $fileExtension = $file->getClientOriginalExtension();

            // Generate a unique filename with the original extension
            $fileAssignedName = time() . '_' . $fileName . '.' . $fileExtension;

            // Store the image in the specified directory with the assigned name
            $file->storeAs($filePath, $fileAssignedName, 'public');

            // Return the path to the stored image
            return $filePath . '/' . $fileAssignedName;
        }

        return null;
    }

    public function getAuthorBooks($author_id){
        $books = Book::where('author_id', '=', $author_id)->get();

        return $books;
    }
}