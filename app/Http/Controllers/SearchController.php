<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\payments;

class SearchController extends Controller
{
    //
    public function searchBook(Request $request)
    {
        if($request->search != null)
        {
            $book = Book::where('name','like','%'.$request->search.'%')->where('status','=',0)->paginate(15);
            return view('search.search_book_all',['books'=>$book]);
        }
        else{
            $book = Book::orderBy('created_at', 'desc')->paginate(15);
            //dd($book);
            return view('search.search_book_all',['books'=>$book]);
        }
    }
}
