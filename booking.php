<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Αρχική</title>

    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <!-- σύνδεση με τη css   -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="css/rooms.css">

</head>
<body>

<!-- TODO 1 . HEADER start -->
<?php include 'header.php'; ?>
<!-- HEADER end -->

<?php
if (isset($_POST['formDate'])) {
    //echo "OKAY";
    $start_date = date('Y-m-d', strtotime($_POST['checkin-date']));
    $end_date = date('Y-m-d', strtotime($_POST['checkout-date']));

   // echo $start_date;
    // echo $end_date;
}
?>

<!-- TODO 6. Form -->
<!-- Form -->
<div class="book" >
    <form name="book" class="book-form" action="" onsubmit="return validateDate()" method="POST">
        <div class="form-item">
            <label for="checkin-date">Check In Date: </label>
            <input type="date" id="checkin-date" name="checkin-date" style="text-transform: none;" >
        </div>
        <div class="form-item">
            <label for="checkout-date">Check Out Date: </label>
            <input type="date" id="checkout-date" name="checkout-date" style="text-transform: none;" >
        </div>
        <div class="form-item">
            <input type="submit" class="btn" name="formDate" value="Book Now">
        </div>
    </form>
</div>

<?php
if (isset($_POST['formDate'])) {
    //echo $start_date;
   // echo $end_date;


    include_once 'include/dbh.inc.php';


    $sql = "SELECT distinct roomtype
FROM
    room where room_num not in ( SELECT
            room.room_num
        FROM
            room
        LEFT OUTER JOIN
            reservation ON reservation.room_num = room.room_num
        WHERE (
                -- wished booking date is after or at the DOR date
                date_checked_in BETWEEN '" . $start_date . "' AND  '" . $end_date . "' OR 
                -- OR wished booking date is before the DCO date
                '" . $start_date . "' BETWEEN date_checked_in AND date_checked_out
            ));";

    $result = mysqli_query($conn, $sql);
    $available_rooms = [];

    if ($result) {

        while ($row = mysqli_fetch_assoc($result)) {
            $type = $row['roomtype'];

           // echo "  <td>" . $type . "</td>";
            $available_rooms[] = $type;
        }
    }


    $deluxe = false;
    $single = false;
    $double_room = false;
    foreach ($available_rooms as $value) {
        if ($value == 'Single') {
            $single = true;
        }

        if ($value == 'Deluxe') {
            $double_room = true;
        }

        if ($value == 'Superior') {
            $deluxe = true;
        }
    }
}
?>


<?php
if (isset($_POST['formDate'])) {
    echo "<section id=\"rooms_ok\" class=\"rooms sec-width\">";
} else {
    echo "<section id=\"rooms_ok_hide\" class=\"rooms sec-width\" >";
}
?>
<!-- rooms -->
<div class="title">
    <h2>E L I T E</h2>
</div>
<div class="rooms-container">
    <!-- Standard Μονόκλινο Δωμάτιο room start-->
    <?php
    if ($single === true) {
       // echo "SINGLE YES";
        echo "<article id=\"single\" class=\"room\" style=\"min-height: 50vh\">";
    } else {
    ?>

    <div class="alert" style="background-color: rgb(242,222,222)">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <h2>

            <?php echo "<h1 style='text-transform: none; color: #d22121'>Δεν υπάρχει Standard Μονόκλινο Δωμάτιο διαθέσιμο στις ημερομηνίες που επιλέξατε</h1>";
            ?>

        </h2>
    </div>

    <?php
    echo "<article id='single_hide' class=\"room\" style=\"min-height: 50vh\">";
    }
    ?>
    <div class="room-image">
        <img src="images/img3.jpg" alt="room image">
    </div>
    <div class="room-text">
        <h3>Standard Μονόκλινο Δωμάτιο</h3>
        <ul>
            <li>
                <i class="fas fa-arrow-alt-circle-right" style="color: var(--yellow)"></i>
                <i class="fa-solid fa-person"></i> Max
            </li>
            <li>
                <i class="fas fa-arrow-alt-circle-right" style="color: var(--yellow)"></i>
                <i class="fa-solid fa-bed"></i> | 1 μονό κρεβάτι
            </li>
            <li>
                <i class="fas fa-arrow-alt-circle-right" style="color: var(--yellow)"></i>
                <i class="fa-solid fa-shower sub"></i><i class="fa-solid fa-snowflake"></i><i
                        class="fa-solid fa-wifi"></i><i class="fa-solid fa-toilet"></i>
                <i class="fa-solid fa-wheelchair"></i><i class="fa fa-phone"></i>
            </li>

        </ul>
        <p class="rate">
            <span>45.00€/</span> διανυκτέρευση
        </p>
        <form method="post" action="include/reservationFormClient.php">

            <input type="hidden" name="start_date" value="<?php if (isset($_POST['formDate'])) {
                echo $start_date;
            } ?>">

    <input type="hidden" name="end_date" value="<?php if (isset($_POST['formDate'])) {
        echo $end_date;
    } ?>">
    <input type="hidden" name="first_name" value="Single">
    <input class="btn" type="submit" name="save" value="ΚΡΑΤΗΣΗ">
    </form>


