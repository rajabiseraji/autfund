
				         	<div class="col s2">
					    		<a class="btn-floating hoverable tooltipped" href="#insertTag" data-position="bottom" data-delay="50" data-tooltip="Add a new Tag"><i class="material-icons">add</i></a>
					    		<a class="btn-floating hoverable tooltipped" href="#editTag" data-position="bottom" data-delay="50" data-tooltip="Edit a Tag"><i class="material-icons">menu</i></a>
					    	</div>

					    	 <!-- Modal Structure -->
							  <div id="insertTag" class="modal">
							    <div class="modal-content">
							      <h4>Add a new tag</h4>

							      <div class="row">
					          		 <div id="tagPar" class="input-field col s6">
							            <select  name="parentID" id="parentID" >
								         @foreach($tags as $tag)
								         		<option value="{{ $tag->tag_id }}" id="{{ $tag->tag_real }}"
								         		@if($loop->index == 0)
												selected
												@endif 
								         		>{{ $tag->tag_real }} - {{ $tag->tag_desc }}</option>
								         	@endforeach
						          		</select>
					          		</div>
						
					          		 <div class="input-field col s6">
							            <input id="tagTitle" name="tagTitle" type="text" class="validate" placeholder="A Title for this Tag"></input>
							            <label for="parentID">Tag Title</label>
					          		</div>
								</div>

							    </div>
							    <div class="modal-footer">
							    <div class="center-btn">
							      <button id="insTag" type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat center">Insert</button>
							      <a href="#" class=" modal-action modal-close waves-effect red waves-green btn-flat center">Cancel</a>
							    </div>
							    </div>
							  </div>
							  

							  <!-- Modal Structure -->
							  <div id="editTag" class="modal">
							    <div class="modal-content">
							      <h4>Edit a tag</h4>

							      <div class="row">
					          		 <div id="tagParEdit" class="input-field col s6">
							            <select  name="tagIdEdit" id="tagIdEdit" >
								         @foreach($tags as $tag)
								         		<option value="{{ $tag->tag_id }}" id="{{ $tag->tag_real }}"
								         		@if($loop->index == 0)
												selected
												@endif 
								         		>{{ $tag->tag_real }} - {{ $tag->tag_desc }}</option>
								         	@endforeach
						          		</select>
					          		</div>
						
					          		 <div class="input-field col s6">
							            <input id="tagTitleEdit" name="tagTitleEdit" type="text" class="validate" placeholder="A Title for this Tag - If you want to delete something don't fill this part "></input>
							            <label for="parentID">Tag Title</label>
					          		</div>
								</div>

							    </div>
							    <div class="modal-footer">
							    <div class="center-btn">
							      <button id="renameTag" type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat center">Rename</button>
							      <button id="deleteTag" type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat center">Delete</button>
							      <a href="#" class=" modal-action modal-close waves-effect red waves-green btn-flat center">Cancel</a>
							    </div>
							    </div>
							  </div>

