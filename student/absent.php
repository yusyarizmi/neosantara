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

$in = isset($_GET['from']) && $_GET['from'] === 'in';
$out = isset($_GET['from']) && $_GET['from'] === 'out';

$cls = $_SESSION['pkCls'];

$cls_name = "SELECT cls_name FROM _class WHERE pkcls=$cls";
$res_cls_name = query($cls_name);
$row_cls_name = mysqli_fetch_array($res_cls_name)['cls_name'];

$username = $_SESSION['txtUsername'];

$pkstu = "SELECT pkstudent FROM _student WHERE _user='$username'";
$res_stu = query($pkstu);
$row_stu = mysqli_fetch_array($res_stu)['pkstudent'];

$pkcls = "SELECT _pkcls FROM _student WHERE pkstudent=$row_stu";
$res_cls = query($pkcls);
$row_cls = mysqli_fetch_array($res_cls)['_pkcls'];

$date_now = date('Y-m-d');

if ($in) {
    $absent = "SELECT COUNT(_infoIn) FROM _absent WHERE _pkstu=$row_stu AND _date='$date_now'";
    $res_absent = query($absent);
    $row_absent = mysqli_fetch_row($res_absent);
    $total_absent = $row_absent[0];
} elseif ($out) {
    $absent = "SELECT COUNT(_infoOut) FROM _absent WHERE _pkstu=$row_stu AND _date='$date_now'";
    $res_absent = query($absent);
    $row_absent = mysqli_fetch_row($res_absent);
    $total_absent = $row_absent[0];
} else {
    echo "<script>localStorage.setItem('modal', 'absent_rejected');window.location.href = 'index.php';</script>";
}

if ($total_absent == 1) {
    echo "<script>localStorage.setItem('modal', 'absent_rejected');window.location.href = 'index.php';</script>";
} else {
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $query = "";
    $infoIn = $success_in = "";
    $infoOut = $success_out = "";
    $date = date('Y-m-d');
    $time = date('H:i');
    $timeIn = date("H:i:s");
    $timeOut = date("H:i:s");
    $reason = $_POST["reason"];
    $img = $_POST["img"];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $_SESSION['reason'] = $reason;

    if ($reason == 'Izin') {
        $infoIn = 'I';
        $infoOut = 'I';
    } elseif ($reason == 'Sakit') {
        $infoIn = 'S';
        $infoOut = 'S';
    } elseif ($reason == 'Pergi') {
        $infoIn = 'P';
        $infoOut = 'P';
    }

    if ($latitude && $longitude) {
        if ($infoIn != "") {
            if ($in) {
                $path_in = '../assets/absent/img_in/' . 'absent_' . $_SESSION['txtUsername'] . '_' . time() . '.png';
                $success_in = file_put_contents($path_in, base64_decode(str_replace('data:image/png;base64,', '', $img)));
            }
        }
        if ($infoOut != "") {
            if ($out) {
                $path_out = '../assets/absent/img_out/' . 'absent_' . $_SESSION['txtUsername'] . '_' . time() . '.png';
                $success_out = file_put_contents($path_out, base64_decode(str_replace('data:image/png;base64,', '', $img)));
            }
        }
    }

    if ($infoIn != "") {
        if ($in) {
            if ($success_in) {
                $sql = "INSERT INTO _absent(_pkstu, _pkcls, _date, _infoIn , _timeIn, _latitude, _longitude, _imgIn)VALUES($row_stu, $row_cls, '$date', '$infoIn', '$timeIn', $latitude, $longitude, '$path_in')";
                $query = query($sql);
            }
        }
    }
    if ($infoOut != "") {
        if ($out) {
            if ($success_out) {
                $sql = "UPDATE _absent SET _infoOut='$infoOut', _timeOut='$timeOut', _imgOut='$path_out' WHERE _pkstu = $row_stu and _date = '$date'";
                $query = query($sql);
            }
        }
    }

    // file_put_contents('sql.txt', $sql);

    if ($query != "") {
        echo "<script>localStorage.setItem('modal', 'absent_success');window.location.href = 'index.php';</script>";
    } else {
        echo "<script>localStorage.setItem('modal', 'absent_fail');window.location.href = 'index.php';</script>";
    }
}
?>

