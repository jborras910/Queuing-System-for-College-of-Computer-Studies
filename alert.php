<style>
@-webkit-keyframes shake-vertical {

    0%,
    100% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }

    10%,
    30%,
    50%,
    70% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
    }

    20%,
    40%,
    60% {
        -webkit-transform: translateY(8px);
        transform: translateY(8px);
    }

    80% {
        -webkit-transform: translateY(6.4px);
        transform: translateY(6.4px);
    }

    90% {
        -webkit-transform: translateY(-6.4px);
        transform: translateY(-6.4px);
    }
}

@keyframes shake-vertical {

    0%,
    100% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }

    10%,
    30%,
    50%,
    70% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
    }

    20%,
    40%,
    60% {
        -webkit-transform: translateY(8px);
        transform: translateY(8px);
    }

    80% {
        -webkit-transform: translateY(6.4px);
        transform: translateY(6.4px);
    }

    90% {
        -webkit-transform: translateY(-6.4px);
        transform: translateY(-6.4px);
    }
}

.message {

    -webkit-animation: shake-vertical 0.8s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
    animation: shake-vertical 0.8s cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
    text-align: center;
    box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;
    background: #b00020 !important;
    color: white;
    margin-top: 14px;
    border-radius: 0px !important;
    padding: 10px;
    margin-bottom: 15px;


}

.message h6 {
    font-size: 15px;
    color: white !important;
    padding: 0px !important;


}

@media screen and (max-width: 1000px) {
    .message {
        border-radius: 10px !important;
        width: 100% !important;
        background: #b00020 !important;
        padding: 10px !important;

        font-size: 20px;
        font-weight: 600 !important;
        margin: 10px auto;



    }

    .message h6 {
        margin: 0 !important;
        padding: 0 !important;
        width: 100%;
        color: white !important;

    }
}

</style>

<style>
.custom-btn {
    background: #292929 !important;
    color: #fae80e !important;
}

</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





<?php if(isset($_SESSION['status']) && $_SESSION['status'] !='') :?>


<script>
Swal.fire({
    title: "<?php echo $_SESSION['status'];?>",
    icon: "<?php echo $_SESSION['status_code']; ?>",
    confirmButtonText: 'DONE',
    customClass: {
        confirmButton: 'custom-btn' // Add the custom CSS class to the confirm button
    }
})
</script>


<?php
unset($_SESSION['status']);
endif; ?>
