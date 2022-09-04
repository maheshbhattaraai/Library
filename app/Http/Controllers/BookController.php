<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
        ]);
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $book->update(['title' => $request->title, 'author' => $request->author]);
    }

    public function delete(Book $book)
    {
        $book->delete();
    }
}
