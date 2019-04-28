@extends('install.layout.head')
@section('content')
		<div class="container">
			<div id="wizard_container">
				<form action="{{ route('AdminSetup') }}" method="post" role="form">
				{{ csrf_field() }}
					<div id="middle-wizard">
							<div class="submit step" id="end">
								<div class="question_title">
									<h3>Secret Message Installer</h3>
									<p>Administrator Details</p>
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
												<input type="text" name="admin_name" class=" form-control" placeholder="Admin name" required>
											</div>
											<div class="form-group">
												<input type="text" name="admin_username" class=" form-control" placeholder="Admin Username" required
											</div>
											<div class="form-group">
												<input type="text" name="admin_password" class=" form-control" placeholder="Admin Password"required>
											</div>
											<div class="form-group">
												<input type="email" name="admin_email" class=" form-control" placeholder="Admin Email" required>
											</div>
											<div class="form-group add_bottom_30">
												<div class="styled-select">
													<select name="timezone" required>
														<option value="" selected>Select your Timezone</option>
														@foreach (timezone_identifiers_list() as $timezone)
														<option value="{{ $timezone }}">{{ $timezone }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="bottom-wizard">
						<button class="btn btn-info anchor">Submit <i class="fa fa-check"></i></button>
					</div>
				</form>
			</div>
		</div>
		@if (session('success'))
    <div id="success-modal" class="modal modal-message modal-success fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   <i style="display: block;margin-left:auto;margin-right:auto;" class="fa fa-check"></i>
                </div>
                <div class="modal-title">Success</div>
                <div class="modal-body">{{ session('success') }}</div>
                <div class="modal-footer">
                    <a href="{{ route('admin.login') }}" class="btn btn-info anchor">Login to Admin Panel</a>
                </div>
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
	@endif
@endsection