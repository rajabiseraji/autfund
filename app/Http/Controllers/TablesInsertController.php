<?php

namespace App\Http\Controllers;

use View;
use DB;
use Illuminate\Http\Request;

class TablesInsertController extends Controller
{
    function show(){
      $orgs = DB::table('funding_org')->get();
    	$fund_rel_id = DB::table('funds')->get();
    	$m = array('m' => 'insert');
    	$res =  DB::table('research_area')->get();
    	$country = DB::table('funding_org')->distinct()->get(['funding_org_country']);
    	$tags = DB::table('tags')->orderByRaw("cast(tag_real as decimal(6,4)) asc")->get();
    	return view('form')->with(compact('res', 'country', 'tags', 'm', 'fund_rel_id', 'orgs'));
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
      $f['country'] = $r->country;       
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
              } else if($key == 'funding_org_code'){

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


      $areas = DB::table('research_area')->get(['research_title']);
      foreach($f['res'] as $ff){
        $tmpp = false;
        foreach ($areas as $ar) {
          if($ar->research_title == $ff)
            {$tmpp = true; break;}
        }
        if(!$tmpp)
          DB::table('research_area')->insert(['research_title'=>$ff]);
      }
            $areas = DB::table('research_area')->get();

      if(!empty($f['res']))
      foreach($f['res'] as $in) {
        foreach ($areas as $row) {
          if($in == $row->research_title)
            DB::table('fund_resarea')->insert(['fund_id'=>$f['fund_id'], 'research_area_code'=>$row->research_code]);
        }
      }


   		if(!empty($f['tags']))
   		foreach ($f['tags'] as $tag) {
   			DB::table('fund_tag')->insert(['fund_id'=>$f['fund_id'], 'tag_id'=>$tag]);
   		}

   		return redirect('/tables/'.$f['fund_id']);
    }




    function home(Request $r){
      if(!empty($r->parentID)){
        $parent = DB::table('tags')->where('tag_id', '=', $r->parentID)->get();
        $lastChild = DB::table('tag_tag')->where('tag_tag.parent_tag_id', '=',$parent[0]->tag_id )->join('tags', 'tags.tag_id', '=','tag_tag.tag_id')->get();
        $lastChildIndex = count($lastChild)+1;
        $myIDreal = $parent[0]->tag_real.".".$lastChildIndex;
        
        DB::table('tags')->insert(['tag_desc'=>$r->tagTitle, 'tag_real'=>$myIDreal ]);
        $myID = DB::table('tags')->where('tag_real', '=', $myIDreal)->get();
        DB::table('tag_tag')->insert(['tag_id'=> $myID[0]->tag_id, 'parent_tag_id'=>$parent[0]->tag_id]);
        $lastTag = DB::table('tags')->orderBy('tag_id', 'desc')->first();
        // return $lastTag->tag_desc;
        $tags = DB::table('tags')->orderByRaw("cast(tag_real as decimal(6,4)) asc")->get();
        return view('parentTags', compact('tags'));
    }
  }



  function tagRename(Request $r){
    if(!empty($r->tagIdEdit) && !empty($r->tagTitleEdit)){
        $tag_id = $r->tagIdEdit; 
        $tagNewName = $r->tagTitleEdit;
        DB::table('tags')->where('tag_id', $tag_id)->update(['tag_desc'=>$tagNewName]);
        $tags = DB::table('tags')->orderByRaw("cast(tag_real as decimal(6,4)) asc")->get();
        return view('tags', compact('tags'));
    }
  }

  function tagDelete(Request  $r ){
    if(!empty($r->tagIdEdit)){
      $tag_id = $r->tagIdEdit; 
      $t = DB::table('tags')->where('tag_id', '=', $tag_id)->get()[0];
      $pattern = $t->tag_real.'%';
      DB::table('tags')->where('tag_real', 'like', $pattern)->delete();
       $tags = DB::table('tags')->orderByRaw("cast(tag_real as decimal(6,4)) asc")->get();
        return view('parentTags', compact('tags'));
    }
  }

  function countryRename(Request $r){
    if(!empty($r->CountrySelectEdit) && !empty($r->CountryTitleEdit)){
        $country = $r->CountrySelectEdit; 
        $CountryNew = $r->CountryTitleEdit;
        DB::table('funding_org')->where('funding_org_country', '=', $country)->update(['funding_org_country'=>$CountryNew]);
        return 'hi';
    }
  }

  function countryDelete(Request  $r ){
    if(!empty($r->CountrySelectEdit)){
        $country = $r->CountrySelectEdit; 
        DB::table('funding_org')->where('funding_org_country', 'like', $country)->delete();
      // return $t->funding_org_country;
      return 'deleted';
      // $u = DB::table('tags')->where('tag_real', 'like', $pattern)->get();
      // return 'hi';
    }
  }

