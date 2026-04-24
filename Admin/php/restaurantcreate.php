<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Restaurant Post</title>
    <link rel="stylesheet" href="../css/restaurantcreate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<body>
    <div class="container">
        <h2>Create Restaurant Post</h2>
        <form action="function.php" method="POST">
            <div class="form-group">
                <label for="post-name">Restaurant Name</label>
                <input type="text" id="restaurant-name" placeholder="Enter restaurant name" name="name">
            </div>

            <div class="form-group">
                <label for="phone">Restaurant Phone Number</label>
                <input type="text" id="restaurant-phone" placeholder="Enter restaurant phone" name="phone">
            </div>
           
            <div class="form-group">
                <label for="foodtype">Restaurant Type</label>
                <select id="foodtype" name="foodtype">
                    <option value="">Select food type</option>
                    <option value="Burmese">Burmese</option>
                    <option value="Chinese">Chinese</option>
                    <option value="India">India</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Western">Western</option>
                    <option value="Italian">Italian</option>
                </select>
            </div>
            <div class="form-group">
                <label for="location">Restaurant Location</label>
                <textarea id="location" placeholder="Location..." name="location"></textarea>
            </div>
            <div class="form-group">
                <label for="content">Restaurant Content</label>
                <textarea id="content" placeholder="Restaurant Content..." name="content"></textarea>
            </div>
            <div class="form-group">
                <label for="image-url">Logo Image</label>
                <input type="text" name="image" placeholder="Image Url">
            </div>
            <div class="form-group">
                <label for="image-url">Restaurant Image 1</label>
                <input type="text" name="image2" placeholder="Image Url">
            </div>
            <div class="form-group">
                <label for="image-url">Restaruant Image 2</label>
                <input type="text" name="image3" placeholder="Image Url">
            </div>
            <div class="form-group">
                <label for="rate">Restaurant Rating</label>
                <select id="rate" name="rate">
                    <option value="">Select Rating</option>
                    <option value="1" style="color: gold;">★</option>
                    <option value="2" style="color: gold;">★★</option>
                    <option value="3" style="color: gold;">★★★</option>
                    <option value="4" style="color: gold;">★★★★</option>
                    <option value="5" style="color: gold;">★★★★★</option>
                </select>
            </div>
            <div class="form-group">
                <label for="day">Select Opeing Day</label>
                <select id="day" name="day">
                    <option value="">Select Opeing day</option>
                    <option value="monday to friday">Monday to Friday</option>
                    <option value="sat & sun">Sat & Sun</option>
                    <option value="everyday">Everyday</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hour">Opening Hour</label>
                <input type="time" name="opentime" placeholder="Time">
                <input type="time" name="closetime" placeholder="Time">
            </div>
            <div class="form-group">
                <button type="submit" name="create-restaurant">Create Restaruant</button>
            </div>
        </form>
    </div>
</body>
</html>
