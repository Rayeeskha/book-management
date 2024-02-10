<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\PurchaseHistoryRepository;

class PurchaseHistoryController extends Controller
{
	protected $purchaseHistoryRepository;

    public function __construct(PurchaseHistoryRepository $purchaseHistoryRepository) {
        $this->purchaseHistoryRepository = $purchaseHistoryRepository;
    }
    public function index(Request $request){
    	if ($request->ajax()) {
    		return $this->purchaseHistoryRepository->index();
        }
        return view('backend.purhcase_history.index');
    }
}
