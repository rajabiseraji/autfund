
							@if(isset($m['m']))
							    <select id="fundSelect" name="fund_org" class="col s10">
							      @foreach($orgs as $o)
							      	<option value="{{ $o->funding_org_id }}" 
							      	@if(isset($arr[0]->funding_org_name) )
							      	 @if($arr[0]->funding_org_code == $o->funding_org_id)
						             selected 
						             @endif
						            @endif
							      	>{{ ucfirst(trans($o->funding_org_name)) }} - {{ $o->funding_org_country }}</option>

							      @endforeach
							    </select>
							    <label>Funding Org</label>
				       		@else
				       			

						<select id="fundSelect" name="fund_org" class="col s10">
						<option value="" disabled selected>Choose your option</option>

					      @foreach($orgs as $o)
					      	<option value="{{ $o->funding_org_name }}" 
					      	@if($loop->index == 0)
							selected
							@endif 
					      	>{{ ucfirst(trans($o->funding_org_name)) }} - {{ $o->funding_org_country }}</option>

					      @endforeach
					    </select>
					    <label>Funding Org</label>
					  		
				       		@endif
							@include('fundOrgModals')