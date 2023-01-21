<?php
include "../backend/load.php";

if (!SessionFunctions::checkSession())
    header("Location: ./login.php");

SessionFunctions::destroy();