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
					  		
						  		