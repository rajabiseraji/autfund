
@section('pageHeader')
	
	<a style="display: none" href="#" data-activates="slide-out" class=" button-collapse btn-floating btn-large red">
      <i class="material-icons">menu</i>
    </a>

		<div style="margin-top: 3.8%" id="slide-out" class="side-nav fixed">
			{{-- <div class="container"> --}}
			<ul>
				<li id="userDetails" style="padding-top: 10%" >
					<div class="row">
						<div class="col s10 offset-s1 center-align" style="background: {{ asset('a.jpg') }}">
							<i class="material-icons circle green large">perm_identity</i>
						</div>
					</div>
				</li>

				<li>
					<div class="row">
						<div id="tip" class="col s10 offset-s1 center-align"><b>Specify the fields you use for search</b></div>
						<hr class="col s6 offset-s3">
					</div>
				</li>

				<li>
					<div class="row">
						<div id="checks" class="col s10 offset-s1">
							<div class="col s12">
								<input type="checkbox" id="fund_name_check"  checked="checked" />
	      						<label for="fund_name_check">Fund Name</label>
							</div>

							<div class="col s12">
								<input type="checkbox" id="fund_id_check" checked="checked" />
	      						<label for="fund_id_check">Fund ID</label>
							</div>
							
							<div class="col s12">
								<input type="checkbox" id="fund_org_check" checked="checked" />
	      						<label for="fund_org_check">Fund Organization</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_prog_check" checked="checked" />
	      						<label for="fund_prog_check">Fund Program Description</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_resArea_check" checked="checked" />
	      						<label for="fund_resArea_check">Research Area</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_duration_check" checked="checked" />
	      						<label for="fund_duration_check">Fund Duration</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_financial_check" checked="checked" />
	      						<label for="fund_financial_check">Financial Support</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_requirements_check" checked="checked" />
	      						<label for="fund_requirements_check">Requirements</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_deadline_check" checked="checked" />
	      						<label for="fund_deadline_check">Deadline</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_link1_check" checked="checked" />
	      						<label for="fund_link1_check">Link 1</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_link2_check" checked="checked" />
	      						<label for="fund_link2_check">Link 2</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_memo_check" checked="checked" />
	      						<label for="fund_memo_check">Memo</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_farsi_check" checked="checked" />
	      						<label for="fund_farsi_check">Farsi Description</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_comment_check" checked="checked" />
	      						<label for="fund_comment_check">Comments</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_tag_check" checked="checked" />
	      						<label for="fund_tag_check">Tag</label>
							</div>
							<div class="col s12">
								<input type="checkbox" id="fund_country_check" checked="checked" />
	      						<label for="fund_country_check">Country</label>
							</div>


						</div>
						<hr class="col s6 offset-s3">
					</div>
				</li>

			</ul>
			{{-- </div> --}}
		</div>
	

@endsection
