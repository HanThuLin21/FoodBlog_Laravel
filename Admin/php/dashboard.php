<?php 
  include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Food Blog</title>
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="dashboard">
    <div class="sidebar">
      <div class="logo">
        <h2>Food Blog Admin</h2>
      </div>
      <ul class="nav">
        <li><a href="../php/dashboard.php" class="active"><i class="fa-solid fa-house"></i>   Dashboard</a></li>
        <li><a href="../php/blogpostmgmt.php"><i class="fa-solid fa-blog"></i> Blog Posts</a></li>
        <li><a href="../php/recipemgmt.php"> <i class="fa-solid fa-receipt"></i> Recipes</a></li>
        <li><a href="../php/restaurantmgmt.php"><i class="fa-solid fa-utensils"></i> Restaurants</a></li>
        <li><a href="../php/usermgmt.php"><i class="fa-solid fa-user"></i> Users</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="header">
        <div class="header-left">
          <h1>Dashboard</h1>
        </div>
        <div class="header-right">
          <span><?php 
            if(isset($_SESSION['admin_name'])){
              $admin_name = $_SESSION['admin_name'];
              echo $admin_name;
            }else{
              $admin_name = 'Guest';
              echo "Session variable $admin_name is not set.";
            }
          ?></span>
          <i class="fa-solid fa-user" style="font-size:  20px;"  ></i>
        </div>
      </div>

      <!-- Widgets -->
      <div class="widgets">
        <div class="widget">
          <h3>Total Blog Posts</h3>
          <p><?=getCount('blogpost') ?></p>
        </div>
        <div class="widget">
          <h3>Total Recipes</h3>
          <p><?=getCount('recipe')?></p>
        </div>
        <div class="widget">
          <h3>Total Restaurants</h3>
          <p><?=getCount('restaurant')?></p>
        </div>
        <div class="widget">
          <h3>Total Users</h3>
          <p><?=getCount('user')?></p>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="recent-activity">
        <h2>Recent Activity</h2>
        <ul>
          <li>New blog post added: "Top 10 Italian Recipes"</li>
          <li>User "JohnDoe" registered</li>
          <li>Recipe "Spicy Tacos" updated</li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>