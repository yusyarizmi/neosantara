<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
if (!isset($_SESSION['txtUsername'])) {
    header("location:landing.php");
}
?>

<head>

    <title>Students | Neosantara</title>
    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>
    <link rel="icon" href="assets/images/meme/favicon.ico">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<?php include 'layouts/body.php'; ?>

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
                            <h4 class="mb-sm-0">students list</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Students List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Home Room Teacher</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">Dawati</h2>
                                        <li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success rounded-circle fs-4">
                                                <i class="ri-checkbox-circle-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Head Of Class</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">Galih</h2>
                                        <li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning rounded-circle fs-4">
                                                <i class="mdi mdi-timer-sand"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Class Treasurer</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">Abdullah</h2>
                                        <li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-secondary rounded-circle fs-4">
                                                <i class="ri-delete-bin-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Class Secretary</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">Akbar</h2>
                                        <li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info rounded-circle fs-4">
                                                <i class="ri-ticket-2-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0 flex-grow-1">List Students</h5>
                                    <div class="flex-shrink-0">
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="action/student_export.php"><button class="btn btn-soft-success shadow-none">Export</button></a>
                                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Student</button>
                                            <button class="btn btn-success" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border border-dashed border-end-0 border-start-0">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-xxl-5 col-sm-12">
                                            <div class="search-box">
                                                <input type="text" class="form-control search bg-light border-light" placeholder="Search for students or something..." id="search" oninput="search_student()">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>

                                        <div class="col-xxl-3 col-sm-4">
                                            <input type="text" class="form-control bg-light border-light" id="demo-datepicker" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Select date range">
                                        </div>

                                        <div class="col-xxl-3 col-sm-4">
                                            <div class="input-light">
                                                <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                                    <option value="">Status</option>
                                                    <option value="all" selected>All</option>
                                                    <option value="M">Entry</option>
                                                    <option value="B">To Late</option>
                                                    <option value="C">False Time</option>
                                                    <option value="F">Stupid Time</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-1 col-sm-4">
                                            <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
                                                <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                                Filters
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card mb-4">
                                    <table class="table align-middle table-nowrap mb-0" id="studentTable">
                                        <div class="noresult" style="display: none" id="loading">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                                <h5 class="mt-2">Loading...</h5>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body p-5 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                </lord-icon>
                                <div class="mt-4 text-center">
                                    <h4>You are about to delete an student ?</h4>
                                    <p class="text-muted fs-14 mb-4">Deleting your student will remove all of
                                        your information from our database.</p>
                                    <div class="hstack gap-2 justify-content-center remove">
                                        <button class="btn btn-link btn-ghost-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                        <button class="btn btn-danger" onclick="deleteData()">Yes, Delete It</button>
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

<script>
    function student_data() {
        $("#loading").show();

        $.ajax({
            type: 'POST',
            url: 'action/student_data.php',
            data: {
                action: 'load'
            },
            success: function(response) {
                $('#studentTable').html(response);
                $("#loading").hide();
            },
            error: function() {
                $("#loading").hide();
            }
        });
    }

    window.search_student = function() {
        var search = $('#search').val();
        $("#loading").show();
        $('#studentTable').hide();

        $.ajax({
            type: 'POST',
            url: 'action/student_data.php',
            data: {
                action: 'search',
                search: search
            },
            success: function(response) {
                $('#studentTable').show();
                $('#studentTable').html(response);
                $("#loading").hide();
            },
            error: function() {
                $("#loading").hide();
            }
        });
    };

    function deleteData() {
        var pk = $('#deleteOrder').data('pk');

        $.ajax({
            type: "POST",
            url: "action/student_delete.php",
            data: {
                action: 'delete',
                pk: pk
            },
            success: function(response) {
                alert(response);
                student_data();
                $('#deleteOrder').modal('hide');
            }
        });
    }

    $(document).ready(function() {
        student_data();
    });

    function deleteOrder(pk) {
        $('#deleteOrder').data('pk', pk);
        $('#deleteOrder').modal('show');
    }
</script>

<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/libs/list.js/list.min.js"></script>
<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/js/app.js"></script>

</body>

</html>