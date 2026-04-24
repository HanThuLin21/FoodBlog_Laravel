<?php 
    include "../../Admin/php/function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Blog Post</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/DetailedBlogPost.css?v=<?php echo time() ?>" >
</head>
<body>
    <div class="full-blog-container">
        <h1><?php echo htmlspecialchars($post_title); ?></h1>
        <div class="post-date"><?php echo date('F j, Y', strtotime($post_date)); ?></div>
        <div class="post-content">
          <div class="post-img">
            <img src="<?php echo htmlspecialchars($post_img); ?>" alt="">
            <img src="<?php echo htmlspecialchars($post_img2); ?>" alt="">
          </div>
            <p><?php echo nl2br(htmlspecialchars($post_desc)); ?></p>
        </div>
       <a href="../php/BlogPost.php" class="back-to-home">Back</a>
       <button class="comment-btn" onclick="openPopup(<?php echo $detailedPostId; ?>)" >Comment</button>
       <div class="comment-section">
            <h3>Comments</h3>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <div class="comment-header">
                            <h4><?php echo htmlspecialchars($comment['user_name']); ?></h4>
                            <small><?php echo date('F j, Y', strtotime($comment['created_at'])); ?></small>
                        </div>
                        <div class="comment-delete">
                            <p><?php echo htmlspecialchars($comment['comment_text']); ?></p>
                           <?php 
                            if($comment['user_name'] == $_SESSION['user_name']){
                                ?>
                                <a href="../php/DetailedBlogPost.php?deleteId=<?php echo $comment['comment_id']; ?>" class="deletebtn" >Delete</a>
                            <?php
                            }
                           ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="popup" id="popup">
        <div class="overlay" onclick="closePopup()"></div>
        <div class="popup-content">
            <form action="../../User/php/DetailedBlogPost.php?detailpostId=<?php echo $detailedPostId; ?>" method="POST">
                <h2>Comment Section</h2>
                <input type="hidden" id="post_id" name="post_id" value="<?php echo $detailedPostId; ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">               
                <label for="review">Comment about blog post</label>
                <textarea id="review" name="commenttext"></textarea>
                <div class="controls">
                    <button type="button" class="close-btn" onclick="closePopup()">Close</button>
                    <button type="submit" class="submit-btn" name="comment-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPopup(postId) {
            document.getElementById('post_id').value = postId;
            document.getElementById('popup').classList.add('active');
        }

        function closePopup() {
            document.getElementById('popup').classList.remove('active');
        }
    </script>
</body>
</html>