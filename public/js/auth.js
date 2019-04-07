$(document).ready(function(){
	const token = $("#token").val();

	$("#registerBtn").click(function(e){
		if($("form")[0].checkValidity()) {
			
			const name = $("#name").val();
			const role = $("#role").val();
			const email = $("#email").val();
			const password = $("#password").val();

			if($.trim(name) == ''){
				$(".resp").html("<p class='alert alert-danger'>Your full name is required</p>");
				$("html, body").animate({scrollTop: 0}, 400);
	        	$("#registrationForm").find(':submit').click();
			}if($.trim(email) == ''){
				$(".resp").html("<p class='alert alert-danger'>Your email is required</p>");
				$("html, body").animate({scrollTop: 0}, 400);
	        	$("#registrationForm").find(':submit').click();
			}if($.trim(password) == ''){
				$(".resp").html("<p class='alert alert-danger'>Your password is required</p>");
				$("html, body").animate({scrollTop: 0}, 400);
	        	$("#registrationForm").find(':submit').click();
			}else{
				e.preventDefault();
				const formData = {
					'name':name, 'email':email, 'role':role, 'password':password, '_token':token
				};

	    		$.ajax({
	    			url: '/auth/register',
	    			type: 'POST',
	    			data: formData,
	    			datatype: 'json'
				})
				.done(function (data) { 
					if(data[0].success == 1){
						$("html, body").animate({scrollTop: 0}, 400);
						$(".resp").html("<span class='alert alert-success'>"+data[0].message+"</span>")
						setTimeout(function(){
							window.location.replace(data[0].url);
						}, 100);
					}else{
						$("html, body").animate({scrollTop: 0}, 400);
						$(".resp").html("<span class='alert alert-danger'>"+data[0].message+"</span>")
					}
				})
				.fail(function (jqXHR, textStatus, errorThrown) { 
					console.log(errorThrown); 
				});
			}

	    }else{
	    	$("#registrationForm").find(':submit').click();
	    }
	});

	// Login
	$("#loginBtn").click(function(e){
		if($("form")[0].checkValidity()) {
			const email = $("#email").val();
			const password = $("#password").val();
			
			e.preventDefault();
			const formData = {
				'email':email, 'password':password, '_token':token
			};

    		$.ajax({
    			url: '/auth/login',
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
	    	$("#loginForm").find(':submit').click();
	    }
	});
})