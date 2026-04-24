<?php 
    include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogpost Management</title>
    <link rel="stylesheet" href="../css/blogpostmgmt.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h2>Blogpost Management</h2>
        <a href="../php/dashboard.php" style="text-decoration: none;"><i class="fa-solid fa-house" style="font-size: 26px; color:#000;"></i></a>
        <div class="top-bar" style="margin-top: 20px;">
            <form method="POST" action="blogpostmgmt.php">
                <div class="search">
                    <input type="text" name="search" placeholder="Search blogpost by title or category..." required>
                    <button type="submit" name="search-btn">Search</button>
                </div>
            </form>
            <button><a href="../php/blogpostcreate.php" class="post-create">+ New Blog Post</a></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Cuisine</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Average Rating</th>
                    <th>Image1</th>
                    <th>Image2</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>   
            <?php 
                if (isset($_POST['search-btn'])) {
                    $searchTerm = mysqli_real_escape_string($db, $_POST['search']);
                    $query = "SELECT blogpost.*, AVG(ratings.rating) AS avg_rating
                              FROM blogpost 
                              LEFT JOIN ratings ON blogpost.post_id = ratings.post_id 
                              WHERE blogpost.post_title LIKE '%$searchTerm%' OR 
                                    blogpost.post_category LIKE '%$searchTerm%' OR 
                                    blogpost.foodtype LIKE '%$searchTerm%'
                              GROUP BY blogpost.post_id
                              ORDER BY avg_rating DESC";
                } else {
                    $query = "SELECT blogpost.*, AVG(ratings.rating) AS avg_rating
                              FROM blogpost 
                              LEFT JOIN ratings ON blogpost.post_id = ratings.post_id 
                              GROUP BY blogpost.post_id
                              ORDER BY avg_rating DESC";
                }
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result) > 0){
                    $num = 0;
                    foreach($result as $row){
                        $num = $num + 1;
            ?>     
                <tr>
                    <td><?php echo $num; ?></td>
                    <td><?php echo $row['post_title']; ?></td>
                    <td><?php echo $row['post_category']; ?></td>
                    <td><?php echo $row['foodtype']; ?></td>
                    <td><?php echo substr($row['post_description'], 0, 150) . '...'; ?></td>
                    <td><?php echo $row['post_date']; ?></td>
                    <td><?php echo number_format($row['avg_rating'] ?? 0, 1); ?></td>
                    <td style="width: 80px;"><img src="<?php echo $row['post_image']; ?>" style="width: 90px; height: 70px;"></td>
                    <td style="width: 80px;"><img src="<?php echo $row['post_image2']; ?>" style="width: 90px; height: 70px;"></td>
                    <td class="actions">
                        <button class="edit"><a href="../php/blogpostedit.php?ptId=<?php echo $row['post_id']; ?>">Edit</a></button>
                        <button class="delete"><a href="../php/blogpostmgmt.php?ptid=<?php echo $row['post_id']; ?>">Delete</a></button>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='10'>No blogpost found matching your search.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>