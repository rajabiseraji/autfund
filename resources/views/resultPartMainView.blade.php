
  <div class="card-header"><h3 class="center red-text text-lighten-2">Search results</h3></div>
@if(count($qq)>0)
  <div class="row"><hr>
    <div class="col s12">
      <ul class="tabs">
      @foreach($funding_orgs as $funding_org)
        <li class="tab col s3"><a href="#{{ $funding_org}}">{{ $funding_org }}</a></li>
      @endforeach
      </ul>
    </div>
    @foreach($funding_orgs as $funding_org)
    	<div id="{{ $funding_org }}" class="col s12">
		    			<ul class="collapsible" data-collapsible="accordion">
		 
			@foreach($qq as $r)
				@if($r->funding_org_name == $funding_org)
				  <li>
						    <div class="collapsible-header"><i class="material-icons">filter_drama</i>
						    <div class="row">
						    	<span class="col s10">{{ $r->fund_id }}  -  {{ $r->fund_name }}</span>
						    		<a href="{{ url('/tables/'.$r->fund_id.'/delete') }}" class="secondary-content"><i class="material-icons red-text ">delete</i></a>
						    	
						    
							    	<a href="{{ url('/tables/'.$r->fund_id) }}" class="secondary-content"><i class="material-icons green-text">send</i>
							    	</a>
						    
						    </div>
						    </div>
						    <div class="collapsible-body col s12"><p style="text-align: center; font-family: IRANSans; direction: rtl">{{ $r->farsi_desc }}</p>
				      				
						    </div>
				  </li>
				@endif
			@endforeach
		     </ul>		
    	</div>
    @endforeach
  </div>
@else

	<h2 class="center red-text text-lighten-2">Your Search didn't return any result</h2>

@endif
