<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class TableUpdateController extends Controller
{
    function updateName(Request $r){
    	try {
    		return $r->fieldName;
    		DB::table('funds')->where('fund_id', '=', $r->fundID)->update(['fund_name'=>$r->fundName]);
    		return 'ok';
    	} catch (Exception $e) {
    		return 'no';
    	}
    }
}
