<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository{

    protected $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    public function getAuthors($filter = '*'){
        $authors = Author::get();

        return $authors;
    }

    public function createAuthor(array $author){
        $author = Author::create([
            'name' => $author['name'],
            'user_id' => $author['user_id']
        ]);

        return $author;

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
        $author = $this->model->find($id);
        if ($author) {
            $author->update($data);
            return $author;
        }
        return null; // Author not found
    }

    public function delete($id)
    {
        $author = $this->model->find($id);
        if ($author) {
            $author->delete();
            return true; // Author deleted
        }
        return false; // Author not found
    }
    
}