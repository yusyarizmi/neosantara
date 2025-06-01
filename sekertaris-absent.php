<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
include 'action/config.php';
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['txtUsername'])) {
    header("location:landing.php");
}

$date = date('Y-m-d');
$username = $_SESSION['txtUsername'];

if (isset($_SESSION['noClass']) && isset($_SESSION['noStudent'])) {
    $pkcls = $_SESSION['noClass'];
    $pkstu = $_SESSION['noStudent'];
    $structure_stu = $_SESSION['txtStructure'];
} else {
    $sql_stu = "SELECT * FROM _student WHERE _user='$username'";
    $res_stu = query($sql_stu);
    $row_stu = mysqli_fetch_array($res_stu);
    $pkstu = $row_stu['pkstudent'];
    $pkcls = $row_stu['_pkcls'];
    $structure_stu = $row_stu['_structure'];
}

$sql_entry = "SELECT COUNT(*) FROM _absent WHERE _pkcls = $pkcls AND _date = '$date'";
$res_entry = query($sql_entry);
$row_entry = mysqli_fetch_row($res_entry);
$total_entry = $row_entry[0];

$sql_count = "SELECT COUNT(*) FROM _student WHERE _pkcls = $pkcls";
$res_count = query($sql_count);
$row_count = mysqli_fetch_row($res_count);
$total_count = $row_count[0];

$pending = $total_count - $total_entry;
?>

