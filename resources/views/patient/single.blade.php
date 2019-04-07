@extends('template')

@section('content')
<form>
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3>
						<i class="icon-feather-folder-plus"></i> Appointment Details
					</h3>
				</div>

				<div class="content with-padding padding-bottom-10">
					<div class="row">
						<div class="col-xl-12" id="resp"></div>
					</div>
					<div class="row">
						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Patient Name</h5>
								<input readonly="true" type="text" id="name" class="with-border" value="{{ $app->visitor->name }}">
							</div>
						</div>

						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Patient Gender</h5>
								<input readonly="true" type="text"  id="gender" class="with-border"  value="{{ $app->visitor->patient->gender }}">
							</div>
                        </div>
                        
                        <div class="col-xl-4">
							<div class="submit-field">
								<h5>DOB</h5>
								<input readonly="true" type="text"  id="age" class="with-border" value="{{ $app->visitor->patient->dob }}">
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
							<div class="submit-field">
								<h5>Symptoms</h5>
								<textarea readonly="true" class="with-border" value="{{ $app->symptoms }}" id="symptoms" required>
									{{ $app->symptoms }}
								</textarea>
							</div>
						</div>
					</div>

					<div class="row">
                        <div class="col-xl-12">
							<div class="submit-field">
								<h5>Lab Results</h5>
								<textarea readonly="true" class="with-border" value="{{ $app->lab }}" id="lab">{{ $app->lab }}</textarea>
							</div>
						</div>
					</div>

					<div class="row">
                        <div class="col-xl-12">
							<div class="submit-field">
								<h5>Diagnosis</h5>
								<textarea readonly="true" class="with-border" value="{{ $app->diagnosis }}" id="diagnosis">{{ $app->diagnosis }}</textarea>
							</div>
						</div>
					</div>

					<div class="row">
                        <div class="col-xl-12">
							<div class="submit-field">
								<h5>Prescription</h5>
								<textarea readonly="true" class="with-border" value="{{ $app->prescription }}" id="prescription">{{ $app->prescription }}</textarea>
							</div>
						</div>
					</div>
						
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
@section('scripts')
	<script>
		$(document).ready(function(){
			
		}) 
	</script>
@endsection