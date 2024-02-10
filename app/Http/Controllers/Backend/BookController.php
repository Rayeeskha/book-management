<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Repositories\Backend\BooksRepository;
use App\Models\Author;
use CustomHelper;

class BookController extends Controller
{
    protected $booksRepository;

    public function __construct(BooksRepository $booksRepository) {
        $this->booksRepository = $booksRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->booksRepository->index();
        }
        return view('backend.books.index');
    }

    public function getAuthor(){
       return response()->json([ 'authors' => Author::orderBy('name', 'ASC')->select('id', 'name')->wherestatus(1)->cursor() ]);  
    }

    
    public function store(BookRequest $request)
    {
        $request->validated();
        try {
            $response = $this->booksRepository->store($request->all());            
            return response()->json(['success' => true,'message' => $response,'url'=>''],200);

        }catch (\Throwable $e)  {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function purchaseBook(Request $request){
        try {
            $response = $this->booksRepository->purchaseBooks($request->all());

            return response()->json(['success' => true,'message' => $response,'url'=>''],200);

        }catch (\Throwable $e)  {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

   
}
