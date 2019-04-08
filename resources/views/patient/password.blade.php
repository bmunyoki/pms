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
								<h5>New Password</h5>
								<input type="password" id="pass" class="with-border" placeholder="Enter new password here">
							</div>
						</div>

						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Repeat Password</h5>
								<input type="password"  id="repeat" class="with-border" placeholder="Repeat your new password">
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
				var pass = $("#pass").val();
				var repeat = $("#repeat").val();
                

				if($.trim(pass) == '' || $.trim(repeat) == ''){
					$("#resp").html("<p class='alert alert-danger'>Both password fields are required.</p>");
				}else if(pass != repeat){
					$("#resp").html("<p class='alert alert-danger'>Passwords do not match</p>");
				}else{
					const formData = {'pass':pass, '_token':$csrf_token};

					$.ajax({
						url: '/change-password',
						type: 'POST',
						data: formData,
						datatype: 'json'
					})
					.done(function (data) { 
						if(data[0].success == 1){
							$("#resp").html("<p class='alert alert-success'>"+data[0].message+"</p>")
							setTimeout(function(){
								window.location.href = "/logout";
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