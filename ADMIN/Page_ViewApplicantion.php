<?php

$page = 'Dashboards';

include('includes/header.php');

?>


<style>
.flex-box {
    display: flex !important;
    justify-content: space-between !important;

}

.box {
    border: 2px solid black !important;
    padding: 10px !important;
    width: 100% !important;
    margin: 10px !important;
    border-bottom: 2px solid rgba(22, 22, 26, 0.18);
    box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;

}

</style>



<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header">
            <div class="flex-box" style="display:flex; justify-content:space-between">
                <h3 class="mb-0">Now Serving</h3>
                <div>

                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="flex-box">
                <div class="box">

                </div>
                <div class="box"></div>
                <div class="box"></div>

            </div>




        </div>
    </div>
</div>

<?php
include('includes/footer.php');

include('includes/script.php');

?>
