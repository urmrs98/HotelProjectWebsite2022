<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Αρχική</title>

    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- σύνδεση με τη css   -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>

<!-- TODO 1. HEADER start -->
<?php include 'header.php'; ?>

<!-- HEADER end -->

<!-- TODO 5. Contact start -->
<div class="contact-section">
    <h1>Επικοινώνησε μαζί μας</h1>
    <div class="border"></div>
    <form class="contact-form" action="#" method="POST" name="insert">
        <input type="text" class="contact-form-text" placeholder="'Ονομα" name="name" id="name" required>
        <input type="text" class="contact-form-text" placeholder="Επώνυμο" name="surname" id="surname" required>
        <input type="email" class="contact-form-text" placeholder="E-mail" name="email"  >
        <input type="text" class="contact-form-text" placeholder="Τηλ. Επικοινωνίας" name="phone" required>
        <textarea class="contact-form-text" placeholder="Πληκτρολογήστε..." name="message" required></textarea>
        <input type="submit" class="contact-form-btn" name="submit" value="Αποστολή">
        <span></span>
    </form>
</div>
<!-- Contact end -->


<!-- TODO 4. Footer start -->

<section class="footer">

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


<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- σύνδεση με τη javascript   -->
<script src="js/script.js"></script>

</body>
</html>