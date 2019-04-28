@extends('install.layout.head')
@section('content')
		<div class="container">
			<div id="wizard_container">
				<form action="{{ route('up.dbinfo') }}" method="post" role="form">
				{{ csrf_field() }}
					<div id="middle-wizard">
							<div class="submit step" id="end">
								<div class="question_title">
									<h3>Secret Message Installer</h3>
									<p>Database Details</p>
								</div>
								@if (session('alert'))
								<div style="display: block;margin-left:auto;margin-right:auto;" class="alert alert-danger col-md-4 col-md-offset-5" align="center">
								{{ session('alert') }}
								</div>
								@endif
								@if ($errors->any())
									@foreach ($errors->all() as $error)
								<div style="display: block;margin-left:auto;margin-right:auto;" class="alert alert-danger col-md-4 col-md-offset-5" align="center">
								{{ $error }}
								</div>
								@endforeach
								@endif
								<div class="row justify-content-center">
								
									<div class="col-lg-5">
										<div class="box_general">
											<div class="form-group">
												<input type="text" name="db_host" class=" form-control" placeholder="Database Host" required>
											</div>
											<div class="form-group">
												<input type="text" name="db_user" class=" form-control" placeholder="Database User" required
											</div>
											<div class="form-group">
												<input type="text" name="db_password" class=" form-control" placeholder="Database Password"required>
											</div>
											<div class="form-group">
												<input type="text" name="db_name" class=" form-control" placeholder="Database Name" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="bottom-wizard">
						<button class="btn btn-info anchor">Next Step <i class="fa fa-angle-double-right"></i></button>
					</div>
				</form>
			</div>
		</div>										
@endsection