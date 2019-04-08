@extends('template')

@section('content')
	<div class="dashboard-headline">
		<h3>Doctors</h3>
	</div>

	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row table-responsive" style="padding: 15px">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Doctor</th>
							<th>Speciality</th>
							<th>Joined at</th>
						</tr>
					</thead>
					<tbody>
						@if($docs->count() > 0)
							@foreach($docs as $doc)
							<tr>
								<td>
									{{ $doc->name }}
								</td>
								<td>
									{{ $doc->doctor->speciality }}
								</td>
								<td>
									{{ $doc->created_at }}
								</td>
							</tr>
							@endforeach
						@else
							<p class="alert alert-info">
								There are doctors in the system yet.
							</p>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
@endsection