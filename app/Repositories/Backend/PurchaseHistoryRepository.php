<?php

namespace App\Repositories\Backend;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use DataTables;
use App\Models\PurchaseBook;
use CustomHelper;
use DB;

class PurchaseHistoryRepository extends BaseRepository
{
	public function model()
    {
    	return PurchaseBook::class;
    }

    public function index(){
        $data = PurchaseBook::permission()->with('book:id,title','user:id,name')->select('*',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->orderBy('id', 'DESC');
        return Datatables::of($data)->addIndexColumn()
            ->editColumn('created_at', function($row){
                return date('d M Y',strtotime($row->created_at));
            })->editColumn('book_id', function($row){
                return $row->book->title ?? 'N/A';

            })->editColumn('user_id', function($row){
                return $row->user->name ?? 'N/A';

            })->addColumn('total', function($row){
                $total =  @$row->price * @$row->quantity;
                return number_format($total);
            })->make(true);
    }


}