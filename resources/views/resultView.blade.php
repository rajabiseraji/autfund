@extends('layout')

@section('pageTitle')
	Search Results
@endsection

@section('navExtensions')
			<ul id="nav-mobile" class="left hide-on-med-and-down">
		        <li><a href="/tables"><i class="material-icons left">replay</i>Back</a></li>
		    </ul>
@endsection

@section('board')


	<ul class="collapsible" data-collapsible="accordion">
        

	@foreach($result as $r)

		  <li>
				    <div class="collapsible-header"><i class="material-icons">filter_drama</i>
				    <div class="row">
				    	<span class="col s10">{{ $r->fund_id }}  -  {{ $r->fund_name }}</span>{{-- <span class="badge"> --}}
				    	
				    		<a href="{{ url('/tables/'.$r->fund_id.'/delete') }}" class="secondary-content"><i class="material-icons red-text ">delete</i></a>
				    	
				    
					    	<a href="{{ url('/tables/'.$r->fund_id) }}" class="secondary-content"><i class="material-icons green-text">send</i>
					    	</a>
				    
				    	{{-- </span> --}}
				    </div>
				    </div>
				    <div class="collapsible-body col s12"><p style="text-align: center; font-family: IRANSans; direction: rtl">{{ $r->farsi_desc }}</p>
		      				
				    </div>
		  </li>

		      	{{-- <p>{{ $r->fund_id }}<br>
		      	{{ $r->fund_program_description }}
		      	</p> --}}
	@endforeach


     </ul>
@endsection