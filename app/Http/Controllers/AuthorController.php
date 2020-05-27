<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::all();
        return view('authors', compact('authors'));
    }

    public function getAuthor($id) {
        $author = Author::find($id);
        return view('author', compact('author'));
    }
}
