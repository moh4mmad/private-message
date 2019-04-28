@extends('adm.app')
@section('title') Frontend Settings @endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
@endsection

@section('content')
<div class="col-md-12">      		
      		
      		<div class="widget stacked ">
      			
      			<div class="widget-header">
      				<i class="icon-html5"></i>
      				<h3>Frontend Settings</h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					
					
							<form id="edit" class="form-horizontal col-md-8">
								<fieldset>
									
									{{ csrf_field() }}
									<div class="form-group">											
										<label for="firstname" class="col-md-4">App Favicon</label>
										<div class="col-md-8">
										<div class="fileupload-new thumbnail" style="width: 25px; height: 25px;">
											<img src="{{ asset('assets/images/icons/favicon.ico') }}" />
											</div>
											<input type="file" name="favicon" class="form-control-file">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">App Title</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="title" value="{{$front->title}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">App description</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="description" value="{{$front->description}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">App keywords</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="keywords" value="{{$front->keywords}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">App header title</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="header_title" value="{{$front->header_title}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">App header description</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="header_description" value="{{$front->header_description}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">Header Background Color</label>
										<div class="col-md-8">
										<div class="input-group">
										<span style="background-color: {{$front->header_bg}};" class="input-group-addon"><span class=""></span></span>
											<input type="text" id="header_bg" class="form-control" name="header_bg" value="{{$front->header_bg}}" autocomplete="off">
											</div>
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">Header fontawesome icon</label>
										<div class="col-md-8">
										<div class="input-group">
										<span class="input-group-addon"><span class="{{$front->header_icon}}"></span></span>
											<input type="text" name="header_icon" value="{{$front->header_icon}}" class="form-control">
											<div class="input-group-btn"> <a href="https://fontawesome.com/icons" target="_blank" class="btn btn-default" ><span class="fas fa-question-circle"></span></a> </div>
										</div> 
										</div>										
									</div>
									
									<div class="form-group">											
										<label for="firstname" class="col-md-4">Page background color</label>
										<div class="col-md-8">
										<div class="input-group">
										<span style="background-color: {{$front->bg_color}};" class="input-group-addon"><span class=""></span></span>
											<input type="text" id="bg_color" class="form-control" name="bg_color" value="{{$front->bg_color}}" autocomplete="off">
											</div>
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->
									
									<div class="form-group">											
										<label for="firstname" class="col-md-4">Page background image</label>
										<div class="col-md-8">
											<div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
											<img src="{{ $front->bg_image }}" />
											</div>
											<input type="file" name="bg_image" class="form-control-file">
										</div> <!-- /controls -->				
									</div>
									
									<div class="form-group">											
										<label for="firstname" class="col-md-4">App footer</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="footer" value="{{$front->footer}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">System timezone</label>
										<div class="col-md-8">
										<select name="timezone" class="form-control">
														<option value="" selected>Select your Timezone</option>
														@foreach (timezone_identifiers_list() as $timezone)
														<option value="{{ $timezone }}" @if($timezone == $current_tz) selected @endif>{{ $timezone }}</option>
														@endforeach
													</select>
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

										<br />
									
										
									<div class="form-group">

										<div class="col-md-offset-4 col-md-8">
											<button type="submit" class="btn btn-primary">Update</button>
									</div> <!-- /form-actions -->
								</fieldset>
							</form>
					  
					  
					</div>
					
					
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->
      
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
<script>
$(function() {
        $('#header_bg').colorpicker();
    });
$(function() {
        $('#bg_color').colorpicker();
    });
$(function() {
     
	 $('#edit').on('submit',function(event){
		
	   var request;
	   event.preventDefault();
	
		
		request = $.ajax({
        url: "{{ route('sysup') }}",
        type: "post",
        data:  new FormData(this),
		contentType: false,
		cache: false,
		processData:false
		});
 
    request.done(function (response, textStatus, jqXHR){
	$.msgGrowl ({
			type: 'success'
			, title: 'Success'
			, text: 'Updated successfully'
			, position: 'top-right'
		});
    });
 
    request.fail(function (jqXHR, textStatus, errorThrown){
		var message = jQuery.parseJSON(jqXHR.responseText);
		$.each( message.errors, function( key, value) {
            errorString = value;
        });
        $.msgGrowl ({
			type: 'error'
			, title: message.message
			, text: errorString
			, position: 'top-right'
		});
    });
    });
		});

</script>
@endsection