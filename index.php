<!DOCTYPE html>
<html lang="en">

<head>
<?php
require_once 'assets/connect/head.php';
?>
<!-- videojs-->
<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
</head>

<body>

	<!--Header start(101) -->
	<header>
		<nav class="navbar navbar-expand-lg navbar-light sticky-top">
			<div class="container">
				<a class="navbar-brand" href="index.php"><img id="logo" src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<a class="nav-link active" href="#Home">Home</a>
						<a class="nav-link active" href="#AboutUs">About Us</a>
						<a class="nav-link active" href="#WhyUs">Why Us</a>
						<a class="nav-link active" href="#Features">Features</a>
						<a class="nav-link active" href="#FAQ">FAQ</a>
						<a class="nav-link active" href="contact.php">Contact Us</a>
					</div>
					<a type="button" href="teacher_Login.php" class="btn btn-sm btn-dark rounded-pill ml-auto">Teacher</a>
					<a type="button" href="student_login.php" class="btn btn-sm btn-dark rounded-pill mx-3">Student</a>
				</div>
			</div>
		</nav>
	</header>
	<!--Header End(101) -->


<!--Home start -->
  <div class="jumbotron" id="cover">
  <h1 class="display-2 text-white"><span class=" d-xs-none">Welcome to </span><br> LU EXAM HIVE</h1>
  <p class=" text-white">Be adviced this website has been created only for the purpose of LU Students.</p>
  <a class="btn btn btn-light btn-lg mr-3 d-xl-none d-lg-none d-md" href="teacher_Login.php" role="button">Teacher</a>
  <a class="btn btn btn-light btn-lg  d-xl-none d-lg-none d-md d-sm" href="student_login.php" role="button">Student</a>
</div>

	<div class="container mt-3 border border-dark border-top-0 border-bottom-0 border-left-0 border-right-0">
		<!--Row 1 -->
		<div class="row">
			<!--Column 1 -->
			<div class="col-md-6 col-sm-12">
				<h1 class="display-4">Online Exam Platform</h1>
				<p class="text-justify font-weight-normal ml-1">Online examination is conducting a test online to measure the knowledge of the participants on a given topic. In the olden days, everybody had to gather in a classroom at the same time to take an exam. With online examination students can do the exam online, in their own time, with their own device, regardless of where they live. You only need a browser and an internet connection. </p>
			</div>
			<!--Column 2 -->
			<div class="col-md-6 col-sm-12 mt-4  border border-dark border-top-0 border-bottom-0  border-right-0">
				<div class="card border-dark mb-3 d-md-none d-lg-block" style="max-width: 35rem;">
					<div class="card-header">EXAM</div>
					<div class="card-body text-dark">
						<h5 class="card-title">Tips</h5>
						<p class="card-text text-justify">Life is the most difficult exam. Many people fail because they try to copy others, not realizing that everyone has a different question paper. Be myself in personality, in sports, and in academics. Go through different methods of studying to constantly improve how you work. Always aim to be efficient.</p>
					</div>
				</div>

				<div class="card text-white bg-dark mb-3 d-none d-md-block d-lg-none d-block d-sm-none" style="max-width: 35rem;">
					<div class="card-header">Education</div>
					<div class="card-body">
						<h5 class="card-title">Life Hacks</h5>
						<p class="card-text text-justify">Keep away from people who try to belittle your ambitions. Small people always do that, but the really great make you feel that you, too, can become great. Education is the passport to the future, for tomorrow belongs to those who prepare for it today.Start where you are. Use what you have. Do what you can.</p>
					</div>
				</div>
			</div>
		</div>
	<!--Home End-->


	<!--About us Start-->

		<!--Row 2 -->
		<div class="row mt-5">
			<!--Column 1 -->
			<div class="col">
				<h2 class="display-3" id="AboutUs">About Us</h2>

		<video id="my-video" class="video-js" controls preload="auto" width="498" height="280" poster="assets/images/LuExamHiveLogo.png" data-setup="{}">
		<source src="assets/videos/AboutUs.mp4" type="video/mp4" />
	    </video>

			</div>

			<!--Column 2-->
			<div class="col mt-4 d-flex justify-content-center align-items-center ">
				<figure class="text-center mt-5">
					<blockquote class="blockquote">
						<p>Success consists of going from failure to failure without loss of enthusiasm.</p>
					</blockquote>
					<figcaption class="blockquote-footer">
					<cite title="Source Title">Winston Churchill</cite>
					</figcaption>
				</figure>
			</div>
		</div>
		<div class="row mt-5">
			<!--Column 1 -->
			<div class="col">
			<p class="lead" id="space1">Note: LEH is a project conducted by a team of 3 people from 44th Batch Leading University, Sylhet.</p>
			</div>
		</div>
	</div>
	<!--About us End(101) -->


	<!--Why Us? Start -->

	<div class="container my-5 border border-dark border-left-0 border-bottom-0 border-right-0">
		<h2 class="display-3 mt-4" id="WhyUs">Why Exam Hive?</h2>
		<div class="container mt-4">
			<div class="row blog-inner justify-content-center">
				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<img src="assets/images/feature1.jfif" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title">Stay Safe</h5>
							<p class="card-text">Stay Home, Stay Safe. During Covid-19 students are adviced to remain within the safety of their house premisis. Give any of your remaining exams via Lu Exam Hive.</p>
						</div>

					</div>
				</div>

				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<img src="assets/images/feature2.jpg" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title">Always Present</h5>
							<p class="card-text">Regardless of you or your lecturer missing out on an exam day, remain tenshon free & contact your teacher to execute exam on Lu Exam Hive.</p>
						</div>

					</div>
				</div>

				<div class="col-lg-4 col-md-12 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<img src="assets/images/feature3.jpeg" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title">Video Conferencing</h5>
							<p class="card-text">Yes now your favorite video communication mediums (Google meet & Zoom) are integrated with Lu Exam Hive.</p>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!--Why Us? End -->


