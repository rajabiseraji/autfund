<?php

namespace App\Http\Controllers;

use DB;
use View;
use Illuminate\Http\Request;

class TableMainController extends Controller
{
    function getTags(){
    	 return DB::table('tags')->orderByRaw("cast(tag_real as decimal(6,4)) asc")->get(); 
    }

    function getFunds(){
    	return DB::table('funds')->get();
    }

    function getResearchAreas(){
    	return  DB::table('research_area')->get();
    }

    function getCountry(){
    	return  DB::table('funding_org')->distinct()->get(['funding_org_country']);
    }


    function generateMainView(){
    	$result = DB::table('funds')->join('funding_org', 'funds.funding_org_code', '=', 'funding_org.funding_org_id');
 		
 		$res = self::getResearchAreas();
 		$country = self::getCountry();
 		$orgs = DB::table('funding_org')->get();
 		$fund_rel_id = self::getFunds();
 		$funding_orgs =  $result->distinct()->pluck('funding_org_name');
    	$qq = $result->get();
    	$tags = self::getTags();
    	return view('mainView', compact('qq', 'funding_orgs', 'tags', 'fund_rel_id', 'res', 'country', 'orgs'));
    }


    function Ajax(Request $r){
        $f = false;
		$globRes = DB::table('funds');
    	$inp = '%'.$r->searchString.'%';
    	if($r->searchString != "") {
	    	if ($r->name == 'true') {
	    		$globRes = $globRes->orWhere('fund_name', 'like', $inp); 
	    	}
	    	if ($r->duration == 'true') {
	    		$globRes = $globRes->orWhere('duration', 'like', $inp); 
	    	}
	    	if ($r->comments == 'true') {
	    		$globRes = $globRes->orWhere('comments', 'like', $inp); 
	    	}
	    	if ($r->memo == 'true') {
	    		$globRes = $globRes->orWhere('memo', 'like', $inp); 
	    	}
	    	if ($r->farsi == 'true') {
	    		$globRes = $globRes->orWhere('farsi_desc', 'like', $inp); 
	    	}
	    	if ($r->link == 'true') {
	    		$globRes = $globRes->orWhere('link1', 'like', $inp); 
	    		$globRes = $globRes->orWhere('link2', 'like', $inp); 
	    	}
	    	if ($r->prog == 'true') {
	    		$globRes = $globRes->orWhere('fund_program_description', 'like', $inp); 
	    	}
	    	if ($r->financial == 'true') {
	    		$globRes = $globRes->orWhere('financial_support', 'like', $inp); 
	    	}
	    	if ($r->requirement == 'true') {
	    		$globRes = $globRes->orWhere('requirements', 'like', $inp); 
	    	}
	    	if ($r->deadline == 'true') {
	    		$globRes = $globRes->orWhere('deadline', 'like', $inp); 
	    	}
    	}
    	
    	if (!empty($r->rating)) {
    		$globRes = $globRes->where('funds.rating', '=', $r->rating); 
    		// return $globRes->get();
    	}
    	if(count($r->related)>0) {
    		$qq = $globRes;
    		$qq = $qq->join('id_map', 'id_map.fund_id', '=', 'funds.fund_id');
	        foreach ($r->related as $x) {
	          $qq->where('related_id', '=', $x);
	        }
	        if(count($qq->get())>0)
	        	$globRes = $qq;
    	}
    	if($r->country != "" && $r->org == ""){
            $f = true;
    		$qq = $globRes;
    		$qq =  $qq->join('funding_org', 'funding_org.funding_org_id', '=', 'funding_org_code')->where('funding_org_country', '=', $r->country);
            // return $r->country;
    		// return $qq->get();
    		if(count($qq->get())>0)
	        	$globRes = $qq;
    	}
    	if(count($r->research)>0){
    		$qq = $globRes;
    		$qq = $qq->join('fund_resarea', 'fund_resarea.fund_id', '=', 'funds.fund_id');
    		foreach ($r->research as $x) {
    			$qq->where('research_area_code', '=', $x);
    		}
    		if(count($qq->get())>0)
	        	$globRes = $qq;
    	}
    	if($r->org != "" && $r->country == ""){
            $f = true;
    		$qq = $globRes;
    		// $r->org = '%'.$r->org.'%';
    		$qq =  $qq->join('funding_org', 'funding_org_id', '=', 'funding_org_code')->where('funding_org_id', '=', $r->org);
    		// return $qq->get();
    		if(count($qq->get())>0)
	        	$globRes = $qq;
    	}
        if($r->org != "" && $r->country != ""){
            $f = true;
            $qq = $globRes;
            // $r->org = '%'.$r->org.'%';
            $qq =  $qq->join('funding_org', 'funding_org_id', '=', 'funding_org_code')->where('funding_org_id', '=', $r->org)->where('funding_org_country', '=', $r->country);
            // return $qq->get();
            if(count($qq->get())>0)
                $globRes = $qq;
        }
    	if(count($r->tag)>0){
    		$qq = $globRes;
    		$qq = $qq->join('fund_tag', 'fund_tag.fund_id', '=', 'funds.fund_id');
        	foreach ($r->tag as $t) {
    			$qq = $qq->where('tag_id', '=', $t);
    		}
    		if(count($qq->get())>0)
	        	$globRes = $qq;
    	}


    	if(!$f){
    		$qq = $globRes->join('funding_org', 'funding_org_code', '=', 'funding_org.funding_org_id');
    	}

    	$funding_orgs =  $qq->distinct()->pluck('funding_org_name');
    	// return $qq->get();
    	// $qq = $qq->select(array('funds.fund_name', 'funds.fund_id', 'funding_org_name', 'farsi_desc'))->get();
        $qq = $qq->get();
        if($f)
            $f = false;
    	// return $result;
    	// return r1esponse()->json(array('success' => true, 'html'=>$returnHTML));
    	return view('resultPartMainView', compact('qq', 'funding_orgs'))->render();



    }


}
