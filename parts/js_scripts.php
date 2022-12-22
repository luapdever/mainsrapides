<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
<!-- inject:js -->
<script src="js/vendor/jquery/jquery-1.12.3.js"></script>
<script src="js/vendor/jquery/popper.min.js"></script>
<script src="js/vendor/jquery/uikit.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/vendor/chart.bundle.min.js"></script>
<script src="js/vendor/grid.min.js"></script>
<script src="js/vendor/jquery-ui.min.js"></script>
<script src="js/vendor/jquery.barrating.min.js"></script>
<script src="js/vendor/jquery.countdown.min.js"></script>
<script src="js/vendor/jquery.counterup.min.js"></script>
<script src="js/vendor/jquery.easing1.3.js"></script>
<script src="js/vendor/owl.carousel.min.js"></script>
<script src="js/vendor/slick.min.js"></script>
<script src="js/vendor/tether.min.js"></script>
<script src="js/vendor/trumbowyg.min.js"></script>
<script src="js/vendor/waypoints.min.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/main.js"></script>

<!-- This is data table -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/modules/datatables/datatables.min.js"></script>

<script src="js/sweetalert/sweetalert.min.js"></script>
<!-- endinject -->


<script>
    $(document).ready(function() {
        var auto_func = function() {
            $.ajax({
                url:'auto/auto.php',
                method: 'POST',
                dataType: "json",
                success: (data) => {
                    if(data === "success") {
                        
                    }
                }
            })
        };
        
        auto_func();

        setInterval(function() {
            auto_func();
        }, 3000);
    });
</script>

<?php if(isset($_SESSION["email"])): ?>
<script>
    $(document).ready(function() {
        var rec_msg = function() {
            $.ajax({
                url:'tables/message/message-fetch.php',
                method: 'POST',
                data: { "user_id": <?= $_SESSION['id'] ?> },
                dataType: "json",
                success: (data) => {
                    $("#messages_list").html(data);
                }
            })

            $.ajax({
                url:'tables/message/count_message.php',
                method: 'POST',
                data: { "user_id": <?= $_SESSION['id'] ?> },
                dataType: "json",
                success: (data) => {
                    $("#count_msg").html(data);
                }
            })
        };

        var rec_notif = function() {
            $.ajax({
                url:'notification/notification-fetch.php',
                method: 'POST',
                data: { "user_id": <?= $_SESSION['id'] ?> },
                dataType: "json",
                success: (data) => {
                    $("#notifications_list").html(data);
                }
            })

            $.ajax({
                url:'notification/count_notification.php',
                method: 'POST',
                data: { "user_id": <?= $_SESSION['id'] ?> },
                dataType: "json",
                success: (data) => {
                    $("#count_notif").html(data);
                }
            })
        };

        rec_msg();
        rec_notif();

        setInterval(function() {
            rec_msg();
            rec_notif();
        }, 3000);

        $(document).on("click", ".seen_notif", function(e) {
            e.preventDefault();
            $.ajax({
                url:'notification/notification-action.php',
                method: 'POST',
                data: {
                    "idnoti": $(this).attr("idnoti"),
                    "btn_action": "seen"
                },
                dataType: "json",
                success: (data) => {
                    if(data != "") {
                        window.location = data;
                    }
                }
            })
        })
    });
</script>
<?php endif; ?>