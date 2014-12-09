<?php
session_start();

function is_logged_in() {
  if(isset($_SESSION['id'])) {
    return true;
  }
  return false;
}
//from login OR signup page page, AJAX request.  On success, window.location = 'app/#/home' to take people back to homepage
//on failure, notify user on page that bad credentials.
?>
<!doctype html>
<html lang="en" ng-app="AppyApp">
<head>
  <meta charset="utf-8">
  <title>Ambassadors</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" href="css/animations.css">


  <script src="http://www.cs.unc.edu/Courses/comp426-f14/jquery-1.11.1.js"></script>
  <script src="bower_components/angular/angular.js"></script>
  <script src="bower_components/angular-animate/angular-animate.js"></script>
  <script src="bower_components/angular-route/angular-route.js"></script>
  <script src="bower_components/angular-resource/angular-resource.js"></script>
  <!--Carousel-->
  <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.2.js"></script>


  <script src="js/app.js"></script>
  <script src="js/animations.js"></script>
  <script src="js/controllers.js"></script>
  <script src="js/filters.js"></script>
  <script src="js/services.js"></script>


  
  
  </head>
<body>

<!--   <div class="view-container">
    <div ng-view class="view-frame"></div>
  </div>
 -->

<div ng-controller="HeaderController">
	<!--The main navagation bar at the top of the page-->
	<ul class="nav nav-pills ">
    <li role="presentation" ng-class="{ active: isActive('/home')}"><a href="#/home">Home</a></li>

       <li role="presentation" ng-class="{ active: isActive('/student-list')}"><a href="#/student-list">Find Students</a></li>

    <li role="presentation" ng-class="{ active: isActive('/companies')}"><a href="#/companies">Jobs</a></li>
  
    <li role="presentation" ng-class="{ active: isActive('/about')}"><a href="#/about">About</a></li>

     <!-- <li role="presentation" ng-class="{ active: isActive('/connected-student-list')}"><a href="#/connected-student-list">"Connected" Find Students</a></li>

 -->
<?php if(!is_logged_in()): ?>

    <li role="presentation" class="login"  ng-class="{ active: isActive('/registration')}"><a href="#/registration"><div class="right">Registration</div></a></li>

     <li role="presentation" class="login" ng-class="{ active: isActive('/login')}"><a href="#/login"><div class="right">Log In</div></a></li>

    <li> 
<?php else: ?>
     <li role="presentation" class="login" ng-class="{ active: isActive('/profile')}"><a href="#/profile"><div class="right">Profile</div></a></li>
	
	 <li role="presentation" class="login" ng-class="{ active: isActive('/login')}"><a href="#/login"><div class="right">Log Out</div></a></li>
   <!-- <li role="presentation" ng-class="{ active: isActive('/login')}"><a href="#/login"><?php echo $user['name']; ?></li>-->
<?php endif; ?>
</ul>

</div>
<!--

</div>
-->
<div ng-view> </div>



<footer class="footer blue">
  <section class="padded">
    <div class="container">
      <div class="row" style="padding-bottom: 15px">
        <div class="col-md-6 col-sm-12">
       <!--    <img src="/assets/img/logo-mini-lg.png" class="pull-left" style="height: 100px; padding: 10px 20px"> -->
          <h5>What is Ambassador</h5>
          <p>A site that allows startups/companies to find and connection with their avid fans on campus, and give them the opportunity to be a part of their brand. Give students the opportunity to connect with small companies/brands they love in a setting outside of LinkedIn.</p>
        </div>
        <div class="col-sm-3">
          <h5>More</h5>
          <ul class="list-unstyled">
            <li><a class="undy" href="#/about">About Us</a></li>
            <li><a class="undy" href="#/testimonials">Testimonals</a></li>

          </ul>
        </div>
        <div class="col-sm-3">
          <h5>Using Ambassador</h5>
          <ul class="list-unstyled">
            <li> <a class="undy" href="#/connected-student-list">"Connected" Find Students</a></li>
             <li> <a class="undy" href="#/connected-company-list">"Connected" Company List</a></li>
            <li><a class="undy" href="mailto:support@ambassador.com">support@ambassador.com</a></li>

          </ul>
        </div>

      </div>
      <div class="row" style="padding-top: 15px;">
        <div class="col-md-12 clearfix">
          <span class="pull-left">Copyright 2014, Student Ambassador Inc.</span>
        </div>
      </div>
    </div>
  </section>
</footer>
 
</body>
</html>
