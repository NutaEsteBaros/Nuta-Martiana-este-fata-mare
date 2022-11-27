<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> Cauta</title>

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   

<?php include 'components/user_header.php'; ?>


<section class="search-form">
   <form method="post" action="">
      <input type="text" name="search_box" placeholder="Search" class="box">
      <button type="submit" name="search_btn" class="fas fa-search"></button>
   </form>
</section>




<section class="products" style="min-height: 100vh; padding-top:0;">

<div class="box-container">

      <?php
         if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
         $search_box = $_POST['search_box'];
         $select_products = $conn->prepare("SELECT * FROM `school` WHERE judet LIKE '%{$search_box}%'");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="judet" value="<?= $fetch_products['judet']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
    
         
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
        
         <div class="title"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="judet"><?= $fetch_products['judet']; ?></div>
       
         </div>
      </form>
            </div>
      <?php
            }
         }else{
            echo '<p class="empty">Nu exista nici un produs inca</p>';
         }
      }
      ?>

   </div>

</section>












<?php include 'components/footer.php'; ?>








<script src="js/script.js"></script>

</body>
</html>