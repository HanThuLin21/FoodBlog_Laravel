<?php 
    include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management</title>
    <link rel="stylesheet" href="../css/restaurantmgmt.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h2>Restaurant Management</h2>
        <a href="../php/dashboard.php" style="text-decoration: none;"><i class="fa-solid fa-house" style="font-size: 26px; color:#000;"></i></a>
        <div class="top-bar" style="margin-top: 20px;">
            <form method="POST" action="restaurantmgmt.php">
                <div class="search">
                    <input type="text" name="search" placeholder="Search restaurant by name or foodtype or rating" required>
                    <button type="submit" name="search-btn">Search</button>
                </div>
            </form>
            <button><a href="../php/restaurantcreate.php" class="post-create">+ New Restaurant Post</a></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Cuisine</th>
                    <th>Location</th>
                    <th>Content</th>
                    <th>Logo</th>
                    <th>Rating</th>
                    <th>Opening Day</th>
                    <th>Opeing Hour</th>
                    <th>Closing Hour</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if(isset($_POST['search-btn'])){
                    $searchTerm = mysqli_real_escape_string($db,$_POST['search']);
                    $query = "SELECT * FROM restaurant WHERE
                            restaurant_name LIKE '%$searchTerm%' OR
                            foodtype LIKE '%$searchTerm%' OR
                            restaurant_rating LIKE '%$searchTerm%'";
                }else{
                    $query = "SELECT * FROM restaurant";
                }
                $result = mysqli_query($db,$query);
                if(mysqli_num_rows($result) > 0){
                    $num = 0;
                foreach($result as $row){
                    $num = $num + 1;
            ?>        
                <tr>
                    <td><?php echo $num; ?></td>
                    <td><?php echo $row['restaurant_name'] ?></td>
                    <td><?php echo $row['restaurant_phone'] ?></td>
                    <td><?php echo $row['foodtype']?></td>
                    <td><?php echo $row['restaurant_location']?></td>
                    <td><?php echo substr($row['restaurant_content'],0,30);?> ...</td>
                    <td><img src="<?php echo $row['restaurant_image'] ?>" style="width: 120px; height:80px;"></td>
                    <td><?php echo $row['restaurant_rating'];?> ★</td>
                    <td><?php echo $row['opening_day'];?></td>
                    <td><?php echo  date("h:i A", strtotime($row['open_hour']));?></td>
                    <td><?php echo  date("h:i A", strtotime($row['close_hour']));?></td>
                    <td class="actions">
                        <button class="edit"><a href="../php/restaurantedit.php?rtId=<?php echo $row['restaurant_id']?>">Edit</a></button>
                        <button class="delete"><a href="../php/restaurantmgmt.php?rtid=<?php echo $row['restaurant_id']?>">Delete</a></button>
                    </td>
                </tr>
                <?php 
                    }
                }else{
                    echo "<tr><td colspan='9'>No restaurant found matching your search.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
