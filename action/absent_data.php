<thead class="table-light text-muted">
    <tr>
        <th scope="col" style="width: 40px;">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
            </div>
        </th>
        <th>Due Date</th>
        <th>Time In</th>
        <th>Time Out</th>
        <th>Student Name</th>
        <th>Picture In</th>
        <th>Picture Out</th>
        <th>Geolocation</th>
        <th>Status In</th>
        <th>Status Out</th>
    </tr>
</thead>

<?php include '../layouts-back/session.php'; ?>
<?php include '../layouts-back/head-main.php'; ?>

<?php
include '../action/config.php';
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

$date = date('Y-m-d');
$conn = get_connection();
$action = $_POST['action'];
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

if ($action == 'load') {
    $sql_absents = "SELECT * FROM _absent WHERE _pkcls = $pkcls AND _date = '$date'";
    $res_absents = query($sql_absents);

    if ($res_absents->num_rows > 0) {
        while ($row_absents = mysqli_fetch_assoc($res_absents)) {

            if ($action == 'load') {
                $pkabsent = $row_absents['pkabsent'];
                $imgIn = preg_replace('/^\.\.\//', './', $row_absents['_imgIn']);
                $imgOut = preg_replace('/^\.\.\//', './', $row_absents['_imgOut']);

                $sql_stu_loop = "SELECT * FROM _absent WHERE pkabsent = '$pkabsent' AND _date = '$date'";
                $res_stu_loop = query($sql_stu_loop);
                $row_stu_loop = mysqli_fetch_assoc($res_stu_loop);
                $stu_loop = $row_stu_loop['_pkstu'];

                $sql_user = "SELECT * FROM _student WHERE pkstudent = $stu_loop";
                $res_user = query($sql_user);
                $row_user = mysqli_fetch_assoc($res_user);
            } elseif ($action == 'search') {
                $pkabsent = $row_absents['pkabsent'];
                $imgIn = preg_replace('/^\.\.\//', './', $row_absents['_imgIn']);
                $imgOut = preg_replace('/^\.\.\//', './', $row_absents['_imgOut']);

                $sql_stu_loop = "SELECT * FROM _absent WHERE pkabsent = '$pkabsent' AND _pkstu = $pkstudent";
                $res_stu_loop = query($sql_stu_loop);
                $row_stu_loop = mysqli_fetch_assoc($res_stu_loop);
                $stu_loop = $row_stu_loop['_pkstu'];

                $sql_user = "SELECT * FROM _student WHERE pkstudent = $stu_loop";
                $res_user = query($sql_user);
                $row_user = mysqli_fetch_assoc($res_user);
            }

            if (mysqli_num_rows($res_stu_loop) > 0) {
                if ($row_stu_loop['_timeIn']) {
                    $timeIn = $row_stu_loop['_timeIn'];
                    $infoIn = $row_stu_loop['_infoIn'];
                    if ($infoIn == 'M') {
                        $statusIn = '<td class="priority"><span class="badge bg-success text-uppercase">Entry</span></td>';
                    } elseif ($infoIn == 'B') {
                        $statusIn = '<td class="priority"><span class="badge bg-info text-uppercase">To Late</span></td>';
                    } elseif ($infoIn == 'C') {
                        $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">False Time</span></td>';
                    } elseif ($infoIn == 'F') {
                        $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">Stupid Time</span></td>';
                    } elseif ($infoIn == 'S') {
                        $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">Sakit</span></td>';
                    } elseif ($infoIn == 'I') {
                        $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">Izin</span></td>';
                    } elseif ($infoIn == 'P') {
                        $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">Pergi</span></td>';
                    }
                } else {
                    $timeIn = "Not Yet";
                }

                if ($row_stu_loop['_timeOut']) {
                    $timeOut = $row_stu_loop['_timeOut'];
                    $infoOut = $row_stu_loop['_infoOut'];
                    if ($infoOut == 'M') {
                        $statusOut = '<td class="priority"><span class="badge bg-success text-uppercase">Normal</span></td>';
                    } elseif ($infoOut == 'C') {
                        $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">False Time</span></td>';
                    } elseif ($infoOut == 'B') {
                        $statusOut = '<td class="priority"><span class="badge bg-info text-uppercase">To Late</span></td>';
                    } elseif ($infoOut == 'F') {
                        $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">Stupid Time</span></td>';
                    } elseif ($infoOut == 'S') {
                        $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">Sakit</span></td>';
                    } elseif ($infoOut == 'I') {
                        $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">Izin</span></td>';
                    } elseif ($infoOut == 'P') {
                        $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">Pergi</span></td>';
                    }
                } else {
                    $timeOut = "Not Yet";
                }
            }

            if ($row_absents['_timeOut'] == "") {
                echo '<tbody class="list form-check-all">';
                echo '<tr>';
                echo '<th scope="row">';
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" name="chk_child" value="option1">';
                echo '</div>';
                echo '</th>';
                echo '<td>' . $row_absents['_date'] . '</td>';
                echo '<td class="flex-grow-1">' . $row_absents['_timeIn'] . '</td>';
                echo '<td>';
                echo '<div class="d-flex">';
                echo '<div class="flex-grow-1 text-muted">not yet</div>';
                if ($structure_stu == 'sekertaris_kelas') {
                    echo '<div class="flex-shrink-0 ms-4">';
                    echo '<ul class="list-inline tasks-list-menu mb-0">';
                    echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item">';
                    echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder(deleteOrder({$row_absents['pkabsent']}))'>";
                    echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                } elseif ($structure_stu == 'ketua_kelas') {
                    echo '<div class="flex-shrink-0 ms-4">';
                    echo '<ul class="list-inline tasks-list-menu mb-0">';
                    echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item">';
                    echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder({$row_absents['pkabsent']})'>";
                    echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                } else {
                    echo '<div class="flex-shrink-0 ms-4">';
                    echo '<ul class="list-inline tasks-list-menu mb-0">';
                    echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                }
                echo '</a>';
                echo '</li>';
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '</td>';
                echo '<td>' . $row_user['_fullname'] . '</td>';
                echo '<td>';
                echo '<div class="avatar-group">';
                echo '<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                echo '<img src="' . $imgIn . '" alt="" class="rounded avatar-xxs" />';
                echo '</a>';
                echo '</div>';
                echo '</td>';
                echo '<td>';
                echo '<div class="avatar-group">';
                echo '<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                echo '<div class="flex-grow-1 text-muted">not yet</div>';
                echo '</a>';
                echo '</div>';
                echo '</td>';
                echo '<td>';
                echo '<div class="avatar-group">';
                echo '<a target="_blank" href="https://www.google.com/maps?q=' . $row_absents['_latitude'] . ',' . $row_absents['_longitude'] . '" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                echo '<span class="fs-4 col-xl-3 col-lg-4 col-sm-6"><i class="bx bxs-map"></i></span>';
                echo '</a>';
                echo '</div>';
                echo '</td>';
                echo $statusIn;
                echo '</td>';
                echo '<td class="flex-grow-1 text-muted">not yet</td>';
                echo '</tr>';
                echo '</tbody>';
            }
            if ($row_absents['_timeOut'] != "") {
                echo '<tbody class="list form-check-all">';
                echo '<tr>';
                echo '<th scope="row">';
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" name="chk_child" value="option1">';
                echo '</div>';
                echo '</th>';
                echo '<td>' . $row_absents['_date'] . '</td>';
                echo '<td class="flex-grow-1">' . $row_absents['_timeIn'] . '</td>';
                echo '<td>';
                echo '<div class="d-flex">';
                echo '<div class="flex-grow-1">' . $row_absents['_timeOut'] . '</div>';
                if ($structure_stu == 'sekertaris_kelas') {
                    echo '<div class="flex-shrink-0 ms-4">';
                    echo '<ul class="list-inline tasks-list-menu mb-0">';
                    echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item">';
                    echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder({$row_absents['pkabsent']})'>";
                    echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                } elseif ($structure_stu == 'ketua_kelas') {
                    echo '<div class="flex-shrink-0 ms-4">';
                    echo '<ul class="list-inline tasks-list-menu mb-0">';
                    echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item">';
                    echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder({$row_absents['pkabsent']})'>";
                    echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                } else {
                    echo '<div class="flex-shrink-0 ms-4">';
                    echo '<ul class="list-inline tasks-list-menu mb-0">';
                    echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                }
                echo '</a>';
                echo '</li>';
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '</td>';
                echo '<td>' . $row_user['_fullname'] . '</td>';
                echo '<td>';
                echo '<div class="avatar-group">';
                echo '<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                echo '<img src="' . $imgIn . '" alt="" class="rounded avatar-xxs" />';
                echo '</a>';
                echo '</div>';
                echo '</td>';
                echo '<td>';
                echo '<div class="avatar-group">';
                echo '<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                echo '<img src="' . $imgOut . '" alt="" class="rounded avatar-xxs" />';
                echo '</a>';
                echo '</div>';
                echo '</td>';
                echo '<td>';
                echo '<div class="avatar-group">';
                echo '<a target="_blank" href="https://www.google.com/maps?q=' . $row_absents['_latitude'] . ',' . $row_absents['_longitude'] . '" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                echo '<span class="fs-4 col-xl-3 col-lg-4 col-sm-6"><i class="bx bxs-map"></i></span>';
                echo '</a>';
                echo '</div>';
                echo '</td>';
                echo $statusIn;
                echo '</td>';
                echo $statusOut;
                echo '</tr>';
                echo '</tbody>';
            }
        }
    } else {
        echo '<div>';
        echo '<div class="text-center">';
        echo '<lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"';
        echo 'colors="primary:#8c68cd,secondary:#4788ff"';
        echo 'style="width:75px;height:75px"></lord-icon>';
        echo '<h5 class="mt-2">Sorry! No Result Found</h5>';
        echo '<p class="text-muted mb-0">Not found any student data.</p>';
        echo '</div>';
        echo '</div>';
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
} elseif ($action == 'search') {

    $search = $_POST['search'];

    $stmt = $conn->prepare("SELECT pkstudent FROM _student WHERE _pkcls = ? AND (_fullname LIKE ? OR _user LIKE ?)");
    $searchParam = "%{$search}%";
    $stmt->bind_param("iss", $pkcls, $searchParam, $searchParam);

    $stmt->execute();
    $res_students = $stmt->get_result();

    while ($row_students = $res_students->fetch_assoc()) {
        $pkstudent = $row_students['pkstudent'];

        $stmt_absents = $conn->prepare("SELECT * FROM _absent WHERE _pkcls = ? AND _pkstu = ?");
        $stmt_absents->bind_param("ii", $pkcls, $pkstudent);
        $stmt_absents->execute();
        $res_absents = $stmt_absents->get_result();

        $stmt_absents->close();

        if ($res_absents->num_rows > 0) {
            while ($row_absents = mysqli_fetch_assoc($res_absents)) {

                if ($action == 'load') {
                    $pkabsent = $row_absents['pkabsent'];
                    $imgIn = preg_replace('/^\.\.\//', './', $row_absents['_imgIn']);
                    $imgOut = preg_replace('/^\.\.\//', './', $row_absents['_imgOut']);

                    $sql_stu_loop = "SELECT * FROM _absent WHERE pkabsent = '$pkabsent' AND _date = '$date'";
                    $res_stu_loop = query($sql_stu_loop);
                    $row_stu_loop = mysqli_fetch_assoc($res_stu_loop);
                    $stu_loop = $row_stu_loop['_pkstu'];

                    $sql_user = "SELECT * FROM _student WHERE pkstudent = $stu_loop";
                    $res_user = query($sql_user);
                    $row_user = mysqli_fetch_assoc($res_user);
                } elseif ($action == 'search') {
                    $pkabsent = $row_absents['pkabsent'];
                    $imgIn = preg_replace('/^\.\.\//', './', $row_absents['_imgIn']);
                    $imgOut = preg_replace('/^\.\.\//', './', $row_absents['_imgOut']);

                    $sql_stu_loop = "SELECT * FROM _absent WHERE pkabsent = '$pkabsent' AND _pkstu = $pkstudent";
                    $res_stu_loop = query($sql_stu_loop);
                    $row_stu_loop = mysqli_fetch_assoc($res_stu_loop);
                    $stu_loop = $row_stu_loop['_pkstu'];

                    $sql_user = "SELECT * FROM _student WHERE pkstudent = $stu_loop";
                    $res_user = query($sql_user);
                    $row_user = mysqli_fetch_assoc($res_user);
                }

                if (mysqli_num_rows($res_stu_loop) > 0) {
                    if ($row_stu_loop['_timeIn']) {
                        $timeIn = $row_stu_loop['_timeIn'];
                        $infoIn = $row_stu_loop['_infoIn'];
                        if ($infoIn == 'M') {
                            $statusIn = '<td class="priority"><span class="badge bg-success text-uppercase">Entry</span></td>';
                        } elseif ($infoIn == 'B') {
                            $statusIn = '<td class="priority"><span class="badge bg-info text-uppercase">To Late</span></td>';
                        } elseif ($infoIn == 'C') {
                            $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">False Time</span></td>';
                        } elseif ($infoIn == 'F') {
                            $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">Stupid Time</span></td>';
                        } elseif ($infoIn == 'S') {
                            $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">Sakit</span></td>';
                        } elseif ($infoIn == 'I') {
                            $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">Izin</span></td>';
                        } elseif ($infoIn == 'P') {
                            $statusIn = '<td class="priority"><span class="badge bg-danger text-uppercase">Pergi</span></td>';
                        }
                    } else {
                        $timeIn = "Not Yet";
                    }

                    if ($row_stu_loop['_timeOut']) {
                        $timeOut = $row_stu_loop['_timeOut'];
                        $infoOut = $row_stu_loop['_infoOut'];
                        if ($infoOut == 'M') {
                            $statusOut = '<td class="priority"><span class="badge bg-success text-uppercase">Normal</span></td>';
                        } elseif ($infoOut == 'C') {
                            $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">False Time</span></td>';
                        } elseif ($infoOut == 'B') {
                            $statusOut = '<td class="priority"><span class="badge bg-info text-uppercase">To Late</span></td>';
                        } elseif ($infoOut == 'F') {
                            $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">Stupid Time</span></td>';
                        } elseif ($infoOut == 'S') {
                            $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">Sakit</span></td>';
                        } elseif ($infoOut == 'I') {
                            $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">Izin</span></td>';
                        } elseif ($infoOut == 'P') {
                            $statusOut = '<td class="priority"><span class="badge bg-danger text-uppercase">Pergi</span></td>';
                        }
                    } else {
                        $timeOut = "Not Yet";
                    }
                }

                if ($row_absents['_timeOut'] == "") {
                    echo '<tbody class="list form-check-all">';
                    echo '<tr>';
                    echo '<th scope="row">';
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" name="chk_child" value="option1">';
                    echo '</div>';
                    echo '</th>';
                    echo '<td>' . $row_absents['_date'] . '</td>';
                    echo '<td class="flex-grow-1">' . $row_absents['_timeIn'] . '</td>';
                    echo '<td>';
                    echo '<div class="d-flex">';
                    echo '<div class="flex-grow-1 text-muted">not yet</div>';
                    if ($structure_stu == 'sekertaris_kelas') {
                        echo '<div class="flex-shrink-0 ms-4">';
                        echo '<ul class="list-inline tasks-list-menu mb-0">';
                        echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                        echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                        echo '<li class="list-inline-item">';
                        echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder(deleteOrder({$row_absents['pkabsent']}))'>";
                        echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                    } elseif ($structure_stu == 'ketua_kelas') {
                        echo '<div class="flex-shrink-0 ms-4">';
                        echo '<ul class="list-inline tasks-list-menu mb-0">';
                        echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                        echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                        echo '<li class="list-inline-item">';
                        echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder({$row_absents['pkabsent']})'>";
                        echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                    } else {
                        echo '<div class="flex-shrink-0 ms-4">';
                        echo '<ul class="list-inline tasks-list-menu mb-0">';
                        echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                    }
                    echo '</a>';
                    echo '</li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>' . $row_user['_fullname'] . '</td>';
                    echo '<td>';
                    echo '<div class="avatar-group">';
                    echo '<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                    echo '<img src="' . $imgIn . '" alt="" class="rounded avatar-xxs" />';
                    echo '</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="avatar-group">';
                    echo '<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                    echo '<div class="flex-grow-1 text-muted">not yet</div>';
                    echo '</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="avatar-group">';
                    echo '<a target="_blank" href="https://www.google.com/maps?q=' . $row_absents['_latitude'] . ',' . $row_absents['_longitude'] . '" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                    echo '<span class="fs-4 col-xl-3 col-lg-4 col-sm-6"><i class="bx bxs-map"></i></span>';
                    echo '</a>';
                    echo '</div>';
                    echo '</td>';
                    echo $statusIn;
                    echo '</td>';
                    echo '<td class="flex-grow-1 text-muted">not yet</td>';
                    echo '</tr>';
                    echo '</tbody>';
                }
                if ($row_absents['_timeOut'] != "") {
                    echo '<tbody class="list form-check-all">';
                    echo '<tr>';
                    echo '<th scope="row">';
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" name="chk_child" value="option1">';
                    echo '</div>';
                    echo '</th>';
                    echo '<td>' . $row_absents['_date'] . '</td>';
                    echo '<td class="flex-grow-1">' . $row_absents['_timeIn'] . '</td>';
                    echo '<td>';
                    echo '<div class="d-flex">';
                    echo '<div class="flex-grow-1">' . $row_absents['_timeOut'] . '</div>';
                    if ($structure_stu == 'sekertaris_kelas') {
                        echo '<div class="flex-shrink-0 ms-4">';
                        echo '<ul class="list-inline tasks-list-menu mb-0">';
                        echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                        echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                        echo '<li class="list-inline-item">';
                        echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder({$row_absents['pkabsent']})'>";
                        echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                    } elseif ($structure_stu == 'ketua_kelas') {
                        echo '<div class="flex-shrink-0 ms-4">';
                        echo '<ul class="list-inline tasks-list-menu mb-0">';
                        echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                        echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                        echo '<li class="list-inline-item">';
                        echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder({$row_absents['pkabsent']})'>";
                        echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                    } else {
                        echo '<div class="flex-shrink-0 ms-4">';
                        echo '<ul class="list-inline tasks-list-menu mb-0">';
                        echo '<li class="list-inline-item"><a href="sekertaris-absent-detail.php?pk=' . $pkabsent . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                        echo '</li>';
                    }
                    echo '</a>';
                    echo '</li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>' . $row_user['_fullname'] . '</td>';
                    echo '<td>';
                    echo '<div class="avatar-group">';
                    echo '<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                    echo '<img src="' . $imgIn . '" alt="" class="rounded avatar-xxs" />';
                    echo '</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="avatar-group">';
                    echo '<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                    echo '<img src="' . $imgOut . '" alt="" class="rounded avatar-xxs" />';
                    echo '</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="avatar-group">';
                    echo '<a target="_blank" href="https://www.google.com/maps?q=' . $row_absents['_latitude'] . ',' . $row_absents['_longitude'] . '" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="' . $row_user['_user'] . '">';
                    echo '<span class="fs-4 col-xl-3 col-lg-4 col-sm-6"><i class="bx bxs-map"></i></span>';
                    echo '</a>';
                    echo '</div>';
                    echo '</td>';
                    echo $statusIn;
                    echo '</td>';
                    echo $statusOut;
                    echo '</tr>';
                    echo '</tbody>';
                }
            }
        } else {
            echo '<script>alert("halo")</script>';
        }
    }

    $stmt->close();

    $sql_entry = "SELECT COUNT(*) FROM _absent WHERE _pkcls = $pkcls AND _pkstu = $pkstudent";
    $res_entry = query($sql_entry);
    $row_entry = mysqli_fetch_row($res_entry);
    $total_entry = $row_entry[0];

    $sql_count = "SELECT COUNT(*) FROM _student WHERE _pkcls = $pkcls";
    $res_count = query($sql_count);
    $row_count = mysqli_fetch_row($res_count);
    $total_count = $row_count[0];

    $pending = $total_count - $total_entry;
}
?>