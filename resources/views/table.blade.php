@extends('parentForm')


@section('pageTitle')
	Table View and Update
@endsection


@section('navExtensions')
			<ul id="nav-mobile" class="left hide-on-med-and-down">
		        <li><a href="/main"><i class="material-icons left">replay</i>Back</a></li>
		    </ul>
@endsection



@section('formHead')
<div class="card-title col s8 offset-s2"><h2 style="text-align: center">{{ ucfirst(trans($arr[0]->fund_name)) }}</h2><hr></div>
	<form id="mainForm" method="post" action="/tables/{{ $arr[0]->fund_id }}/edit" class="col s12">



@endsection
				@section('fundNameValue' , $arr[0]->fund_name)


				@section('tagValue')
				        	 <select name="tags[]" multiple searchable="Search here.." id="tag" class="col s10">
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
				@endsection

				         	
				@section('fundRelatedValue')
				           <select multiple searchable="Search here.." id="fund_related_id" name="fund_related_id[]" class="col s12">
				           <option disabled="">Choose The related funds</option>
					      @foreach($funds as $fund)
					      	<option value="{{ $fund->fund_id }}" 
					      		{{-- @foreach($fund_rel_id as $fr) --}}
					      		@foreach($arr as $a) 
				         		@if(isset($a->related_id))
				         		@if($a->related_id == $fund->fund_id)
				         		selected
				         		@endif
				         		@endif
				         		@endforeach
				         		{{-- @endforeach --}}
				         		> {{$fund->fund_name}} </option>
					      @endforeach
					    </select>
				@endsection
				          
					 	

				@section('ratingValue' , $arr[0]->rating)

				@section('acceptenceValue',$arr[0]->fund_acceptence)

				@section('orgValue')	
					    <select searchable="Search here.." id="fundSelect" name="fund_org" class="col s10">
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
				@endsection
					  		

				@section('resValue')
					<select id="resSelect" multiple searchable="Search here.." name="resArea[]" class="col s10">
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
				@endsection
					    
{{-- 				@section('countryValue')
					<select id="fund_country" name="fund_country" class="icons">
					      @foreach($c as $cou)
						      
						      	<option value="{{ $cou->funding_org_country }}" class="circle" 
						      @foreach($arr as $a)
						      @if(isset($a->funding_org_country))
						      @if($cou->funding_org_country == $a->funding_org_country)
						      selected
						      @endif
						      @endif
						      @endforeach
						      >{{ $cou->funding_org_country }}</option>
						      
					      @endforeach

					    </select>
				@endsection --}}
				      

				@section('progValue',$arr[0]->fund_program_description)

		       @section('durationValue',$arr[0]->duration )

		       @section('financialValue',$arr[0]->financial_support )

		       @section('requirementsValue',$arr[0]->requirements )

		       @section('deadlineValue',$arr[0]->deadline )

		       @section('link1Value',$arr[0]->link1 )
		       
		       @section('link1ValueHref',$arr[0]->link1 )

		       @section('link1Value',$arr[0]->link1 )

		       @section('link2Value',$arr[0]->link2 )

		       @section('link2ValueHref',$arr[0]->link2 )   		 

				@section('memoValue',$arr[0]->memo )

		       @section('farsiValue',$arr[0]->farsi_desc )

		       @section('commentsValue',$arr[0]->comments )
		          		
		          		


		       @section('subbutValue')
		       		<a href="{{ url('/tables/'.$arr[0]->fund_id.'/delete') }}" class="waves-effect waves-light red btn col s12" >Discard Table</a>
		       		<button class="waves-effect waves-light btn col s12 disabled" disabled>You're Data is autosaved, no need to press anything :) </button>
		       		<script type="text/javascript" src="{{ asset('js/updateTable.js') }}"></script>
		       @endsection
	          			
