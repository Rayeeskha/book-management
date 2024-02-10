<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\RevenueTrackingRepository;


class RevenueTrackingController extends Controller
{
	protected $RevenueTrackingRepository;

    public function __construct(RevenueTrackingRepository $revenueTrackingRepository) {
        $this->revenueTrackingRepository = $revenueTrackingRepository;
    }

    public function index(Request $request){
    	if ($request->ajax()) {
            return $this->revenueTrackingRepository->index();
        }
        return view('backend.revenue_tracking.index');
    }

    public function store(Request $request){
    	try {
            $response = $this->revenueTrackingRepository->sendAuthorNotification($request->all());
            return response()->json(['success' => true,'message' => $response,'url'=> ''],200);
            
        }catch (\Throwable $e)  {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
}
