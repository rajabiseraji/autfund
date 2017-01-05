{{-- @yield('tagValue') --}}



@if(isset($m['m']))
	<select name="tags[]" searchable="Search here ..." multiple id="tag" class="col s10">
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
@else

	@include('tags')

@endif

@include('tagModals')