<!--Features Start -->

<div class="wrapper p-5" id="cover2">
	<div class="container mb-5">
		<h2 class="display-3 mt-4 text-white" id="Features">Features</h2>
		<div class="container mt-4">
			<div class="row blog-inner justify-content-center">
				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="pt-4 mt-3 ml-2">
										<h1><i class="fas fa-mobile-alt"></i></h1>
									</div>
								</div>
								<div class="col-9">
									<h5 class="card-title">Mobile Friendly</h5>
									<p class="card-text">Our website works perfectly on moblie devices. Student can join in exam via mobile phone.</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="pt-4 mt-3 ml-2">
										<h1><i class="fas fa-globe"></i></h1>
									</div>
								</div>
								<div class="col-9">
									<h5 class="card-title">Access Anywhere</h5>
									<p class="card-text">With the website link users can access from anywhere.</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="pt-4 mt-3 ml-2">
										<h1><i class="fas fa-american-sign-language-interpreting"></i></h1>
									</div>
								</div>
								<div class="col-9">
									<h5 class="card-title">Easy to Use</h5>
									<p class="card-text">The website interface is very userfriendly anyone with basic website idea can use it.</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="pt-4 mt-3 ml-2">
										<h1><i class="fas fa-lock"></i></h1>
									</div>
								</div>
								<div class="col-9">
									<h5 class="card-title">Secured</h5>
									<p class="card-text">All the data is secured and users passwords are encrypted. Only the registerd students can participate in exam.</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="pt-4 mt-3 ml-2">
										<h1><i class="fas fa-keyboard"></i></h1>
									</div>
								</div>
								<div class="col-9">
									<h5 class="card-title">Responsive</h5>
									<p class="card-text">LU Exam Hive is compatible with both smartphone and laptop as well as other devices like tablet.</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="pt-4 mt-3 ml-2">
										<h1><i class="fas fa-mobile-alt"></i></h1>
									</div>
								</div>
								<div class="col-9">
									<h5 class="card-title">Support</h5>
									<p class="card-text">For any assistance we are always available via Contact form submission moreover our User Manual is equally helpful. </p>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
	</div>

	<!--Features End-->

	<!--FAQ start -->

	<div class="container  mt-5 pb-5  class="accordion accordion-flush" id="accordionFlushExample"">
		<h2 class="display-3 mt-4" id="FAQ">FAQ</h2>
		<div class="accordion" id="accordionExample">
		<div class="row mt-4">
			<div class="col-md-12">
					<div class="card border-light">
						<div class="card-header" id="headingOne">
						<h2 class="mb-0">
							<button class="btn btn-link btn-block text-left text-decoration-none " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<p class="faq_custom1"><b class='text-dark'>Q. Who is LU Exam Hive  for?</b></p class="lead">
							</button>
						</h2>
					</div>
				</div>
				<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						<p class="text-justify">LU Exam Hive has been created with the purpose of taking examination of Leading University students only by LU Authorized Teachers <br> in times of need.👮🏻‍♂️ </p>
					</div>
				</div>
			</div>

		</div>
		</div>
		<div class="accordion" id="accordionExample">
		<div class="row mt-4">
			<div class="col-md-12">
					<div class="card border-light">
						<div class="card-header" id="headingTwo">
						<h2 class="mb-0">
							<button class="btn btn-link btn-block text-left text-decoration-none " type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							<p class="faq_custom1"><b class='text-dark'>Q. How can a new teacher register?</b></p class="lead">
							</button>
						</h2>
					</div>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
					<div class="card-body">
						<p class="text-justify">Only LU teachers can register on LU Exam Hive. If you are a LU teacher please reach us via contact form provided in the website. 💼<br>
 Such request must be in the following format: <br><br>

