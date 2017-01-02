  
@extends('layout')

@section('pageTitle')
	Search Results
@endsection

@section('navExtensions')
			<ul id="nav-mobile" class="left hide-on-med-and-down">
		        <li><a href="/tables"><i class="material-icons left">replay</i>Back</a></li>
		        <li>
		    </ul>
@endsection

@section('form')
	<h2 class="center black-text">Select your desired table from the list below</h2>
	<hr class="col s5">
	<span class="center green-text col s2">OR</span>
	<hr class="col s5">
	<div id="filter" class="card-panel hoverable gray text-black  col s10 offset-s1">
		<h2 class="center green-text">Use search filters</h2>
	</div>
	<div id="filterDescription" class = "col s10 offset-s1 card" style="display: none">
		<div class="card-content">

        <div class="input-field">
          <input id="search" type="text"  >
          <label for="search">Look for a Fund name, a comment or any other text</label>
        </div>
        <h3 class="center">Where do you want to look for your text? </h3>
        
        <div class="input-field">
        	<input type="checkbox" id="fund_name_check"   />
	      	<label for="fund_name_check">In Fund Names</label>
	    </div>
	    <div class="input-field">
	      	<input type="checkbox" id="fund_prog_check"   />
	      	<label for="fund_prog_check">In Fund Descriptions</label>
	    </div>
	    <div class="input-field">
	      	<input type="checkbox" id="fund_duration_check"   />
	      	<label for="fund_duration_check">In Fund Duration descriptions</label>
        </div>
        <div class="input-field">
	      	<input type="checkbox" id="fund_financial_check"   />
	      	<label for="fund_financial_check">In Fund Financial Support descriptions</label>
        </div>
        <div class="input-field">
	      	<input type="checkbox" id="fund_requirement_check"   />
	      	<label for="fund_requirement_check">In Fund Requirements descriptions</label>
        </div>
        <div class="input-field">
	      	<input type="checkbox" id="fund_deadline_check"   />
	      	<label for="fund_deadline_check">In Fund Deadline Information</label>
        </div>
        <div class="input-field">
	      	<input type="checkbox" id="fund_link_check"   />
	      	<label for="fund_link_check">In Fund Web URLs </label>
        </div>
        <div class="input-field">
	      	<input type="checkbox" id="fund_memo_check"   />
	      	<label for="fund_memo_check">In Fund Memo </label>
        </div>
        <div class="input-field">
	      	<input type="checkbox" id="fund_farsi_check"   />
	      	<label for="fund_farsi_check">In Fund Farsi Descriptions </label>
        </div>
        <div class="input-field">
	      	<input type="checkbox" id="fund_comments_check"   />
	      	<label for="fund_comments_check">Or In Fund Comments </label>
        </div>
        <br>
        <div id="fund_tag_parent" class="row">	
        	 <h3 class="center black-text text-lighten-2">You can specify your <strong>fund category</strong> here</h3>	          		 
			 {{-- @include('tags') --}}
			 <select multiple name="tags[]" id="tag" class="col s12">
				         @foreach($tags as $tag)
				         		<option value="{{ $tag->tag_id }}" id="{{ $tag->tag_real }}">{{ $tag->tag_real }} - {{ $tag->tag_desc }}</option>
				         	@endforeach
		          		</select>
			</div>

		</div>
		<div class="row">
			<h3 class="center black-text text-lighten-2">The fund you're looking has <strong>rating</strong> of: </h3>
			<div id="fund_rating_parent" class="input-field col s12">
				          <input placeholder="" name="fund_rating" id="fund_rating" type="number" min="1" max="6" class="validate">
			</div>
		</div>

		<div class="row">
			<h3 class="center black-text text-lighten-2">Specify the <strong> research area</strong> of the fund you're looking for </h3>
			<div id="fund_resArea_parent" class="input-field col s12">

					    <select multiple id="resSelect" name="resArea[]" class="col s12">
					      @foreach($res as $r)

					      	<option value="{{ $r->research_title }}" >{{ ucfirst(trans($r->research_title)) }}</option>

					      @endforeach
					    </select>
			</div>
		</div>	

		<div class="row">
			<h3 class="center black-text text-lighten-2">Specify the <strong>Country</strong> of the fund you're looking for </h3>
			<div id="fund_country_parent" class="input-field col s12">
				          <select id="fund_country" name="fund_country" class="icons">
					      <option value="" disabled selected>Choose your option</option>
					      
					      @foreach($country as $c)
					      	<option value="{{ $c->funding_org_country }}" class="circle">{{ $c->funding_org_country }}</option>	
					      @endforeach

					    </select>
					    <label>Coutry</label>
				        </div>
		</div>

		<div class="row">
			<h3 class="center black-text text-lighten-2">Specify the <strong>funding organization</strong> of the fund you're looking for </h3>
			<div id="fund_org_parent" class="input-field col s6">

					    <select id="fund_org" name="fund_org" class="col s12">
						<option value="" disabled selected>Choose your option</option>

					      @foreach($orgs as $o)
					      	<option value="{{ $o->funding_org_name }}" >{{ ucfirst(trans($o->funding_org_name)) }}</option>

					      @endforeach
					    </select>
			</div>
		</div>

		 <div class="row">
		 				<h3 class="center black-text text-lighten-2">The fund you're looking for is <strong>related to</strong>: </h3>
					 	 <div id="fund_related_id_parent" class="input-field col s12">
				           <select multiple id="fund_related_id" name="fund_related_id[]" class="col s12">
							<option disabled selected>Choose The related funds</option>

					      @foreach($fund_rel_id as $fr)
					      	<option value="{{ $fr->fund_id }}">{{ ucfirst(trans($fr->fund_name)) }}</option>

					      @endforeach
					    </select>
				        </div>
					 </div>
		</div>
	</div>
@endsection

@section('board')
	@include('resultPartMainView')
@endsection
