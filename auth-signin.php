<!--
    Succeesfull page without any error with SOP features
 -->

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
include 'action/config.php';

$username = $password = $res = "";
$username_err = $password_err = $res_err = "";

$student = isset($_GET['from']) && $_GET['from'] === 'studentin';
$teacher = isset($_GET['from']) && $_GET['from'] === 'teacherin';
$admin = isset($_GET['from']) && $_GET['from'] === 'adminin';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['txtUsername']);
    $password = $conn->real_escape_string($_POST['txtPassword']);

    if (empty($username)) {
        $username_err = "Silahkan masukkan username Anda.";
    }

    if (empty($password)) {
        $password_err = "Silahkan masukkan password Anda.";
    }

    if (empty($username_err) && empty($password_err)) {
        if ($student) {
            $sql = "SELECT _uid,_fullname,_pkcls,_structure FROM _student WHERE _user='$username' AND _password='$password'";
            $level = 3;
        } elseif ($teacher) {
            $sql = "SELECT _fullname FROM _teacher WHERE _user='$username' AND _password='$password'";
            $level = 2;
        } elseif ($admin) {
            $sql = "SELECT _fullname FROM _admin WHERE _user='$username' AND _password='$password'";
            $level = 1;
        }
        $res = query($sql, true);
    }

    if ($res) {
        $_SESSION['txtUsername'] = $username;
        $_SESSION['level'] = $level;
        $_SESSION['noUid'] = $res['_uid'];
        $_SESSION['txtFullname'] = $res['_fullname'];
        $_SESSION['pkCls'] = $res['_pkcls'];
        $_SESSION['txtStructure'] = $res['_structure'];

        echo "<script>localStorage.setItem('modal', 'login_success');window.location.href = 'index.php';</script>";
    } elseif (empty($username_err) && empty($password_err)) {
        $res_err = "Masukkan password dan username yang benar.";
    }
}
?>

<head>

    <?php
    if (isset($_GET['from']) && $_GET['from'] === 'studentin') {
        echo "<title>Student Sign In | Neosantara</title>";
    } elseif (isset($_GET['from']) && $_GET['from'] === 'teacherin') {
        echo "<title>Teacher Sign In | Neosantara</title>";
    } elseif (isset($_GET['from']) && $_GET['from'] === 'adminin') {
        echo "<title>Admin Sign In | Neosantara</title>";
    } else {
        header("Location: ver-signin.php");
    }
    ?>

    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="icon" href="assets/images/meme/favicon.ico">

</head>

<?php include 'layouts/body.php'; ?>

<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden card-bg-fill border-0 card-border-effect-none">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 auth-one-bg p-4 acc h-100">
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
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to Neosantara.</p>
                                    </div>
                                    <div class="mt-4">
                                        <form action="" method="post">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" id="username" name="txtUsername" class="form-control" placeholder="Enter username" autocomplete="off">
                                                <span class="text-danger"><?php echo $username_err; ?></span>
                                                <span class="text-danger"><?php echo $res_err; ?></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" id="password" name="txtPassword" class="form-control pe-5 password-input" placeholder="Enter password" autocomplete="off">
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    <span class="text-danger"><?php echo $password_err; ?></span>
                                                    <span class="text-danger"><?php echo $res_err; ?></span>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <p class="mb-0">Don't have an account ? <a href="auth-signup.php" class="fw-semibold text-primary text-decoration-underline"> Signup</a> </p>
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
<script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>