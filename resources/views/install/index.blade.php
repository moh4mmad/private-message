@php
function extension_check($name)
{
	if (!extension_loaded($name))
	{
		$response = false;
		} else {
			$response = true;
			}
	return $response;
}

function folder_permission($name)
{
	$perm = substr(sprintf('%o', fileperms($name)), -4);
	if ($perm >= '0775')
	{
		return true;
		} else {
			return false;
			}
}

function CreateTable($name, $details, $status)
{
	if ($status=='1')
	{
		$pr = '<i class="fa fa-check" style="color:green;"><i>';
		}else{
			$pr = '<i class="fa fa-times" style="color:red;"><i>';
			}
			return "<tr><td>$name</td><td>$details</td><td>$pr</td></tr>";
}

@endphp

@extends('install.layout.head')
@section('content')
<div class="container">
			<div id="wizard_container">
					<div id="middle-wizard">
							<div class="submit step" id="end">
								<div class="question_title">
									<h3>Secret Message Installer</h3>
									<p>System Requirements</p>
								</div>
								<div class="row justify-content-center">
								<div class="col-lg-6">
								<table class="table table-striped">
								<tbody>
								@php
								$error = 0;
								$phpversion = version_compare(PHP_VERSION, '7.0.0', '>=');
								if ($phpversion==true) {
									$error = $error+0;
									echo createTable("PHP", "Required PHP version 7.0 or higher",1);
									}else{
										$error = $error+1;
										echo createTable("PHP", "Required PHP version 7.0 or higher",0);
										}
										@endphp
							@foreach($extensions as $key)
							@php
							$extension = extension_check($key);
							if ($extension==true) {
								$error = $error+0;
								echo createTable($key, "Required ".strtoupper($key)." PHP Extension",1);
								}else{
									$error = $error+1;
								echo createTable($key, "Required ".strtoupper($key)." PHP Extension",0);
									}
							@endphp
							@endforeach
							
							@foreach($folders as $key)
							@php
							$folder_perm = folder_permission($key);
							if ($folder_perm==true) {
								$error = $error+0;
								echo createTable(str_replace("../", "", $key)," Required permission: 0775 ",1);
								}else{
									$error = $error+1;
									echo createTable(str_replace("../", "", $key)," Required permission: 0775 ",0);
									}
							@endphp
							@endforeach
							@php
							$envCheck = is_writable('../.env');
							if ($envCheck==true) {
								$error = $error+0;
								echo createTable('env'," Required .env to be writable",1);
								}else{
									$error = $error+1;
									echo createTable('env'," Required .env to be writable",0);
									}						
							@endphp
  </tbody>
  </table>
  </div>
  </div>
								</div>
							</div>
						</div>
					<div id="bottom-wizard">
							@if($error == 0)
								<button onclick="next()" class="btn btn-info anchor">Next Step <i class="fa fa-angle-double-right"></i></button>
							@else
								<button onclick="refresh()" class="btn btn-info anchor">ReCheck <i class="fa fa-sync-alt"></i></button>
							@endif
							</div>

</div>
<script>
function refresh() {
   setTimeout(function () {
        location.reload()
    }, 100);
}
function next() {
   setTimeout(function () {
        window.location.replace("{{route('dbinfo')}}")
    }, 100);
}
</script>
@endsection