Subject: Lu New Teacher <br>
Name: [Your Name ] <br>
Email: [Your Email ] <br>
Phone: [Your Phone ] <br>
Address: [Your address ]</p>
					</div>
				</div>
			</div>

		</div>
		</div>
		<div class="accordion" id="accordionExample">
		<div class="row mt-4">
			<div class="col-md-12">
					<div class="card border-light">
						<div class="card-header" id="headingThree">
						<h2 class="mb-0">
							<button class="btn btn-link btn-block text-left text-decoration-none " type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
							<p class="faq_custom1"><b class='text-dark'>Q. What should I do if I forgot my password? (Student)</b></p class="lead">
							</button>
						</h2>
					</div>
				</div>
				<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						<p class="text-justify">Can’t remember your password? Don’t worry. If you have an existing account you can change your password any time. <br>
Click the link below if you forgot your
password .😑<br><br>
Link: <a href="request_reset_password.php"> Forgot my password.</a></p>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="accordion" id="accordionExample">
		<div class="row mt-4">
			<div class="col-md-12">
					<div class="card border-light">
						<div class="card-header" id="headingFour">
						<h2 class="mb-0">
							<button class="btn btn-link btn-block text-left text-decoration-none " type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
							<p class="faq_custom1"><b class='text-dark'>Q. What to do if I am unable to register with my Student ID and Email?</b></p class="lead">
							</button>
						</h2>
					</div>
				</div>
				<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
					<div class="card-body">
						<p class="text-justify">If you are unable to register using your Student ID and Email please reach out to us via contact us form provided in the website.☹️<br>

Request of such must contain the following format:<br><br>

Subject: Student Registration Problem<br>
Name: [Your Name ]<br>
Email: [Your Email ]<br>
Phone: [Your Phone ]<br>
Address: [Your address ]<br>
Department: [Your Department]<br>
Section: [Your Section]<br>
Batch: [Your Batch ]</p>
					</div>
				</div>
			</div>

		</div>
		</div>
		<div class="accordion" id="accordionExample">
		<div class="row mt-4">
			<div class="col-md-12">
					<div class="card border-light">
						<div class="card-header" id="headingFive">
						<h2 class="mb-0">
							<button class="btn btn-link btn-block text-left text-decoration-none " type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
							<p class="faq_custom1"><b class='text-dark'>Q. What should i do if I want to delete my LU Exam Hive Account? (Student & Teacher)</b></p class="lead">
							</button>
						</h2>
					</div>
				</div>
				<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
					<div class="card-body">
						<p class="text-justify">Please note that after your delete request is made we will get rid of all data related to your account within 7 business days. Let us know if you want to delete your account via contact from present in the website.👋🏻 <br>
					Such request require the following format: <br><br>
					Subject: Student / Teacher Account Deletetion<br>
Name: [Your Name]<br>
Email: [Your Email]<br>
Phone: [Your Phone]<br>
Address: [Your Address]<br>
Department: [Your Department]<br>
Section: [Your Section] (Only students)<br>
Batch: [Your Batch] (Only students)<br>
Reason of Account Delete: [Shortly state why you opt to delete Your Account]</p>
				</p>
					</div>
				</div>
			</div>

		</div>
		</div>
	</div>


	<!--FAQ End -->



<?php

require_once 'assets/connect/footer.php';
?>
<!-- videojs-->
<script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
</body>

</html>