<?php 
    include "function.php";

    // Handle user deletion
    if(isset($_GET['userid'])){
        $id = $_GET['userid'];
        $query = "DELETE FROM user WHERE user_id = '$id'";
        mysqli_query($db, $query);
        header("Location: usermgmt.php");
    }

    // Function to get the comment count for a user
    function getComment($userid){
        global $db;
        $query = "SELECT COUNT(*) FROM comment WHERE user_id = $userid";
        $result = mysqli_query($db, $query);
        $count = mysqli_fetch_row($result)[0];  // Fetch the count directly
        return $count;
    }

    // Function to get the rating count for a user
    function getRating($userid){
        global $db;
        $ratequery = "SELECT COUNT(*) FROM ratings WHERE user_id = $userid";
        $result = mysqli_query($db, $ratequery);
        $count = mysqli_fetch_row($result)[0];  // Fetch the count directly
        return $count; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/restaurantmgmt.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <h2>User Management</h2>
        <a href="../php/dashboard.php" style="text-decoration: none; margin: 20px 10px;"><i class="fa-solid fa-house" style="font-size: 26px; color:#000;"></i></a>
        <div class="top-bar">
            <form method="POST" action="usermgmt.php">
                <div class="search">
                    <input type="text" name="search" placeholder="Search user by name or email..." required>
                    <button type="submit" name="search-btn">Search</button>
                </div>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Comment Count</th>
                    <th>Rating Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(isset($_POST['search-btn'])){
                        $searchTerm = mysqli_real_escape_string($db, $_POST['search']);
                        // Updated query with GROUP BY to avoid duplicate rows
                        $query = "SELECT user.*, 
                                         (SELECT COUNT(*) FROM comment WHERE user_id = user.user_id) AS comment_count,
                                         (SELECT COUNT(*) FROM ratings WHERE user_id = user.user_id) AS rating_count
                                  FROM user
                                  WHERE user.user_name LIKE '%$searchTerm%' OR user.user_email LIKE '%$searchTerm%'";
                    } else {
                        // Query to fetch data without duplicate entries
                        $query = "SELECT user.*, 
                                         (SELECT COUNT(*) FROM comment WHERE user_id = user.user_id) AS comment_count,
                                         (SELECT COUNT(*) FROM ratings WHERE user_id = user.user_id) AS rating_count
                                  FROM user";
                    }
                    $result = mysqli_query($db, $query);
                    if(mysqli_num_rows($result) > 0){
                        $num = 0;
                        foreach($result as $row){
                            $num = $num + 1;
                ?>        
                    <tr>
                        <td><?php echo $num; ?></td>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['comment_count']); ?></td>
                        <td><?php echo htmlspecialchars($row['rating_count']); ?></td>
                        <td class="actions">
                            <button class="delete"><a href="../php/usermgmt.php?userid=<?php echo htmlspecialchars($row['user_id']); ?>">Remove</a></button>
                        </td>
                    </tr>
                <?php 
                        }
                    } else {
                        echo "<tr><td colspan='7'>No users found matching your search.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
