  	
  	 
				         
					
				         <select multiple searchable="Search here.." name="tags[]" id="tag" class="col s10">
				         @foreach($tags as $tag)
				         		<option value="{{ $tag->tag_id }}" id="{{ $tag->tag_real }}"
				         		@if($loop->index == 0)
								selected
								@endif 
				         		>{{ $tag->tag_real }} - {{ $tag->tag_desc }}</option>
				         	@endforeach
		          		</select>

		          		