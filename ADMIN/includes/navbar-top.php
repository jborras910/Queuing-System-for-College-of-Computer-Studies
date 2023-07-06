<style>
.navbar-expand {

    background: #292929 !important;

}

.myemail {
    color: #fae80e !important;
    font-weight: 600 !important;
}

.navbar img {
    width: 100% !important;
}

.faculty_image-nav {
    border: 2px solid #fae80e !important;
    padding: 1px !important;

    max-width: 40px !important;
    max-height: 40px !important;
    border-radius: 50% !important;

}

@media screen and (max-width: 1000px) {


    .navbar img {
        display: none !important;
    }

}

</style>



<nav class="sb-topnav navbar navbar-expand navbar-dark bg-light ">
    <!-- Navbar Brand-->

    <a class="navbar-brand " href="index.php"><img src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt=""></a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <span class="mr-2 d-none d-lg-inline text-light small"></span>
        </div>
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span class="mr-1 myemail"><?php echo $_SESSION['auth_user']['email']?></span>
                <img class="faculty_image-nav"
                    src="upload_image_faculty/<?php echo $_SESSION['auth_user']['faculty_image']?>" alt="">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

        </li>
        <li><a type="button" data-toggle="modal" data-target="#logoutModal" class="dropdown-item">Logout</a>
        </li>
    </ul>
    </li>
    </ul>
</nav>
<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ALERT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="x_btn" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to sign-out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" href="logout.php" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>
