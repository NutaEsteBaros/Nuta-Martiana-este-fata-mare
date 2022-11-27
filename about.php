<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/about.css">

</head>
<body>
   

<?php include 'components/user_header.php'; ?>


<div class="heading">
   <h3>About us</h3>
   <p><a href="home.php">Home</a> <span> / About</span></p>
</div>



<section class="about">

   

   

</section>
<section class="grid">

   <div class="section">
		<div class="container">
			<div class="content-section">
				<div class="title">
					<h1>What`s our purpose?</h1>
				</div>
				<div class="content">
					
					
  <div class="card-holder">

<div class="card">

  <div class="card-contents">
	<p>
	This concept was created out of the curiosity of <span id="dots">...</span>

	  <span class="card__read-more">5 Highschool students from Hunedoara. Being surrounded by alot of teachers  during our 12 year stay in this educational system, we saw that alot of the problems regarding the way  that pupils recieve information from their teacher is granted to the lack of communication and feedback towards eachother.  That`s why, today, we present you, our solution to this common problem that we  are all facing. The project is meant to ease the interaction betweeen the teachers and the pupils through a simple easy-to-use feedback and review engine, in which the pupils can rate the teachers in a way that anybody who wants to know the pupils experience with the teacher can simply see it. The project was mainly made in PHP, with css and JavaScript implementations. </span>
	</p>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<p class="read-more-btn" onclick="readmore()" id="myBtn">Read More</p>


  </div>


</div>
					
	</div>
				<div class="social">
					<a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
					<a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
					<a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
				</div>
			</div>
			
			</div>
		</div>
		<div class="image-section">
				<img src="images/doamneduma.png">
	</div>
	
     
</footer>

<div class="loader">
   <img src="images/loader.gif" alt="">




<script>

const btn = document
    .querySelector('.read-more-btn');

const text = document
    .querySelector('.card__read-more');

const cardHolder = document
    .querySelector('.card-holder');

cardHolder
    .addEventListener('click', e => {

        const current = e.target;

        const isReadMoreBtn = current.className.includes('read-more-btn');

        if (!isReadMoreBtn)
            return;

        const currentText = e.target.parentNode.querySelector('.card__read-more');

        currentText.classList.toggle('card__read-more--open');

        current.textContent = current.textContent.includes('Read More') ? 'Read Less' : 'Read More';

    });

</script>
   
</div>


























<script src="js/script.js"></script>
<script src="js/theme.js"></script>





</body>
</html>