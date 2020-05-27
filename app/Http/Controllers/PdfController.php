<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Pdf;
use App\Author;
use Illuminate\Support\Facades\Auth;
use Imagick;


class PdfController extends Controller {

    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index_admin() {
        $books = Pdf::all();
        $user = Auth::user();
        return view('admin.libros', compact('books', 'user'));
    }

    public function pdf_viewer($book, $isLarge) {
        $book = $book;
        $isLarge = $isLarge;
        $theBook = Pdf::where('internal_id', $book)->first();
        $theBook->views = $theBook->views + 1;
        $theBook->save();
        return view('pdf-viewer', compact('book', 'isLarge', 'theBook'));        
    }

    public function form_pdf(Request $req) {
        $books = Pdf::all();
        $temas = HomeController::getTemas($books);
        $autores = Author::all();
        return view('admin.pdf-form', compact('temas', 'autores'));
    }

    public function unzip($zipname, $the_path) {

        // Zip file name
        $filename = $the_path.'/'.$zipname;
        $zip = new \ZipArchive;
        $res = $zip->open($filename);
        if ($res === TRUE) {
            // Unzip path
            $path = $the_path;
            // Extract file
            $zip->extractTo($path);
            $zip->close();

            echo 'Unzip!';
        } else {
            echo 'failed!';
        }
    }

    public function post_pdf(Request $req) {
            $temas = json_encode($req->temas);
            $path_original = storage_path('books/');
            $client = new \GuzzleHttp\Client();
            $file = $req->file('theFile');
            
            if($file->getMimeType() != 'application/pdf') {
                return redirect()->back()->with('mime_error', 'El archivo deber ser pdf');
            }
            $fileSize = $file->getSize();
            
            $at = Author::where('name', $req->autor)->first();

            if(!$at) {
                $author_db = new Author();
                $author_db->name = $req->autor;
                $author_db->save();
                $at = Author::where('name', $req->autor)->first();
            }
            $pdf_db = new Pdf();
            $pdf_db->is_large_file = $fileSize > 8000000 ? 1 : 0;
            $pdf_db->title = $req->title;
            $pdf_db->author_id = $at->id;
            $pdf_db->theme = $temas;
            $pdf_db->description = $req->descrip;
            $pdf_db->internal_id = $req->ident;
            $pdf_db->is_scanned = $req->type_data == 'original' ? 0 : 1;
            $pt = $path_original;

            $pdf_db->path_to_folder = $pt.$req->ident;
            $destinationPath = $pt.$req->ident;

            $file->move($destinationPath, $req->ident.'.pdf');
            $file_path_stored = $destinationPath.'/'.$req->ident.'.pdf';
            $amazon = 'http://ec2-18-191-177-28.us-east-2.compute.amazonaws.com:3000/';
            $local = 'http://localhost:3001';
            $mbx8 = 8000000;

            if($fileSize > $mbx8) {
                
                    $res = $client->request('POST', $amazon, [
                        'multipart' => [
                            [
                                'name'     => 'theFile',
                                'contents' => file_get_contents($file_path_stored),
                                'filename' => $file->getClientOriginalName()
                            ],
                        ],
                        'sink' => $destinationPath .'/'. $req->ident . '.zip'
                    ]);
                    
                    $this->unzip($req->ident . '.zip', $destinationPath);
                    $pages = [0 => null];
                    $files = glob(storage_path('books').'/'.$req->ident.'/encrypted*');
                    foreach($files as $file) {
                        array_push($pages, $this->getStringBetween("filename:".$file."<br />", '_', '.'));
                    }
                    $pdf_db->total_pages = (count($pages) - 1);
            } else {
                $im = new Imagick($destinationPath.'/'.$req->ident.'.pdf');
                $pdf_db->total_pages = $im->getNumberImages();
            }

            $pdf_db->save();
            return redirect()->back()->with('success', 'done');

    }

    public function BinaryPdf($book) {
        return response()->file(storage_path('books/'.$book).'/'.$book.'.pdf', ['Content-Type'=>'application/pdf']);
    }

    public function BinaryPdf_byPart($book, $page) {
        $pages = [0 => null];
        $files = glob(storage_path('books').'/'.$book.'/encrypted*');
        foreach($files as $file) {
            array_push($pages, $this->getStringBetween("filename:".$file."<br />", 'encrypted_', '.'));
        }
        
        return response()->file(storage_path('books').'/'.$book.'/encrypted_'.$pages[$page].'.pdf', ['Content-Type'=>'application/pdf']);
    }

    public function getStringBetween($str,$from,$to)
    {
        $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
        return substr($sub,0,strpos($sub,$to));
    }

}
