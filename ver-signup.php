<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Who Are You🤔 | Neosantara</title>

    <?php include 'layouts/head-css.php'; ?>
    <link rel="icon" href="assets/images/meme/favicon.ico">

</head>

<?php include 'layouts/body.php'; ?>

<div class="auth-page-wrapper pt-5">

    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center pt-4">
                        <div class="">
                            <img src="assets/images/meme/favicon.ico" alt="" class="error-basic-img move-animation">
                        </div>
                        <div class="mt-n4">
                            <h1 class="display-1 fw-medium">Oops !</h1>
                            <h3 class="text-uppercase">sorry, who are you 😎</h3>
                            <p class="text-muted mb-4">Jika kamu wali kelas kamu tetap memilih sebagai siswa 😊</p>
                            <a href="token.php?from=student" class="btn btn-success"><i class="ri-team-line me-1"></i>I'm a student</a>
                            <a href="token.php?from=teacher" class="btn btn-danger"><i class="ri-team-line me-1"></i>I'm a teacher</a>
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

</body>

</html>