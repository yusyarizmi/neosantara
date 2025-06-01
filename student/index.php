<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php include '../layouts-back/session.php'; ?>
<?php include '../layouts-back/head-main.php'; ?>

<?php
include '../action/config.php';
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

$timeIn = "Not Yet";
$timeOut = "Not Yet";
$statusIn = "";
$statusOut = "";
$infoIn = "";
$infoOut = "";
$date = date('Y-m-d');
$date = date('Y-m-d');
$currentTime = date('H:i');
$username = $_SESSION['txtUsername'];

if ($currentTime >= '05:00' && $currentTime < '10:00') {
    $timeOfDay = 'Morning';
} elseif ($currentTime >= '10:00' && $currentTime < '15:00') {
    $timeOfDay = 'Afternoon';
} elseif ($currentTime >= '15:00' && $currentTime < '18:00') {
    $timeOfDay = 'Evening';
} else {
    $timeOfDay = 'Night';
}

$pkstu = "SELECT * FROM _student WHERE _user='$username'";
$res_stu = query($pkstu);
$row_till = mysqli_fetch_array($res_stu);
$row_stu = $row_till['pkstudent'];

$stu_structure = $row_till['_structure'];

$pkcls = $row_till['_pkcls'];

$stu_cls = "SELECT COUNT(*) FROM _student WHERE _pkcls = $pkcls";
$res_sc = query($stu_cls);
$row_sc = mysqli_fetch_row($res_sc);
$total_sc = $row_sc[0];

$sql = "SELECT * FROM _absent WHERE _pkstu = '$row_stu' and _date = '$date'";
$res = query($sql);
$row = mysqli_fetch_array($res);

if (mysqli_num_rows($res) > 0) {

    if ($row['_timeIn']) {
        $timeIn = $row['_timeIn'];
        $infoIn = $row['_infoIn'];
        if ($infoIn == 'M') {
            $statusIn = 'Entry';
        } elseif ($infoIn == 'B') {
            $statusIn = 'To Late';
        } elseif ($infoIn == 'C') {
            $statusIn = 'False Time';
        } elseif ($infoIn == 'F') {
            $statusIn = 'Stupid Time';
        } elseif ($infoIn == 'S') {
            $statusIn = 'Sakit';
        } elseif ($infoIn == 'I') {
            $statusIn = 'Izin';
        } elseif ($infoIn == 'P') {
            $statusIn = 'Pergi';
        }
    } else {
        $timeIn = "Not Yet";
    }

    if ($row['_timeOut']) {
        $timeOut = $row['_timeOut'];
        $infoOut = $row['_infoOut'];
        if ($infoOut == 'M') {
            $statusOut = 'Normal';
        } elseif ($infoOut == 'C') {
            $statusOut = 'False Time';
        } elseif ($infoOut == 'B') {
            $statusOut = 'To Late';
        } elseif ($infoOut == 'F') {
            $statusOut = 'Stupid Time';
        } elseif ($infoOut == 'S') {
            $statusOut = 'Sakit';
        } elseif ($infoOut == 'I') {
            $statusOut = 'Izin';
        } elseif ($infoOut == 'P') {
            $statusOut = 'Pergi';
        }
    } else {
        $timeOut = "Not Yet";
    }
}

$entryStu = "SELECT COUNT(*) FROM _absent WHERE _pkcls = $pkcls and _date = '$date' and _infoIn NOT IN ('P','S','I');";
$res_entryStu = query($entryStu);
$row_entryStu = mysqli_fetch_row($res_entryStu);
$total_stu = $row_entryStu[0];

$_SESSION['noClass'] = $pkcls;
$_SESSION['noStudent'] = $row_stu;
$_SESSION['txtStructure'] = $stu_structure;
// $_SESSION['reason']
?>

<head>

    <title>Home | Neosantara</title>
    <link href="../assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <link rel="icon" href="../assets/images/meme/favicon.ico">
    <?php include '../layouts-back/title-meta.php'; ?>
    <?php include '../layouts-back/head-css.php'; ?>

</head>

<!--  -->
<?php include '../layouts-back/body.php'; ?>
<!--  -->

