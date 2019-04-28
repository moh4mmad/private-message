@extends('front.app')
@section('title'){{$front->title}} - {{$title}} @endsection
@section('content')
<div class="data-msg">
<div class="main">
{!!$content!!}
</div>
</div>

			@endsection
