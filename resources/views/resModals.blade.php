
					    <label>Research Area</label>
					  	
						  		<div class="col s1">
						    	<a class="btn-floating hoverable tooltipped" href="#insertResAreaModal" data-position="bottom" data-delay="50" data-tooltip="Add a new research area"><i class="material-icons">add</i></a>
						    	</div>
						    	<div class="col s1">
						    		<a class="btn-floating hoverable tooltipped" href="#editResearchAreaModal" data-position="bottom" data-delay="50" data-tooltip="Edit a research area"><i class="material-icons">menu</i></a>
						    	</div>
					    
					  	
					
							<!-- Modal Structure -->
							  <div id="insertResAreaModal" class="modal">
							    <div class="modal-content">
							      <h3 class="center">You can <strong>Add a new research Area</strong></h3>
							      <br>
							      <div class="row">
								     <h4>Type your new research area name</h4>
					          		 <div class="input-field col s12">
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

							   <div id="editResearchAreaModal" class="modal">
							    <div class="modal-content">
							      <h3 class="center">You can <strong>Edit or Delete</strong> an existing research Area</h3>
							      <br>
							      <div class="row">
							      	<h4 class="center"><strong>Select</strong> the fund you wish to edit</h4>
									<select id="resSelectNew" name="resAreaNew" class="col s12">
								      @foreach($res as $r)

								      	<option value="{{ $r->research_title }}">{{ ucfirst(trans($r->research_title)) }}</option>

								      @endforeach
										</select>
							      </div>

							      <div class="row">
							      		<br>
							      	 <h2 class="center">Edit</h2>
								     <h4 class="center"><strong>Type a new name</strong> for the selected research area</h4>
					          		 <div class="input-field col s12">
							            <input id="resAreaTitleNew" name="resAreaTitleNew" type="text" class="validate" placeholder="A Title for this research area"></input>
							            <label for="resAreaTitleNew">Reasearch area title</label>
					          		</div>
								</div>

							    </div>
							    <div class="modal-footer">
							    <div class="center-btn">
							      <button id="editResArea" type="submit" class=" modal-action modal-close waves-effect waves-white green btn-flat center">Submit Changes</button>
							      <button id="deleteResArea" type="submit" class=" modal-action modal-close waves-effect waves-green red btn-flat center">Delete</button>
							      <a href="#" class=" modal-action modal-close waves-effect red waves-green btn-flat center">Cancel</a>
							    </div>
							    </div>
							  </div>
					
