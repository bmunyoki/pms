@extends('template')

@section('content')
<form>
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3>
						<i class="icon-feather-folder-plus"></i> Create Partner
					</h3>
				</div>

				<div class="content with-padding padding-bottom-10">
					<div class="row">
						<div class="col-xl-12" id="resp"></div>
					</div>
					<div class="row">
						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Nama</h5>
								<input type="text" id="name" class="with-border" required>
							</div>
						</div>

						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Email</h5>
								<input type="email"  id="email" class="with-border" required>
							</div>
                        </div>

						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Activation Code</h5>
								<input type="text"  id="code" class="with-border" required>
							</div>
                        </div>
                        <div class="col-xl-4">
							<div class="submit-field">
								<h5>Phone</h5>
								<input type="text"  id="phone" class="with-border" required>
							</div>
                        </div>

                        <div class="col-xl-4">
                            <div class="submit-field">
                                <h5>Role</h5>
                                <select title="Role" id="role">
                                    <option value="IUP">IUP</option>
                                    <option value="IUJP">IUJP</option>
                                    <option value="IUPOPK">IUPOPK</option>
                                </select>
                            </div>
                        </div>

						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Address</h5>
								<textarea class="with-border" id="address" required></textarea>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12">
			<button type="submit" id="createPartner" class="button ripple-effect big margin-top-30">
				Create Partner
			</button>
		</div>
	</div>
</form>
@endsection
@section('scripts')
	<script>
		$(document).ready(function(){
			$('#createPartner').click(function(e) { 
				e.preventDefault();
				var email = $("#email").val();
				var name = $("#name").val();
                var address = $("#address").val();
                var code = $("#code").val();
                var phone = $("#phone").val();
                var role = $("#role").val();

				if($.trim(name) == ''){
					$("#resp").html("<p class='alert alert-danger'>Name is a required field</p>");
				}else if($.trim(email) == ''){
					$("#resp").html("<p class='alert alert-danger'>Email is a required field</p>");
				}else if($.trim(address) == ''){
					$("#resp").html("<p class='alert alert-danger'>Address is required</p>");
				}else if($.trim(code) == ''){
					$("#resp").html("<p class='alert alert-danger'>Activation code is required</p>");
				}else if($.trim(phone) == ''){
					$("#resp").html("<p class='alert alert-danger'>Phone number is required</p>");
				}else{
					const formData = {'name':name, 'email':email, 'address':address, 'code':code, 'phone':phone, 'role':role, '_token':$csrf_token};

					$.ajax({
						url: '/partners/create',
						type: 'POST',
						data: formData,
						datatype: 'json'
					})
					.done(function (data) { 
						if(data[0].success == 1){
							$("#resp").html("<p class='alert alert-success'>"+data[0].message+"</p>")
							setTimeout(function(){
								window.location.href = "/partners/iup";
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