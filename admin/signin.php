<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php
session_start();
header('location:../auth-signin.php?from=adminin');
$_SESSION['noToken'] = 5555;