<head>

    <?php
    if (isset($_GET['from']) && $_GET['from'] === 'in') {
        echo "<title>Absent In | Neosantara</title>";
    } elseif (isset($_GET['from']) && $_GET['from'] === 'out') {
        echo "<title>Absent Out | Neosantara</title>";
    }
    ?>

    <?php include '../layouts-back/title-meta.php'; ?>
    <?php include '../layouts-back/head-css.php'; ?>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <link rel="icon" href="../assets/images/meme/favicon.ico">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="../assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

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
                            <h4 class="mb-sm-0">Absent</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Absent</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xxl-5">
                        <div class="d-flex flex-column h-100">
                            <div class="row h-100">
                                <div class="col-12">
                                    <div class="card ">
                                        <div class="card-body p-0">
                                            <div class="alert alert-primary border-0 rounded-0 rounded-top m-0 d-flex align-items-center" role="alert">
                                                <i data-feather="alert-triangle" class="text-primary me-2 icon-sm"></i>
                                                <div class="flex-grow-1 text-truncate">
                                                    let's, <b>set</b> your status.
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <a href="pages-pricing.php" class="text-reset text-decoration-underline"><b>Contact</b></a>
                                                </div>
                                            </div>

                                            <div class="row align-items-end">
                                                <div class="col-sm-8">
                                                    <div class="p-3">
                                                        <p class="fs-16 lh-base">If you not entry to school or <span class="fw-semibold">sick</span>, you in right place
                                                            <i class="mdi mdi-arrow-right"></i>
                                                        </p>
                                                        <div class="mt-3">
                                                            <a href="pages-pricing.php" class="btn btn-primary">Permission</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="notAccepted" aria-hidden="true" aria-labelledby="..." tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center p-5">
                                            <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f7b84b,secondary:#405189" style="width:130px;height:130px">
                                            </lord-icon>
                                            <div class="mt-4 pt-4">
                                                <h4>Uh oh, something went wrong!</h4>
                                                <p class="text-muted"> You not accepted edit this form.</p>
                                                <!-- Toogle to second dialog -->
                                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Back</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reasonModalLabel">Reason</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="reason" class="col-form-label">Reason:</label>
                                                    <select class="form-select mb-3" aria-label="Default reason" id="selectReason">
                                                    </select>
                                                </div>
                                                <!-- <div class="mb-3">
                                                    <label for="reason-detail" class="col-form-label">Reason detail:</label>
                                                    <textarea class="form-control" id="reason-detail" rows="4"></textarea>
                                                </div> -->
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Back</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveReason()">Save reason</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Date</p>
                                                    <h2 class="mt-4 ff-secondary fw-semibold"><?php echo date("Y/m/d") ?></h2>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#notAccepted" class="text-decoration-underline">Edit</a>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                            <i class="text-primary ri-calendar-2-line"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Time</p>
                                                    <h2 class="mt-4 ff-secondary fw-semibold"><span id="current-time"><?php echo date("H:i:s"); ?></span></h2>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#notAccepted" class="text-decoration-underline">Edit</a>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                            <i data-feather="clock" class="text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Reason</p>
                                                    <h2 class="mt-4 ff-secondary fw-semibold" id="reason">Not Yet</h2>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#reasonModal" data-bs-whatever="Null" class="text-decoration-underline">Edit</a>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                            <i data-feather="clock" class="text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Class</p>
                                                    <h2 class="mt-4 ff-secondary fw-semibold"><?php echo $row_cls_name; ?></h2>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#notAccepted" class="text-decoration-underline">Edit</a>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                            <i data-feather="external-link" class="text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-7">
                        <div class="row h-100">
                            <div class="col-xl-6">
                                <div class="card card-height-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Picture</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <img class="rounded res" id="captured-photo" style="display: none;">
                                        </div>
                                        <div class="container">
                                            <video class="rounded oto" id="video-element" autoplay></video>
                                        </div>
                                        <button type="button" class="btn btn-success w-100 mt-3" id="confirm-btn" onclick="capturePhoto()"><i class="ri-camera-fill label-icon fs-5"></i></button>
                                        <button type="button" class="btn btn-primary w-100 mt-3" id="cancel-button" onclick="cancelCapture()" style="display: none;"><i class="ri-close-circle-line label-icon fs-5"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card card-height-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Maps</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="map"></div>
                                        <button type="button" class="btn btn-success w-100 mt-3" id="location-button"><i class="ri-map-fill label-icon fs-5"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="latitude" id="latitude" value="">
                    <input type="hidden" name="longitude" id="longitude" value="">
                    <input type="hidden" name="img" id="imgAbsentInput" />
                    <input type="hidden" name="reason" id="reasonAbsentInput" />
                    <button type="submit" class="btn btn-danger w-100 mb-3"><i class="mdi mdi-exit-run"></i></button>

                </form>
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

        .panjang {
            margin: 0 auto;
        }

        .oto {
            max-width: 100%;
            height: 338px;
            object-fit: cover;
            transform: rotateY(180deg);
        }

        .res {
            max-width: 100%;
            height: 338px;
            object-fit: cover;
            transform: rotateY(180deg);
        }

        #map {
            max-width: 100%;
            height: 338px;
            object-fit: cover;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .lebar {
            width: auto;
        }

        .bawah {
            bottom: -170px;
        }
    </style>

    <script>
        const videoElement = document.getElementById('video-element');
        const captureButton = document.getElementById('confirm-btn');
        const cancelButton = document.getElementById('cancel-button');
        const photoElement = document.getElementById('captured-photo');
        let stream = null;
        let photoData = null;

        typeReason = ['Izin', 'Sakit', 'Pergi']

        var selectReason = document.getElementById('selectReason')

        typeReason.forEach(reason => {
            const option = document.createElement("option");
            option.value = reason;
            if (reason === 'Izin') {
                option.selected = true;
            }
            option.append(reason);
            selectReason.append(option);
        })

        function saveReason() {
            const selectedReason = selectReason.options[selectReason.selectedIndex].text;
            reason.textContent = selectedReason;

            const reasonAbsentInput = document.getElementById('reasonAbsentInput')
            reasonAbsentInput.value = selectedReason
        }

        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(function(cameraStream) {
                stream = cameraStream;
                videoElement.srcObject = cameraStream;
            })
            .catch(function(error) {
                console.error(error);
            });

        function capturePhoto() {
            if (stream) {
                const canvas = document.createElement('canvas');
                canvas.width = videoElement.videoWidth;
                canvas.height = videoElement.videoHeight;
                const ctx = canvas.getContext('2d');

                ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

                photoData = canvas.toDataURL('image/png');

                document.getElementById('imgAbsentInput').value = photoData;

                videoElement.style.display = 'none';
                photoElement.src = photoData;
                photoElement.style.display = 'block';

                captureButton.style.display = 'none';
                cancelButton.style.display = 'block';
            }
        }

        function cancelCapture() {
            photoData = null;
            photoElement.src = '';
            photoElement.style.display = 'none';

            videoElement.style.display = 'block';

            captureButton.style.display = 'block';
            cancelButton.style.display = 'none';
        }
    </script>

    <script>
        var map = L.map('map').setView([0, 0], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function getLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    map.setView([latitude, longitude], 15);

                    L.marker([latitude, longitude]).addTo(map)
                        .bindPopup("You are here!").openPopup();

                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                }, function(error) {});
            } else {
                document.getElementById("location").textContent = "Geolokasi tidak didukung oleh browser ini.";
            }
        }
        document.getElementById('location-button').addEventListener('click', getLocation);
    </script>

    <script>
        function updateTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();

            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            if (seconds < 10) {
                seconds = "0" + seconds;
            }

            var formattedTime = hours + ":" + minutes + ":" + seconds;
            document.getElementById("current-time").innerHTML = formattedTime;
        }
        setInterval(updateTime, 1000);
    </script>

    <?php include '../layouts-back/vendor-scripts.php'; ?>
    <!-- apexcharts -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
    <!--Swiper slider js-->
    <script src="../assets/libs/swiper/swiper-bundle.min.js"></script>
    <!-- Dashboard init -->
    <script src="../assets/js/pages/dashboard-ecommerce.init.js"></script>
    <!-- Sweet alert init js-->
    <script src="../assets/js/pages/sweetalerts.init.js"></script>
    <!-- Sweet Alerts js -->
    <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- App js -->
    <script src="../assets/js/app.js"></script>
    </body>

    </html>