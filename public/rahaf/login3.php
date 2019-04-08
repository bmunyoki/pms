<?php

// include the configs / constants for the database connection
require_once("../conf/db.php");
$errors = array();
//form handler code starts here. 
if (isset($_POST["Login"])) {
    
    if(empty($_POST['username'])){
        $errors[] = "Username is required";
    }elseif (empty($_POST['password'])){
        $errors[] = "Password is required";
    }elseif (strlen($_POST['password']) < 6) {
        $errors[] = "Password minimum length is 6 characters";
    }
    
    //if everything is valid
    if (empty($errors)) {
        
        //connection to db
        $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // change character set to utf8 and check it
        if (!$db_connection->set_charset("utf8")) {
            $errors[] = $db_connection->error;
        }
        if (!$db_connection->connect_errno) {
            
            // escape the POST stuff
            $username = $db_connection->real_escape_string(strip_tags($_POST['username'], ENT_QUOTES));
            
            $password = $_POST['password'];
            $usertype =$_POST['type'];
            
            // database query, getting all the info of the selected user (allows login via email address in the
            // username field)
            $sql = "SELECT *
                    FROM user

                    WHERE name = '" . $username . "' and password='"$password."'and type='"$usertype."'" 
            $result_of_login_check = $db_connection->query($sql);
            // if this user exists
            if ($result_of_login_check->num_rows == 1) {

                // get result row (as an object)
                $result_row = $result_of_login_check->fetch_object();

                // using PHP 5.5's password_verify() function to check if the provided password fits
                // the hash of that user's password
                 if (password_verify($password, $result_row->password)) {

                    
                    // create/read session, absolutely necessary
                    session_start();
                    $_SESSION['id'] = $result_row->admin_id;
                    $_SESSION['user'] = $result_row->userName;
                    $_SESSION['user_login_status'] = 1;
                    //move to admin index page
                    if ($type == doctor) {
                      header("Location: ".ROOT_URL."php/Doctor.php");
                    die();
                    }elseif ($type == patient) {
                      header("Location: ".ROOT_URL."php/Patient.php");
                    die();
                    }else if ($type == admin) {
                      # code...
                    }{
                      header("Location: ".ROOT_URL."php/Admin.php");
                    die();
                    }
                    
                    

                } else {
                    $errors[] = "Wrong password. Try again.";
                }
            } else {
                $errors[] = "This Admin user does not exist.";
            }
            
            
            



        }else {
                $errors[] = "Sorry, no database connection.";
        }
    
        
    }
    
    
}//form handler code ends here. 



?>




















<!DOCTYPE html>
<html lang="en">
<head>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alshefa Hospital</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <link rel="stylesheet" type="text/css" href="style1.css">
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css1/demo.css" />
        <link rel="stylesheet" type="text/css" href="css1/style.css" />
    <link rel="stylesheet" type="text/css" href="css1/animate-custom.css" />
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
<div class="container-fluid">
   <a class="navbar-brand" href="#"><img src="logo1.png" alt="Hospital logo"></a>
   <button class="navbar-toggler" type = "button" data-toggle="collapse"
   data-target="#navbarResponsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto"><!--ml-auto it will make the navbar to the right if we maxmized the window -->
     		<li class="nav-item active">
     			<a class="nav-link" href="homepage.html">Home</a>
     		</li>

     		<li class="nav-item">
     			<a class="nav-link" href="services.html">Our services</a>
     		</li>

     		<li class="nav-item">
     			<a class="nav-link" href="contactForm.html">Contact us</a>
     		</li>

     		<li class="nav-item">
     			<a class="nav-link" href="AboutUs.html">About us</a>
     		</li>

     		<li class="nav-item">
     			<a class="nav-link" href="#" onclick="document.getElementById('container_demo').style.display='block'" style="width:auto;">Log in</a>
     		</li>
     	</ul>
     </div>
