<!--
    Succeesfull page without any error with SOP features
 -->

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
include 'action/config.php';

if (!isset($_SESSION['noToken'])) {
    header("location:ver-signup.php");
}

$fullname = $username = $password = $class = $structure = $level = "";
$fullname_err = $username_err = $password_err = $class_err = $structure_err = $level_err = "";

$student = isset($_GET['from']) && $_GET['from'] === 'studentup';
$teacher = isset($_GET['from']) && $_GET['from'] === 'teacherup';
$admin = isset($_GET['from']) && $_GET['from'] === 'adminup';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $conn->real_escape_string($_POST['txtFullname']);
    $username = $conn->real_escape_string($_POST['txtUsername']);
    $password = $conn->real_escape_string($_POST['txtPassword']);

    if ($student) {
        $class = $_POST['class'];
        $structure = $_POST['structure'];
    }
    if ($teacher) {
        $level = $_POST['level'];
    }

    if (empty($fullname)) {
        $fullname_err = "Silahkan masukkan fullname";
    }

    if (empty($username)) {
        $username_err = "Silahkan masukkan username";
    }

    if (empty($password)) {
        $password_err = "Silahkan masukkan password";
    }

    if ($class == 'Select your class at school') {
        $class_err = "Silahkan pilih kelas";
    }

    if ($structure == 'Select your level at class') {
        $structure_err = "Silahkan pilih level";
    }

    if ($level == 'Select your level at school') {
        $level_err = "Silahkan pilih level";
    }

    if (empty($fullname_err) && empty($username_err) && empty($password_err) && empty($class_err) && empty($structure_err) && empty($level_err)) {
        if ($student) {
            $sql = "INSERT INTO _student(_fullname, _user, _email, _mobno, _password, _structure, _pkcls) VALUES('$fullname', '$username', NULL, NULL, '$password', '$structure', '$class')";
        } elseif ($teacher) {
            $sql = "INSERT INTO _teacher(_fullname, _user, _email, _mobno, _password, _level) VALUES('$fullname', '$username', NULL, NULL, '$password', '$level')";
        } elseif ($admin) {
            $sql = "INSERT INTO _admin(_fullname, _user, _email, _mobno, _password) VALUES('$fullname', '$username', NULL, NULL, '$password')";
        }

        $res = query($sql);

        if ($res) {
            $_SESSION['txtUsername'] = $username;
            $_SESSION['txtFullname'] = $fullname;
            if ($student) {
                header("Location: auth-signin.php?from=studentin");
            } elseif ($teacher) {
                header("Location: auth-signin.php?from=teacherin");
            } elseif ($admin) {
                header("Location: auth-signin.php?from=adminin");
            }
            session_destroy();
        }
    }
}
?>

<head>

    <?php
    if (isset($_GET['from']) && $_GET['from'] === 'studentup') {
        echo "<title>Student Sign Up | Neosantara</title>";
    } elseif (isset($_GET['from']) && $_GET['from'] === 'teacherup') {
        echo "<title>Teacher Sign Up | Neosantara</title>";
    } elseif (isset($_GET['from']) && $_GET['from'] === 'adminup') {
        echo "<title>Admin Sign Up | Neosantara</title>";
    } else {
        header("Location: ver-signup.php");
    }
    ?>

    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="icon" href="assets/images/meme/favicon.ico">

</head>

<!--  -->
<?php include 'layouts/body.php'; ?>
<!--  -->

<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden m-0 card-bg-fill border-0 card-border-effect-none">
                        <div class="row justify-content-center g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg acc h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <h4 class="fw-semibold mb-3 lh-base"><span class="text-danger">Neo</span> Santara</h4>
                                        </div>
                                        <div class="mt-auto">
                                            <div class="mb-3">
                                                <i class="ri-double-quotes-l display-4 text-success"></i>
                                            </div>

                                            <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>
                                                <div class="carousel-inner text-center text-white pb-5">
                                                    <div class="carousel-item active">
                                                        <p class="fs-15 fst-italic">" Jadilah seperti Internet of Things, tetap terhubung dengan dirimu sendiri "</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" Jika komputermu bisa diperbaharui, mengapa tidak dengan dirimu "</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" Di era 4.0, bukan kecepatan yang penting tapi kemampuan untuk beradaptasi "</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Register Account</h5>
                                        <p class="text-muted">Get your Free Neosantara account now.</p>
                                    </div>

                                    <div class="mt-4">
                                        <form action="" method="post">

                                            <div class="mb-3">
                                                <label for="fullname" class="form-label">Fullname</label>
                                                <input type="text" id="fullname" name="txtFullname" class="form-control" placeholder="Enter fullname" autocomplete="off">
                                                <span class="text-danger"><?php echo $fullname_err; ?></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" id="username" name="txtUsername" class="form-control" placeholder="Enter username" autocomplete="off">
                                                <span class="text-danger"><?php echo $username_err; ?></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="position-relative auth-pass-inputgroup">
                                                    <input type="password" id="password" name="txtPassword" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password" aria-describedby="passwordInput">
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                                                    <span class="text-danger"><?php echo $password_err; ?></span>
                                                </div>
                                            </div>

                                            <?php
                                            if ($student) {
                                                echo
                                                '
                                                <div class="mb-3">
                                                <label class="form-label">Class</label>
                                                <select class="form-select" name="class">
                                                <option selected>Select your class at school</option> 
                                                ';
                                            }

                                            $class = "SELECT * FROM _class ORDER BY pkcls ASC";
                                            $result = query($class);

                                            if ($student) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row['pkcls'] . "'>" . $row['cls_name'] . "</option>";
                                                }

                                                echo
                                                '
                                                        </select>
                                                        <span class="text-danger">' . $class_err . '</span>
                                                        </div>

                                                        <div class="mb-3">
                                                        <label class="form-label">Level</label>
                                                        <select class="form-select" name="structure">
                                                        <option selected>Select your level at class</option>
                                                        <option value="wali_kelas">Wali Kelas</option>
                                                        <option value="siswa_biasa">Siswa Biasa</option>
                                                        <option value="ketua_kelas">Ketua Kelas</option>
                                                        <option value="bendahara_kelas">Bendahara Kelas</option>
                                                        <option value="sekertaris_kelas">Sekertaris Kelas</option>
                                                        </select>
                                                        <span class="text-danger">' . $structure_err . '</span>
                                                        </div>
                                                ';
                                            } elseif ($teacher) {
                                                echo
                                                '
                                                        <div class="mb-3">
                                                        <label class="form-label">Level</label>
                                                        <select class="form-select" name="level">
                                                        <option selected>Select your level at school</option>
                                                        <option value="guru_mapel">Guru Mapel</option>
                                                        </select>
                                                        <span class="text-danger">' . $level_err . '</span>
                                                        </div>
                                                ';
                                            }
                                            ?>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Sign Up</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p class="mb-0">Already have an account ? <a href="auth-signin.php" class="fw-semibold text-primary text-decoration-underline"> Signin</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">&copy; <script>
                                document.write(new Date().getFullYear())
                            </script> Neosantara. Crafted with <i class="mdi mdi-heart text-danger"></i> by Futurecode</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/libs/cleave.js/cleave.min.js"></script>
<script src="assets/js/pages/form-validation.init.js"></script>
<script src="assets/js/pages/passowrd-create.init.js"></script>
<script src="assets/js/pages/form-masks.init.js"></script>
</body>

</html>