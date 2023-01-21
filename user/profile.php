<?php
include "./inc/header.php";

$logged_user = AuthFunction::cfun()->getAuthedUser() ?? header("Location: ./exit.php");
$subsManager = SubsManager::cfun()->GetSubsStatus();

?>

<section class="w-[275px] mx-auto bg-[#282828] rounded-2xl px-8 py-6 shadow-lg mt-20" style="box-shadow: 0 0 3px lightgreen;">
    <div class="">
        <p class="text-white font-semibold text-md tracking-wide"><?php echo "Uid: " . $logged_user["id"]; ?></p>
    </div>
    <div class="mt-6 w-fit mx-auto">
        <img src="https://api.lorem.space/image/face?w=120&h=120&hash=bart89fe" class="rounded-full w-28 " alt="profile picture" srcset="">
    </div>

    <div class="mt-8">
        <h2 class="text-white font-bold text-2xl tracking-wide"><?php echo $logged_user["username"]; ?></h2>
    </div>
    <div class="mt-0">
        <h2 class="text-gray-500 font-medium text-sm tracking-wide"><?php echo $logged_user["email"]; ?></h2>
    </div>
    <p class="text-emerald-400 font-semibold mt-10">
        <?php echo $subsManager[0] ? "Active: " . $subsManager[1]. " days" : "Passive"; ?>
    </p>
    <?php if ($subsManager[1]) { ?>

        <p class="text-slate-400 text-sm">
            <?php echo "Subs till: " . $subsManager[2]; ?>
        </p>
    <?php } ?>

    <!--<div class="h-1 w-full bg-black mt-8 rounded-full">
        <div class="h-1 rounded-full w-2/5 bg-yellow-500 "></div>
    </div>
    <div class="mt-3 text-white text-sm">
        <span class="text-gray-400 font-semibold">Storage:</span>
        <span>40%</span>
    </div>-->

</section>


<?php if ($subsManager[1]) { ?>


    <section class="w-[275px] overflow-hidden hover:text-black font-bold mx-auto bg-[#282828] hover:bg-emerald-500 transition-all duration-300 ease-in-out text-white rounded-2xl shadow-lg mt-20" style="box-shadow: 0 0 3px lightgreen;">
        <a href="https://proximitycsgo.com/getinj.php" class="w-full h-full flex items-center justify-center px-8 py-6">DOWNLOAD</a>
    </section>


<?php } ?>



<?php
include "./inc/footer.php";
?>
