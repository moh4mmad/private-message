@extends('adm.app')
@section('title') Frontend Settings @endsection

@section('content')
<div class="col-md-12">      		
      		
      		<div class="widget stacked ">
      			
      			<div class="widget-header">
      				<i class="icon-envelope"></i>
      				<h3>Message Attachment Settings</h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					
					
							<form id="edit" class="form-horizontal col-md-8">
								<fieldset>
									
									{{ csrf_field() }}
									<div class="form-group">											
										<label for="firstname" class="col-md-4">Attachment allowed file</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="allowed_file" value="{{$front->allowed_file}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="form-group">											
										<label for="firstname" class="col-md-4">Attachment max size (KB)</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="max_size" value="{{$front->max_size}}">
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
<script>
$(function() {
     
	 $('#edit').on('submit',function(event){
		
	   var request;
	   event.preventDefault();
		
		var $form = $(this);
		var $inputs = $form.find("input");
		var serializedData = $form.serialize();
		
		request = $.ajax({
        url: "{{ route('sysup') }}",
        type: "post",
        data: serializedData
		});
 
    request.done(function (response, textStatus, jqXHR){
	$.msgGrowl ({
			type: 'success'
			, title: 'Success'
			, text: 'Updated successfully'
		});
    });
 
    request.fail(function (jqXHR, textStatus, errorThrown){
		var message = jQuery.parseJSON(jqXHR.responseText);
        $.msgGrowl ({
			type: 'error'
			, title: 'Updating failed'
			, text: message.message
		});
    });
    });
		});

</script>
@endsection