</div>
</article>
<!-- end of single room -->

<!-- Double room -->
<?php
if ($double_room === true) {
    //echo "double room yes";
    echo "<article id=\"double_room\" class=\"room\" style=\"min-height: 50vh\">";
} else {
    ?>

    <div class="alert" style="background-color: rgb(242,222,222)">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <h2>

            <?php echo "<h1 style='text-transform: none; color: #d22121'>Δεν υπάρχει Standard Δίκλινο  Δωμάτιο διαθέσιμο στις ημερομηνίες που επιλέξατε</h1>";
            ?>

        </h2>
    </div>

    <?php
    echo "<article id='double_room_hide' class=\"room\" style=\"min-height: 50vh\">";
}
?>



<div class="room-image">
    <img src="images/img2.jpg" alt="room image">
</div>
<div class="room-text">
    <h3>Standard Δίκλινο Δωμάτιο </h3>
    <ul>
        <li>
            <i class="fas fa-arrow-alt-circle-right" style="color: var(--yellow)"></i>
            <i class="fa-solid fa-person"></i><i class="fa-solid fa-person"></i> Max
        </li>
        <li>
            <i class="fas fa-arrow-alt-circle-right" style="color: var(--yellow)"></i>
            <i class="fa-solid fa-bed"></i> | 1 Διπλό ή 2 Μονά Κρεβάτια
        </li>
        <li>
            <i class="fas fa-arrow-alt-circle-right" style="color: var(--yellow)"></i>
            <i class="fa-solid fa-shower"></i>
            <i class="fa-solid fa-snowflake"></i>
            <i class="fa-solid fa-wifi"></i>
            <i class="fa-solid fa-toilet"></i>
            <i class="fa-solid fa-wheelchair"></i>
            <i class="fa fa-phone"></i>
            <i class="fa-solid fa-tv"></i>
            <i class="fa-solid fa-couch"></i>
        </li>
    </ul>
    <p class="rate">
        <span>60.00€/</span> διανυκτέρευση
    </p>
    <form method="post" action="include/reservationFormClient.php">
        <input type="hidden" name="start_date" value="<?php if (isset($_POST['formDate'])) {
            echo $start_date;
        } ?>">

        <input type="hidden" name="end_date" value="<?php if (isset($_POST['formDate'])) {
            echo $end_date;
        } ?>">
        <input type="hidden" name="first_name" value="Deluxe">
        <input class="btn" type="submit" name="save" value="ΚΡΑΤΗΣΗ">
    </form>
</div>
</article>
<!-- end of double room -->

<!-- Deluxe room -->
<?php
if ($deluxe === true) {
    //echo "Deluxe room yes";
    echo "<article id=\"deluxe_room\" class=\"room\" style=\"min-height: 50vh\">";
} else {
    ?>

    <div class="alert" style="background-color: rgb(242,222,222)">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <h2>

            <?php echo "<h1 style='text-transform: none; color: #d22121'>Δεν υπάρχει Premium Δίκλινο Δωμάτιο διαθέσιμο στις ημερομηνίες που επιλέξατε</h1>";
            ?>

        </h2>
    </div>

    <?php
    echo "<article id='deluxe_room_hide' class=\"room\" style=\"min-height: 50vh\">";
}
?>

    <div class="room-image">
    <img src="images/suite.jpg" alt="room image">
