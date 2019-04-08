@extends('template')

@section('content')
<form>
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3>
						<i class="icon-feather-folder-plus"></i> Create Appointment
					</h3>
				</div>

				<div class="content with-padding padding-bottom-10">
					<div class="row">
						<div class="col-xl-12" id="resp"></div>
					</div>
					<div class="row">

                        <div class="col-xl-4">
                            <div class="submit-field">
                                <h5>Select Doctor</h5>
                                <select title="Doctor" id="doctor">
                                	<option value="{{ $app->attender->id }}">
                                			{{ $app->attender->name }}
                                	</option>
                                	@foreach($docs as $doc)
                                		<option value="{{ $doc->id }}">
                                			{{ $doc->name }} ({{ @$doc->doctor->speciality }})
                                		</option>
                                	@endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-4">
							<div class="submit-field">
								<h5>Date</h5>
								<input type="hidden" name="id" id="id" value="{{ $app->id }}">
								<input type="date" id="dt" class="with-border" value="{{ $app->dt }}">
							</div>
                        </div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12">
			<button type="submit" id="createApp" class="button ripple-effect big margin-top-30">
				Create Appointment
			</button>
		</div>
	</div>
</form>
@endsection
@section('scripts')
	<script>
		$(document).ready(function(){
			$('#createApp').click(function(e) { 
				e.preventDefault();
				var doc = $("#doctor").val();
				var dt = $("#date").val();
				var id = $("#id").val();

				const formData = {'doc':doc, 'id':id, 'dt':dt, '_token':$csrf_token};

				$.ajax({
					url: '/patients/appointments/update',
					type: 'POST',
					data: formData,
					datatype: 'json'
				})
				.done(function (data) { 
					if(data[0].success == 1){
						$("#resp").html("<p class='alert alert-success'>"+data[0].message+"</p>")
						setTimeout(function(){
							window.location.href = "/patients/appointments";
						}, 3000);
					}else{
						$("#resp").html("<p class='alert alert-danger'>"+data[0].message+"</p>")
					}
				})
				.fail(function (jqXHR, textStatus, errorThrown) { 
					console.log(errorThrown); 
				});
			});
		}) 
	</script>
@endsection