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
   <title>Acasa</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   

   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/expend.css">
   <link rel="stylesheet" href="css/home.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>
<script src="js/script.js"></script>
<section>
</section>
<section>



















<center>
<div class="title">

   <section class="center">

   <form action="" method="post" class="solids">
         <h3>Find the perfect highschool for you</h3>
         <div class="box">
               <p class="city">Select your city <span>*</span></p>
               <select name="judet" class="input_nuti" required>
                 <div class="nutica"> <option value="non">None</option>
                  <option value="AB">Alba Iulia</option>
                  <option value="AG">Arges</option>
                  <option value="AR">Arad</option>
                  <option value="BC">Bacau</option>
                  <option value="BH">Bihor</option>
                  <option value="BN">Bistrita-Nasaud</option>
                  <option value="BR">Braila</option>
                  <option value="BT">Botosani</option>
                  <option value="BV">Brasov</option>
                  <option value="BZ">Buzau</option>
                  <option value="CJ">Cluj</option>
                  <option value="CL">Calarasi</option>
                  <option value="CS">Caras-Severin</option>
                  <option value="CT">Constanta</option>
                  <option value="CV">Covasna</option>
                  <option value="DB">Dambovita</option>
                  <option value="DJ">Dolj</option>
                  <option value="GJ">Gorj</option>
                  <option value="GL">Galati</option>
                  <option value="GR">Giurgiu</option>
                  <option value="HD">Hunedoara</option>
                  <option value="HR">Harghita</option>
                  <option value="IF">Ilfov</option>
                  <option value="IL">Ialomita</option>
                  <option value="IS">Iasi</option>
                  <option value="MH">Mehedinti</option>
                  <option value="MM">Maramures</option>
                  <option value="MS">Mures</option>
                  <option value="NT">Neamt</option>
                  <option value="OT">Olt</option>
                  <option value="PH">Prahova</option>
                  <option value="SB">Sibiu</option>
                  <option value="SJ">Salaj</option>
                  <option value="SM">Satu-Mare</option>
                  <option value="SV">Suceava</option>
                  <option value="TL">Tulcea</option>
                  <option value="TM">Timis</option>
                  <option value="TR">Teleorman</option>
                  <option value="VL">Valcea</option>
                  <option value="VN">Vrancea</option>
                  <option value="VS">Vaslui</option>
</div>
              
               </select>
            </div>
            
         </div>
         <input type="submit" value="search school" name="search" class="btn">
      </form>

   </section>

</div>
</center>



   



   	
	
	<?php
	 if(isset($_POST['search'])){
      $search_box = $_POST['judet'];
      $select_products = $conn->prepare("SELECT * FROM `school` WHERE judet LIKE '%{$search_box}%'");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
	$rating = new Rating();
	$itemList = $rating->getItemList();
   $average = $rating->getRatingAverage($fetch_products["id"]);
	?>	
   <section class="solids">
	<div class="row">
		
		<div class="col-sm-4">
      <div class="title"><?= $fetch_products['name']; ?></div>

      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="" class="schoolph">
      
		<div class="heading"><h1>County:<?= $fetch_products['oras'];?><br > Rating:<?php printf('%.1f', $average); ?> <small>/ 5</small></span> <span class="rating-reviews">
         <br><a href="show_rating.php?item_id=<?php echo $fetch_products["id"]; ?>"><button type="button"  class="btn btn-info">Rate this school</button></a></h1></div>
				
		</div>		
	</div>
    
  <div class="heading"><h1>Teachers:</h1>
   <div class="card-holder">
<div class="card">
  <div class="card-contents">
  <section class="card__read-more">
   
	<?php
   $idsc=$fetch_products['id'];
     $select_teach = $conn->prepare("SELECT * FROM `prof` WHERE id_school LIKE '%{$idsc}%'");
      $select_teach->execute();
      if($select_teach->rowCount() > 0){
         while($fetch_teach = $select_teach->fetch(PDO::FETCH_ASSOC)){
            $rating = new RatingProf();
            $itemList = $rating->getItemList();
            $average = $rating->getRatingAverage($fetch_teach["id"]);
	?>	
	


	
	 

<div class="heading"><h4><div class="title"><?= $fetch_teach['name']; ?></div><br>
      <img src="uploaded_img/<?= $fetch_teach['image']; ?>" class="profpic" alt=""><br>Subjects:<?= $fetch_teach['mat'];?><br > Rating:<?php printf('%.1f', $average); ?> <small>/ 5</small></span> <span class="rating-reviews">
         <br><a href="show_rating.php?item_id=<?php echo $fetch_teach["id"]; ?>"><button type="button"  class="btn btn-info">Rate this theach</button></a></h1></div>









      
	

      
      <?php
         
      }
   }else{
      echo '<p class="empty">There are no teahcers</p>';
   } ?>

</section>
	<br><br><br><br><br><br><br>
	<p class="read-more-btn" onclick="readmore()" id="myBtn">Show Teachers</p>
  </div>
   </div>


<?php
            }
         }else{
            echo '<p class="empty">Please Select A Registered County.</p>';
         }
    }
      ?>

   </div>
   </section>
   

					

	

     
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
        current.textContent = current.textContent.includes('Read More') ? 'Show1' : 'Show';
    });
</script>


<script src="js/theme.js"></script>

</div>	
</body>
</html>