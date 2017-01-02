

@extends('parentForm')



@if(!isset($m['m']))
@include('pageHeader')
@endif

@section('form')


@section('formHead')
<div class="card-title col s8 offset-s2"><h1 style="text-align: center">Table Insert</h1><hr></div>
	<form id="mainForm" method="post" action="/insert" class="col s12">
@endsection

				@section('tagValue')
				        @include('tags')
				@endsection
					


				@section('fundRelatedValue')
				           <select multiple id="fund_related_id" name="fund_related_id[]" class="col s12">
							<option disabled="">Choose The related funds</option>

					      @foreach($fund_rel_id as $fr)
					      	<option value="{{ $fr->fund_id }}">{{ ucfirst(trans($fr->fund_name)) }}</option>

					      @endforeach
					    </select>
				@endsection
				          



							@section('orgValue')
								@include('editFundOrgModal')
							@endsection





				        	@section('resValue')
				        		@include('resList')
				        	@endsection



					  
					@section('countryValue')
				          <select id="fund_country" name="fund_country" class="icons">
					      <option value="" disabled selected>Choose your option</option>
					      
					      @foreach($country as $c)
					      	<option value="{{ $c->funding_org_country }}" class="circle">{{ $c->funding_org_country }}</option>	
					      @endforeach

					    </select>
					@endsection
				

					
					@section('subbutValue')
	          			<button id="subbutt" type="submit" class="waves-effect waves-light btn col s12">
	          			@if(!isset($m['m']))
	          			Search
	          			@else
	          			Insert
	          			@endif
	          			</button>
					@endsection

{{-- 
@section('scripts')
	<script type="text/javascript" src="{{ asset('js/function.js') }}"></script>
@endsection --}}