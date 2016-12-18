<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TablesInsertController extends Controller
{
    function show(){
    	$fund_rel_id = DB::table('funds')->get();
    	$m = array('m' => 'insert');
    	$res =  DB::table('research_area')->get();
    	$country = DB::table('funding_org')->pluck('funding_org_country');
    	$tags = DB::table('tags')->orderByRaw("cast(tag_real as decimal(6,4)) asc")->get();
    	return view('form')->with(compact('res', 'country', 'tags', 'm', 'fund_rel_id'));
    }

    function insert(Request $r){
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
      

      // return $f;
      $result = DB::table('funds');
      $updateWhat = array();
      foreach ($f as $key => $value) {
          if(($value)){ //check for only not null values

              if($key == 'tags'){

              } else if($key == 'country') {
                  continue;
              } else if($key == 'funding_org_code' && isset($r->fund_org)){
              		$forgs = DB::table('funding_org')->where('funding_org_name', '=', $r->fund_org)->get();				      
				      if(empty($forgs))
				        DB::table('funding_org')->insert(['funding_org_name'=>$r->fund_org, 'funding_org_country'=>$f['country']]);
				      
				      $forgs = DB::table('funding_org')->where('funding_org_name', '=', $r->fund_org)->get();
				      $forgID = $forgs[0]->funding_org_id;
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
      $result->insert($updateWhat);




      $f['fund_id'] = DB::table('funds')->where('fund_name', 'like', $f['fund_name'])->get()[0]->fund_id;

      if(!empty($f['fund_related_id']))
      foreach ($f['fund_related_id'] as $in) {
        DB::table('id_map')->insert(['fund_id'=>$f['fund_id'], 'related_id'=>$in]);
      }

      if(!empty($f['res']))
   		foreach ($f['res'] as $in) {
   			DB::table('fund_resarea')->insert(['fund_id'=>$f['fund_id'], 'research_area_code'=>$in]);
   		}

   		if(!empty($r->resAreaTitle)){
   			DB::table('research_area')->insert(['research_title'=>$r->resAreaTitle]);
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
   		return redirect('/tables/'.$f['fund_id']);
    }
}
