<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
include 'action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:landing.php");
}

$user = $_SESSION['txtUsername'];

if (isset($_GET['pk'])) {
    $pk =  $_GET['pk'];
    if ($pk != '') {

        $sql = "SELECT * FROM _absent WHERE pkabsent='$pk'";
        $res = query($sql);
        $row = mysqli_fetch_array($res);

        if ($row) {
            $pkstu = $row['_pkstu'];

            $sql_student = "SELECT * FROM _student WHERE pkstudent='$pkstu'";
            $res_student = query($sql_student);
            $row_student = mysqli_fetch_array($res_student);

            $username = $row_student['_user'];
            $fullname = $row_student['_fullname'];
            $pkcls = $row_student['_pkcls'];
            $date = $row['_date'];

            $imgIn = $row['_imgIn'];
            $imgOut = $row['_imgOut'];
            $imgIn = str_replace('../', '', $imgIn);
            $imgOut = str_replace('../', '', $imgOut);
            $imgInSize = filesize($imgIn);
            $imgOutSize = filesize($imgOut);
            $imgInSizeMb = $imgInSize / (1024 * 1024);
            $imgOutSizeMb = $imgOutSize / (1024 * 1024);

            $sql_cls = "SELECT cls_name FROM _class WHERE pkcls='$pkcls'";
            $res_cls = query($sql_cls);
            $row_cls = mysqli_fetch_array($res_cls);

            $cls_name = $row_cls['cls_name'];

            if ($row['_timeIn']) {
                $timeIn = $row['_timeIn'];
                $infoIn = $row['_infoIn'];
                if ($infoIn == 'M') {
                    $statusIn = '<button class="btn btn-success btn-sm" id="entry-desc"><i class="ri-information-line align-bottom me-1"></i> Entry</button>';
                } elseif ($infoIn == 'B') {
                    $statusIn = '<button class="btn btn-info btn-sm" id="to-late-in-desc"><i class="ri-information-line align-bottom me-1"></i> To Late</button>';
                } elseif ($infoIn == 'C') {
                    $statusIn = '<button class="btn btn-danger btn-sm" id="false-time-in-desc"><i class="ri-information-line align-bottom me-1"></i> False Time</button>';
                } elseif ($infoIn == 'F') {
                    $statusIn = '<button class="btn btn-danger btn-sm" id="stupid-time-in-desc"><i class="ri-information-line align-bottom me-1"></i> Stupid Time</button>';
                } elseif ($infoIn == 'S') {
                    $statusIn = '<button class="btn btn-danger btn-sm" id="sakit-in-desc"><i class="ri-information-line align-bottom me-1"></i> Sakit</button>';
                } elseif ($infoIn == 'I') {
                    $statusIn = '<button class="btn btn-danger btn-sm" id="izin-in-desc"><i class="ri-information-line align-bottom me-1"></i> Izin</button>';
                } elseif ($infoIn == 'P') {
                    $statusIn = '<button class="btn btn-danger btn-sm" id="pergi-in-desc"><i class="ri-information-line align-bottom me-1"></i> Pergi</button>';
                }
            } else {
                $timeIn = '--:--:--';
                $statusIn = '<button class="btn btn-info btn-sm"><i class="ri-information-line align-bottom me-1"></i> Not Yet</button>';
            }
            if ($row['_timeOut']) {
                $timeOut = $row['_timeOut'];
                $infoOut = $row['_infoOut'];
                if ($infoOut == 'M') {
                    $statusOut = '<button class="btn btn-success btn-sm" id="normal-desc"><i class="ri-information-line align-bottom me-1"></i> Normal</button>';
                } elseif ($infoOut == 'C') {
                    $statusOut = '<button class="btn btn-danger btn-sm" id="false-time-out-desc"><i class="ri-information-line align-bottom me-1"></i> False Time</button>';
                } elseif ($infoOut == 'B') {
                    $statusOut = '<button class="btn btn-info btn-sm" id="to-late-out-desc"><i class="ri-information-line align-bottom me-1"></i> To Late</button>';
                } elseif ($infoOut == 'F') {
                    $statusOut = '<button class="btn btn-danger btn-sm" id="stupid-time-out-desc"><i class="ri-information-line align-bottom me-1"></i> Stupid Time</button>';
                } elseif ($infoOut == 'S') {
                    $statusOut = '<button class="btn btn-danger btn-sm" id="sakit-out-desc"><i class="ri-information-line align-bottom me-1"></i> Sakit</button>';
                } elseif ($infoOut == 'I') {
                    $statusOut = '<button class="btn btn-danger btn-sm" id="izin-out-desc"><i class="ri-information-line align-bottom me-1"></i> Izin</button>';
                } elseif ($infoOut == 'P') {
                    $statusOut = '<button class="btn btn-danger btn-sm" id="pergi-out-desc"><i class="ri-information-line align-bottom me-1"></i> Pergi</button>';
                }
            } else {
                $timeOut = '--:--:--';
                $statusOut = '<button class="btn btn-info btn-sm"><i class="ri-information-line align-bottom me-1"></i> Not Yet</button>';
            }
        } else {
            $fullname = '--';
            $cls_name = '--';
            $date = '--';

            $imgIn = '';
            $imgOut = '';

            $timeIn = '--:--:--';
            $timeOut = '--:--:--';

            $statusIn = '<button class="btn btn-secondary btn-sm"><i class="ri-information-line align-bottom me-1"></i> Nothing</button>';
            $statusOut = '<button class="btn btn-secondary btn-sm"><i class="ri-information-line align-bottom me-1"></i> Nothing</button>';
        }
    } elseif ($pk == '') {
        $fullname = '--';
        $cls_name = '--';
        $date = '--';

        $imgIn = '';
        $imgOut = '';

        $timeIn = '--:--:--';
        $timeOut = '--:--:--';

        $statusIn = '<button class="btn btn-secondary btn-sm"><i class="ri-information-line align-bottom me-1"></i> Nothing</button>';
        $statusOut = '<button class="btn btn-secondary btn-sm"><i class="ri-information-line align-bottom me-1"></i> Nothing</button>';
    }
} else {
    $fullname = '--';
    $cls_name = '--';
    $date = '--';

    $imgIn = '';
    $imgOut = '';

    $timeIn = '--:--:--';
    $timeOut = '--:--:--';

    $statusIn = '<button class="btn btn-secondary btn-sm"><i class="ri-information-line align-bottom me-1"></i> Nothing</button>';
    $statusOut = '<button class="btn btn-secondary btn-sm"><i class="ri-information-line align-bottom me-1"></i> Nothing</button>';
}
?>

