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

    public function workingWithWhere()
    {
        /**
        1. where
        2. whereBetween
        3. whereStrict
        4. whereIn
        5. whereNotIn
        6. whereNull
        7. whereNotNull
        8. whereDate
        9. whereDay
        10. whereMonth
        11. whereYear
        12. whereTime
        12. filter
        12. reject
         */

        $result = [];

        $published_book = Book::where('is_published', 1)->count();
        $published_book_this_year = Book::where('is_published', 1)->whereYear('created_at', 2024)->count();
        $published_book_multi_condition = Book::where(['is_published' => 1, 'user_id' => 110])->count();
        $published_book_using_function = Book::where(fn($query) => $query->where('is_published', 1))->count();
        $range_price_books = Book::whereBetween('price', [200, 500])->count();
        $created_date_range_books = Book::whereBetween('created_at', ['2024-01-01', '2024-08-30'])->where('is_published', 1)->count();

        $find_2_author_books = Book::whereIn('user_id', [1, 2])->where('is_published', 1)->count();
        $find_all_author_books_count_except_1_2 = Book::whereNotIn('user_id', [1, 2])->where('is_published', 1)->count();

        $find_null_description_author_users = Book::with('author')->whereNull('description')->select('user_id')->get();
        $find_not_null_description_author_count = Book::whereNotNull('description')->count();

        $date_filter = Book::whereDate('created_at', '2024-02-21')->count();
        $day_filter = Book::whereDay('created_at', 6)->count();
        $month_filter = Book::whereMonth('created_at', 2)->count();
        $year_filter = Book::whereYear('created_at', 2024)->count();
        $time_filter = Book::whereTime('created_at', '>', '8:00')->count();

        $books = Book::where('is_published', 1)->get();

        $filter_on_limited_stock = $books->filter(function ($book) {
            return $book->stock > 2;
        })->count();

        $filter_on_limited_stock_update = $books->filter(fn($book) => $book->stock < 2)->count();

        $with_description_not_null_book_count = $books->reject(function ($book) {
            return $book->description == null;
        })->count();

        $with_description_book_count = $books->reject(fn($book) => $book->description != null)->count();

        $result['published_book'] = $published_book;
        $result['published_book_this_year'] = $published_book_this_year;
        $result['published_book_multi_condition'] = $published_book_multi_condition;
        $result['published_book_using_function'] = $published_book_using_function;
        $result['range_price_books'] = $range_price_books;
        $result['created_date_range_books'] = $created_date_range_books;

        $result['find_2_author_books'] = $find_2_author_books;
        $result['find_all_author_books_count_except_1_2'] = $find_all_author_books_count_except_1_2;

        $result['find_null_description_author_users'] = $find_null_description_author_users;
        $result['find_not_null_description_author_count'] = $find_not_null_description_author_count;

        $result['date_filter'] = $date_filter;
        $result['day_filter'] = $day_filter;
        $result['month_filter'] = $month_filter;
        $result['year_filter'] = $year_filter;
        $result['time_filter'] = $time_filter;

        $result['filter_on_limited_stock'] = $filter_on_limited_stock;
        $result['filter_on_limited_stock_update'] = $filter_on_limited_stock_update;
        $result['with_description_book_count'] = $with_description_book_count;
        $result['with_description_not_null_book_count'] = $with_description_not_null_book_count;

        return $result;
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
