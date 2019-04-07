@extends('template')

@section('content')
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row table-responsive" style="padding: 15px">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Doctor</th>
							<th>Date</th>
							<th>Status</th>
							<th>View</th>
							<th>Cancel</th>
						</tr>
					</thead>
					<tbody>
						@if($apps->count() > 0)
							@foreach($apps as $app)
							<tr>
								<td>
									{{ $app->attender->name }} ({{ $app->attender->doctor->speciality }})
								</td>
								<td>
									{{ $app->created_at }}
								</td>
								<td>
									@if($app->status == "1")
										Waiting
									@elseif($app->status == "2")
										In Lab
									@elseif($app->status == "3")
										Diagnosis
									@elseif($app->status == "4")
										Attended
									@endif
								</td>
								<td>
									<a href="/appointments/view/{{ $app->id }}"><i class="icon-feather-eye"></i></a>
								</td>
								<td>
									<a href="/appointments/delete/{{ $app->id }}"><i class="delete icon-feather-trash-2"></i></a>
								</td>
							</tr>
							@endforeach
						@else
							<p class="alert alert-info">
								You have not added any appointments to the system yet. Use the "Create New" button to add an appointment
							</p>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
@endsection