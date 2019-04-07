@extends('template')

@section('content')
<form>
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3>
						<i class="icon-feather-folder-plus"></i> Attend to Appointment
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
								<textarea class="with-border" value="{{ $app->symptoms }}" id="symptoms" required>
									{{ $app->symptoms }}
								</textarea>
							</div>
						</div>
					</div>

					<div class="row">
                        <div class="col-xl-4">
                            <div class="submit-field">
                                <h5>Send to Lab</h5>
                                <select title="send" id="send">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
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
								<textarea class="with-border" value="{{ $app->diagnosis }}" id="diagnosis">{{ $app->diagnosis }}</textarea>
							</div>
						</div>
					</div>

					<div class="row">
                        <div class="col-xl-12">
							<div class="submit-field">
								<h5>Prescription</h5>
								<input type="hidden" name="id" value="{{ $app->id }}" id="id">
								<textarea class="with-border" value="{{ $app->prescription }}" id="prescription">{{ $app->prescription }}</textarea>
							</div>
						</div>
					</div>
						
				</div>
			</div>
		</div>
		<div class="col-xl-12">
			<button type="submit" id="save" class="button ripple-effect big margin-top-30">
				Save
			</button>
		</div>
	</div>
</form>
@endsection
@section('scripts')
	<script>
		$(document).ready(function(){
			$('#save').click(function(e) { 
				e.preventDefault();
				var symptoms = $("#symptoms").val();
				var send = $("#send").val();
                var lab = $("#lab").val();
                var diagnosis = $("#diagnosis").val();
                var prescription = $("#prescription").val();
                var id = $("#id").val();

				if($.trim(symptoms) == ''){
					$("#resp").html("<p class='alert alert-danger'>Symptoms is a required field</p>");
				}else{
					const formData = {'symptoms':symptoms, 'send':send, 'lab':lab, 'diagnosis':diagnosis, 'id':id, 'prescription':prescription, '_token':$csrf_token};

					$.ajax({
						url: '/doctor/appointments/attend',
						type: 'POST',
						data: formData,
						datatype: 'json'
					})
					.done(function (data) { 
						if(data[0].success == 1){
							$("#resp").html("<p class='alert alert-success'>"+data[0].message+"</p>")
							setTimeout(function(){
								window.location.href = "/doctor/appointments/new";
							}, 3000);
						}else{
							$("#resp").html("<p class='alert alert-danger'>"+data[0].message+"</p>")
						}
					})
					.fail(function (jqXHR, textStatus, errorThrown) { 
						console.log(errorThrown); 
					});
				}
			});
		}) 
	</script>
@endsection