<head>

    <title>Absents | Neosantara</title>
    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>
    <link rel="icon" href="assets/images/meme/favicon.ico">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- When it's online -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- When it's offline -->
    <script src="assets/js/jquery.min.js"></script>
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
                            <h4 class="mb-sm-0">absents list</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sekertaris</a></li>
                                    <li class="breadcrumb-item active">Absents List</li>
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
                                        <p class="fw-medium text-muted mb-0">Completed Absents</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?php echo $total_entry ?>">0</span> absent</h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> Completed
                                            </span>
                                        </p>
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
                                        <p class="fw-medium text-muted mb-0">Pending Absents</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?php echo $pending ?>">0</span> absent</h2>
                                        <p class="mb-0 text-muted">
                                            <span class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i>Pending
                                            </span>
                                        </p>
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
                                        <p class="fw-medium text-muted mb-0">Rejected Absents</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="4">0</span> absents</h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i> Bad
                                            </span></p>
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
                                        <p class="fw-medium text-muted mb-0">Total Students</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?php echo $total_count ?>">0</span> students</h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> Good
                                            </span></p>
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
                        <div class="card" id="AbsentsList">
                            <div class="card-header border-0">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0 flex-grow-1">List Absents</h5>
                                    <div class="flex-shrink-0">
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="action/absent_export.php"><button class="btn btn-soft-success shadow-none">Export</button></a>
                                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Absent</button>
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
                                                <input type="text" class="form-control search bg-light border-light" placeholder="Search for absents or something..." id="search">
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
                                                    <option value="B">Late</option>
                                                    <option value="C">False Time</option>
                                                    <option value="I">Izin</option>
                                                    <option value="S">Sakit</option>
                                                    <option value="P">Pergi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-1 col-sm-4">
                                            <button type="button" class="btn btn-primary w-100" onclick="search_absent();">
                                                <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                                Filters
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- hanya opsi sementara -->
                            <!-- <div id="results"></div> -->
                            <!-- <div id="pagination"></div> -->
                            <!-- hanya opsi sementara -->

                            <div class="card-body">
                                <div class="table-responsive table-card mb-4">
                                    <table class="table align-middle table-nowrap mb-0" id="absentTable">
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
                                    <h4>You are about to delete an absent ?</h4>
                                    <p class="text-muted fs-14 mb-4">Deleting your absent will remove all of
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

                <div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0">
                            <div class="modal-header p-3 bg-soft-info">
                                <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                            </div>
                            <form class="tablelist-form" autocomplete="off">
                                <div class="modal-body">
                                    <input type="hidden" id="tasksId" />
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <label for="projectName-field" class="form-label">Project Name</label>
                                            <input type="text" id="projectName-field" class="form-control" placeholder="Project name" required />
                                        </div>
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="tasksTitle-field" class="form-label">Title</label>
                                                <input type="text" id="tasksTitle-field" class="form-control" placeholder="Title" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="clientName-field" class="form-label">Client Name</label>
                                            <input type="text" id="clientName-field" class="form-control" placeholder="Client name" required />
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="form-label">Assigned To</label>
                                            <div data-simplebar style="height: 95px;">
                                                <ul class="list-unstyled vstack gap-2 mb-0">
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-2.jpg" id="james-forbes">
                                                            <label class="form-check-label d-flex align-items-center" for="james-forbes">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">James Forbes</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-3.jpg" id="john-robles">
                                                            <label class="form-check-label d-flex align-items-center" for="john-robles">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">John Robles</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-4.jpg" id="mary-gant">
                                                            <label class="form-check-label d-flex align-items-center" for="mary-gant">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">Mary Gant</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-1.jpg" id="curtis-saenz">
                                                            <label class="form-check-label d-flex align-items-center" for="curtis-saenz">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">Curtis Saenz</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-5.jpg" id="virgie-price">
                                                            <label class="form-check-label d-flex align-items-center" for="virgie-price">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">Virgie Price</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-10.jpg" id="anthony-mills">
                                                            <label class="form-check-label d-flex align-items-center" for="anthony-mills">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">Anthony Mills</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-6.jpg" id="marian-angel">
                                                            <label class="form-check-label d-flex align-items-center" for="marian-angel">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">Marian Angel</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-10.jpg" id="johnnie-walton">
                                                            <label class="form-check-label d-flex align-items-center" for="johnnie-walton">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">Johnnie Walton</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-8.jpg" id="donna-weston">
                                                            <label class="form-check-label d-flex align-items-center" for="donna-weston">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">Donna Weston</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-9.jpg" id="diego-norris">
                                                            <label class="form-check-label d-flex align-items-center" for="diego-norris">
                                                                <span class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-9.jpg" alt="" class="avatar-xxs rounded-circle">
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">Diego Norris</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="duedate-field" class="form-label">Due Date</label>
                                            <input type="text" id="duedate-field" class="form-control" data-provider="flatpickr" placeholder="Due date" required />
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="ticket-status" class="form-label">Status</label>
                                            <select class="form-control" data-choices data-choices-search-false id="ticket-status">
                                                <option value="">Status</option>
                                                <option value="New">New</option>
                                                <option value="Inprogress">Inprogress</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="priority-field" class="form-label">Priority</label>
                                            <select class="form-control" data-choices data-choices-search-false id="priority-field">
                                                <option value="">Priority</option>
                                                <option value="High">High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" id="add-btn">Add Task</button>
                                    </div>
                                </div>
                            </form>
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
    function absent_data() {
        $("#loading").show();

        $.ajax({
            type: "POST",
            url: "action/absent_data.php",
            data: {
                action: 'load'
            },
            success: function(response) {
                $("#absentTable").html(response);
                $("#loading").hide();
            },
            error: function() {
                $("#loading").hide();
            }
        });
    }

    window.search_absent = function() {
        var search = $('#search').val();
        $("#loading").show();
        $('#absentTable').hide();

        $.ajax({
            type: 'POST',
            url: 'action/absent_data.php',
            data: {
                action: 'search',
                search: search
            },
            success: function(response) {
                $('#absentTable').show();
                $('#absentTable').html(response);
                $("#loading").hide();
            },
            error: function() {
                $("#loading").hide();
            }
        });
    };

    $(document).ready(function() {
        absent_data();
    });

    function deleteOrder(pk) {
        $('#deleteOrder').data('pk', pk);
        $('#deleteOrder').modal('show');
    }

    function deleteData() {
        var pk = $('#deleteOrder').data('pk');

        $.ajax({
            type: "POST",
            url: "action/absent_delete.php",
            data: {
                action: 'delete',
                pk: pk
            },
            success: function(response) {
                var timeInterval;
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your absent has been deleted.',
                    icon: 'success',
                    timer: 2000,
                    timerProgressBar: true,
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    buttonsStyling: false
                })
                absent_data();
                $('#deleteOrder').modal('hide');
            }
        });
    }
</script>

<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/libs/list.js/list.min.js"></script>
<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/js/pages/sweetalerts.init.js"></script>
<script src="assets/js/app.js"></script>

</body>

</html>