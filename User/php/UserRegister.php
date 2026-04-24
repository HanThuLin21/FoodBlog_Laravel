<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-10 text-center text-3xl font-bold tracking-tight text-gray-900">Register for user account</h2>
    </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="../../Admin/php/function.php" method="POST">
    <div>
        <label for="username" class="block text-base font-medium text-gray-900">User Name</label>
        <div class="mt-2">
          <input type="text" name="username" id="username" autocomplete="username" required class="block w-full rounded-md bg-white px-3 py-1.5 text-lg text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-base">
        </div>
      </div>
        
      <div>
        <label for="email" class="block text-base font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-lg text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-base">
        </div>
      </div>
      <div>
        <label for="email" class="block text-base font-medium text-gray-900">Phone Number</label>
        <div class="mt-2">
          <input type="text" name="phone" id="phone" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-lg text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-base">
        </div>
      </div>
      <div>
        <label for="password" class="block text-base font-medium text-gray-900">Password</label>
        <div class="mt-2">
          <input type="password" name="password" id="password" autocomplete="password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-lg text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-base">
        </div>
      </div>
      
      <div>
        <div class="flex items-center justify-between">
          <label for="conpass" class="block text-base font-medium text-gray-900">Confirm Password</label>
        </div>
        <div class="mt-2">
          <input type="password" name="conpass" id="conpass" autocomplete="conpass" required class="block w-full rounded-md bg-white px-3 py-1.5 text-lg text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-base">
        </div>
      </div>

      <div>
        <button type="submit" name="user-register" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-base font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
      </div>
    </form>

    <p class="mt-10 text-center text-base text-gray-500">
      Your have account?
      <a href="../php/UserLogin.php" class="font-semibold text-indigo-600 hover:text-indigo-500">Login Here</a>
    </p>
  </div>
</div>
</body>
</html>