<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class TableUpdateController extends Controller
{
    function updateName(Request $r){
    	try {
    		$name = $r->fieldName;
    		if($r->fieldName == 'fund_rating')
    			$name = 'rating';
    		else if($r->fieldName == 'program_desc')
    			$name = 'fund_program_description';
    		else if($r->fieldName == 'farsiDesc')
    			$name = 'farsi_desc';
    		else if($r->fieldName == 'comment')
    			$name = 'comments';

    		DB::table('funds')->where('fund_id', '=', $r->fundID)->update([$name=>$r->fieldValue]);
    		return 'ok';
    	} catch (Exception $e) {
    		return 'no';
    	}
    }

    function tagSave(Request $r){
    	try {
				$resultTags = DB::table('fund_tag')->where('funds.fund_id', '=', $r->fundID)->join('funds', 'funds.fund_id', '=', 'fund_tag.fund_id')->get();
		      if(!empty($resultTags))
		   		foreach ($resultTags as $tt) {
		   			DB::table('fund_tag')->where('fund_tag.tag_id', '=', $tt->tag_id)->where('fund_id', '=', $r->fundID)->delete();
		   		}
		      if(!empty($r->tag))
		   		foreach ($r->tag as $tag) {
		   			DB::table('fund_tag')->insert(['fund_id'=>$r->fundID, 'tag_id'=>$tag]);
		   		}
    		return 'ok';
    	} catch (Exception $e) {
    		return 'no';
    	}
    }


     function fundRelSave(Request $r){
    	try {
			  $resultRelFund = DB::table('id_map')->where('funds.fund_id', '=', $r->fundID)->join('funds', 'funds.fund_id', '=', 'id_map.fund_id')->get();
		      if(!empty($resultRelFund))
		        DB::table('id_map')->where('fund_id', '=', $r->fundID)->delete();
		      
		      if(!empty($r->fund_related_id))
		      foreach ($r->fund_related_id as $in) {
		        DB::table('id_map')->insert(['fund_id'=>$r->fundID, 'related_id'=>$in]);
		      }
    		return 'ok';
    	} catch (Exception $e) {
    		return 'no';
    	}
    }

    function orgSave(Request $r){
    	try {
			  // return $r->fund_org;
			  DB::table('funds')->where('fund_id', '=', $r->fundID)->update(['funding_org_code'=>$r->fund_org]);
    		return 'ok';
    	} catch (Exception $e) {
    		return 'no';
    	}
    }

    function resSave(Request $r){
    	try {
			$resultResearch = DB::table('fund_resarea')->where('funds.fund_id', '=', $r->fundID)->join('funds', 'funds.fund_id', '=', 'fund_resarea.fund_id')->get();
		      if(!empty($resultResearch))
		      foreach ($resultResearch as $research) {
		        DB::table('fund_resarea')->where('fund_resarea.research_area_code', '=', $research->research_area_code)->where('fund_id', '=', $r->fundID)->delete();
		      }
		      if(!empty($r->res_code))
		      foreach ($r->res_code as $in) {
		        DB::table('fund_resarea')->insert(['fund_id'=>$r->fundID, 'research_area_code'=>$in]);
		      }
    		return 'ok';
    	} catch (Exception $e) {
    		return 'no';
    	}
    }

}
