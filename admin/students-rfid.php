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
?>

<head>

    <title>Students (RFID) | Neosantara</title>

    <link rel="icon" href="../assets/images/meme/favicon.ico">

    <?php include '../layouts-back/title-meta.php'; ?>

    <?php include '../layouts-back/head-css.php'; ?>

    <script src="../assets/js/jquery.min.js"></script>

</head>

<?php include '../layouts-back/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include '../layouts-back/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Students</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Students</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: none;" id="mySuccess" class="alert alert-success alert-dismissible alert-solid alert-label-icon shadow fade show">
                    <i class="ri-notification-off-line label-icon"></i><strong>Success</strong> - Label icon alert
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div style="display: none;" id="myFailed" class="alert alert-danger alert-dismissible alert-solid alert-label-icon shadow fade show">
                    <i class="ri-notification-off-line label-icon"></i><strong>Failed</strong> - Label icon alert
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Student Card</h4>
                            </div>
                            <div class="card-body">
                                <div style="text-align: center;">
                                    <img class="align-center" src="../assets/images/rfid.gif" alt="">
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control rounded-end flag-input" readonly placeholder="Select a student" data-bs-toggle="dropdown" aria-expanded="false" />
                                        <div class="dropdown-menu w-100">
                                            <div class="p-2 px-3 pt-1 searchlist-input">
                                                <input type="text" class="form-control form-control-sm border mb-3" placeholder="Search country name or country code..." />
                                            </div>
                                            <ul class="list-unstyled dropdown-menu-list mb-0" id="studentSelect">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input id="uid" type="text" class="form-control" placeholder=" Tap a UID Card" aria-label="Tap Card's UID" aria-describedby="basic-addon2" readonly="true" value="">
                                        <span class="input-group-text">UID</span>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="submit">Submit form</button>
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

<script>
    function student_data() {
        $.ajax({
            type: 'POST',
            url: '../action/student_data.php',
            data: {
                action: 'fullname'
            },
            success: function(response) {
                $('#studentSelect').html(response);
            }
        });
    }

    var intervalId;

    function startInterval() {
        intervalId = setInterval(function() {
            $("#uid").load("../action/uid_data.php", function(responseText) {
                var numUid = responseText;
                var decodeData = JSON.parse(numUid);

                var valueUid = document.getElementById("uid");
                valueUid.value = decodeData;

                if (decodeData != null) {
                    localStorage.setItem('uid', decodeData);
                    clearInterval(intervalId);
                    deleteUidFromDatabase(decodeData);
                }
            });
        }, 500);
    }

    $('#studentSelect').on('click', 'li', function() {
        var studentName = $(this).find('.country-name').text();
        $('.flag-input').val(studentName);

        var pkstudent = $(this).data('pkstudent');

        var valueUid = document.getElementById("uid");

        $('#submit').on('click', function() {
            var uid = localStorage.getItem('uid');
            $.ajax({
                type: 'POST',
                url: '../action/uid_add.php',
                data: {
                    pkstudent: pkstudent,
                    uid: uid
                },
                success: function(response) {
                    console.log(response);

                    if (response === '200') {
                        // window.location.reload();
                        localStorage.clear();

                        $('.flag-input').val('');

                        var valueUid = document.getElementById("uid");
                        valueUid.value = '';

                        startInterval();

                        var mySuccess = document.getElementById("mySuccess");
                        mySuccess.style.display = 'block';

                        setTimeout(function() {
                            mySuccess.style.display = 'none';
                        }, 5000);
                    }

                    if (response === '500') {

                        var myFailed = document.getElementById("myFailed");
                        myFailed.style.display = 'block';

                        setTimeout(function() {
                            myFailed.style.display = 'none';
                        }, 5000);
                    }
                }
            });
        });
    });

    function deleteUidFromDatabase(uid) {
        $.ajax({
            type: 'POST',
            url: '../action/uid_delete.php',
            data: {
                uid: uid
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $(document).ready(function() {
        student_data();
        startInterval();
    });
</script>

<?php include '../layouts-back/vendor-scripts.php'; ?>

<script src="../assets/js/app.js"></script>
<script src="../assets/libs/prismjs/prism.js"></script>
</body>

</html>