</div>
</nav>
<section>       
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="mysuperscript.php" autocomplete="on"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="keeplogin">
                                    <label > Select your role:- </label>   
                                    <select>

                     <option value="volvo">patient</option>
                     <option value="saab">doctor</option>
                     <option value="mercedes">admin</option>

                   </select>
                </p>
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
                </p>
                                <p class="change_link">
                  Not a member yet ?
                  <a href="#toregister" class="to_register">Join us</a>
                </p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="mysuperscript.php" autocomplete="on"> 
                                <h1> Sign up </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p class="signin button"> 
                  <input type="submit" value="Sign up"/> 
                </p>
                                <p class="change_link">  
                  Already a member ?
                  <a href="#tologin" class="to_register"> Go and log in </a>
                </p>
                            </form>
                        </div>
            
                    </div>
                </div>  
            </section>

<script>
// Get the modal
var modal = document.getElementById('container_demo');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>



<!--- Image Slider -->

<div id="slides" class="carousel slide" data-ride="carousel">
<ul class="carousel-indicators">
  <li data-target="#slides" data-slide-to="0" class="active"></li>
  <li data-target="#slides" data-slide-to="1"></li>
  <li data-target="#slides" data-slide-to="2"></li>
</ul>
<div class="carousel-inner">
	<div class="carousel-item active">
		<img src="h.jpg">
	</div>
	<div class="carousel-item">
		<img src="h6.jpg">
	</div>
	<div class="carousel-item">
		<img src="h4.jpg">
	</div>
	<div class="carousel-item">
		<img src="h8.jpg">
	</div>

</div>
</div>


<!--- Welcome Section -->
<div class="container-fluid padding">
<div class="row welcome text-center">
	<div class="col-12">
		<h2 id="Aboutus" class="display-5">AlShefa Hospital</h2>
	</div>

	<div class="col-12">
		<p class="lead">
		Welcome to the alShefa Hospital web site.<br> We are committed to providing the highest quality patient care<br> in a friendly, compassionate setting.
		</p>
	</div>
</div>
</div>

<!--- Three Column Section -->

<div class="container-fluid padding">
<div class="row text-center padding">
  <div class="col-xs-12 col-sm-6 col-md-4">
  	<h3>Mission</h3>
  	<p>To provide quality care and education as a partner in your health and wellness.</p>
  </div>

  <div class="col-xs-12 col-sm-6 col-md-4">
  	<h3>Values</h3>
  	<p>As a dedicated team we value integrity, respect and excellence for all people.</p>
  </div>

  <div class="col-sm-12 col-md-4">
  	<h3>Vision</h3>
  	<p>To have highly satisfied patients who receive ideal healthcare from exceptional providers, employees, and facilities.</p>
  </div>

</div>
<hr class= "my-4">
</div>



<!--- Connect -->
<div class="container-fluid padding">
<div class="row text-center padding">
	<div class="col-12">
	  <h2 id="Contact">Contact us</h2>
	</div>
	<div class="col-12 social padding">
	 <a href="https://facebook.com/AlShefaHospital"><i class="fab fa-facebook"></i></a>
	 <a href="https://twitter.com/AlShefaHospital"><i class="fab fa-twitter"></i></a>
	 <a href="https://instagram.com/AlShefaHospital"><i class="fab fa-instagram"></i></a>
	</div>

</div>
<hr class= "my-4">
</div>

<!--- Footer -->
<footer>
<div class="container-fluid padding">
<div class="row text-center">
	<div class="col-md-4">
	  <img src="logo2.png">
	  <hr class="light">
	  <p>01155555</p>
	  <p>AlshefaHospital@gmail.com</p>
	  <p>100 street Name</p>
	  <p>Riyadh,saudi Arabia</p>
    </div>
    <div class="col-md-4">
	  <hr class="light">
	  <h5>Our hours</h5>
	  <hr class="light">
	  <p> Sunday - Thursday : 7:30 am - 5:00 pm </p>
	  <p> Friday - Saturday : 8:00 am - 1:00 pm </p>
    </div>
    <div class="col-md-4">
	  <hr class="light">
	  <h5>Service Area</h5>
	  <hr class="light">
	  <p> Riyadh , saudi Arabia </p>
	  <p> Dammam , saudi Arabia </p>
	  <p> jeddah , saudi Arabia </p>
    </div>


</div>
</div>
</footer>



</body>
</html>
