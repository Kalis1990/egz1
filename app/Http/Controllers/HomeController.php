<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Author;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function homeList(Request $request)
    {
        // Filter
        if ($request->cat) {
            $books = Book::where('author_id', $request->cat);
        } 
        else if ($request->s) {
            $search = explode(' ', $request->s);
            if (count($search) == 1) {
                $books = Book::where('title', 'like', '%'.$request->s.'%');
            }
            else {
                $books = Book::where('title', 'like', '%'.$search[0].' '.$search[1].'%')
                ->orWhere('title', 'like', '%'.$search[1].'%'.$search[0].'%')
                ->orWhere('title', 'like', '%'.$search[0].'%')
                ->orWhere('title', 'like', '%'.$search[1].'%');
            }
        }
        else {
            $books = Book::where('id', '>', 0);
        }

        // Sort
        if ($request->sort == 'rate_asc') {
            $books->orderBy('rating');
        }
        else if ($request->sort == 'rate_desc') {
            $books->orderBy('rating', 'desc');
        }
        else if ($request->sort == 'title_asc') {
            $books->orderBy('title');
        }
        else if ($request->sort == 'title_desc') {
            $books->orderBy('title', 'desc');
        }
        else if ($request->sort == 'price_asc') {
            $books->orderBy('price');
        }
        else if ($request->sort == 'price_desc') {
            $books->orderBy('price', 'desc');
        }
        
        return view('home.index', [
            'books' => $books->get(),
            'authors' => Author::orderBy('title')->get(),
            'cat' => $request->cat ?? '0',
            'sort' => $request->sort ?? '0',
            'sortSelect' => Book::SORT_SELECT,
            's' => $request->s ?? '',
        ]);
    }


    public function rate(Request $request, Book $movie)
    {
        $movie->rating_sum = $movie->rating_sum + $request->rate;
        $movie->rating_count ++;
        $movie->rating = $movie->rating_sum / $movie->rating_count;
        // $movie->rating_sum = $movie->rating_sum + $request->rate;
        // $movie->rating_count ++;
        // $movie->rating_sum = $movie->rating_sum + $movie->rating;
        $movie->save();
        return redirect()->back();
        
    }

}
