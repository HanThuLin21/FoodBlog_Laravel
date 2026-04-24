<?php 
    session_start();
    include "connect.php";

    if(isset($_POST['admin-register'])){
        $nameError = "";$emailError = ""; $passError = "";$conpassError = "";
        $name = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $conpass = $_POST['conpassword'];

        if(empty($name)){
            $nameError = "You need to fill user name";
        }
        if(empty($email)){
            $emailError = "You need to fill email";
        }
        if(empty($pass)){
            $passError = "You need to fill password";
        }
        if(empty($conpass)){
            $conpassError = "You need to fill confirm password";
        }
    
        if(empty($nameError) && empty($emailError) && empty($passError) && empty($conpassError)){
            $query = "INSERT INTO tbladmin(admin_name, admin_email, admin_pass, admin_conpass)
                  VALUES('$name', '$email', '$pass', '$conpass')";
            mysqli_query($db, $query);
        
            $query = "SELECT admin_name FROM tbladmin WHERE admin_email = '$email' AND admin_pass = '$pass'";
            $result = mysqli_query($db, $query);
        
            if($result && mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $_SESSION['admin_name'] = $row['admin_name'];
                header("Location: dashboard.php");
            }
        }
    }

    if(isset($_POST['admin-login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query= "SELECT admin_name FROM tbladmin WHERE admin_email = '$email' AND admin_pass = '$password'";

        $result = mysqli_query($db,$query);

        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin_name'] = $row['admin_name'];
            header("Location: dashboard.php");
        }
    }

    if(isset($_POST['create-post'])){
        $title = mysqli_real_escape_string($db,$_POST['title']);
        $category = mysqli_real_escape_string($db,$_POST['category']);
        $foodtype = mysqli_real_escape_string($db,$_POST['foodtype']);
        $desc = mysqli_real_escape_string($db,$_POST['desc']);
        $image = mysqli_real_escape_string($db,$_POST['image']);
        $image2 = mysqli_real_escape_string($db,$_POST['image2']);
        $old_date = date('l, F d y h:i:s');
        $old_date_timestamp = strtotime($old_date);
        $new_date = date('Y-m-d H:i:s', $old_date_timestamp); 
        $query = "INSERT INTO blogpost(post_title,post_category,foodtype,post_description,post_image,post_image2, post_date)
                VALUES('$title','$category','$foodtype','$desc','$image','$image2','$new_date')";
        mysqli_query($db,$query);
        header("Location: blogpostmgmt.php");
    }

    if(isset($_GET['ptid'])){
        $id = $_GET['ptid'];
        $query = "DELETE FROM blogpost WHERE post_id = '$id'";
        mysqli_query($db,$query);
        header("Location: blogpostmgmt.php");
    }

    if(isset($_POST['edit-post'])){
        $id = mysqli_real_escape_string($db,$_POST['id']);
        $title = mysqli_real_escape_string($db,$_POST['title']);
        $category = mysqli_real_escape_string($db,$_POST['category']);
        $foodtype = mysqli_real_escape_string($db,$_POST['foodtype']);
        $desc = mysqli_real_escape_string($db,$_POST['desc']);
        $image = mysqli_real_escape_string($db,$_POST['image']);
        $image2 = mysqli_real_escape_string($db,$_POST['image2']);

        $query = "UPDATE blogpost SET 
                post_title = '$title',
                post_category = '$category',
                foodtype = '$foodtype',
                post_description = '$desc',
                post_image = '$image',
                post_image2 = '$image2' WHERE post_id = '$id'"; 
        mysqli_query($db,$query);
        header("Location: blogpostmgmt.php");
    }

    function getCount($table){
        global $db;
        $query = "SELECT * FROM $table";
        $result = mysqli_query($db,$query);
        $count =  mysqli_num_rows($result);
        return $count;
    }


    // Restaruant
    if(isset($_POST['create-restaurant'])){
        $name = mysqli_real_escape_string($db,$_POST['name']);
        $phone = mysqli_real_escape_string($db,$_POST['phone']);
        $foodtype = mysqli_real_escape_string($db,$_POST['foodtype']);
        $location= mysqli_real_escape_string($db,$_POST['location']);
        $content = mysqli_real_escape_string($db,$_POST['content']);
        $image = mysqli_real_escape_string($db,$_POST['image']);
        $image2 = mysqli_real_escape_string($db,$_POST['image2']);
        $image3 = mysqli_real_escape_string($db,$_POST['image3']);
        $rate = mysqli_real_escape_string($db,$_POST['rate']);
        $day = mysqli_real_escape_string($db,$_POST['day']);
        $opentime = mysqli_real_escape_string($db,$_POST['opentime']);
        $closetime = mysqli_real_escape_string($db,$_POST['closetime']);

        $query = "INSERT INTO restaurant(restaurant_name,restaurant_phone,foodtype,restaurant_location,restaurant_content,
                restaurant_image,restaurant_image2,restaurant_image3,restaurant_rating, opening_day,open_hour,close_hour) 
                VALUES('$name','$phone','$foodtype','$location','$content','$image','$image2','$image3','$rate','$day','$opentime','$closetime')";
        
        mysqli_query($db,$query);
        header("Location: restaurantmgmt.php");
    }

    if(isset($_GET['rtid'])){
        $id = $_GET['rtid'];
        $query = "DELETE FROM restaurant WHERE restaurant_id = '$id'";
        mysqli_query($db,$query);
        header("Location: restaurantmgmt.php");
    }


    if (isset($_POST['edit-restaurant'])) {
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $foodtype = mysqli_real_escape_string($db, $_POST['type']);
        $location = mysqli_real_escape_string($db, $_POST['location']);
        $content = mysqli_real_escape_string($db, $_POST['content']);
        $image = mysqli_real_escape_string($db, $_POST['image']);
        $image2 = mysqli_real_escape_string($db, $_POST['image2']);
        $image3 = mysqli_real_escape_string($db, $_POST['image3']);
        $rate = mysqli_real_escape_string($db, $_POST['rating']);
        $day = mysqli_real_escape_string($db, $_POST['day']);
        $opentime = mysqli_real_escape_string($db, $_POST['opentime']);
        $closetime = mysqli_real_escape_string($db, $_POST['closetime']);

        $query = "UPDATE restaurant SET 
                restaurant_name = '$name',
                restaurant_phone = '$phone',
                foodtype = '$foodtype',
                restaurant_content = '$content',
                restaurant_location = '$location',
                restaurant_image = '$image',
                restaurant_image2 = '$image2',
                restaurant_image3 = '$image3',
                restaurant_rating = '$rate',
                opening_day = '$day',
                open_hour = '$opentime',
                close_hour = '$closetime' 
                WHERE restaurant_id = '$id'";

            $result = mysqli_query($db, $query);
            if ($result) {
                header("Location: restaurantmgmt.php");
                exit();
            } else {
                die("Error updating restaurant: " . mysqli_error($db));
            }
        }

    // Recipe
    if(isset($_POST['create-recipe'])){
        $name = mysqli_real_escape_string($db,$_POST['name']);
        $category = mysqli_real_escape_string($db,$_POST['category']);
        $foodtype = mysqli_real_escape_string($db,$_POST['foodtype']);
        $image1 = mysqli_real_escape_string($db,$_POST['image1']);
        $image2 = mysqli_real_escape_string($db,$_POST['image2']);
        $image3 = mysqli_real_escape_string($db,$_POST['image3']);
        $content = mysqli_real_escape_string($db,$_POST['content']);
        $prep_time = mysqli_real_escape_string($db,$_POST['preptime']);
        $cook_time = mysqli_real_escape_string($db,$_POST['cooktime']);
        $servings = mysqli_real_escape_string($db,$_POST['servings']);
        $instructions = mysqli_real_escape_string($db,$_POST['instructions']);

        $query = "INSERT INTO recipe(recipe_name,recipe_category,foodtype,image1,image2,image3,recipe_content,prep_time,
                cook_time,servings,instructions)
                VALUES('$name','$category','$foodtype','$image1','$image2','$image3','$content','$prep_time',
                '$cook_time','$servings','$instructions')";
        
        mysqli_query($db,$query);
        header("Location: recipemgmt.php");
    }

    if(isset($_POST['edit-recipe'])){
        $id = mysqli_real_escape_string($db,$_POST['id']);
        $name = mysqli_real_escape_string($db,$_POST['name']);
        $category = mysqli_real_escape_string($db,$_POST['category']);
        $foodtype = mysqli_real_escape_string($db,$_POST['foodtype']);
        $image1 = mysqli_real_escape_string($db,$_POST['image1']);
        $image2 = mysqli_real_escape_string($db,$_POST['image2']);
        $image3 = mysqli_real_escape_string($db,$_POST['image3']);
        $content = mysqli_real_escape_string($db,$_POST['content']);
        $prep_time = mysqli_real_escape_string($db,$_POST['preptime']);
        $cook_time = mysqli_real_escape_string($db,$_POST['cooktime']);
        $servings = mysqli_real_escape_string($db,$_POST['servings']);
        $instructions = mysqli_real_escape_string($db,$_POST['instructions']);
        $instructions = mysqli_real_escape_string($db,$_POST['instructions']);

        $query = "UPDATE recipe SET
                recipe_name = '$name',
                recipe_category = '$category',
                foodtype = '$foodtype',
                image1 = '$image1',
                image2 = '$image2',
                image3 = '$image3',
                recipe_content = '$content',
                prep_time = '$prep_time',
                cook_time = '$cook_time',
                servings = '$servings',
                instructions = '$instructions'
                WHERE recipe_id = '$id' ";
        
        mysqli_query($db,$query);
        header("Location: recipemgmt.php");
    }

    if(isset($_GET['recipeid'])){
        $id = $_GET['recipeid'];
        $query = "DELETE FROM recipe WHERE recipe_id = '$id'";
        mysqli_query($db,$query);
        header("Location: recipemgmt.php");
    }

    // VIew Recipe 
    if(isset($_GET['recipeId'])){
        $recipe_id = $_GET['recipeId'];
        $query = "SELECT * FROM recipe WHERE recipe_id = '$recipe_id'";
        $result = mysqli_query($db, $query);

        if($row = mysqli_fetch_assoc($result)){
            $recipe_name = $row['recipe_name'];
            $category = $row['recipe_category'];
            $foodtype = $row['foodtype'];
            $image1 = $row['image1'];
            $image2 = $row['image2'];
            $image3 = $row['image3'];
            $content =  $row['recipe_content'];
            $prep_time = $row['prep_time'];
            $cook_time = $row['cook_time'];
            $servings = $row['servings'];
            $instructions = $row['instructions'];
        } 
    } 
