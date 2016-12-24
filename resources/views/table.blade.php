@extends('layout')


@section('pageTitle')
	Table View and Update
@endsection


@section('navExtensions')
			<ul id="nav-mobile" class="left hide-on-med-and-down">
		        <li><a href="/tables"><i class="material-icons left">replay</i>Back</a></li>
		    </ul>
@endsection

@section('form')


<div class="card-title col s8 offset-s2"><h2 style="text-align: center">{{ ucfirst(trans($arr[0]->fund_name)) }}</h2><hr></div>

	<form id="mainForm" method="post" action="/tables/{{ $arr[0]->fund_id }}/edit" class="col s12">

				 {{ csrf_field() }}
				<div class="formWrap">
					
					 <div id="firstRow" class="row">
						<div id="fund_name_parent" class="input-field col s6 ">
				          <input placeholder="" name="fund_name" id="fund_name" type="text" class="validate blue-text text-darken-2" value="{{ $arr[0]->fund_name}}">
				          <label for="fund_name" class="">Fund Name</label>
				        </div>
				        <div id="fund_id_parent" class="input-field col s6">
				          <input placeholder="" name="fund_id" id="fund_id" type="text" class="validate" value="{{ $arr[0]->fund_id}}" disabled>
				          <label for="fund_id">Fund ID</label>
				        </div>
					 </div>
					 {{-- <div class="row"> --}}


					 <div class="row">
					 	 <div id="fund_related_id_parent" class="input-field col s12">
				           <select multiple id="fund_related_id" name="fund_related_id[]" class="col s12">
				           <option disabled="">Choose The related funds</option>
					      @foreach($funds as $fund)
					      	<option value="{{ $fund->fund_id }}" 
					      		{{-- @foreach($fund_rel_id as $fr) --}}
					      		@foreach($arr as $a) 
				         		@if(isset($a->related_id))
				         		@if($a->related_id == $fund->fund_id)
				         		selected
				         		@endif
				         		@endif
				         		@endforeach
				         		{{-- @endforeach --}}
				         		> {{$fund->fund_name}} </option>
					      @endforeach
					    </select>
				          <label for="fund_id">Fund Related IDs</label>
				        </div>
					 </div>
					 	

					 	<div id="fund_rating_parent" class="input-field col s6">
				          <input placeholder="" name="fund_rating" id="fund_rating" type="number" min="1" max="6" class="validate" value="{{ $arr[0]->rating}}">
				          <label for="fund_rating">Funding Rating</label>
				        </div>

				        <div id="fund_acceptence_parent" class="input-field col s6">
				          <input placeholder="" name="fund_acceptence" id="fund_acceptence" type="text" class="validate" value="{{ $arr[0]->fund_acceptence}}">
				          <label for="fund_acceptence">Funding Acceptence</label>
				        </div>



				        <div id="fund_org_parent" class="input-field col s6">

					    <select id="fundSelect" name="fund_org" class="col 
					    {{-- @if(isset($m['m'])) --}}
					    s10"
					    {{-- @else --}}
					    {{-- s12" --}}
					    {{-- @endif --}}
					    >
					      @foreach($orgs as $o)
					      	<option value="{{ $o->funding_org_name }}" 
					      	@if(isset($arr[0]->funding_org_name) )
					      	 @if($arr[0]->funding_org_code == $o->funding_org_id)
					      	 @if($arr[0]->funding_org_country == $o->funding_org_country)
				             selected 
				             @endif
				             @endif
				            @endif
					      	>{{ ucfirst(trans($o->funding_org_name)) }} - {{ $o->funding_org_country }}</option>

					      @endforeach
					    </select>
					    <label>Funding Org</label>
					  		{{-- @if(isset($m['m'])) --}}
						  		<div class="col s2">
						    	<a class="btn-floating hoverable" href="#insertFundOrgModal"><i class="material-icons">add</i></a>
						    	</div>
					    	{{-- @endif --}}
					  	</div>
					{{-- </div> --}}
						{{-- @if(isset($m['m'])) --}}
							<!-- Modal Structure -->
							  <div id="insertFundOrgModal" class="modal">
							    <div class="modal-content">
							      <h4>Add a new Fund Organization</h4>

							      <div class="row">
					          		 <div class="input-field col s6">
							            <input id="fundingOrgName" name="fundingOrgName" type="text" class="validate" placeholder="A Name"></input>
							            <label for="fundingOrgName">Funding Organization Name</label>
					          		</div>
								</div>

							    </div>
							    <div class="modal-footer">
							    <div class="center-btn">
							      <button id="insFundOrg" type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat center">Insert</button>
							      <a href="#" class=" modal-action modal-close waves-effect red waves-green btn-flat center">Cancel</a>
							    </div>
							    </div>
							  </div>
						{{-- @endif --}}









				        <div id="fund_resArea_parent" class="input-field col s6">

					    <select id="resSelect" multiple name="resArea[]" class="col s10">
					      @foreach($res as $r)
					      		<option value="{{ $r->research_title }}" 
					      		@foreach($arr as $tmp)
					      		@if(isset($tmp->research_area_code))
						      	@if($r->research_code == $tmp->research_area_code)
						      	selected
						      	@endif
						      	@endif
					      		@endforeach
					      		>{{ ucfirst(trans($r->research_title)) }}</option>
					      @endforeach
					    </select>
					    {{-- <label>Research Area</label> --}}
					    <div class="col s2">
					    	<a class="btn-floating hoverable" href="#insertResAreaModal"><i class="material-icons">add</i></a>
					    </div>
					  	</div>
					{{-- </div> --}}



					  <!-- Modal Structure -->
							  <div id="insertResAreaModal" class="modal">
							    <div class="modal-content">
							      <h4>Add a new research Area</h4>

							      <div class="row">
					          		{{--  <div class="input-field col s6">
							            <input id="resAreaCode" name="resAreaCode" type="number" class="validate" placeholder="A number"></input>
							            <label for="resAreaCode">Reasearch area code</label>
					          		</div> --}}
						
					          		 <div class="input-field col s6">
							            <input id="resAreaTitle" name="resAreaTitle" type="text" class="validate" placeholder="A Title for this research area"></input>
							            <label for="resAreaTitle">Reasearch area title</label>
					          		</div>
								</div>

							    </div>
							    <div class="modal-footer">
							    <div class="center-btn">
							      <button id="insResArea" type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat center">Insert</button>
							      <a href="#" class=" modal-action modal-close waves-effect red waves-green btn-flat center">Cancel</a>
							    </div>
							    </div>
							  </div>

					{{-- <div class="row"> --}}
						<div id="fund_country_parent" class="input-field col s10">
				          <select id="fund_country" name="fund_country" class="icons">
					      {{-- <option value="" disabled selected>Choose your option</option> --}}
					      
					      @foreach($c as $cou)
						      
						      	<option value="{{ $cou->funding_org_country }}" class="circle" 
						      @foreach($arr as $a)
						      @if(isset($a->funding_org_country))
						      @if($cou->funding_org_country == $a->funding_org_country)
						      selected
						      @endif
						      @endif
						      @endforeach
						      >{{ $cou->funding_org_country }}</option>
						      
					      @endforeach

					    </select>
					    <label>Coutry</label>
				        </div>
				        <div class="col s2">
					    	<a class="btn-floating hoverable" href="#addCountry"><i class="material-icons">add</i></a>
					    </div>


					  <!-- Modal Structure -->
							  <div id="addCountry" class="modal">
							    <div class="modal-content">
							      <h4>Add a new Country</h4>

							      <div class="row">
					          		 <div class="input-field col s12">
							            <input id="country" name="country" type="text" class="validate" placeholder="A country name"></input>
							            <label for="country">Country name</label>
					          		</div>
									
								</div>

							    </div>
							    <div class="modal-footer">
							    <div class="center-btn">
							      <button id="addC" class=" modal-action modal-close waves-effect waves-green btn-flat center">add</button>
							      <button id="cancelCountry" class=" modal-action modal-close waves-effect red waves-green btn-flat center">Cancel</button>
							    </div>
							    </div>
							  </div>

					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_prog_parent" class="input-field col s12">
				            <textarea id="program_desc" name="program_desc" class="materialize-textarea" length="120" class="validate" placeholder="Search in program description" >{{ $arr[0]->fund_program_description }}</textarea>
				            <label for="program_desc">Program Description</label>
		          		</div>

		          		
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_duration_parent" class="input-field col s6">
				            <textarea id="duration" name="duration" class="materialize-textarea" length="80" class="validate" placeholder="Search accoring to duration description">{{ $arr[0]->duration }}</textarea>
				            <label for="duration">Duration Description</label>
		          		</div>
			
		          		 <div id="fund_financial_parent" class="input-field col s6">
				            <textarea id="financial_support" name="financial_support" class="materialize-textarea" length="80" class="validate" placeholder="Search accoring to financial support">{{ $arr[0]->financial_support }}</textarea>
				            <label for="financial_support">financial support </label>
		          		</div>
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_requirements_parent" class="input-field col s6">
				            <textarea id="requirements" name="requirements" class="materialize-textarea" length="80" class="validate" placeholder="Search according to requirements" >{{ $arr[0]->requirements }}</textarea>
				            <label for="requirements">Requirements</label>
		          		</div>
				
		          		 <div id="fund_deadline_parent" class="input-field col s6">
				            <textarea id="deadline" name="deadline" class="materialize-textarea" length="80" class="validate" placeholder="Search according to deadline">{{ $arr[0]->deadline }}</textarea>
				            <label for="deadline">Deadline</label>
		          		</div>
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_link1_parent" class="input-field col s6">
				            <textarea id="link1" name="link1" class="materialize-textarea" length="120" class="validate" placeholder="Search with Link 1"  >{{ $arr[0]->link1 }}</textarea>
				            <label for="link1" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="U can click me!"><a href="{{ $arr[0]->link1 }}">Link 1</a></label>
		          		</div>
					
		          		 <div id="fund_link2_parent" class="input-field col s6">
				            <textarea id="link2" name="link2" class="materialize-textarea" length="120" class="validate" placeholder="Search with link 2" >{{ $arr[0]->link2 }}</textarea>
				            <label for="link2" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="U can click me!"><a href="{{ $arr[0]->link2 }}">Link 2</a></label>
		          		</div>
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_memo_parent" class="input-field col s6">
				            <textarea id="memo" name="memo" class="materialize-textarea" length="120" class="validate" placeholder="Search in memo">{{ $arr[0]->memo }}</textarea>
				            <label for="memo">Memo</label>
		          		</div>
					
		          		 <div id="fund_farsi_parent" class="input-field col s6">
				            <textarea style="font-family: IRANSans; direction: rtl" id="farsiDesc" name="farsiDesc" class="materialize-textarea" length="120" class="validate" placeholder="Search in Farsi Description"  >{{ $arr[0]->farsi_desc }}</textarea>
				            <label for="farsiDesc">Farsi Description</label>
		          		</div>
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_comment_parent" class="input-field col s6 offset-s3">
				            <textarea style="text-align: center; font-family: IRANSans; direction: rtl" id="comment" name="comment" class="materialize-textarea" length="120" class="validate" placeholder="Search in comments" >{{ $arr[0]->comments }}</textarea>
				            <label for="comment">Comment</label>
		          		</div>
					{{-- </div> --}}

					<div id="fund_tag_parent" class="row">
		          		 

				           	{{-- <div class="chips chips-placeholder"></div> --}}
				        	 <select name="tags[]" multiple id="tag" class="col s10">
				         	@foreach($tags as $tag)
				         		<option value="{{ $tag->tag_id }}"
				         		@foreach($arr as $a) 
				         		@if(isset($a->tag_id) && isset($tag->tag_id))
				         		@if($a->tag_id == $tag->tag_id)
				         		selected
				         		@endif
				         		@endif
				         		@endforeach
				         		>{{ $tag->tag_real }} - {{ $tag->tag_desc }}</option>
				         	@endforeach
				         	</select>

				         	<div class="col s2">
					    		<a class="btn-floating hoverable" href="#insertTag"><i class="	material-icons">add</i></a>
					    	</div>

					    	 <!-- Modal Structure -->
							  <div id="insertTag" class="modal">
							    <div class="modal-content">
							      <h4>Add a new tag</h4>

							      <div class="row">
					          		 <div class="input-field col s6">
							            <input id="parentID" name="parentID" type="text" class="validate" placeholder="A number"></input>
							            <label for="parentID">Parent Tag ID</label>
					          		</div>
						
					          		 <div class="input-field col s6">
							            <input id="tagTitle" name="tagTitle" type="text" class="validate" placeholder="A Title for this Tag"></input>
							            <label for="tagTitle">Tag Title</label>
					          		</div>
								</div>

							    </div>
							    <div class="modal-footer">
							    <div class="center-btn">
							      <button type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat center">Insert</button>
							      <a href="#" class=" modal-action modal-close waves-effect red waves-green btn-flat center">Cancel</a>
							    </div>
							    </div>
							  </div>

					</div>

					<div class="row">
	          			<button id="subbutt" type="submit" class="waves-effect waves-light btn col s12">Update</button>
					</div>

					 
				 </div>

		       {{--  <div class="input-field inline">
		            <input id="email" name="email" type="email" class="validate">
		            <label for="email" data-error="wrong" data-success="right">Email</label>
          		</div> --}}

</form>


@endsection