<div id="layout-wrapper">
    <?php include '../layouts-back/menu.php'; ?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Home</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Home</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 style="text-transform:capitalize;" class="fs-16 mb-1"><?php echo "Good $timeOfDay, ";
                                                                                                        echo $_SESSION['txtUsername']; ?>!</h4>
                                            <p class="text-muted mb-0">Here's what's happening with your class today.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            absent in</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <?php
                                        if ($statusIn == "") {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            Nothing Info
                                            ';
                                        }
                                        if ($infoIn == 'M') {
                                            echo
                                            '
                                            <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusIn;
                                        }
                                        if ($infoIn == 'B') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusIn;
                                        }
                                        if ($infoIn == 'C') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusIn;
                                        }
                                        if ($infoIn == 'F') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusIn;
                                        }
                                        if ($infoIn == 'S') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusIn;
                                        }
                                        if ($infoIn == 'I') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusIn;
                                        }
                                        if ($infoIn == 'P') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusIn;
                                        }
                                        ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><?php echo $timeIn ?></h4>
                                        <?php
                                        if ($timeIn == "Not Yet") {
                                            echo
                                            '<a class="text-decoration-underline hand-cursor" id="sa-permission-in">Permission Here</a>';
                                        } else {
                                            echo
                                            '<a href="../sekertaris-absent-detail.php?pk=' . $row['pkabsent'] . '" class="text-decoration-underline">See detail</a>';
                                        }
                                        ?>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success rounded fs-3">
                                            <i class="mdi mdi-exit-run"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">absent out</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <?php
                                        if ($statusOut == "") {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            Nothing Info
                                            ';
                                        }
                                        if ($infoOut == 'M') {
                                            echo
                                            '
                                            <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusOut;
                                        }
                                        if ($infoOut == 'B') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusOut;
                                        }
                                        if ($infoOut == 'C') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusOut;
                                        }
                                        if ($infoOut == 'F') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusOut;
                                        }
                                        if ($infoOut == 'S') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusOut;
                                        }
                                        if ($infoOut == 'I') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusOut;
                                        }
                                        if ($infoOut == 'P') {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            ';
                                            echo $statusOut;
                                        }
                                        ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><?php echo $timeOut ?></h4>
                                        <?php
                                        if ($timeOut == "Not Yet") {
                                            echo
                                            '<a class="text-decoration-underline hand-cursor" id="sa-permission-out">Permission Here</a>';
                                        } else {
                                            echo
                                            '<a href="../sekertaris-absent-detail.php?pk=' . $row['pkabsent'] . '" class="text-decoration-underline">See detail</a>';
                                        }
                                        ?>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info rounded fs-3">
                                            <i class="mdi mdi-exit-run mirrored-logo"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            students entered</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <?php
                                        $ntentry = $total_sc - $total_stu;

                                        if ($total_stu < $total_sc) {
                                            echo
                                            '
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                             -' . $ntentry . ' not entered
                                            ';
                                        } elseif ($total_stu == $total_sc) {
                                            echo
                                            '
                                            <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            Entry All
                                            ';
                                        }
                                        ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><?php echo $total_stu ?> entered</h4>
                                        <a href="../sekertaris-absent.php" class="text-decoration-underline">See details</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning rounded fs-3">
                                            <i class="mdi mdi-account-group"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Our Balance</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            Debit
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">100,000.00</h4>
                                        <a href="" class="text-decoration-underline">Cashbook</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-danger rounded fs-3">
                                            <i class="bx bx-wallet"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->
            <?php include '../layouts-back/footer.php'; ?>
            <!--  -->

        </div>
    </div>

    <style>
        .mirrored-logo {
            transform: scaleX(-1);
        }
    </style>

    <?php include '../layouts-back/vendor-scripts.php'; ?>

    <script>
        //Permission in
        if (document.getElementById("sa-permission-in"))
            document.getElementById("sa-permission-in").addEventListener("click", function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be permitted and not entered!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, permission!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                    buttonsStyling: false,
                    showCloseButton: true
                }).then(function(result) {
                    if (result.value) {
                        window.location.href = "absent.php?from=in";
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'Please Absent on your existing device :)',
                            icon: 'error',
                            confirmButtonClass: 'btn btn-primary mt-2',
                            buttonsStyling: false
                        })
                    }
                });
            });

        //Permission out
        if (document.getElementById("sa-permission-out"))
            document.getElementById("sa-permission-out").addEventListener("click", function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be permitted for go home!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, permission!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                    buttonsStyling: false,
                    showCloseButton: true
                }).then(function(result) {
                    if (result.value) {
                        window.location.href = "absent.php?from=out";
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'Please Absent on your existing device :)',
                            icon: 'error',
                            confirmButtonClass: 'btn btn-primary mt-2',
                            buttonsStyling: false
                        })
                    }
                });
            });

        // Absent Rejected
        if (localStorage.getItem('modal') === 'absent_rejected') {
            window.addEventListener('DOMContentLoaded', (event) => {
                var timerInterval;
                Swal.fire({
                    title: 'Cancelled',
                    text: 'Maybe You have been absent :)',
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true,
                    confirmButtonClass: 'btn btn-primary mt-2',
                    buttonsStyling: false
                });
            });
            localStorage.removeItem('modal')
        }

        // Absent Rejected
        if (localStorage.getItem('modal') === 'absent_fail') {
            window.addEventListener('DOMContentLoaded', (event) => {
                var timerInterval;
                Swal.fire({
                    title: 'Failed',
                    text: 'You did not fill the absent :)',
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true,
                    confirmButtonClass: 'btn btn-primary mt-2',
                    buttonsStyling: false
                });
            });
            localStorage.removeItem('modal')
        }

        // Absent Success
        if (localStorage.getItem('modal') === 'absent_success') {
            window.addEventListener('DOMContentLoaded', (event) => {
                var timerInterval;
                Swal.fire({
                    title: 'Good job!',
                    text: 'You have added permission!',
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                    buttonsStyling: false,
                    showCloseButton: true
                })
            });
            localStorage.removeItem('modal')
        }

        // Login Success
        if (localStorage.getItem('modal') === 'login_success') {
            window.addEventListener('DOMContentLoaded', (event) => {
                var timerInterval;
                Swal.fire({
                    title: 'Well Done!',
                    text: 'You logged in!',
                    icon: 'success',
                    timer: 2000,
                    timerProgressBar: true,
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                    buttonsStyling: false,
                    showCloseButton: true
                })
            });
            localStorage.removeItem('modal')
        }
    </script>

    <style>
        .hand-cursor {
            cursor: pointer;
        }
    </style>

    <!--Swiper slider js-->
    <script src="../assets/libs/swiper/swiper-bundle.min.js"></script>
    <!-- Dashboard init -->
    <script src="../assets/js/pages/dashboard-ecommerce.init.js"></script>
    <!-- App js -->
    <script src="../assets/js/app.js"></script>
    <!-- Sweet Alerts js -->
    <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Sweet alert init js-->
    <script src="../assets/js/pages/sweetalerts.init.js"></script>
    </body>

    </html>