<head>

    <title>Absent Details | Neosantara</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="icon" href="assets/images/meme/favicon.ico">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <?php include 'layouts/title-meta.php'; ?>

</head>

<!--  -->
<?php include 'layouts/body.php'; ?>
<!--  -->

<div id="layout-wrapper">

    <!--  -->
    <?php include 'layouts/menu.php'; ?>
    <!--  -->

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Absent Details</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sekertaris</a></li>
                                    <li class="breadcrumb-item active">Absent Details</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6 class="card-title mb-3 flex-grow-1 text-start">Time Tracking in</h6>
                                <div class="mb-2">
                                    <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="loop" colors="primary:#8c68cd,secondary:#4788ff" style="width:90px;height:90px">
                                    </lord-icon>
                                </div>
                                <h3 class="mb-1"><?php echo $timeIn ?></h3>
                                <h5 class="fs-14 mb-4">When Student Do Absent</h5>
                                <div class="hstack gap-2 justify-content-center">
                                    <?php echo $statusIn; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center">
                                <h6 class="card-title mb-3 flex-grow-1 text-start">Time Tracking out</h6>
                                <div class="mb-2">
                                    <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="loop" colors="primary:#8c68cd,secondary:#4788ff" style="width:90px;height:90px">
                                    </lord-icon>
                                </div>
                                <h3 class="mb-1"><?php echo $timeOut ?></h3>
                                <h5 class="fs-14 mb-4">When Student Do Absent</h5>
                                <div class="hstack gap-2 justify-content-center">
                                    <?php echo $statusOut; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="card card-height-100 mb-3">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                            Absent Data
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="table-card">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="fw-medium">Student Name :</td>
                                                <td><?php echo $fullname; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium">Class Name :</td>
                                                <td><?php echo $cls_name; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium">Due Date :</td>
                                                <td><?php echo $date; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium">Geolocation :</td>
                                                <td><a class="text-decoration-underline" target="_blank" href="https://www.google.com/maps?q=<?php echo $row['_latitude'] ?>,<?php echo $row['_longitude'] ?>">Click Here!</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-5">
                        <div class="card card-height-100">
                            <div class="card-header">
                                <div>
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                                Attachments File (2)
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home-1" role="tabpanel">
                                        <div class="table-responsive table-card">
                                            <table class="table table-borderless align-middle mb-0">
                                                <thead class="table-light text-muted">
                                                    <tr>
                                                        <th scope="col">File Name</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Size</th>
                                                        <th scope="col">Upload Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($imgIn != '' && $imgOut != '') {
                                                        echo
                                                        '
                                                        <tr>
                                                        <td>
                                                        <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                        <div class="avatar-title bg-soft-info text-info rounded fs-20">
                                                        <i class="ri-image-2-fill"></i>
                                                        </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">' . $username . '_in.png</a>
                                                        </h6>
                                                        </div>
                                                        </div>
                                                        </td>
                                                        <td>PNG File</td>
                                                        <td>' . number_format($imgInSizeMb, 2) . " MB" . '</td>
                                                        <td>' . $date . '</td>
                                                        <td>
                                                        <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="ri-equalizer-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                        <li><a class="dropdown-item" href="' . $imgIn . '" target="_blank"><i class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="' . $imgIn . '" download><i class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                        </li>
                                                        </ul>
                                                        </div>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>
                                                        <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                        <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                        <i class="ri-image-2-fill"></i>
                                                        </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">' . $username . '_out.png</a>
                                                        </h6>
                                                        </div>
                                                        </div>
                                                        </td>
                                                        <td>PNG File</td>
                                                        <td>' . number_format($imgOutSizeMb, 2) . " MB" . '</td>
                                                        <td>' . $date . '</td>
                                                        <td>
                                                        <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="ri-equalizer-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                        <li><a class="dropdown-item" href="' . $imgOut . '" target="_blank"><i class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="' . $imgOut . '" download><i class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                        </li>
                                                        </ul>
                                                        </div>
                                                        </td>
                                                        </tr>
                                                        ';
                                                    } elseif ($imgIn != '' && $imgOut == '') {
                                                        echo
                                                        '
                                                        <tr>
                                                        <td>
                                                        <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                        <div class="avatar-title bg-soft-info text-info rounded fs-20">
                                                        <i class="ri-image-2-fill"></i>
                                                        </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">' . $username . '_in.png</a>
                                                        </h6>
                                                        </div>
                                                        </div>
                                                        </td>
                                                        <td>PNG File</td>
                                                        <td>' . number_format($imgInSizeMb, 2) . " MB" . '</td>
                                                        <td>' . $date . '</td>
                                                        <td>
                                                        <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="ri-equalizer-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                        <li><a class="dropdown-item" href="' . $imgIn . '" target="_blank"><i class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="' . $imgIn . '" download><i class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                        </li>
                                                        </ul>
                                                        </div>
                                                        </td>
                                                        </tr>
                                                        ';
                                                    } elseif ($imgIn == '' && $imgOut != '') {
                                                        echo
                                                        '
                                                        <tr>
                                                        <td>
                                                        <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                        <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                        <i class="ri-image-2-fill"></i>
                                                        </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">' . $username . '_out.png</a>
                                                        </h6>
                                                        </div>
                                                        </div>
                                                        </td>
                                                        <td>PNG File</td>
                                                        <td>' . number_format($imgOutSizeMb, 2) . " MB" . '</td>
                                                        <td>' . $date . '</td>
                                                        <td>
                                                        <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="ri-equalizer-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                        <li><a class="dropdown-item" href="' . $imgOut . '" target="_blank"><i class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="' . $imgOut . '" download><i class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                        </li>
                                                        </ul>
                                                        </div>
                                                        </td>
                                                        </tr>
                                                        ';
                                                    } elseif ($imgIn == '' && $imgOut == '') {
                                                        echo '<tr><td></td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  -->
        <?php include 'layouts/footer.php'; ?>
        <!--  -->

    </div>
</div>

<!--  -->
<?php include 'layouts/vendor-scripts.php'; ?>
<!--  -->

<script>
    //Entry Desc
    if (document.getElementById("entry-desc"))
        document.getElementById("entry-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:40BB82;">Entry</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:40BB82;">Entry</b> is an Absent in condition which means that students enter and arrive at school on time. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //Normal Desc
    if (document.getElementById("normal-desc"))
        document.getElementById("normal-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:40BB82;">Normal</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:40BB82;">Normal</b> is an Absent out condition which means that students out of school on time and ready to go home. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //To Late In Desc
    if (document.getElementById("to-late-in-desc"))
        document.getElementById("to-late-in-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:3FA7D6;">To Late</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:3FA7D6;">To Late</b> is an Absent in condition which means that students enter and arrive at school but student not on time/to late. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //To Late Out Desc
    if (document.getElementById("to-late-out-desc"))
        document.getElementById("to-late-out-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:3FA7D6;">To Late</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:3FA7D6;">To Late</b> is an Absent out condition which means that students out of school not on time/to late but still ready to go home. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //False Time Desc In
    if (document.getElementById("false-time-in-desc"))
        document.getElementById("false-time-in-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">False Time</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">False Time</b> is an Absent out condition which means that students absent at not normal time, and must be reported. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //False Time Desc Out
    if (document.getElementById("false-time-out-desc"))
        document.getElementById("false-time-out-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">False Time</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">False Time</b> is an Absent out condition which means that students absent at not normal time, and must be reported. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //Stupid Time Desc Out
    if (document.getElementById("stupid-time-out-desc"))
        document.getElementById("stupid-time-out-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">Stupid Time</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">Stupid Time</b> is an Absent in & out condition which means that students absent at crazy time long of normal, and must be reported. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //Stupid Time Desc In
    if (document.getElementById("stupid-time-in-desc"))
        document.getElementById("stupid-time-in-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">Stupid Time</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">Stupid Time</b> is an Absent in & out condition which means that students absent at crazy time long of normal, and must be reported. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //Izin Desc In
    if (document.getElementById("izin-in-desc"))
        document.getElementById("izin-in-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">Izin</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">Izin</b> is an Absent in & out condition which means that student not go to school, but take a permission. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //Izin Desc Out
    if (document.getElementById("izin-out-desc"))
        document.getElementById("izin-out-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">Izin</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">Izin</b> is an Absent in & out condition which means that student not go to school, but take a permission. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //Sakit Desc Out
    if (document.getElementById("sakit-out-desc"))
        document.getElementById("sakit-out-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">Sakit</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">Sakit</b> is an Absent in & out condition which means that student not go to school, but take a sick permission. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //Sakit Desc In
    if (document.getElementById("sakit-in-desc"))
        document.getElementById("sakit-in-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">Sakit</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">Sakit</b> is an Absent in & out condition which means that student not go to school, but take a sick permission. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //Pergi Desc Out
    if (document.getElementById("pergi-out-desc"))
        document.getElementById("pergi-out-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">Pergi</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">Pergi</b> is an Absent in & out condition which means that student not go to school, but go to another place, idk. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
    //Pergi Desc In
    if (document.getElementById("pergi-in-desc"))
        document.getElementById("pergi-in-desc").addEventListener("click", function() {
            Swal.fire({
                title: '<h3><b>What is </b><b style="color:EE6352;">Pergi</b>??<h3>',
                icon: 'info',
                html: '<h5><b style="color:EE6352;">Pergi</b> is an Absent in & out condition which means that student not go to school, but go to another place, idk. </h5>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success me-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> Great!',
                cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i>',
                background: '#fff url(assets/images/chat-bg-pattern.png)',
                showCloseButton: true,
                width: 500
            })
        });
</script>

<!-- App js -->
<script src="assets/js/app.js"></script>
<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

</body>

</html>