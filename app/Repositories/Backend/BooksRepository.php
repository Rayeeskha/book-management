<?php

namespace App\Repositories\Backend;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use DataTables;
use App\Models\Book;
use App\Models\PurchaseBook;
use App\Models\Author;
use App\Notifications\AuthorNotification;
use CustomHelper;
use App\Mail\RevenueTracking;
use DB;
use Str;
use Auth;

class BooksRepository extends BaseRepository
{
   

	public function model()
    {
    	return Book::class;
    }

    public function index(){
        $data = Book::select('*',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->orderBy('books.id', 'DESC');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '';
                if ($row->sellCount > 0) {
                    $btn = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="delete btn btn-info btn-md buyBooks">Buy books</a>';
                }
                 
                $btn .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.route('admin.purchase-history.index').'" class="delete btn btn-success btn-md ">Purchase history</a>'; 
                $btn .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="edit btn btn-info btn-md editBooks"><span class=" bx bx-edit text-white"></span></a>'; 
                // $btn .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="delete btn btn-danger btn-md deleteDataTableRow"><span class=" bx bx-trash text-white"></span></a>'; 

                return $btn; 
            })->editColumn('created_at', function($row){
                return date('d M Y',strtotime($row->created_at));

            })->addColumn('author_id', function($row)
            {
                $authorIds = !empty($row->author_ids) ? explode(',',$row->author_ids) : '';
                $authorDataArr = [];
                foreach($row->getAuthorData($authorIds) ?? [] as $author){
                    $authorDataArr[] = @$author->name;
                }
                return implode(', ', $authorDataArr);

            })->editColumn('status', function($row){
                $active = $row->status == '1' ? "checked" : '';
                $x = ($active) ? " switch3-checked " : " ";
                return '<div class="form-check form-switch form-switch-right form-switch-md">
                    <label for="rounded-button" class="form-label text-muted '.$x.' "></label>
                    <input class="form-check-input code-switcher status_change_datatable" type="checkbox" id="rounded-button" '.$active.'>
                </div>';    
            })->rawColumns(['status','action'])->make(true);
    }


    public function store($data){
        $id = @$data['id'];
        $data['author_ids'] = implode(',', $data['author_ids']);
        $data['url'] = Str::slug($data['title']);
        Book::updateOrCreate(['id' => $id], $data);
        return $id > 0 ? 'Updated Sucessfully' : 'Added Sucessfully';
    }

    public function purchaseBooks($data){
        $book = Book::whereid($data['book_id'])->first();
       
        $history = PurchaseBook::create([
            'purchase_id' => CustomHelper::generatePurchaseId(),
            'book_id' => $data['book_id'],
            'user_id' => Auth::user()->id,
            'price' => @$book->price,
            'quantity' => $data['qty'],
        ]);

        Book::whereid($data['book_id'])->update([
            'sellCount' => $book->sellCount - $data['qty'] 
        ]);
        
        if (!empty($book->author_ids)) {
            $authorIds  = explode(',', $book->author_ids);
            Author::whereIn('id', $authorIds)
            ->chunk(100, function ($authors) use ($book) {
                foreach ($authors as $author) {
                    $mail = new RevenueTracking([
                        'title' => $book->title ?? 'N/A', 
                        'price' => $book->price ?? 'N/A', 
                        'purchase_date' => date('Y-m-d h:i:s'), 
                    ]);
                    \Mail::to($author->email)->send($mail);
                }
            });
        }
        return 'your order has been purchase successfully !';
    }

    


}