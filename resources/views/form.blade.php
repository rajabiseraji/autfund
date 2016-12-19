@extends('layout')



@if(!isset($m['m']))
@include('pageHeader')
@endif

@section('form')


@if(isset($m['m']))
<div class="card-title col s8 offset-s2"><h1 style="text-align: center">Table Insert</h1><hr></div>
	<form id="mainForm" method="post" action="/insert" class="col s12">	
	@section('pageTitle')
		Table Insert
	@endsection
@else
<div class="card-title col s8 offset-s2"><h2 style="text-align: center">Table Search</h2><hr></div>
	<form id="mainForm" method="post" action="/tables" class="col s12">
	@section('pageTitle')
		Table Search
	@endsection

@endif
				 {{ csrf_field() }}
				
				<div class="formWrap">
					
					 <div id="firstRow" class="row">
						
						<div id="fund_name_parent" class="input-field col s6 ">
				          <input placeholder="" name="fund_name" id="fund_name" type="text" class="validate blue-text text-darken-2">
				          <label for="fund_name" class="">Fund Name</label>
				        </div>
				        <div id="fund_id_parent" class="input-field col s6">
				          <input placeholder="" name="fund_id" id="fund_id" type="text" class="validate">
				          <label for="fund_id">Fund ID</label>
				        </div>
					 	
					 </div>

					 <div class="row">
					 	 <div id="fund_related_id_parent" class="input-field col s12">
				           <select multiple id="fund_related_id" name="fund_related_id[]" class="col s12">
							<option disabled="">Choose The related funds</option>

					      @foreach($fund_rel_id as $fr)
					      	<option value="{{ $fr->fund_id }}">{{ ucfirst(trans($fr->fund_name)) }}</option>

					      @endforeach
					    </select>
				          <label for="fund_id">Fund Related IDs</label>
				        </div>
					 </div>
					 {{-- <div class="row"> --}}
					 	

					 	<div id="fund_rating_parent" class="input-field col s6">
				          <input placeholder="" name="fund_rating" id="fund_rating" type="number" min="1" max="6" class="validate">
				          <label for="fund_rating">Funding Rating</label>
				        </div>

				        <div id="fund_acceptence_parent" class="input-field col s6">
				          <input placeholder="" name="fund_acceptence" id="fund_acceptence" type="text" class="validate">
				          <label for="fund_acceptence">Funding Acceptence</label>
				        </div>




				        <div id="fund_org_parent" class="input-field col s6">
				          <input placeholder="" name="fund_org" id="fund_org" type="text" class="validate">
				          <label for="fund_org">Funding Organization</label>
				        </div>


				        <div id="fund_resArea_parent" class="input-field col s6">

					    <select multiple id="resSelect" name="resArea[]" class="col 
					    @if(isset($m['m']))
					    s10"
					    @else
					    s12"
					    @endif
					    >
					      @foreach($res as $r)
					      	<option value="{{ $r->research_code }}">{{ ucfirst(trans($r->research_title)) }}</option>

					      @endforeach
					    </select>
					    <label>Research Area</label>
					  		@if(isset($m['m']))
						  		<div class="col s2">
						    	<a class="btn-floating hoverable" href="#insertResAreaModal"><i class="material-icons">add</i></a>
						    	</div>
					    	@endif
					  	</div>
					{{-- </div> --}}
						@if(isset($m['m']))
							<!-- Modal Structure -->
							  <div id="insertResAreaModal" class="modal">
							    <div class="modal-content">
							      <h4>Add a new research Area</h4>

							      <div class="row">
					          		 <div class="input-field col s6">
							            <input id="resAreaCode" name="resAreaCode" type="number" class="validate" placeholder="A number"></input>
							            <label for="resAreaCode">Reasearch area code</label>
					          		</div>
						
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
						@endif


					  
					{{-- <div class="row"> --}}
						<div id="fund_country_parent" class="input-field col 
						@if(isset($m['m']))
						s10"
						@else
						s12"
						@endif
						>
				          <select id="fund_country" name="fund_country" class="icons">
					      <option value="" disabled selected>Choose your option</option>
					      
					      @foreach($country as $c)
					      	<option value="{{ $c }}" data-icon="{{ asset($c.'.jpg') }}" class="circle">{{ $c }}</option>	
					      @endforeach

					    </select>
					    <label>Coutry</label>
				        </div>
				   @if(isset($m['m']))
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
					@endif
					{{-- <div class="row"> --}}
		          		 <div id="fund_prog_parent" class="input-field col s12">
				            <textarea id="program_desc" name="program_desc" class="materialize-textarea" length="120" class="validate" placeholder="Search in program description"></textarea>
				            <label for="program_desc">Program Description</label>
		          		</div>

		          		
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_duration_parent" class="input-field col s6">
				            <textarea id="duration" name="duration" class="materialize-textarea" length="80" class="validate" placeholder="Search accoring to duration description"></textarea>
				            <label for="duration">Duration Description</label>
		          		</div>
			
		          		 <div id="fund_financial_parent" class="input-field col s6">
				            <textarea id="financial_support" name="financial_support" class="materialize-textarea" length="80" class="validate" placeholder="Search accoring to financial support"></textarea>
				            <label for="financial_support">financial support </label>
		          		</div>
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_requirements_parent" class="input-field col s6">
				            <textarea id="requirements" name="requirements" class="materialize-textarea" length="80" class="validate" placeholder="Search according to requirements"></textarea>
				            <label for="requirements">Requirements</label>
		          		</div>
				
		          		 <div id="fund_deadline_parent" class="input-field col s6">
				            <textarea id="deadline" name="deadline" class="materialize-textarea" length="80" class="validate" placeholder="Search according to deadline"></textarea>
				            <label for="deadline">Deadline</label>
		          		</div>
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_link1_parent" class="input-field col s6">
				            <textarea id="link1" name="link1" class="materialize-textarea" length="120" class="validate" placeholder="Search with Link 1"></textarea>
				            <label for="link1">Link 1</label>
		          		</div>
					
		          		 <div id="fund_link2_parent" class="input-field col s6">
				            <textarea id="link2" name="link2" class="materialize-textarea" length="120" class="validate" placeholder="Search with link 2"></textarea>
				            <label for="link2">Link 2</label>
		          		</div>
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_memo_parent" class="input-field col s6">
				            <textarea id="memo" name="memo" class="materialize-textarea" length="120" class="validate" placeholder="Search in memo"></textarea>
				            <label for="memo">Memo</label>
		          		</div>
					
		          		 <div id="fund_farsi_parent" class="input-field col s6">
				            <textarea id="farsiDesc" name="farsiDesc" class="materialize-textarea" length="120" class="validate" placeholder="Search in Farsi Description"></textarea>
				            <label for="farsiDesc">Farsi Description</label>
		          		</div>
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_comment_parent" class="input-field col s6 offset-s3">
				            <textarea id="comment" name="comment" class="materialize-textarea" length="120" class="validate" placeholder="Search in comments"></textarea>
				            <label for="comment">Comment</label>
		          		</div>
					{{-- </div> --}}

					<div id="fund_tag_parent" class="row">
		          		 

				           	{{-- <div class="chips chips-placeholder"></div> --}}
				         <select multiple name="tags[]" id="tag" class="col 
				         @if(isset($m['m']))
				         s10"
				         @else
				         s12"
				         @endif
				         >
				         @foreach($tags as $tag)
				         		<option value="{{ $tag->tag_id }}">{{ $tag->tag_real }} - {{ $tag->tag_desc }}</option>
				         	@endforeach
		          		</select>

		          		@if(isset($m['m']))

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
							            <label for="resAreaCode">Parent Tag ID</label>
					          		</div>
						
					          		 <div class="input-field col s6">
							            <input id="tagTitle" name="tagTitle" type="text" class="validate" placeholder="A Title for this Tag"></input>
							            <label for="resAreaTitle">Tag Title</label>
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
		          		@endif

					</div>

					<div class="row">
	          			<button id="subbutt" type="submit" class="waves-effect waves-light btn col s12">
	          			@if(!isset($m['m']))
	          			Search
	          			@else
	          			Insert
	          			@endif
	          			</button>
					</div>

					 
				 </div>

		       {{--  <div class="input-field inline">
		            <input id="email" name="email" type="email" class="validate">
		            <label for="email" data-error="wrong" data-success="right">Email</label>
          		</div> --}}

</form>

@endsection