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
								         		@if(isset($m['m']))
												selected
												@endif
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