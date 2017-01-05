@if(isset($m['m']))
									<select id="resSelect" searchable="Search here ..." multiple name="resArea[]" class="col s10">
								      @foreach($res as $r)
								      		<option value="{{ $r->research_code }}" 
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
				        	@else
				        		



<select multiple id="resSelect" name="resArea[]" class="col s10">
					      @foreach($res as $r)

					      	<option value="{{ $r->research_title }}" 
					      	@if($loop->index==0)
					      	selected
					      	@endif
					      	>{{ ucfirst(trans($r->research_title)) }}</option>

					      @endforeach
</select>

						@endif
						@include('resModals')

