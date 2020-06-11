<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Buyer;
use App\DairyToken;
use App\Record;

use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function PurchaseListEloquent()
    {
       
		$data=DB::table('buyers')
            ->join('diary_taken', 'buyers.id', '=', 'diary_taken.buyer_id')
            ->join('eraser_taken', 'buyers.id', '=', 'eraser_taken.buyer_id')
            ->select('buyers.id', 'buyers.name')
			//->unique('buyers.id')
			->groupBy('buyers.id','buyers.name')
            ->get();
		
		print_r($data);
		
		
		
		
    }
	
	public function RecordTransfert(){
		
		$path = storage_path() . "/app/public/records.json";
		$data = json_decode(file_get_contents($path), true); 
		foreach($data['RECORDS'] as $value){
			Record::insert($value);
		}  
		
	}
}
