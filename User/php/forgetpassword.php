<?php 
    include "../../Admin/php/function.php";
    $forgetpass = "";

    if(isset($_POST['forgetpassbtn'])){
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $passQuery = "SELECT user_pass FROM user WHERE user_email = '$email'";
        $resultquery = mysqli_query($db,$passQuery);
        if($resultquery && mysqli_num_rows($resultquery) > 0){
            $row = mysqli_fetch_assoc($resultquery);
            $forgetpass = $row['user_pass'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-3xl font-bold tracking-tight text-gray-900">Forgot Password</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enter your email address, and we'll send your password.
            </p>
            <p class="mt-2 text-center text-base text-gray-900">
                <?php
                    if(!empty($forgetpass)){
                        echo "Your Password : ". $forgetpass;
                    }
                ?>
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="forgetpassword.php" method="POST">
                <div>
                    <label for="email" class="block text-base font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" name="forgetpassbtn" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send Email</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Remember your password?
                <a href="../php/UserLogin.php" class="font-semibold text-indigo-600 hover:text-indigo-500">Login here</a>
            </p>
        </div>
    </div>
</body>
</html>

