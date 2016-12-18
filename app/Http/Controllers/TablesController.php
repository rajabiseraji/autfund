<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    function show(){
    	// return $tableID;
      $m = []; 
    	$res =  DB::table('research_area')->get();
      $fund_rel_id = DB::table('funds')->get();
    	$country = DB::table('funding_org')->pluck('funding_org_country');
    	$tags = DB::table('tags')->orderByRaw("cast(tag_real as decimal(6,4)) asc")->get();
    	return view('form')->with(compact('res', 'country', 'tags', 'm', 'fund_rel_id'));
    }

    public function search(Request $r){
      $f['fund_rel_id'] = $r->fund_related_id;
      $f['fund_id'] = $r->fund_id;
    	$f['fund_name'] = $r->fund_name; 
    	$f['rating'] = $r->fund_rating;     
    	$f['fund_acceptence'] = $r->fund_acceptence;  
    	$f['funding_org_code'] = $r->fund_org;
    	$f['res'] = $r->resArea;
      $f['tags'] = $r->tags;
    	$f['country'] = $r->fund_country;       
    	$f['fund_program_description'] = $r->program_desc; 
    	$f['duration'] = $r->duration;        	
    	$f['financial_support'] = $r->financial_support;       
    	$f['requirements'] = $r->requirements;       
    	$f['deadline'] = $r->deadline;        	
    	$f['link1'] = $r->link1;   
    	$f['link2'] = $r->link2;   
    	$f['memo'] = $r->memo; 
    	$f['farsi_desc'] = $r->farsiDesc;   
    	$f['comments'] = $r->comment;
      // return $f;
      $result = DB::table('funds');
    	foreach ($f as $key => $value) {
          if(($value)){ //check for only not null values

              if($key == 'tags'){

              } else if($key == 'country') {
                  continue;
              } else if($key == 'funding_org_code'){
                  continue;
              } else if($key == 'res'){
                  continue;
              } else if($key == 'fund_rel_id'){
                  continue;
              } else {
                // return $key.' '.$value;
                  $value = '%'.$value.'%';
                  $result = $result->where($key, 'like', $value);
              }
          }
      }
                

      if(($r->fund_org) and !isset($r->fund_country)){
        $result =  $result->join('funding_org', 'funding_org.funding_org_id', '=', 'funding_org_code')->where('funding_org_name', 'like', $f['funding_org_code']);
    	} else if(isset($r->fund_country)){
    		$result =  $result->join('funding_org', 'funding_org.funding_org_id', '=', 'funding_org_code')->where('funding_org_country', 'like', $f['country']);
    	}

    	if(!empty($f['res'])){
    		$result = $result->join('fund_resarea', 'fund_resarea.fund_id', '=', 'funds.fund_id');
    		foreach ($f['res'] as $x) {
    			$result->where('research_area_code', '=', $x);
    		}
    	}

      if(!empty($f['fund_rel_id'])){
        $result = $result->join('id_map', 'id_map.fund_id', '=', 'funds.fund_id');
        foreach ($f['fund_rel_id'] as $x) {
          $result->where('related_id', '=', $x);
        }
      }

    	if(!empty($f['tags'])){
    		$result = $result->join('fund_tag', 'fund_tag.fund_id', '=', 'funds.fund_id');
    		foreach ($f['tags'] as $t) {
    			$result->where('tag_id', '=', $t);
    		}
    	}

      // return $result->get();
      $result = $result->get();
		return view('resultView')->with(compact('result'));
   }



   function ajax(Request $request){

   		// $result =array('fund_name' => 'sd');

     //    return response()
     //              ->json($result);
   }




   function oneTable($tableID){
   		// $m = array('m'=> 'edit');
      // $fund_rel_id = DB::table('id_map')->join('funds', 'id_map.related_id', '=', 'funds.fund_id')
      //                                   ->join('funds', 'id_map.fund_id', '=', 'funds.fund_id')
      //                                   ->get(); 
      $funds = DB::table('funds')->get(); 
   		$res =  DB::table('research_area')->get();
    	$c = DB::table('funding_org')->pluck('funding_org_country');
    	$tags = DB::table('tags')->orderByRaw("cast(tag_real as unsigned) asc")->get();
   		$arr = DB::table('funds')->where('funds.fund_id', '=', $tableID);
      $tmpRes = $arr->get();
      $tmp = $arr->join('fund_resarea', 'fund_resarea.fund_id', '=', 'funds.fund_id');
      if(isset($tmp->get()[0]))
        $arr = $tmp;
      $tmp = $arr->join('research_area', 'fund_resarea.research_area_code', '=', 'research_area.research_code');
      if(isset($tmp->get()[0]))
        $arr = $tmp;
      $tmp = $arr->join('funding_org', 'funding_org.funding_org_id', '=', 'funding_org_code');
      // return $tmp->get
       if(isset($tmp->get()[0]))
        $arr = $tmp;
      $tmp = $arr->join('fund_tag', 'fund_tag.fund_id', '=', 'funds.fund_id');
      if(isset($tmp->get()[0]))
        $arr = $tmp;
      $tmp = $arr->join('tags', 'fund_tag.tag_id', '=', 'tags.tag_id');
      if(isset($tmp->get()[0]))
        $arr = $tmp;
      $tmp = $arr->join('id_map', 'id_map.fund_id', '=', 'funds.fund_id');
      if(isset($tmp->get()[0]))         
        $arr = $tmp->get();
      else
        $arr = $tmpRes;
      // return $arr;
   		return view('table')->with(compact('arr', 'res', 'c', 'tags', 'funds'));
   }



   function edit(Request $r){
      $f['fund_related_id'] = $r->fund_related_id;
      $f['fund_id'] = $r->fund_id;
      $f['fund_name'] = $r->fund_name; 
      $f['rating'] = $r->fund_rating;     
      $f['fund_acceptence'] = $r->fund_acceptence;  
      $f['funding_org_code'] = $r->fund_org;
      $f['res'] = $r->resArea;
      $f['tags'] = $r->tags;
      $f['country'] = $r->fund_country;       
      $f['fund_program_description'] = $r->program_desc; 
      $f['duration'] = $r->duration;          
      $f['financial_support'] = $r->financial_support;       
      $f['requirements'] = $r->requirements;       
      $f['deadline'] = $r->deadline;          
      $f['link1'] = $r->link1;   
      $f['link2'] = $r->link2;   
      $f['memo'] = $r->memo; 
      $f['farsi_desc'] = $r->farsiDesc;   
      $f['comments'] = $r->comment;
      //     $resAreas = $r->resArea;
      // $tags = $r->tags;
        // $country = $r->fund_country; 
      $forgs = DB::table('funding_org')->where('funding_org_name', '=', $r->fund_org)->get();
      
      if(empty($forgs))
        DB::table('funding_org')->insert(['funding_org_name'=>$r->fund_org, 'funding_org_country'=>$f['country']]);
      
      $forgs = DB::table('funding_org')->where('funding_org_name', '=', $r->fund_org)->get();
      $forgID = $forgs[0]->funding_org_id;

      // return $f;
      $result = DB::table('funds')->where('fund_id', '=', $f['fund_id']);
      $updateWhat = array();
      foreach ($f as $key => $value) {
          if(($value)){ //check for only not null values

              if($key == 'tags'){

              } else if($key == 'country') {
                  continue;
              } else if($key == 'funding_org_code'){
                  $updateWhat[$key] = $forgID;
              } else if($key == 'res'){
                  continue;
              } else if($key == 'fund_related_id'){
                  continue;
              } else {
                // return $key.' '.$value;
                $updateWhat[$key] = $value;
              }
          }
      }
      
      $result->update($updateWhat);


      $resultRelFund = DB::table('id_map')->where('funds.fund_id', '=', $f['fund_id'])->join('funds', 'funds.fund_id', '=', 'id_map.fund_id')->get();
      if(!empty($resultRelFund))
        DB::table('id_map')->where('fund_id', '=', $f['fund_id'])->delete();
      
      if(!empty($f['fund_related_id']))
      foreach ($f['fund_related_id'] as $in) {
        DB::table('id_map')->insert(['fund_id'=>$f['fund_id'], 'related_id'=>$in]);
      }


   		$resultResearch = DB::table('fund_resarea')->where('funds.fund_id', '=', $f['fund_id'])->join('funds', 'funds.fund_id', '=', 'fund_resarea.fund_id')->get();
   		if(!empty($resultResearch))
      foreach ($resultResearch as $research) {
   			DB::table('fund_resarea')->where('fund_resarea.research_area_code', '=', $research->research_area_code)->where('fund_id', '=', $f['fund_id'])->delete();
   		}if(!empty($f['res']))
   		foreach ($f['res'] as $in) {
   			DB::table('fund_resarea')->insert(['fund_id'=>$f['fund_id'], 'research_area_code'=>$in]);
   		}

   		if(!empty($r->resAreaTitle)){
   			DB::table('research_area')->insert(['research_title'=>$r->resAreaTitle]);
   		}

   		$resultTags = DB::table('fund_tag')->where('funds.fund_id', '=', $r->fund_id)->join('funds', 'funds.fund_id', '=', 'fund_tag.fund_id')->get();
      if(!empty($resultTags))
   		foreach ($resultTags as $tt) {
   			DB::table('fund_tag')->where('fund_tag.tag_id', '=', $tt->tag_id)->where('fund_id', '=', $f['fund_id'])->delete();
   		}
      if(!empty($f['tags']))
   		foreach ($f['tags'] as $tag) {
   			DB::table('fund_tag')->insert(['fund_id'=>$f['fund_id'], 'tag_id'=>$tag]);
   		}

   		if(!empty($r->parentID)){
   			$parent = DB::table('tags')->where('tag_real', '=', $r->parentID)->get();
   			$lastChild = DB::table('tag_tag')->where('tag_tag.parent_tag_id', '=',$parent[0]->tag_id )->join('tags', 'tags.tag_id', '=','tag_tag.tag_id')->get();
   			$lastChildIndex = count($lastChild)+1;
   			$myIDreal = $parent[0]->tag_real.".".$lastChildIndex;
   			
   			DB::table('tags')->insert(['tag_desc'=>$r->tagTitle, 'tag_real'=>$myIDreal ]);
   			$myID = DB::table('tags')->where('tag_real', '=', $myIDreal)->get();
   			DB::table('tag_tag')->insert(['tag_id'=> $myID[0]->tag_id, 'parent_tag_id'=>$parent[0]->tag_id]);

   		}

   		// return $r->fund_id;
   		return redirect('/tables/'.$r->fund_id);
   }



   function delete($tableID){
   		DB::table('funds')->where('fund_id', '=', $tableID)->delete();

   		return redirect('/tables/');

   }

}
