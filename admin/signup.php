<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php
session_start();
header('location:../auth-signup.php?from=adminup');
$_SESSION['noToken'] = 5555;
