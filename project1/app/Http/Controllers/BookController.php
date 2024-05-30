<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Book;
use App\Repositories\PostInterface;

class BookController extends Controller
{
    protected $post;

    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        /**
        1.count
        2.countBy -- frequency
        3.min
        4.max
        5.avg
        6.sum
        7.random
        8.median -- middle
        9.mode -- frequency
         */

        // $result = [];
        // $result['totalBook'] = Book::count();
        // $result['totalBook'] = Book::pluck('user_id');
        // $result['author_book_count'] = Book::pluck('user_id')->countBy();
        // $result['max_price'] = Book::max('price');
        // $result['min_price'] = Book::min('price');
        // $result['avg_price'] = Book::avg('price');
        // $result['total_price'] = Book::sum('price');
        // $result['random_value'] = Book::get()->random()->price;
        // $result['median_price'] = Book::get()->median('price');
        // $result['max_book_written_by_author'] = Book::pluck('user_id')->mode();
        // $result['books'] = Book::all();

        $result = $this->post->all();

        return $result;

        // return view("bookList", compact("books"));
    }

    public function create()
    {

    }

    public function store(StorePostRequest $request)
    {
        $result = $this->post->store($request->validated());
        return $result;

    }

    public function show(Book $post)
    {
        $result = $this->post->show($post->id);
        return $result;
    }

    public function edit()
    {

    }

    public function update()
    {

    }
    public function delete()
    {

    }
}
