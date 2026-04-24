<?php 
    include "../../Admin/php/function.php";

    if (isset($_POST['submitRating'])) {
        $post_id = $_POST['post_id'];
        $rating = $_POST['rating'];
        $user_id = $_SESSION['user_id'];
    
        // Validate input
        if (empty($rating)) {
            echo "<script>alert('Please select a rating.'); window.history.back();</script>";
            exit();
        }
    
        // Check if the user has already rated this post
        $check_query = "SELECT * FROM ratings WHERE post_id = '$post_id' AND user_id = '$user_id'";
        $check_result = mysqli_query($db, $check_query);
    
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('You have already rated this post.'); window.history.back();</script>";
            exit();
        }
    
        // Insert the rating into the database
        $query = "INSERT INTO ratings (post_id, user_id, rating) VALUES ('$post_id', '$user_id', '$rating')";
        $result = mysqli_query($db, $query);
    
        if ($result) {
            echo "<script>alert('Thank you for rating!'); window.location.href='../php/BlogPost.php';</script>";
        } else {
            echo "<script>alert('Error submitting rating.'); window.history.back();</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/BlogPost.css?v=<?php echo time(); ?>">
    <title>Food Blog Collection</title>
    <script>
        function searchBlogs() {
            let input = document.getElementById('search').value.toLowerCase();
            let blogs = document.getElementsByClassName('blog-card');
            for (let blog of blogs) {
                let title = blog.getElementsByClassName('blog-title')[0].innerText.toLowerCase();
                let content = blog.getElementsByTagName('p')[0].innerText.toLowerCase();
                blog.style.display = (title.includes(input) || content.includes(input)) ? 'block' : 'none';
            }
        }
        function openModal(postId) {
            document.getElementById("post_id").value = postId;
            document.getElementById("ratingModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("ratingModal").style.display = "none";
        }

        function openPopup(postId) {
        document.getElementById("post_id").value = postId;
        document.getElementById("ratingModal").style.display = "block";
    }

        function closePopup() {
            document.getElementById("ratingModal").style.display = "none";
        }

        // Close modal if user clicks outside the modal
        window.onclick = function(event) {
            let modal = document.getElementById("ratingModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</head>
<body>
<header>
        <div class="container">
            <h1 class="logo">Delicious Bites</h1>
            <nav>
                <ul class="nav-list">
                    <li><a href="../php/index.php">Home</a></li>
                    <li><a href="../php/BlogPost.php">Blogs</a></li>
                    <li><a href="../php/Recipe.php">Recipes</a></li>
                    <li><a href="../php/Restaurant.php">Restaurant</a></li>
                    <li><a href="../php/About.php">About</a></li>
                    <?php if(isset($_SESSION['user_name'])) { ?>
                        <li class="dropdown">
                            <div class="user_account">
                                <i class="fa-solid fa-user" style="font-size: 20px;"></i> <?php echo $_SESSION['user_name']; ?>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="../php/UserRegister.php">New Account</a></li>
                                <li><a href="../php/UserLogin.php">Log In</a></li>
                                <li><a href="../php/Logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="dropdown">
                            <a href="#" class="btn-signup">Account <i class="fa-solid fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="../php/UserLogin.php">Log in</a></li>
                                <li><a href="../php/UserRegister.php">Register</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </header>

<main>
    <h1 class="page-title">Food Blog Collection</h1>
    <div class="search-container">
        <input type="text" id="search" class="search-bar" placeholder="Search blogs..." onkeyup="searchBlogs()">
    </div>
    
    <div class="blog-container">
        <?php 
            $query = "SELECT * FROM blogpost";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $post_id = $row['post_id'];
        ?>
        <!-- Blog Card -->
        <div class="blog-card">
            <img src="<?php echo $row['post_image']; ?>" alt="Blog Image" class="blog-image">
            <div class="blog-content">
                <h2 class="blog-title"><?php echo $row['post_title']; ?></h2>
                <p class="blog-date">Published on: <?php echo date('F j, Y', strtotime($row['post_date'])); ?></p>
                <p><?php echo substr($row['post_description'],0,150); ?>...</p>
                <div class="buttons">
                    <a href="../php/DetailedBlogPost.php?detailpostId=<?php echo $row['post_id']; ?>" class="view-button">Read More</a>
                    <button type="button" class="review-button" onclick="openPopup(<?php echo $post_id; ?>)">Rate</button>
                </div>
            </div>
        </div>
        <?php 
                }
            }
        ?>
            <!-- Star Rating Modal -->
    <div id="ratingModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Rate This Blog</h2>
            <form action="../php/BlogPost.php" method="POST">
                <input type="hidden" id="post_id" name="post_id">
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5" title="5 stars">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4" title="4 stars">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3" title="3 stars">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2" title="2 stars">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1" title="1 star">&#9733;</label>
                </div>
                <button type="submit" name="submitRating" class="submit-btn">Submit Rating</button>
            </form>
        </div>
    </div>
    </div>
</main>
<footer>
    <section class="subscribe">
        <h2>Subscribe for Weekly Recipes!</h2>
        <form action="#" method="post">
            <input type="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
        </form>
    </section>
    <div class="social-media">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
    </div>
        <p>&copy; 2025 Delicious Bites | All Rights Reserved</p>
    </footer>
</body>
</html>