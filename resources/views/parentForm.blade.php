

@extends('layout')



{{-- @if(!isset($m['m']))
@include('pageHeader')
@endif --}}

@section('form')


@yield('formHead')

	@section('pageTitle')
		Table Insert
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#mainForm').validate({
                rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          fund_name: "required",
          tags: "required",
          fund_rating: "required",
          fund_org: "required", 
          resArea: "required"
        },
        // Specify validation error messages
        messages: {
          fund_name: "Please enter the fund name",
          tags: "Please specify the tag",
          fund_rating: "Please specify the fund rating",
          fund_org: "Please specify the funding organization"
        },

        errorPlacement: function(error, element) {
          error.appendTo( element.parent() );
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }

    });

			});
				 			
		</script>
	@endsection


				 {{ csrf_field() }}
				
				<div class="formWrap">
		

					 <div id="firstRow" class="row">
						
						<div id="fund_name_parent" class="input-field col s6 offset-s3">
				          <input placeholder="" data="text" name="fund_name" id="fund_name" type="text" class="validate blue-text text-darken-2" value="@yield('fundNameValue')" >
				          <label for="fund_name" class="">Fund Name</label>
				        </div>

					 	
					 </div>

					

					 <div id="fund_tag_parent" class="row">
					 	 @include('parentTags')
					</div>


					 <div class="row">
					 	 <div id="fund_related_id_parent" class="input-field col s12">
				           @yield('fundRelatedValue')
				          <label for="fund_id">Fund Related IDs</label>
				        </div>
					 </div>
				
					 	

					 	<div id="fund_rating_parent" class="input-field col s6">
				          <input placeholder="" data="text" name="fund_rating" id="fund_rating" type="number" min="1" max="6" class="validate" value="@yield('ratingValue')">
				          <label for="fund_rating">Funding Rating</label>
				        </div>

				        <div id="fund_acceptence_parent" class="input-field col s6">
				          <input placeholder="" data="text" name="fund_acceptence" id="fund_acceptence" type="text" class="validate" value="@yield('acceptenceValue')">
				          <label for="fund_acceptence">Funding Acceptence</label>
				        </div>


				       <div id="fund_org_parent" class="input-field col s6">
				       		@yield('orgValue')
							@include('fundOrgModals')

						</div>



				        <div id="fund_resArea_parent" class="input-field col s6">
				        	@yield('resValue')
				       		 @include('resModals')

				        </div>


					  
			
			
		          		 <div id="fund_prog_parent" class="input-field col s12">
				            <textarea id="program_desc" data="text" name="program_desc" class="materialize-textarea" length="120" class="validate" placeholder="Search in program description">
				            	@yield('progValue')
				            </textarea>
				            <label for="program_desc">Program Description</label>
		          		</div>

		 
		          		 <div id="fund_duration_parent" class="input-field col s6">
				            <textarea id="duration" data="text" name="duration" class="materialize-textarea" length="80" class="validate" placeholder="Search accoring to duration description">
				            	@yield('durationValue')
				            </textarea>
				            <label for="duration">Duration Description</label>
		          		</div>
			
		          		 <div id="fund_financial_parent" class="input-field col s6">
				            <textarea id="financial_support" data="text" name="financial_support" class="materialize-textarea" length="80" class="validate" placeholder="Search accoring to financial support">
				            	@yield('financialValue')
				            </textarea>
				            <label for="financial_support">financial support </label>
		          		</div>
					{{-- </div> --}}

					{{-- <div class="row"> --}}
		          		 <div id="fund_requirements_parent" class="input-field col s6">
				            <textarea id="requirements" data="text" name="requirements" class="materialize-textarea" length="80" class="validate" placeholder="Search according to requirements">
				            	@yield('requirementsValue')
				            </textarea>
				            <label for="requirements">Requirements</label>
		          		</div>
				
		          		 <div id="fund_deadline_parent" class="input-field col s6">
				            <textarea id="deadline" data="text" name="deadline" class="materialize-textarea" length="80" class="validate" placeholder="Search according to deadline">
				            	@yield('deadlineValue')
				            </textarea>
				            <label for="deadline">Deadline</label>
		          		</div>

		          		 <div id="fund_link1_parent" class="input-field col s6">
				            <textarea id="link1" data="text" name="link1" class="materialize-textarea" length="120" class="validate" placeholder="Search with Link 1">
				            	@yield('link1Value')
				            </textarea>
				            <label for="link1" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="U can click me!"><a href="@yield('link1ValueHref')">Link 1</a></label>
		          		</div>
					
		          		 <div id="fund_link2_parent" class="input-field col s6">
				            <textarea id="link2" data="text" name="link2" class="materialize-textarea" length="120" class="validate" placeholder="Search with link 2">
				            	@yield('link2Value')
				            </textarea>
				            <label for="link2" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="U can click me!"><a href="@yield('link2ValueHref')">Link 2</a></label>
		          		</div>

		          		 <div id="fund_memo_parent" class="input-field col s6">
				            <textarea id="memo" data="text" name="memo" class="materialize-textarea" length="120" class="validate" placeholder="Search in memo">
				            	@yield('memoValue')
				            </textarea>
				            <label for="memo">Memo</label>
		          		</div>
					
		          		 <div id="fund_farsi_parent" class="input-field col s6">
				            <textarea id="farsiDesc" data="text" name="farsiDesc" class="materialize-textarea" length="120" class="validate" placeholder="Search in Farsi Description">
				            	@yield('farsiValue')
				            </textarea>
				            <label for="farsiDesc">Farsi Description</label>
		          		</div>

		          		 <div id="fund_comment_parent" class="input-field col s6 offset-s3">
				            <textarea id="comment" data="text" name="comment" class="materialize-textarea" length="120" class="validate" placeholder="Search in comments">
				            	@yield('commentsValue')
				            </textarea>
				            <label for="comment">Comment</label>
		          		</div>


					
					<div class="row">
	          			@yield('subbutValue')
					</div>

					 
				 </div>


</form>

@endsection