  function orgInsert(Request $r){
    if(isset($r->fundingOrgName) && isset($r->country) && empty($r->newCountry)){
      DB::table('funding_org')->insert(['funding_org_name'=>$r->fundingOrgName, 'funding_org_country'=>$r->country]);
      $orgs = DB::table('funding_org')->get();
      $country = DB::table('funding_org')->distinct()->get(['funding_org_country']);
      return view('editFundOrgModal', compact('orgs', 'country'));
    } 
    if(isset($r->fundingOrgName) && !empty($r->newCountry) ){
      DB::table('funding_org')->insert(['funding_org_name'=>$r->fundingOrgName, 'funding_org_country'=>$r->newCountry]);
      $orgs = DB::table('funding_org')->get();
      $country = DB::table('funding_org')->distinct()->get(['funding_org_country']);
      return view('editFundOrgModal', compact('orgs', 'country'));
    }
    return 'not';
  }

   function orgEdit(Request $r){
    if(isset($r->countryEditSelect) && isset($r->fundingOrgName)){
      if(isset($r->newCountryEdit) && !empty($r->newNameEdit) && empty($r->typeNewCountry)){
        // return $r->newNameEdit." ".$r->newCountryEdit." ".$r->fundingOrgName." ".$r->countryEditSelect;
        DB::table('funding_org')->where(['funding_org_name'=>$r->fundingOrgName, 'funding_org_country' => $r->countryEditSelect])->update(['funding_org_name'=>$r->newNameEdit, 'funding_org_country' => $r->newCountryEdit]);
      

      } else if(!empty($r->newNameEdit) && !empty($r->typeNewCountry)){
        DB::table('funding_org')->where(['funding_org_name'=>$r->fundingOrgName, 'funding_org_country' => $r->countryEditSelect])->update(['funding_org_name'=>$r->newNameEdit, 'funding_org_country' => $r->typeNewCountry]);
      } else if(empty($r->newNameEdit) && !empty($r->typeNewCountry)){
        DB::table('funding_org')->where(['funding_org_name'=>$r->fundingOrgName, 'funding_org_country' => $r->countryEditSelect])->update(['funding_org_country' => $r->typeNewCountry]);
      } else if(isset($r->newCountryEdit)) {
          DB::table('funding_org')->where(['funding_org_name'=>$r->fundingOrgName, 'funding_org_country' => $r->countryEditSelect])->update(['funding_org_country' => $r->newCountryEdit]);
      } else {
        return 'not';
      }


        $orgs = DB::table('funding_org')->get();
      $country = DB::table('funding_org')->distinct()->get(['funding_org_country']);
      // return 'hiiii';
      return view('editFundOrgModal', compact('orgs', 'country'));

    }

    return 'not';
  }


  function fundOrgDelete(Request $r){
    try {
      // return $r->fundingOrgName." ".$r->countryEditSelect;
      $res = DB::table('funding_org')->where(['funding_org_name'=>$r->fundingOrgName, 'funding_org_country' => $r->countryEditSelect])->delete();
      $orgs = DB::table('funding_org')->get();
      $country = DB::table('funding_org')->distinct()->get(['funding_org_country']);
      return view('editFundOrgModal', compact('orgs', 'country'));
    } catch (Exception $e) {
      return 'not';
    }
  }

  function resInsert(Request $r){
    $newTitle = $r->newTitle;

    try {
      DB::table('research_area')->insert(['research_title'=>$r->newTitle]);
      $m = array('m' => 'insert');
      $res =  DB::table('research_area')->get();
      return view('resList', compact('m', 'res'));
    } catch (Exception $e) {
      return 'not';
    }
  }

  function resEdit(Request $r){
    $newTitle = $r->newTitle;

    try {
      if(isset($r->resSelectNew) && !empty($r->newTitle)){
        DB::table('research_area')->where(['research_title'=>$r->resSelectNew])->update(['research_title'=>$r->newTitle]);
        $m = array('m' => 'insert');
        $res =  DB::table('research_area')->get();
        return view('resList', compact('m', 'res'));
      } else {
        return 'not';
      }
    } catch (Exception $e) {
      return 'not';
    }
  }

    function resDelete(Request $r){
    $newTitle = $r->newTitle;

    try {
      if(isset($r->resSelectNew)){
        DB::table('research_area')->where(['research_title'=>$r->resSelectNew])->delete();
        $m = array('m' => 'insert');
        $res =  DB::table('research_area')->get();
        return view('resList', compact('m', 'res'));
      } else {
        return 'not';
      }
    } catch (Exception $e) {
      return 'not';
    }
  }


}
