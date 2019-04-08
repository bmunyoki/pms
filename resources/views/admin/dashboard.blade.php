@extends('template')

@section('content')
	<div class="dashboard-headline">
		<h3>Admin Report</h3>
	</div>

	<div class="row">
		<div class="col-xl-12">
			<div class="fun-facts-container">
				<div class="fun-fact" data-fun-fact-color="#36bd78">
					<div class="fun-fact-text">
						<span>Patients</span>
						<h4>{{ $pats->count() }}</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-feather-user-plus"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#b81b7f">
					<div class="fun-fact-text">
						<span>Doctors</span>
						<h4>{{ $docs->count() }}</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-line-awesome-stethoscope"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#efa80f">
					<div class="fun-fact-text">
						<span>Appointments</span>
						<h4>{{ $visits->count() }}</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
				</div>

				<!-- Last one has to be hidden below 1600px, sorry :( -->
				<div class="fun-fact" data-fun-fact-color="#2a41e6">
					<div class="fun-fact-text">
						<span>This Month Views</span>
						<h4>987</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
				</div>
			</div>
		</div>
	</div>

	@if($pats->count() > 0)
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3>
						<i class="icon-feather-folder-plus"></i> Patients
					</h3>
				</div>

				<div class="content with-padding padding-bottom-10 table-responsive" style="padding: 15px">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Gender</th>
								<th>DOB</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pats as $pat)
							<tr>
								<td>
									{{ $pat->user->name }}
								</td>
								<td>
									{{ $pat->user->email }}
								</td>
								<td>
									{{ $pat->gender }}
								</td>
								<td>
									{{ $pat->dob }}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif

	@if($docs->count() > 0)
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3>
						<i class="icon-feather-folder-plus"></i> Doctors
					</h3>
				</div>

				<div class="content with-padding padding-bottom-10 table-responsive" style="padding: 15px">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Speciality</th>
								<th>Join Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach($docs as $doc)
							<tr>
								<td>
									{{ $doc->user->name }}
								</td>
								<td>
									{{ $doc->user->email }}
								</td>
								<td>
									{{ $doc->speciality }}
								</td>
								<td>
									{{ $doc->created_at }}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif

	@if($visits->count() > 0)
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3>
						<i class="icon-feather-folder-plus"></i> Appointments
					</h3>
				</div>

				<div class="content with-padding padding-bottom-10 table-responsive" style="padding: 15px">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Patient</th>
								<th>Doctor</th>
								<th>Status</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach($visits as $visit)
							<tr>
								<td>
									{{ $visit->visitor->name }}
								</td>
								<td>
									{{ $visit->attender->name }}
								</td>
								<td>
									@if($visit->status == "1")
										Waiting
									@elseif($visit->status == "2")
										In Lab
									@elseif($visit->status == "3")
										Diagnosis
									@elseif($visit->status == "4")
										Attended
									@endif
								</td>
								<td>
									{{ $visit->created_at }}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif
@endsection