<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
$_SESSION = array();
session_destroy();
?>

<head>

    <title>Log Out | Neosantara</title>
    <link rel="icon" href="assets/images/meme/favicon.ico">

    <?php include 'layouts/head-css.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<div class="auth-page-wrapper pt-5">
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <a href="index.php"><h2 class="fw-semibold"><span class="text-danger">Neo</span> Santara</h2></a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">
                        <div class="card-body p-4 text-center">
                            <lord-icon src="https://cdn.lordicon.com/hzomhqxz.json" trigger="loop" colors="primary:#8c68cd,secondary:#4788ffs" style="width:180px;height:180px">
                            </lord-icon>
                            <div class="mt-4 pt-2">
                                <h5>You are Logged Out</h5>
                                <p class="text-muted">Thank you for using <span class="fw-semibold">Neosantara</span> web class</p>
                                <div class="mt-4">
                                    <a href="auth-signin.php" class="btn btn-primary w-100">Sign In</a>
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
<!-- particles js -->
<script src="assets/libs/particles.js/particles.js"></script>
<!-- particles app js -->
<!-- <script src="assets/js/pages/particles.app.js"></script> -->
</body>

</html>