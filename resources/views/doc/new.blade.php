@extends('template')

@section('content')
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Patient</th>
							<th>Date</th>
							<th>Status</th>
							<th>Attend</th>
						</tr>
					</thead>
					<tbody>
						@if($apps->count() > 0)
							@foreach($apps as $app)
							<tr>
								<td>
									{{ $app->visitor->name }}
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
									<a href="/doctor/appointments/attend/{{ $app->id }}"><i class="icon-feather-edit"></i></a>
								</td>
							</tr>
							@endforeach
						@else
							<p class="alert alert-info">
								You have no waiting appointments in the system yet.
							</p>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
@endsection