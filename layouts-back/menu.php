<?php

include 'topbar.php';

if ($_SESSION['level'] == 1) {
    include 'sidebar_admin.php';
} elseif ($_SESSION['level'] == 2) {
    include 'sidebar_teacher.php';
} elseif ($_SESSION['level'] == 3) {
    include 'sidebar_student.php';
}
