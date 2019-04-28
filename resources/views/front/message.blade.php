@section('title'){{$front->title}} - Content succesfully retrieved @endsection
@extends('front.app')

@section('content')
			<div class="data-msg">
			<div class="alert alert-info">
  <strong>Info!</strong>@if($content->maxview == $content->viewcount) This massage has been viewed maximum times. @else  This massage will be destroyed after viewing {{$content->maxview - $content->viewcount}} times @endif
</div> 
	
	
  <h3 style="text-decoration: underline; font-weight: bold; color: #000;">Succesfully retrieved</h3>
  <hr style="margin-top: 3rem">
  <div class="wrap-input100">
  <textarea class="input100" id="message" name="content" placeholder="Message contents...">{{$message}}</textarea>
  <span class="focus-input100"></span>
  </div>
	
	<button id="button" type="button" class="btn btn-info">Copy text</button>
	@if($content->attachment == 1)
	<div class="wrap-input100" style="border-bottom: 1px;">
	<hr style="margin-top: 2rem;border-top: 1px;">
	<h5 style="text-decoration: underline; font-weight: bold; color: #000;">Download attachment</h5>
  <hr style="margin-top: .5rem;border-top: 1px;">
  <button onclick="location.href='{{ route('AttachDownload', $attach->secret) }}'" type="button" class="btn btn-info">{{$attach->filename}}</button>
  </div>
  @endif
</div>
@endsection
@section('script')
<script>

$.notify("Countdown timer",
  {
	className: 'info',
	autoHide: false
	}
	);
var countDownDate = new Date("{{$content->destroy_in}}").getTime();
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  var msg = document.getElementsByClassName("notifyjs-bootstrap-base notifyjs-bootstrap-info");
  msg[0].innerHTML = "Destroying in " + days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  if (distance < 0) {
    clearInterval(x);
	var msg = document.getElementsByClassName("notifyjs-bootstrap-base notifyjs-bootstrap-info");
	msg[0].innerHTML = "Message expired";
  }
}, 1000);

$("#button").click(function(){
    $("#message").select();
    document.execCommand('copy');
});
</script>
@endsection