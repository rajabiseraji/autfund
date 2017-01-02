<select multiple id="resSelect" name="resArea[]" class="col s10">
					      @foreach($res as $r)

					      	<option value="{{ $r->research_title }}">{{ ucfirst(trans($r->research_title)) }}</option>

					      @endforeach
</select>

