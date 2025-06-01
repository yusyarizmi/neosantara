<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php include '../layouts-back/session.php'; ?>
<?php include '../layouts-back/head-main.php'; ?>

<?php
include '../action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

$random_number = random_int(1000, 9999);

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

$sqlCont_t = "SELECT COUNT(*) FROM _teacher";
$resCont_t = query($sqlCont_t);
$rowCont_t = mysqli_fetch_array($resCont_t);
$total_t = $rowCont_t[0];

$sqlCont_s = "SELECT COUNT(*) FROM _student";
$resCont_s = query($sqlCont_s);
$rowCont_s = mysqli_fetch_array($resCont_s);
$total_s = $rowCont_s[0];
?>

<head>

    <title>Home | Neosantara</title>
    <link href="../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../assets/images/meme/favicon.ico">
    <?php include '../layouts-back/title-meta.php'; ?>
    <?php include '../layouts-back/head-css.php'; ?>
    <style>
        .loading {
            cursor: not-allowed;
            opacity: 0.7;
        }
    </style>

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
                                            <p class="text-muted mb-0">Ini yang terjadi pada sekolahmu hari ini.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6 form-container">
                        <div class="card card-bg-fill">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Teacher Token</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h3 class="fs-25 fw-semibold ff-secondary mb-4" id="token_t"></h3>
                                        <input type="hidden" id="token_t_input" value="<?php echo $random_number; ?>">
                                        <a href="" class="text-decoration-underline">See details</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <button type="button" id="updateButtonT" onclick="updateTokenT('token_t_input', 'token_t', 'updateButtonT')" class="avatar-title bg-soft-primary rounded fs-3">
                                            <i class="mdi mdi-restore text-primary"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 form-container">
                        <div class="card card-bg-fill">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Student Token</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h3 class="fs-25 fw-semibold ff-secondary mb-4" id="token_s"></h3>
                                        <input type="hidden" id="token_s_input" value="<?php echo $random_number; ?>">
                                        <a href="" class="text-decoration-underline">See details</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <button type="button" id="updateButtonS" onclick="updateTokenS('token_s_input', 'token_s', 'updateButtonS')" class="avatar-title bg-soft-primary rounded fs-3">
                                            <i class="mdi mdi-restore text-primary"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-bg-fill">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="text-uppercase fw-medium text-muted mb-0">Total Guru</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><?php echo $total_t; ?> Guru</h4>
                                        <a href="" class="text-decoration-underline">Lihat Guru</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-warning rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-bg-fill">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="text-uppercase fw-medium text-muted mb-0">Total Siswa</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><?php echo $total_s; ?> Siswa</h4>
                                        <a href="" class="text-decoration-underline">Lihat Siswa</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-warning rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                </div>
            </div>

            <?php include '../layouts-back/footer.php'; ?>

        </div>
    </div>

    <style>
        .form-container {
            display: inline-block;
        }
    </style>

    <script>
        function showLoading(elementId) {
            var loadingElement = document.getElementById(elementId);
            loadingElement.innerHTML = "Loading...";
        }

        function hideLoading(elementId) {
            var loadingElement = document.getElementById(elementId);
            loadingElement.innerHTML = "";
        }

        function fetchData(tableNumber, elementId) {
            showLoading(elementId);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    hideLoading(elementId)
                    var tokens = JSON.parse(this.responseText);

                    var tokenList = document.getElementById(elementId);
                    tokens.forEach(function(token) {
                        var listItem = document.createElement("p");
                        listItem.textContent = token;
                        tokenList.appendChild(listItem);
                    });
                }
            };

            xhttp.open("GET", "../action/token_data.php?table=" + tableNumber, true);
            xhttp.send();
        }

        function updateTokenS(inputId, displayId, buttonId) {
            var tokenInput = document.getElementById(inputId).value;
            var tokenDisplay = document.getElementById(displayId);
            var updateButton = document.getElementById(buttonId);

            updateButton.disabled = true;
            updateButton.classList.add('loading');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);

                    updateButton.classList.remove('loading');
                    updateButton.disabled = false;

                    if (response.status === "Success") {
                        // tokenDisplay.textContent = tokenInput;
                        fetchData(1, "token_s");
                    } else {
                        alert("Failed to update token. Error: " + response.message);
                    }
                }
            };

            xhttp.open("POST", "../action/token_update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("token_s=" + tokenInput);
        }

        function updateTokenT(inputId, displayId, buttonId) {
            var tokenInput = document.getElementById(inputId).value;
            var tokenDisplay = document.getElementById(displayId);
            var updateButton = document.getElementById(buttonId);

            updateButton.disabled = true;
            updateButton.classList.add('loading');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);

                    updateButton.classList.remove('loading');
                    updateButton.disabled = false;

                    if (response.status === "Success") {
                        // tokenDisplay.textContent = tokenInput;
                        fetchData(2, "token_t");
                    } else {
                        alert("Failed to update token. Error: " + response.message);
                    }
                }
            };

            xhttp.open("POST", "../action/token_update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("token_t=" + tokenInput);
        }

        fetchData(1, "token_s");
        fetchData(2, "token_t");
    </script>

    <?php include '../layouts-back/vendor-scripts.php'; ?>
    <!-- apexcharts -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <!--Swiper slider js-->
    <script src="../assets/libs/swiper/swiper-bundle.min.js"></script>
    <!-- Dashboard init -->
    <script src="../assets/js/pages/dashboard-ecommerce.init.js"></script>
    <!-- App js -->
    <script src="../assets/js/app.js"></script>
    </body>

    </html>