@extends('adm.app')
@section('title') Dashboard @endsection

@section('content')
<div class="col-md-6 col-xs-12">
      		
      		<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-star"></i>
					<h3>Statistics</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<div class="stats">
						
						<div class="stat">
							<span class="stat-value">{{$msg['total']}}</span>									
							Total messages
						</div> <!-- /stat -->
						
						<div class="stat">
							<span class="stat-value">{{$msg['read']}}</span>									
							Read messages
						</div> <!-- /stat -->
						
						<div class="stat">
							<span class="stat-value">{{$msg['unread']}}</span>									
							Unread messages
						</div> <!-- /stat -->
						
					</div> <!-- /stats -->
					
					
					
					
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->	
			
			
	
						
      		
	    </div> <!-- /span6 -->
      	
      	
      	<div class="col-md-6">	
      		
      		
      		<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-envelope"></i>
					<h3>Recent 20 messages</h3>
				</div> 
				<div class="widget-content">
					
					<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
					        <thead>
					          <tr>
					            <th>#</th>
					            <th>IP</th>
					            <th>Status</th>
					            <th>Content</th>
					          </tr>
					        </thead>
					        <tbody>
							@php
							$count = count($recent);
							@endphp
							@if($count == 0)
							<td style="text-align: center;" colspan="4"> No message yet </td>
							@endif
							@foreach($recent as $key=>$msg)
					          <tr>
					            <td>{{$key+1}}</td>
					            <td>{{$msg->by}}</td>
					            <td>@if($msg->viewcount == 0) Read @else Unread @endif</td>
								<td><a class="btn btn-default" id="viewcontent" msgid="{{$msg->id}}">View</a></td>
					          </tr>
					         @endforeach
							 
					        </tbody>
					      </table>
					  </div> 
					
				</div>
				
			</div> <!-- /widget -->
      		
      		
		
				
	      </div> <!-- /span6 -->			
			
@endsection
@section('modal')

  <div class="modal fade" id="content">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Content</h4>
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
@section('script')
<script>
$("a#viewcontent").click(function(){

    $.post("{{ route('showcontent') }}",
       {
         id: $(this).attr("msgid"),
         _token: '{{ csrf_token() }}',
       },
       function(data, statusText, resObject) {
     //    alert("Data Loaded: " + resObject.responseJSON.message.content);
		 $('#content').modal('show');
		 var mdl = $('#content');
						var data = resObject.responseJSON.message.content;
						$('#content .modal-body').empty();
						mdl.find('.modal-body').append("<p>" +data+ "</p>");
		 
		 
       }
    );

    return false;
});
</script>
@endsection