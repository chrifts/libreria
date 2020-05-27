<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pdf;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lastBooks = Pdf::orderBy('views', 'desc')->take(4)->get();
        $recents = Pdf::orderBy('created_at', 'desc')->take(4)->get();
        return view('home', compact('lastBooks', 'recents'));
    }

    public function index_all() {
        $books = Pdf::all();
        $books->makeHidden(['path_to_folder']);
        $user = Auth::user();
        $temas = HomeController::getTemas($books);
        return view('allbooks', compact('books', 'user', 'temas'));
    }

    public static function getTemas($books) {
        $temas = [];
        foreach ($books as $bk) {
            $book_themes = json_decode($bk->theme);
            foreach($book_themes as $tm) {
                array_push($temas, $tm);
            }
        }
        $temas = array_unique($temas);
        return $temas;
    }
}
