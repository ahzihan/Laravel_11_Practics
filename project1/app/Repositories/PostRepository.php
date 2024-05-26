<?php
namespace App\Repositories;

use App\Models\Book;

class PostRepository implements PostInterface
{
    public function all()
    {
        return Book::all();
    }
    public function index()
    {
        return Book::paginate(50);
    }
    public function store($data)
    {
        return Book::create($data);
    }
    public function show($id)
    {
        return Book::findOrFail($id);
    }
    public function update($data, $id)
    {
        return Book::findOrFail($id)->update($data);
    }
    public function delete($id)
    {
        return Book::findOrFail($id)->delete();

    }
}
