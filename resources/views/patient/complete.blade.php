@extends('auth.template')

@section('content')
	<form class="registrationForm">
		<div class="row" id="subcontent">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<h5 class="subtitles">Complete Registration</h5>
			</div>
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3 mb-3">
				<span class="resp"></span>
			</div>

			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
			    <div class="form-group">
	    			<label for="name">Date of Birth</label>
	    			<input type="date" class="form-control" id="dob" required />
	  			</div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
				<div class="form-group">
	    			<label for="gender">Gender</label>
	    			<select class="form-control" id="gender">
	    				<option value="Male">Male</option>
	    				<option value="Female">Female</option>
	    				<option value="Other">Other</option>
	    			</select>
	  			</div>
	  		</div>

			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	  			<div class="form-group">
	    			<button type="submit" class="btn btn-asgard btn-block" id="finish">Finish</button>
	  			</div>
			</div>
			
		</div>
	</form>
@endsection
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			const token = $("#token").val();
			
			$("#finish").click(function(e){
				if($("form")[0].checkValidity()) {
					const gender = $("#gender").val();
					const dob = $("#dob").val();
					
					e.preventDefault();
					const formData = {
						'dob':dob, 'gender':gender, '_token':token
					};

		    		$.ajax({
		    			url: '/auth/patient/complete',
		    			type: 'POST',
		    			data: formData,
		    			datatype: 'json'
					})
					.done(function (data) { 
						if(data[0].success == 1){
							window.location.replace(data[0].url);
						}else{
							$("html, body").animate({scrollTop: 0}, 400);
							$(".resp").html("<span class='alert alert-danger'>"+data[0].message+"</span>")
						}
					})
					.fail(function (jqXHR, textStatus, errorThrown) { 
						console.log(errorThrown); 
					});
			    }else{
			    	$("#registrationForm").find(':submit').click();
			    }
			});
		})
	</script>
@endsection