@extends('auth.template')

@section('content')
	<form class="registrationForm">
		<div class="row" id="subcontent">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<h5 class="subtitles">Register</h5>
			</div>
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3 mb-3">
				<span class="resp"></span>
			</div>

			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			    <div class="form-group">
	    			<label for="name">Your Name</label>
	    			<input type="text" class="form-control" id="name" placeholder="Enter your full name here" required />
	  			</div>
	  			<div class="form-group">
	    			<label for="role">Register As</label>
	    			<select class="form-control" id="role">
	    				<option value="Patient">Patient</option>
	    				<option value="Doctor">Doctor</option>
	    				<option value="Lab">Lab Technician</option>
	    				<option value="Admin">Admin</option>
	    			</select>
	  			</div>
	  			<div class="form-group">
	    			<label for="email">Email</label>
	    			<input type="email" class="form-control" id="email" placeholder="Enter your email here" required />
	  			</div>
	  			<div class="form-group">
	    			<label for="password">Password</label>
	    			<input type="password" class="form-control" id="password" placeholder="Enter password" required />
	  			</div>
	  			<div class="form-group">
	    			<button type="submit" class="btn btn-asgard btn-block" id="registerBtn">Continue</button>
	  			</div>
			</div>
			
		</div>
	</form>
@endsection
