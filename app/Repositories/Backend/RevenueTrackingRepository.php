<?php

namespace App\Repositories\Backend;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use DataTables;
use App\Models\Author;
use App\Models\Book;
use App\Models\PurchaseBook;
use CustomHelper;
use App\Mail\AuthorRevenueTracking;
use DB;
use Str;
use Auth;

class RevenueTrackingRepository extends BaseRepository
{
	public function model()
    {
    	return Author::class;
    }

    public function index(){
        $data = Author::select('*',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->orderBy('id', 'DESC');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                return '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="delete btn btn-info btn-md sendAuthorNotification">Send Notification</a>'; 
                return $btn; 
            })->editColumn('created_at', function($row){
                return date('d M Y',strtotime($row->created_at));

            })->rawColumns(['status','action'])->make(true);
    }


    public function sendAuthorNotification($data){
        $authorId = $data['author_id'];
        $currentMonthRevenue = 0;
        $currentYearRevenue = 0;
        $totalRevenue = 0;

        Book::whereIn('author_ids', [$authorId])->chunk(100, function ($bookDatas) use (&$currentMonthRevenue, &$currentYearRevenue, &$totalRevenue) {
            foreach ($bookDatas as $bookData) {
                $currentMonthRevenue += PurchaseBook::where('book_id', $bookData->id)
                    ->whereMonth('created_at', now()->month)
                    ->sum('price');

                $currentYearRevenue += PurchaseBook::where('book_id', $bookData->id)
                    ->whereYear('created_at', now()->year)
                    ->sum('price');

                $totalRevenue += PurchaseBook::where('book_id', $bookData->id)
                    ->sum('price');
            }
        });

        $mail = new AuthorRevenueTracking([
            'currentMonthRevenue' => $currentMonthRevenue,
            'currentYearRevenue' => $currentYearRevenue,
            'totalRevenue' => $currentYearRevenue,
        ]);
        \Mail::to($data['email'])->send($mail);
        return 'Notification has been sent successfully !';
    }

}