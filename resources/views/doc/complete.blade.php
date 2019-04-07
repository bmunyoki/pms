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

			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			    <div class="form-group">
	    			<label for="name">Your Speciality</label>
	    			<input type="text" class="form-control" id="speciality" placeholder="Enter your speciality e.g Neurologist" required />
	  			</div>
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
					const speciality = $("#speciality").val();
					
					e.preventDefault();
					const formData = {
						'speciality':speciality, '_token':token
					};

		    		$.ajax({
		    			url: '/auth/doc/complete',
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