<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
include 'action/config.php';

$student = isset($_GET['from']) && $_GET['from'] === 'student';
$teacher = isset($_GET['from']) && $_GET['from'] === 'teacher';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $digit1 = isset($_POST['digit1']) ? $_POST['digit1'] : '';
    $digit2 = isset($_POST['digit2']) ? $_POST['digit2'] : '';
    $digit3 = isset($_POST['digit3']) ? $_POST['digit3'] : '';
    $digit4 = isset($_POST['digit4']) ? $_POST['digit4'] : '';

    if (!empty($digit1) && !empty($digit2) && !empty($digit3) && !empty($digit4)) {
        if (ctype_digit($digit1) && ctype_digit($digit2) && ctype_digit($digit3) && ctype_digit($digit4)) {
            $safeToken = ($digit1 . $digit2 . $digit3 . $digit4);

            if ($student) {
                $sql = "SELECT id FROM student_tokens WHERE token_value='$safeToken'";
            } elseif ($teacher) {
                $sql = "SELECT id FROM teacher_tokens WHERE token_value='$safeToken'";
            }

            $res = query($sql, true);

            if ($res) {
                session_start();
                $_SESSION[$safeToken] = $res['token_value'];
                $_SESSION['noToken'] = $safeToken;
                if ($student) {
                    header("Location: auth-signup.php?from=studentup");
                } elseif ($teacher) {
                    header("Location: auth-signup.php?from=teacherup");
                }
            } else {
                $error = "Kode yang Anda masukkan tidak valid. Silakan coba lagi.";
            }
        } else {
            $error = "Kode harus berupa angka.";
        }
    } else {
        $error = "Harap isi semua digit kode.";
    }
}
?>

<head>

    <?php
    if (isset($_GET['from']) && $_GET['from'] === 'student') {
        echo "<title>Student | Neosantara</title>";
    } elseif (isset($_GET['from']) && $_GET['from'] === 'teacher') {
        echo "<title>Teacher | Neosantara</title>";
    } else {
        header("Location: ver-signup.php");
    }
    ?>

    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="icon" href="assets/images/meme/favicon.ico">
</head>

<?php include 'layouts/body.php'; ?>

<div class="auth-page-wrapper pt-5">

    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <h2 class="fw-semibold"><span class="text-danger">Neo</span> Santara</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4">
                            <div class="mb-4">
                                <div class="avatar-lg mx-auto">
                                    <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                        <i class="ri-mail-line"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="p-2 mt-4">
                                <div class="text-muted text-center mb-4 mx-lg-3">
                                    <h4 class="">Are You Sure? 🤨</h4>
                                    <p>Please enter the 4 digit code from <span class="fw-semibold">Administrator</span></p>
                                </div>

                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="digit1-input" class="visually-hidden">Digit 1</label>
                                                <input type="text" name="digit1" class="form-control form-control-lg bg-light border-light text-center" maxLength="1" id="digit1" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="digit2-input" class="visually-hidden">Digit 2</label>
                                                <input type="text" name="digit2" class="form-control form-control-lg bg-light border-light text-center" maxLength="1" id="digit2" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="digit3-input" class="visually-hidden">Digit 3</label>
                                                <input type="text" name="digit3" class="form-control form-control-lg bg-light border-light text-center" maxLength="1" id="digit3" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="digit4-input" class="visually-hidden">Digit 4</label>
                                                <input type="text" name="digit4" class="form-control form-control-lg bg-light border-light text-center" maxLength="1" id="digit4" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success w-100">Confirm</button>
                                    </div>
                                </form>
                                <div class="mt-4 text-danger text-center"><?php echo $error; ?></div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-4 text-center">
                        <p class="mb-0">Get code from Administrator ? <a href="auth-pass-reset-basic.php" class="fw-semibold text-primary text-decoration-underline">Contact</a> </p>
                    </div>

                </div>
            </div>

        </div>

    </div>


    <footer class="footer start-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy; <script>
                                document.write(new Date().getFullYear())
                            </script> Neosantara. Crafted with <i class="mdi mdi-heart text-danger"></i> by Futurecode</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/libs/particles.js/particles.js"></script>
<!-- <script src="assets/js/pages/particles.app.js"></script> -->
<script src="assets/js/pages/two-step-verification.init.js"></script>
<script>
    var currentDigit = 1;

    document.getElementById('digit1').addEventListener('input', function() {
        if (this.value.length === 1) {
            document.getElementById('digit2').disabled = false;
            document.getElementById('digit2').focus();
            currentDigit = 2;
        }
    });

    document.getElementById('digit2').addEventListener('input', function() {
        if (this.value.length === 1) {
            document.getElementById('digit3').disabled = false;
            document.getElementById('digit3').focus();
            currentDigit = 3;
        } else if (this.value.length === 0 && currentDigit > 1) {
            document.getElementById('digit1').focus();
            currentDigit = 1;
        }
    });

    document.getElementById('digit3').addEventListener('input', function() {
        if (this.value.length === 1) {
            document.getElementById('digit4').disabled = false;
            document.getElementById('digit4').focus();
            currentDigit = 4;
        } else if (this.value.length === 0 && currentDigit > 2) {
            document.getElementById('digit2').focus();
            currentDigit = 2;
        }
    });

    document.getElementById('digit4').addEventListener('input', function() {
        if (this.value.length === 1) {
            currentDigit = 4;
        } else if (this.value.length === 0 && currentDigit > 3) {
            document.getElementById('digit3').focus();
            currentDigit = 3;
        }
    });
</script>
</body>

</html>