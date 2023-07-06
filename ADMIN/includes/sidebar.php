<style>
.accordion {
    background: #292929 !important;

}

.nav .active_nav {
    color: #fae80e !important;

}

.sb-sidenav-footer {
    background: #ffc20f !important;
    color: #292929 !important;
    font-weight: 600 !important;
}

.faculty_image_nav {
    margin-top: 40px !important;
    max-width: 90px !important;
    max-height: 80px !important;
    border: 2px solid #fae80e !important;
    padding: 5px !important;
    box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;


}


.reservation_count {

    margin-left: 20% !important;
    color: #fae80e !important;
    border-radius: 50% !important;

}

</style>







<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">





                <div class="text-center">
                    <img src="upload_image_faculty/<?php echo $_SESSION['auth_user']['faculty_image']; ?>" alt="..."
                        class="faculty_image_nav rounded-circle border mb-3">
                    <br>
                    <label
                        for=""><?php echo $_SESSION['auth_user']['first_name']." ".$_SESSION['auth_user']['middle_name']." ".$_SESSION['auth_user']['last_name'];?></label>
                    <br>
                    <label for=""><?php echo $_SESSION['auth_user']['role'] ?></label>

                </div>
                <hr>



                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link <?php if($page=='Dashboards'){echo 'active_nav';}?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboards
                </a>

                <hr>

                <a class="nav-link <?php if($page=='Profile_page'){echo 'active_nav';}?>" href="Page_profile.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Profile
                </a>



                <?php if($_SESSION['auth_user']['role'] != 'Main Admin'):?>
                <hr>
                <a class="nav-link <?php if($page=='reservation'){echo 'active_nav';}?>" href="Page_reservation.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-check-to-slot"></i></div>
                    Reservation


                    <span class="reservation_count">

                        <?php 

                        $faculty = $_SESSION['auth_user']['email'];
                    $query = "SELECT COUNT(`id`) AS reserve_total FROM `queing_table` WHERE `reserve`='true' AND faculty='$faculty' ORDER BY`reserve`;";
                    $query_run = mysqli_query($conn,$query);
                    // Check if any rows were returned
                    $has_results = (mysqli_num_rows($query_run) > 0);
                                                            
                    // Fetch the result set
                    $row = mysqli_fetch_assoc($query_run);
                    ?>
                        <?php if ($has_results): ?>
                        <?php echo $row['reserve_total'] ?>
                        <?php endif; ?>




                    </span>
                </a>
                <?php endif; ?>



















                <?php if($_SESSION['auth_user']['role'] == 'Main Admin'):?>
                <hr>
                <a class="nav-link <?php if($page=='Faculty'){echo 'active_nav';}?>" href="Page_Faculty.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                    Faculty
                </a>
                <hr>




                <a class="nav-link <?php if($page=='Faculty deleted'){echo 'active_nav';}?>"
                    href="Page_Faculty_Deleted.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-trash"></i></div>
                    Restore Faculties
                </a>
                <hr>















                <a class="nav-link <?php if($page=='Accept_Faculty'){echo 'active_nav';}?>"
                    href="Page_acceptFaculty.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                    Accept Faculty
                </a>


                <?php endif;?>




                <hr>










                <a class="nav-link <?php if($page=='view_consultation_page'){echo 'active_nav';}?>"
                    href="Page_ViewConsultation.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                    Reports
                </a>
                <hr>





                <a class="nav-link <?php if($page=='ActivityLog'){echo 'active_nav';}?>" href="Page_ActivityLog.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                    Activity logs
                </a>
                <hr>
















            </div>
        </div>

    </nav>
</div>
