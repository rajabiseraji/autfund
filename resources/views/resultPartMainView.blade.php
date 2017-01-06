
  <div class="card-header"><h3 class="center red-text text-lighten-2">Search results</h3></div>
@if(count($qq)>0)
  <div class="row">
  <div class="btn green col col s6 offset-s3" id="expandAll" >Toggle expand all</div>
  <hr class="col s12">
    <div class="col s12">
      <ul class="tabs">
      @foreach($funding_orgs as $funding_org)
        <li class="tab"><a href="#{{ $funding_org}}"><b>{{ $funding_org }}</b></a></li>
      @endforeach
      </ul>
    </div>
    @foreach($funding_orgs as $funding_org)
    	<div id="{{ $funding_org }}" class="col s12">
		    			<ul class="collapsible" data-collapsible="expandable">
		 
			@foreach($qq as $r)
				@if($r->funding_org_name == $funding_org)
				  <li>
						    <div class="collapsible-header
						    	@if(!empty($r->comments))
							    	@if(preg_match('/undone/', $r->comments))
							    		yellow
							    	@endif
						    	@endif
						    "><i class="material-icons">filter_drama</i>
						    <div class="row">
						    	
						    	
						    	<span class="col s10">{{ $r->fund_id }}  -  {{ $r->fund_name }}</span>
						    	@if (!(Auth::guest()))
						    		<a href="{{ url('/tables/'.$r->fund_id.'/delete') }}" class="secondary-content"><i class="material-icons red-text ">delete</i></a>
						    	@endif
						    
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
