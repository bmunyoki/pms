@extends('template')

@section('content')
<form>
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3>
						<i class="icon-feather-folder-plus"></i> My Profile
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
								<input type="text" id="name" class="with-border" value="{{ $user->name }}">
							</div>
						</div>

						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Gender</h5>
								<input type="text"  id="gender" class="with-border"  value="{{ $user->patient->gender }}">
							</div>
                        </div>
                        
                        <div class="col-xl-4">
							<div class="submit-field">
								<h5>DOB</h5>
								<input type="date"  id="dob" class="with-border" value="{{ $user->patient->dob }}">
							</div>
                        </div>
                        <div class="col-xl-4">
							<div class="submit-field">
								<h5>Email</h5>
								<input type="hidden" name="id" id="id" value="{{ $user->id }}">
								<input type="text" id="email" class="with-border" value="{{ $user->email }}">
							</div>
						</div>
                    </div>
						
				</div>
			</div>
		</div>
		<div class="col-xl-12">
			<button type="submit" id="save" class="button ripple-effect big margin-top-30">
				Update
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
				var name = $("#name").val();
				var gender = $("#gender").val();
                var dob = $("#dob").val();
                var email = $("#email").val();
                var id = $("#id").val();

				if($.trim(name) == ''){
					$("#resp").html("<p class='alert alert-danger'>Name is a required field</p>");
				}else if($.trim(gender) == '' && ($.trim(gender) != 'Male' || $.trim(gender) != 'Female')){
					$("#resp").html("<p class='alert alert-danger'>Gender is a required field. Accepted: Male or Female</p>");
				}else if($.trim(dob) == ''){
					$("#resp").html("<p class='alert alert-danger'>DOB is a required field</p>");
				}else if($.trim(email) == ''){
					$("#resp").html("<p class='alert alert-danger'>Email is a required field</p>");
				}else{
					const formData = {'name':name, 'gender':gender, 'dob':dob, 'email':email, 'id':id, '_token':$csrf_token};

					$.ajax({
						url: '/settings/update',
						type: 'POST',
						data: formData,
						datatype: 'json'
					})
					.done(function (data) { 
						if(data[0].success == 1){
							$("#resp").html("<p class='alert alert-success'>"+data[0].message+"</p>")
							setTimeout(function(){
								location.reload();
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