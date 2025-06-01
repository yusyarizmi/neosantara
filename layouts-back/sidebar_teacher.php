<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu border-end">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Light Logo-->
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="../assets/images/meme/favicon.ico" alt="" height="22">
            </span>
            <span class="logo-lg">
                <h3 class="fw-semibold logo-height"><span class="text-danger">Neo</span> Santara</h3>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title title"><i class="ri-more-fill"></i> <span>Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php">
                        <i class="bx bx bxs-home"></i> <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="" class="nav-link">Subjects List</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Classes List</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="menu-title"><i class="ri-more-fill"></i> <span>About</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="../pages-team.php">
                        <i class="ri-team-fill"></i> <span>Team</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<style>
    .logo-height {
        height: 65px;
        line-height: 65px;
    }

    .title {
        margin-top: -1px;
    }
</style>