<?php include '../layouts-back/session.php'; ?>
<?php include '../layouts-back/head-main.php'; ?>

<?php
include '../action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

date_default_timezone_set('Asia/Jakarta');

$currentTime = date('H:i');

if ($currentTime >= '05:00' && $currentTime < '10:00') {
    $timeOfDay = 'Pagi';
} elseif ($currentTime >= '10:00' && $currentTime < '15:00') {
    $timeOfDay = 'Siang';
} elseif ($currentTime >= '15:00' && $currentTime < '18:00') {
    $timeOfDay = 'Sore';
} else {
    $timeOfDay = 'Malam';
}
?>

<head>

    <title>Home | Neosantara</title>
    <link href="../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../assets/images/meme/favicon.ico">
    <?php include '../layouts-back/title-meta.php'; ?>
    <?php include '../layouts-back/head-css.php'; ?>

</head>

<?php include '../layouts-back/body.php'; ?>

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
                                            <h4 style="text-transform:capitalize;" class="fs-16 mb-1"><?php echo "Selamat $timeOfDay, ";
                                                                                                        echo $_SESSION['txtUsername']; ?></h4>
                                            <p class="text-muted mb-0">Ini yang terjadi pada kelasmu hari ini.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include '../layouts-back/footer.php'; ?>

        </div>
    </div>

    <?php include '../layouts-back/vendor-scripts.php'; ?>
    <!-- apexcharts -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <!--Swiper slider js-->
    <script src="../assets/libs/swiper/swiper-bundle.min.js"></script>
    <!-- Dashboard init -->
    <script src="../assets/js/pages/dashboard-ecommerce.init.js"></script>
    <!-- App js -->
    <script src="../assets/js/app.js"></script>
    </body>

    </html>