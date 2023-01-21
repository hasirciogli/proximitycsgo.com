<?php

//$_SERVER["REMOTE_ADDR"] != "78.189.149.69" ? die("Yakında geliyoruz...") : 0;


include $_SERVER["DOCUMENT_ROOT"] . "/backend/load.php";

if(!AuthFunction::cfun()->isLogged())
{
    header("Location: ./login.php");
    exit;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proximiy CS:GO - Plugin of CS:GO</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body class="bg-[#141414]">

<div class="container h-[60px] bg-[#282828] mx-auto shadow-lg rounded mt-10 text-slate-50 flex flex-row overflow-hidden border-b border-[#28a028]">
    <a href="./index.php" class="flex h-full w-[200px] min-w-[200px] items-center justify-center font-bold shadow-xl font-mono text-xl hover:cursor-pointer hover:text-white hover:bg-[#28a028] transition-all duration-200 ease-in-out">
        Proximity <span class="pl-1 text-[#28a028]">CS:GO</span>
    </a>

    <div class="flex w-full items-center justify-end h-full font-semibold tracking-wide">
        <a href="./subs.php" class="flex w-[150px] h-full items-center justify-center hover:cursor-pointer hover:bg-[#28a028] transition-all duration-200 ease-in-out">Subs</a>
        <!--<a href="./configs.php" class="flex w-[150px] h-full items-center justify-center hover:cursor-pointer hover:bg-[#28a028] transition-all duration-200 ease-in-out">Configs</a>-->
        <a href="./profile.php" class="flex w-[150px] h-full items-center justify-center hover:cursor-pointer hover:bg-[#28a028] transition-all duration-200 ease-in-out">Profile</a>
        <a href="https://proximitycsgo.com/user/exit.php" class="flex w-[60px] h-full items-center justify-center hover:cursor-pointer hover:bg-[#28a028] transition-all duration-200 ease-in-out"><span class="material-symbols-outlined">logout</span></a>
    </div>
</div>

<?php

if (AuthFunction::cfun()->isBanned())
{ ?>


    <div class="container mx-auto flex mt-10 items-center justify-center bg-red-600 h-[60px] rounded-md text-white font-bold">
        <?php echo AuthFunction::cfun()->getAuthedUser()["username"]. ", "; ?> You are banned from this application... | Reason is: <?php echo AuthFunction::cfun()->getAuthedUser()["status_content"]; ?>
    </div>


<?php

    exit;
}

?>