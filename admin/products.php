<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $judet = $_POST['judet'];
   $judet = filter_var($judet, FILTER_SANITIZE_STRING);
   $oras = $_POST['oras'];
   $oras = filter_var($judet, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `school` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'numele produsului exista deja!';
   }else{
      if($image_size > 2000000){
         $message[] = 'imaginea este prea mare';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `school`(name, judet, oras, image) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $judet, $oras, $image]);

         $message[] = 'noul produs a fost adaugat!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `school` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `school` WHERE id = ?");
   $delete_product->execute([$delete_id]);
 
   header('location:products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Scoala</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>



<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>adauga scoala</h3>
      <input type="text" required placeholder="Nume scoala" name="name" maxlength="100" class="box">
      <input type="text" maxlength="100" required placeholder="Judet" name="judet" class="box">
      <input type="text" maxlength="100" required placeholder="Oras" name="oras" class="box">
      <input type="file" name="image"  class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="Adauga scoala" name="add_product" class="btn">
   </form>

</section>


<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `school`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="flex">
         <div class="price"><?= $fetch_products['judet']; ?></div>
        
      </div>
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="flex-btn">
         <a href="add_teach.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Adauga profesor</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('stergi acest produs?');">sterge</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">nici un produs nu a fost agaugat inca!</p>';
      }
   ?>

   </div>

</section>












<script src="../js/admin_script.js"></script>

</body>
</html>