</div>
<div class="room-text">
    <h3>Premium Δίκλινο Δωμάτιο</h3>
    <ul>
        <li>
            <i class="fas fa-arrow-alt-circle-right" style="color: var(--yellow)"></i>
            <i class="fa-solid fa-person"></i><i class="fa-solid fa-person"></i> Max
        </li>
        <li>
            <i class="fas fa-arrow-alt-circle-right" style="color: var(--yellow)"></i>
            <i class="fa-solid fa-bed"></i> | 1 Διπλό ή 2 Μονά Κρεβάτια
        </li>
        <li>
            <i class="fas fa-arrow-alt-circle-right" style="color: var(--yellow)"></i>
            <i class="fa-solid fa-shower"></i>
            <i class="fa-solid fa-snowflake"></i>
            <i class="fa-solid fa-wifi"></i>
            <i class="fa-solid fa-toilet"></i>
            <i class="fa-solid fa-wheelchair"></i>
            <i class="fa fa-phone"></i>
            <i class="fa-solid fa-tv"></i>
            <i class="fa-solid fa-couch"></i>
            <i class="fa-solid fa-computer"></i>
            <i class="fa-solid fa-person-swimming"></i>
            <i class="fa-solid fa-utensils"></i>
        </li>
    </ul>
    <p class="rate">
        <span>114.00€ /</span> διανυκτέρευση
    </p>
    <form method="post" action="include/reservationFormClient.php">
        <input type="hidden" name="start_date" value="<?php if (isset($_POST['formDate'])) {
            echo $start_date;
        } ?>">

        <input type="hidden" name="end_date" value="<?php if (isset($_POST['formDate'])) {
            echo $end_date;
        } ?>">
        <input type="hidden" name="first_name" value="Superior">
        <input class="btn" type="submit" name="save" value="ΚΡΑΤΗΣΗ">
    </form>
</div>
</article>
<!-- end of deluxe room -->
</div>

<?php
if (($single === false) && ($double_room === false) && ($deluxe === false))
    echo "<h1>No available rooms given date</h1>"
?>
</section>
<!-- end rooms -->


<!-- TODO 4. Footer start -->

<section class="footer" style="margin-top: 100px;">

    <div class="box-container">

        <div class="box">
            <h3>Συντομεύσεις</h3>
            <a href="index.php" > <i class="fas fa-angle-right"></i> Αρχική</a>
            <a href="rooms.php"> <i class="fas fa-angle-right"></i> Δωμάτια</a>
            <a href="booking.php"> <i class="fas fa-angle-right"></i> Κράτηση</a>
            <a href="contact.php"> <i class="fas fa-angle-right"></i> Επικοινωνία</a>
        </div>

        <div class="box fontmine">
            <h3>Επικοινωνία</h3>
            <a> <i class="fas fa-phone"></i> +211-000-0000 </a> <!--fa-phone sxedio-->
            <a> <i class="fas fa-envelope"></i> cs161020@uniwa.gr </a>
            <a> <i class="fas fa-envelope"></i> cs161142@uniwa.gr </a>
        </div>

        <div class="box">
            <h3>Ακολούθησέ Μας!</h3>
            <a href="https://gr.linkedin.com/in/paolavlsc98"> <i class="fab fa-linkedin"></i> linkedin </a>
            <a href="https://gr.linkedin.com/in/nikospanagis"> <i class="fab fa-linkedin"></i> linkedin </a>
        </div>

    </div>

    <div class="credit"><span style="text-transform: none;"> created by UniWA |  ΠΑΝΑΓΗΣ ΝΙΚΟΛΑΟΣ cs161142  | ΒΕΛΑΣΚΟ ΠΑΟΛΑ cs161020 </span>
    </div>

</section>

<!-- Footer end -->


<!-- σύνδεση με τη javascript   -->

<!-- enable jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>$(document).ready(function () {

        $('#rooms_ok').show();
        $('#rooms_ok_hide').hide();
        $('#single').show();
        $('#single_hide').hide();
        $('#double_room').show();
        $('#double_room_hide').hide();
        $('#deluxe_room').show();
        $('#deluxe_room_hide').hide();
    });</script>
<script src="js/script.js"></script>
<script src="js/date.js"></script>

</body>
</html>