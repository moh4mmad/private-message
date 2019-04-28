@extends('adm.app')
@section('title') Frontend Settings @endsection

@section('content')
<div class="col-md-12">      		
      		
      		<div class="widget stacked ">
      			
      			<div class="widget-header">
      				<i class="icon-envelope"></i>
      				<h3>Mailer Settings</h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					
					
							<form id="edit-mailer" class="form-horizontal col-md-8">
								<fieldset>
									
									{{ csrf_field() }}
									
									<div class="form-group">											
										<label for="firstname" class="col-md-4">Driver</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="driver" value="{{$data->driver}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">Host</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="host" value="{{$data->host}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">Port</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="port" value="{{$data->port}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">From address</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="from_address" value="{{$data->from_address}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">From name</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="from_name" value="{{$data->from_name}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">Encryption</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="encryption" value="{{$data->encryption}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">Username</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="username" value="{{$data->username}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">Password</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="password" value="{{$data->password}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

										<br />
									
										
									<div class="form-group">

										<div class="col-md-offset-4 col-md-8">
											<button type="submit" class="btn btn-primary">Save</button>
									</div> <!-- /form-actions -->
								</fieldset>
							</form>
					  
					  
					</div>
					
					
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->
      
@endsection
@section('script')
<script>
$(function() {
     
	 $('#edit-mailer').on('submit',function(event){
		
	   var request;
	   event.preventDefault();
		
		var $form = $(this);
		var $inputs = $form.find("input");
		var serializedData = $form.serialize();
		
		request = $.ajax({
        url: "{{ route('mailup') }}",
        type: "post",
        data: serializedData
		});
 
    request.done(function (response, textStatus, jqXHR){
	$.msgGrowl ({
			type: 'success'
			, title: 'Success'
			, text: 'Mailer updated successfully'
			, position: 'top-right'
		});
    });
 
    request.fail(function (jqXHR, textStatus, errorThrown){
		var message = jQuery.parseJSON(jqXHR.responseText);
        $.msgGrowl ({
			type: 'error'
			, title: 'Updating failed'
			, text: message.message
			, position: 'top-right'
		});
    });
    });
		});

</script>
@endsection
