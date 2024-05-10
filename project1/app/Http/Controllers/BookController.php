<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function BookList()
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

        $result = [];
        $result['totalBook'] = Book::count();
        $result['totalBook'] = Book::pluck('user_id');
        $result['author_book_count'] = Book::pluck('user_id')->countBy();
        $result['max_price'] = Book::max('price');
        $result['min_price'] = Book::min('price');
        $result['avg_price'] = Book::avg('price');
        $result['total_price'] = Book::sum('price');
        $result['random_value'] = Book::get()->random()->price;
        $result['median_price'] = Book::get()->median('price');
        $result['max_book_written_by_author'] = Book::pluck('user_id')->mode();
        $result['books'] = Book::all();

        return $result;

        // return view("bookList", compact("books"));
    }
}
