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
}