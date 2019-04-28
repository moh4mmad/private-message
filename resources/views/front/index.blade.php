@extends('front.app')
@section('title'){{$front->title}}@endsection
@section('content')
			<form class="contact100-form validate-form" enctype="multipart/form-data" id="secret" method="post">

				{{csrf_field()}}
				<div class="wrap-input100 validate-input" data-validate = "Content is required">
					<span class="label-input100">Content:</span>
					<textarea class="input100" name="content" placeholder="Your secret content..."></textarea>
					<span class="focus-input100"></span>
				</div>
				

		<div class="checkbox">
            <label style="font-size: 1em">
                <input name="use_password" type="checkbox" value="1">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                Password
            </label><small> (A secret password to access this message) - optional</small>
        </div>
		
		<div id="use_password" style="border-bottom:none;" class="wrap-input100"> </div>
		
		<div class="checkbox">
            <label style="font-size: 1em">
                <input name="ip_restriction" type="checkbox" value="1">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                IP Restriction
            </label> <small> (Only assigned IP can view this secret message) - optional</small>
        </div>
		<div id="ip_restriction" style="border-bottom:none;" class="wrap-input100"> </div>
		
		
		<div class="checkbox">
            <label style="font-size: 1em">
                <input name="file_attach" type="checkbox" value="1">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                Attach file
            </label> <small> ({{$front->allowed_file}} allowed)</small>
        </div>
		<div id="file_attach" style="border-bottom:none;" class="input-group"> </div>

				<div class="wrap-input100 validate-input" data-validate = "time and date is required">
					<span class="label-input100">Message destructs:</span>
				<input class="input100" id="datetimepicker" autocomplete="off" type="text" name="destruct_time" placeholder="Select destruct time and date">
					<span class="focus-input100"></span>
                               
				</div>
				
				
				<div class="wrap-input100 validate-input" data-validate = "required">
					<span class="label-input100">Maximum views:</span>
					<input class="input100" type="text" name="maxview" placeholder="Enter maximum view">
					<span class="focus-input100"></span>
				</div>
				
				
				<div class="wrap-input100">
					<span class="label-input100">Email (Optional):</span>
					<input class="input100" type="email" name="email" placeholder="Notify the user about this secret message">
					<span class="focus-input100"></span>
				</div>
				
				<div class="g-recaptcha" data-sitekey="{{$front->GOOGLE_RECAPTCHA_KEY}}"></div>

				
				<div class="container-contact100-form-btn">
					<button id="submit" class="contact100-form-btn">
						<span>
							Submit
							<i class="fas fa-long-arrow-alt-right"></i>
						</span>
					</button>
					
					<a id="show_result" class="btn btn-info btn-lg active" data-toggle="modal" data-target="#result" role="button" aria-pressed="true">
						<span>
							Result
							<i class="fas fa-info-circle"></i>
						</span>
					</a>
					
				</div>
			
			</form>
			@endsection
		@section('modal')

  <div class="modal fade" id="result">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">New secret message created</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
		
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  @endsection
  
  @section("script")
  <script>
  $("#show_result").hide();
  var submit = '{{route('submit')}}';
  </script>
  @endsection