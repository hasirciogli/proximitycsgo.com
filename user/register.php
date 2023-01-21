<?php
include "../backend/load.php";

if (AuthFunction::cfun()->isLogged()) {
    header("Location: https://proximitycsgo.com/user/index.php");
    exit;
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>
<body class="bg-[#141414]">

<?php if(SessionFunctions::checkKey("register-error")) { ?>

    <div class="fixed w-full h-[60px] bg-red-500 flex items-center justify-center text-slate-50">
        <?php echo SessionFunctions::checkKey("register-error"); ?>
    </div>

<?php } ?>

<?php if(SessionFunctions::checkKey("register-success")) {

    header("Refresh: 3, ./login.php");

    ?>

    <div class="fixed w-full h-[60px] bg-green-500 flex items-center justify-center text-slate-50">
        <?php echo SessionFunctions::checkKey("register-success"); ?>
    </div>

<?php } ?>

<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <a href="#" class="flex flex-col items-center mb-6 text-2xl font-semibold text-white">
        <img class="w-[85px] h-[85px] mr-2 mb-3 rounded-full border-2 border-green-700" src="./../assets/proximity-discord-logo.gif" alt="logo">
        Proxmity CS:GO
    </a>
    <div class="w-full rounded-lg md:mt-0 sm:max-w-md xl:p-0 bg-[#282828]" style="box-shadow: 0 0 3px rgb(20, 170, 20);">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl">
                Create and account
            </h1>
            <form class="space-y-4 md:space-y-6" action="https://proximitycsgo.com/backend/if/register.php" method="post">
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-white">Your username</label>
                    <input type="username" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Username | admin..." required="">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white">Your Email address</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@domain.com" required="">
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                </div>
                <div>
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-white">Confirm password</label>
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                </div>
                <!--<div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                    </div>
                </div>-->
                <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                <p class="text-sm font-light text-slate-300">
                    Already have an account? <a href="./login.php" class="font-medium text-white hover:underline">Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>


</body>
</html>









<?php

if(SessionFunctions::checkKey("register-success"))
    SessionFunctions::setKey("register-success", null);

if(SessionFunctions::checkKey("register-error"))
    SessionFunctions::setKey("register-error", null);



 ?>
