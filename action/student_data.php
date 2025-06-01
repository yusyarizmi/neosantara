<?php include '../layouts-back/session.php'; ?>

<?php
include '../action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

$username = $_SESSION['txtUsername'];

$action = $_POST['action'];
$conn = get_connection();

if ($action != 'fullname') {

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
        $sql_students = "SELECT * FROM _student WHERE _pkcls = $pkcls ORDER BY pkstudent";
        $res_students = query($sql_students);

        if ($res_students->num_rows > 0) {
            echo '<thead class="table-light text-muted">';
            echo '<tr>';
            echo '<th scope="col" style="width: 40px;">';
            echo '<div class="form-check">';
            echo '<input class="form-check-input" type="checkbox" id="checkAll" value="option">';
            echo '</div>';
            echo '</th>';
            echo '<th>Username</th>';
            echo '<th>Fullname</th>';
            echo '<th>Email</th>';
            echo '<th>Phone</th>';
            echo '<th>Structure</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
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

        if ($res_students->num_rows > 0) {
            while ($row_students = $res_students->fetch_assoc()) {

                $structure = $row_students['_structure'];
                if ($structure == 'siswa_biasa') {
                    $lev = '<td class="priority"><span class="badge bg-success text-uppercase">Anggota Kelas</span></td>';
                } elseif ($structure == 'ketua_kelas') {
                    $lev = '<td class="priority"><span class="badge bg-success text-uppercase">Ketua Kelas</span></td>';
                } elseif ($structure == 'bendahara_kelas') {
                    $lev = '<td class="priority"><span class="badge bg-success text-uppercase">Bendahara Kelas</span></td>';
                } elseif ($structure == 'sekertaris_kelas') {
                    $lev = '<td class="priority"><span class="badge bg-success text-uppercase">Sekertaris Kelas</span></td>';
                }

                if ($row_students['_email'] == '') {
                    $email = '<td class="text-muted">undefined</td>';
                } else {
                    $email = '<td>' . $row_students['_email'] . '</td>';
                }

                if ($row_students['_mobno'] == '') {
                    $mobno = '<td class="text-muted">undefined</td>';
                } else {
                    $mobno = '<td>' . $row_students['_mobno'] . '</td>';
                }

                echo '<tbody class="list form-check-all">';
                echo '<tr>';
                echo '<th scope="row">';
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" name="chk_child" value="option1">';
                echo '</div>';
                echo '</th>';
                echo '<td>' . $row_students['_user'] . '</td>';
                echo '<td class="flex-grow-1">' . $row_students['_fullname'] . '</td>';
                echo $email;
                echo $mobno;
                echo $lev;
                echo '<td>';
                if ($structure_stu == 'sekertaris_kelas') {
                    echo '<ul class="list-inline tasks-list-menu mb-0">';
                    echo '<li class="list-inline-item"><a href="apps-tasks-details.php"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item">';
                    echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder({$row_students['pkstudent']})'>";
                    echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                } elseif ($structure_stu == 'ketua_kelas') {
                    echo '<ul class="list-inline tasks-list-menu mb-0">';
                    echo '<li class="list-inline-item"><a href="apps-tasks-details.php"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                    echo '<li class="list-inline-item">';
                    echo "<a class='remove-item-btn' data-bs-toggle='modal' onclick='deleteOrder({$row_students['pkstudent']})'>";
                    echo '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>';
                } else {
                    echo '<ul class="list-inline tasks-list-menu mb-0">';
                    echo '<li class="list-inline-item"><a href="apps-tasks-details.php"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a>';
                    echo '</li>';
                }
                echo '</a>';
                echo '</li>';
                echo '</ul>';
                echo '</td>';
            }
        }
    } elseif ($action == 'search') {
        $search = $_POST['search'];

        $stmt = $conn->prepare("SELECT * FROM _student WHERE _pkcls = ? AND (_fullname LIKE ? OR _user LIKE ?)");
        $searchParam = "%{$search}%";
        $stmt->bind_param("iss", $pkcls, $searchParam, $searchParam);

        $stmt->execute();
        $res_students = $stmt->get_result();

        if ($res_students->num_rows > 0) {
            echo '<thead class="table-light text-muted">';
            echo '<tr>';
            echo '<th scope="col" style="width: 40px;">';
            echo '<div class="form-check">';
            echo '<input class="form-check-input" type="checkbox" id="checkAll" value="option">';
            echo '</div>';
            echo '</th>';
            echo '<th>Username</th>';
            echo '<th>Fullname</th>';
            echo '<th>Email</th>';
            echo '<th>Phone</th>';
            echo '<th>Structure</th>';
            echo '</tr>';
            echo '</thead>';
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

        if ($res_students->num_rows > 0) {
            while ($row_students = $res_students->fetch_assoc()) {

                $structure = $row_students['_structure'];
                if ($structure == 'siswa_biasa') {
                    $lev = '<td class="priority"><span class="badge bg-success text-uppercase">Anggota Kelas</span></td>';
                } elseif ($structure == 'ketua_kelas') {
                    $lev = '<td class="priority"><span class="badge bg-success text-uppercase">Ketua Kelas</span></td>';
                } elseif ($structure == 'bendahara_kelas') {
                    $lev = '<td class="priority"><span class="badge bg-success text-uppercase">Bendahara Kelas</span></td>';
                } elseif ($structure == 'sekertaris_kelas') {
                    $lev = '<td class="priority"><span class="badge bg-success text-uppercase">Sekertaris Kelas</span></td>';
                }

                if ($row_students['_email'] == '') {
                    $email = '<td class="text-muted">undefined</td>';
                } else {
                    $email = '<td>' . $row_students['_email'] . '</td>';
                }

                if ($row_students['_mobno'] == '') {
                    $mobno = '<td class="text-muted">undefined</td>';
                } else {
                    $mobno = '<td>' . $row_students['_mobno'] . '</td>';
                }

                echo '<tbody class="list form-check-all">';
                echo '<tr>';
                echo '<th scope="row">';
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" name="chk_child" value="option1">';
                echo '</div>';
                echo '</th>';
                echo '<td>' . $row_students['_user'] . '</td>';
                echo '<td class="flex-grow-1">' . $row_students['_fullname'] . '</td>';
                echo $email;
                echo $mobno;
                echo $lev;
            }
        }
    }
}

if ($action == 'fullname') {
    $sql_fullname = "SELECT pkstudent, _fullname FROM _student ORDER BY _fullname ASC";
    $res_fullname = query($sql_fullname);

    if ($res_fullname->num_rows > 0) {
        while ($row_fullname = $res_fullname->fetch_assoc()) {
            echo '<li id="valueName" data-pkstudent=" ' . $row_fullname['pkstudent'] . ' " class="dropdown-item d-flex"><div class="flex-grow-1"><div class="d-flex"><div class="country-name me-1">' . $row_fullname['_fullname'] . '</div></div></div></li>';
        }
    }
}
