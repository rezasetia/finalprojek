<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="./output.css" rel="stylesheet">
</head>



<body>
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md p-6 bg-white rounded-md shadow-md" style="margin-top: -100px;">
            <h2 class="text-2xl font-bold mb-4 text-center">REGISTER</h2>
          
            <form action="fungsiRegister.php" method="POST">
                <div class="mb-4 relative">
                    <label for="username" class="block mb-1"></label>
                    <input type="text" id="username" name="username" required placeholder="UserName" class="w-full px-3 py-2 border rounded-md">
                    <img src="./asset/Vector (1).png" class="absolute right-3 top-2 h-6 " width="20 " height="10">
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-1"></label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required placeholder="Password" class="w-full px-3 py-2 border rounded-md pr-10">
                        <img src="./asset/Union.png" class="absolute right-3 top-2 h-6 cursor-pointer" onclick="togglePasswordVisibility()" width="20 " height="10">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block mb-1"></label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class="mb-6">
                    <label for="address" class="block mb-1"></label>
                    <input type="text" id="address" name="address" placeholder="Address" class="w-full px-3 py-2 border rounded-md">
                </div>
                <div class=" justify-between">
                    <p>Already Have an Account ? </p>
                    <p class="text-bluetua mb-4"><a href="login.php" class="text-bluetua hover:underline">Login</a></p>
                </div>

                <div class="flex justify-center">
                    <input type="submit" value="Daftar" class="w-2/4 bg-customBlue text-white px-8 py-3 rounded-md hover:bg-customHoverBlue cursor-pointer">
                </div>

            </form>
        </div>
    </div>


</body>



</html>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>