?>

<!-- User  -->

<?php 
if(isset($_POST['user-register'])){
    $name = mysqli_real_escape_string($db,$_POST['username']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['password'];
    $conpass = $_POST['conpass'];

    $query = "INSERT INTO user(user_name, user_email, user_phone, user_pass, user_conpass)
              VALUES('$name', '$email', '$phone', '$pass', '$conpass')";
    mysqli_query($db, $query);

    $query = "SELECT user_id, user_name FROM user WHERE user_email = '$email' AND user_pass = '$pass'";
    $result = mysqli_query($db, $query);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['user_id'] = $row['user_id']; // Ensure user_id is set
        header("Location: ../../User/php/index.php");
    }
}

if(isset($_POST['user-login'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = "SELECT user_id, user_name FROM user WHERE user_email = '$email' AND user_pass = '$pass'";
    $result = mysqli_query($db, $query);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['user_id'] = $row['user_id']; 
        header("Location: ../../User/php/index.php");
    } else {
        echo "Invalid email or password.";
    }
}

    if(isset($_GET['userid'])){
        $id = $_GET['userid'];
        $query = "DELETE FROM user WHERE user_id = '$id'";
        mysqli_query($db,$query);
        header("Location: usermgmt.php");
    }

    $post_title = "Blog Post Not Found";
    $post_date = date('Y-m-d'); // Default to today's date
    $post_desc = "The blog post you are looking for does not exist.";
    $post_img = ""; // Default to no image
    $post_img2 = ""; // Default to no image
    $detailedPostId = null;
    $comments = [];

    if(isset($_GET['detailpostId'])){
        $post_id = $_GET['detailpostId'];
        $query = "SELECT * FROM blogpost WHERE post_id = '$post_id'";
        $result = mysqli_query($db, $query);
        if($row = mysqli_fetch_assoc($result)){
            $detailedPostId = $row['post_id'];
            $post_title = $row['post_title'];
            $post_category = $row['post_category'];
            $foodtype = $row['foodtype'];
            $post_desc = $row['post_description'];
            $post_img = $row['post_image'];
            $post_img2 = $row['post_image2'];
            $post_date = $row['post_date'];
        } 
    } 

    if(isset($_POST['comment-btn'])){
        $post_id = $_POST['post_id'];
        $comment = $_POST['commenttext'];
        
        $user_id = $_SESSION['user_id'];

        $check_user_query = "SELECT user_id FROM user WHERE user_id = '$user_id'";
        $check_user_result = mysqli_query($db, $check_user_query);
    
        if(mysqli_num_rows($check_user_result) == 0) {
            die("Error: User ID $user_id does not exist in the user table.");
        }
    
        $check_post_query = "SELECT post_id FROM blogpost WHERE post_id = '$post_id'";
        $check_post_result = mysqli_query($db, $check_post_query);
    
        if(mysqli_num_rows($check_post_result) == 0) {
            die("Error: Post ID $post_id does not exist in the blogpost table.");
        }
    
        if(empty($comment)){
            echo "Please fill comment section";
        } else {
            $post_id = mysqli_real_escape_string($db, $post_id);
            $user_id = mysqli_real_escape_string($db, $user_id);
            $comment = mysqli_real_escape_string($db, $comment);
    
            $query = "INSERT INTO comment (post_id, user_id, comment_text) VALUES ('$post_id', '$user_id', '$comment')";
            $result = mysqli_query($db, $query);
            header("Location: ../../User/php/DetailedBlogPost.php?detailpostId=$post_id");
        }
    }

    $comment_query = "SELECT c.comment_id, c.comment_text, c.created_at, u.user_name 
    FROM comment c 
    JOIN user u ON c.user_id = u.user_id 
    WHERE c.post_id = ? 
    ORDER BY c.created_at DESC";
    $stmt = mysqli_prepare($db, $comment_query);
    mysqli_stmt_bind_param($stmt, 'i', $detailedPostId);
    mysqli_stmt_execute($stmt);
    $comment_result = mysqli_stmt_get_result($stmt);
    $comments = mysqli_fetch_all($comment_result, MYSQLI_ASSOC);

    if(isset($_GET['deleteId'])){
        $comment_id = $_GET['deleteId'];
        $deleteComment = "DELETE FROM comment WHERE comment_id = '$comment_id'";
        mysqli_query($db,$deleteComment);
        header("Location: ../../User/php/DetailedBlogPost.php");
    }

?>