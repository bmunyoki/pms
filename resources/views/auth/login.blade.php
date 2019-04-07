@extends('auth.template')

@section('content')
	<form class="registrationForm">
		<div class="row" id="subcontent">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3 mb-3">
				<span class="resp"></span>
			</div>
		
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
				<div class="form-group">
	    			<label for="email">Email</label>
	    			<input type="email" class="form-control" id="email" placeholder="Your email address" required />
	  			</div>
			    <div class="form-group">
	    			<label for="password">Password</label>
	    			<input type="password" class="form-control" id="password" placeholder="Your password" required />
	  			</div>
	  			<div class="form-group">
	  				<p class="mt-2 mb-3">
	    				<a class="float-right" href="/recover-account">Forgot Password? </a>
	    			</p>
	    			<button type="submit" class="btn btn-asgard btn-block" id="loginBtn">Login</button>
	  			</div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
			    &nbsp;
			</div>
			
		</div>
	</form>
@endsection
