<?php 
    include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link rel="stylesheet" href="../css/recipemgmt.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Recipe Management</h2>
        <a href="../php/dashboard.php" style="text-decoration: none;"><i class="fa-solid fa-house" style="font-size: 26px; color:#000;"></i></a>
        <div class="top-bar" style="margin-top: 20px;">
            <form method="POST" action="recipemgmt.php">
                <div class="search">
                    <input type="text" name="search" placeholder="Search recipe by name or category or foodtype..." required>
                    <button type="submit" name="search-btn">Search</button>
                </div>
            </form>
            <div id="searchresult"></div>
            <button><a href="../php/recipecreate.php" class="post-create">+ New Recipe Post</a></button>
        </div>
        <table>     
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Foodtype</th>
                    <th>Image1</th>
                    <th>Image2</th>
                    <th>Image3</th>
                    <th>Available Restaurant</th>
                    <th>Recipe Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if (isset($_POST['search-btn'])) {
                    $searchTerm = mysqli_real_escape_string($db, $_POST['search']);
                    $query = "SELECT DISTINCT recipe.*,restaurant.restaurant_name
                            FROM recipe
                            INNER JOIN restaurant ON recipe.foodtype = restaurant.foodtype
                            WHERE
                            recipe.recipe_name LIKE '%$searchTerm%' OR 
                            recipe.recipe_category LIKE '%$searchTerm%' OR 
                           recipe.foodtype LIKE '%$searchTerm%'";
                } else {
                    $query = "SELECT DISTINCT recipe.*,restaurant.restaurant_name
                            FROM recipe
                            INNER JOIN restaurant ON recipe.foodtype = restaurant.foodtype;";
                }

                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    $num = 0;
                    foreach ($result as $row) {
                        $num = $num + 1;
            ?>        
                <tr>
                    <td><?php echo $num; ?></td>
                    <td><?php echo htmlspecialchars($row['recipe_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['recipe_category']); ?></td>
                    <td><?php echo htmlspecialchars($row['foodtype']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($row['image1']); ?>" style="width: 90px; height: 70px" alt="<?php echo htmlspecialchars($row['recipe_name']); ?>" ></td>
                    <td><img src="<?php echo htmlspecialchars($row['image2']); ?>" style="width: 90px; height: 70px" alt="<?php echo htmlspecialchars($row['recipe_name']); ?>" ></td>
                    <td><img src="<?php echo htmlspecialchars($row['image3']); ?>" style="width: 90px; height: 70px" alt="<?php echo htmlspecialchars($row['recipe_name']); ?>" ></td>      
                    <td><?php echo htmlspecialchars($row['restaurant_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['recipe_content'])?></td>
                    <td class="actions">
                        <button class="view"><a href="../php/recipeview.php?recipeId=<?php echo htmlspecialchars($row['recipe_id']); ?>">View</a> </button>
                        <button class="edit"><a href="../php/recipeedit.php?recipeId=<?php echo htmlspecialchars($row['recipe_id']); ?>">Edit</a></button>
                        <button class="delete"><a href="../php/recipemgmt.php?recipeid=<?php echo htmlspecialchars($row['recipe_id']); ?>">Delete</a></button>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='9'>No recipes found matching your search.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
