<div class="col s1">
						    	<a class="btn-floating hoverable tooltipped" href="#insertFundOrgModal" data-position="bottom" data-delay="50" data-tooltip="Add a new Fund organization"><i class="material-icons">add</i></a>
						    	</div>
						    	<div class="col s1">
						    		<a class="btn-floating hoverable tooltipped" href="#editFundOrg" data-position="bottom" data-delay="50" data-tooltip="Edit a Fund organization"><i class="material-icons">menu</i></a>
						    	</div>
					    	
					  	
					  <!-- Modal Structure -->
							  <!-- Modal Structure -->
							  <div id="insertFundOrgModal" class="modal">
							    <div class="modal-content">
							      <h4>Add a new Fund Organization</h4>

							      <div class="row">
					          		 <div class="input-field col s6">
							            <input id="fundingOrgName" name="fundingOrgName" type="text" class="validate" placeholder="A Name"></input>
							            <label for="fundingOrgName">Funding Organization Name</label>
					          		</div>
					          		 <div id="countryParent" class="input-field col s3">
							            <select searchable="Search here ..." name="country" id="country" >
								        
								        	@foreach($country as $c)
									      	<option value="{{ $c->funding_org_country }}" class="circle" >{{ $c->funding_org_country }}</option>	
									      	@endforeach
						          		</select>
					          		</div>
					          		 <div id="newCountryParent" class="input-field col s3">
							            <input type="text" name="newCountry" id="newCountry" >
								        </input>
								        <label for="newCountry">New country name</label>
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

					{{-- </div> --}}

					<!-- Modal Structure -->
							
					  <!-- Modal Structure -->
							  <!-- Modal Structure -->
							  <div id="editFundOrg" class="modal">
							    <div class="modal-content">
							    
					          	<div class="row">
					          		<br>
					          			<h3 class="col s12">You can <strong>Change fund organization name</strong> here:</h3>
						          		<div id="newNameEditParent" class="input-field col s12">
						          			
								            <input type="text" name="newNameEdit" id="newNameEdit" >
									        </input>
									        <label for="newNameEdit">Type a new name for your selected organization</label>
						          		</div>

					          		<br>
					          		<h3 class="col s12">Choose a new country for your fund form the list below</h3>
					          		<div id="countryEditSelect" class="input-field col s12">
					          			
							            <select searchable="Search here ..."  name="countryEditSelect" id="countryEditSelector" >
								        
								        	@foreach($country as $c)
									      	<option value="{{ $c->funding_org_country }}" class="circle">{{ $c->funding_org_country }}</option>	
									      	@endforeach
						          		</select>
						          		<label for="countryEditSelect">Choose your fund new country</label>
						          		<br>

						          		
					          		</div>
					          			{{-- <h3 class="center"><strong>OR</strong></h3> --}}
						          		{{-- <h3 class="col s12">Add a new country</h3> --}}
					          		{{-- <div class="input-field col s12">
						          		<input type="text" name="typeNewCountry" id="typeNewCountry" >
									        </input>
									        <label for="typeNewCountry">Type a new country name</label>
					          		</div> --}}
						          	

						          		<h3 class="center">If you want to <strong>Delete</strong> an organization, Choose it and just click Delete</h3>
						          		<div class="input-field col s12">
							            <select searchable="Search here ..." id="fundingOrgNameEdit" name="fundingOrgNameEdit" class="col s12">
										<option value="" disabled selected>Choose your option</option>

									      @foreach($orgs as $o)
									      	<option value="{{ $o->funding_org_name }}-{{ $o->funding_org_country }}" 
									      		@if(isset($arr[0]->funding_org_name) )
										      	 @if($arr[0]->funding_org_code == $o->funding_org_id)
									             selected 
									             @endif
									            @endif
									      	>{{ ucfirst(trans($o->funding_org_name)) }}</option>

									      @endforeach
					    				</select>
							            <label for="fundingOrgName">Funding Organization Name</label>
							            <div class="row">
					          		 
					          		
						          		<div class="center-btn center">
						          			<button id="deleteFundOrg" type="submit" class=" modal-action modal-close waves-effect waves-red red btn-flat center">Delete</button>
						          		</div>
					          	</div>
					          		</div>
					          		
								</div>

							    </div>
							    <div class="modal-footer">
							    <div class="center-btn center">
							      <button id="editFundOrgSub" type="submit" class=" modal-action modal-close waves-effect waves-white green btn-flat center">Submit Changes</button>
							      
							      <a href="#" class=" modal-action modal-close waves-effect red waves-green btn-flat center">Cancel</a>
							    </div>
							    </div>
							  </div>
