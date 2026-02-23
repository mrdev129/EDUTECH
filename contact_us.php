
<?php
// Start session only if it's not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/db.php';

/* ===============================
   FLASH MESSAGE HANDLING
================================= */
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';

unset($_SESSION['success']);
unset($_SESSION['error']);

/* ===============================
   INPUT SANITIZATION FUNCTION
================================= */
function clean_input($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/* ===============================
   FORM SUBMISSION HANDLER
================================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect & sanitize inputs
    $full_name = clean_input($_POST['full_name'] ?? '');
    $mobile = clean_input($_POST['mobile_number'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $last_qualification = clean_input($_POST['last_qualification'] ?? '');
    $preferred_course = clean_input($_POST['preferred_course'] ?? '');
    $preferred_city = clean_input($_POST['preferred_city'] ?? '');
    $budget_range = clean_input($_POST['budget_range'] ?? '');
    $hostel_required = clean_input($_POST['hostel_required'] ?? '');
    $message = clean_input($_POST['message'] ?? '');

    /* ===============================
       VALIDATION
    ================================= */

    if (
        empty($full_name) || empty($mobile) || empty($email) ||
        empty($last_qualification) || empty($preferred_course) ||
        empty($preferred_city) || empty($budget_range) ||
        empty($hostel_required)
    ) {
        $_SESSION['error'] = "All required fields must be filled.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $full_name)) {
        $_SESSION['error'] = "Full name should contain only letters.";
    } elseif (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $_SESSION['error'] = "Mobile number must be exactly 10 digits.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
    } else {

        /* ===============================
           DUPLICATE MOBILE CHECK
        ================================= */
        $check = $conn->prepare("SELECT id FROM students WHERE mobile = ?");
        $check->bind_param("s", $mobile);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {

            $_SESSION['error'] = "This mobile number is already registered.";
        } else {

            /* ===============================
               INSERT DATA SECURELY
            ================================= */
            $stmt = $conn->prepare("INSERT INTO students 
                (full_name, mobile, email, last_qualification, preferred_course, preferred_city, budget_range, hostel_required, message)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if ($stmt) {

                $stmt->bind_param(
                    "sssssssss",
                    $full_name,
                    $mobile,
                    $email,
                    $last_qualification,
                    $preferred_course,
                    $preferred_city,
                    $budget_range,
                    $hostel_required,
                    $message
                );

                if ($stmt->execute()) {
                    $_SESSION['success'] = "Application submitted successfully!";
                } else {
                    $_SESSION['error'] = "Something went wrong. Please try again.";
                }

                $stmt->close();
            } else {
                $_SESSION['error'] = "Database error. Please contact admin.";
            }
        }

        $check->close();
    }

    /* ===============================
       POST-REDIRECT-GET
    ================================= */
    header("Location: " . basename($_SERVER['PHP_SELF']) . "#hero");
    exit();
}
?>




<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EDUTECH | ADMISSION EXPERT</title>
    <meta name="robots" content="noindex, follow">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/cliet_logo.png">

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->

    <!-- Font CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="../../css2?family=Flow+Circular&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap & Icon Font -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/animation.css">

    <!-- jquery UI CSS -->
    <link rel="stylesheet" href="assets/css/jquery-ui.css">

    <!-- awesome Icon Font -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- remixicon Icon Font -->
    <link rel="stylesheet" href="assets/css/remixicon.css">

    <!-- Slick Slider CSS  -->
    <link rel="stylesheet" href="assets/css/slick.css">

    <!-- owl carousel CSS  -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">

    <!-- flickity CSS  -->
    <link rel="stylesheet" href="assets/css/flickity.css">

    <!-- odometer CSS  -->
    <link rel="stylesheet" href="assets/css/odometer.min.css">

    <!-- skeletabs CSS  -->
    <link rel="stylesheet" href="assets/css/skeletabs.css">

    <!-- magnific popup CSS -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <!-- layout CSS -->
    <link rel="stylesheet" href="assets/css/rs-layouts.css">

    <!-- Style CSS -->
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

    <link rel="stylesheet" href="assets/css/style.css?v=1.2">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Poppins:wght@600;700;800&family=Outfit:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap"
        rel="stylesheet">
    <style>
        /* 1. Initial State: Lowered and Invisible */
        .reveal {
            opacity: 0;
            transform: translateY(60px) scale(0.95);
            /* Moves it down and slightly smaller */
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            /* Smooth "pop" curve */
            visibility: hidden;
            will-change: opacity, transform;
        }

        /* 2. Active State: Triggered when scrolled into view */
        .reveal.active {
            opacity: 1;
            transform: translateY(0) scale(1);
            /* Moves to original spot and full size */
            visibility: visible;
        }
    </style>
</head>


<body class="home-page-2">

    <!--======== Header Onepage 2 start ========-->
    <div id="home" class="header-announcement-wrapper">
        <header class="edutech-main-header">
            <div class="container-fluid">
                <div class="header-container">
                    <div class="logo-side">
                        <div class="logo-circle-wrap">
                            <img src="assets/images/EDUTECH Admission Experts logo.png" alt="Logo" class="logo-glow">
                        </div>

                        <div class="logo-text">
                            <span class="brand-name">EDUTECH</span>
                            <span class="brand-tagline">ADMISSION EXPERTS</span>
                        </div>
                    </div>

                    <div class="action-side">
                        <a href="javascript:void(0);" id="openEnquire" class="main-btn">
                            ENQUIRE NOW
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="static-announcement">
            <div class="container">
                <p class="sliding-text">Jan'26 Admissions Closing Soon! Avail Up to 25% Scholarship on 1st Semester*.
                </p>
            </div>
        </div>

       

        <!--======== Footer 2 Start ========-->

        <footer id="rs-contact" class="rs-footer rs-footer-2 reveal">
            <section class="rs-contact-page pt-120 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="rs-contact-page__info">
                                <div class="rs-section-title black">
                                    <h3 class="title split-in-fade">Get in touch with us</h3>
                                    <p>Fill out the form below and our admission experts will contact you to discuss
                                        suitable courses, colleges, budget options, and hostel facilities based on your
                                        preferences.</p>
                                    <p></p>
                                </div>

                                <div class="rs-contact-page__info-box">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h5 class="title mb-15">Head Office (India):</h5>
                                            <div class="info-box-item">
                                                <div class="rs-info-icon">
                                                    <i class="ri-map-2-line"></i>
                                                </div>
                                                <div class="rs-info-contact">
                                                    <span>Address</span>
                                                    <h5 class="title">
                                                        HIG-141 K6 (A), 1st Floor
                                                        Kalinga Nagar <br>PIN - 751019
                                                        Bhubaneswar, Odisha
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="info-box-item mb-15">
                                                <div class="rs-info-icon">
                                                    <i class="ri-phone-line"></i>
                                                </div>
                                                <div class="rs-info-contact">
                                                    <span>Call Us</span>
                                                    <h5 class="title"><a href="tel:+919876543210">+91 98765 43210</a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="info-box-item">
                                                <div class="rs-info-icon">
                                                    <i class="ri-mail-send-line"></i>
                                                </div>
                                                <div class="rs-info-contact">
                                                    <span>Email Us</span>
                                                    <h5 class="title"><a
                                                            href="mailto:edutechadmissionexperts@gmail.com">edutechadmissionexperts@gmail.com</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="rs-contact-page__info-social mt-20">
                                    <h5 class="title">Follow Us:</h5>
                                    <ul>
                                        <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
                                        <li><a href="#"><i class="ri-instagram-fill"></i></a></li>
                                        <li><a href="#"><i class="ri-linkedin-fill"></i></a></li>
                                        <li><a href="#"><i class="ri-youtube-fill"></i></a></li>
                                        <li><a href="#"><i class="ri-whatsapp-fill"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="rs-contact-page__content">
                                <div class="rs-section-title black">
                                    <h3 class="title split-in-fade">Let's discuss with us</h3>
                                    <p>Fill out the form below and our admission experts will contact you to discuss
                                        suitable courses, colleges, budget options, and hostel facilities based on your
                                        preferences.</p>
                                </div>

                                <form id="contact-form" action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <input type="text" id="name" name="name" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <input type="email" id="email" name="email" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <input type="text" id="city" name="city" placeholder="Preferred City">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <input type="text" id="phone" name="phone" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <textarea name="message" id="message"
                                                    placeholder="Tell us about your preferred city, budget range, or any specific requirement..."></textarea>
                                                
                                            </div>
                                        </div>
                                        <div id="form-response" class="mb-3"></div>
                                        <!-- Honeypot Spam Field -->
                                        <div style="display:none;">
                                            <input type="text" name="website">
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <button type="submit" class="main-btn">
                                                    Submit Inquiry <i class="ri-arrow-right-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- <p id="form-messages" class="form-message"></p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--======== Contact Page Ends ========-->
            <!--======== Contact Map Start ========-->
            <div class="rs-contact-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3743.4911157931533!2d85.83120177469385!3d20.238456914454027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a19a726c8ffc807%3A0x212845f89456a2cd!2sLingaraj%20Temple!5e0!3m2!1sen!2sin!4v1771681075912!5m2!1sen!2sin"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" width="600" height="450" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <!--======== Contact Map Ends ========-->
            <div class="rs-footer__main-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="rs-footer__about-box">
                                <a href="index-2.html"><img src="assets/images/about/logo.jpeg" alt=""></a>
                                <p> To empower students by providing expert guidance and transparent insights into the
                                    complex world of higher education.</p>
                                <div class="rs-footer__social">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="ri-twitter-x-fill"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="rs-footer__navigation">
                                <div class="rs-footer-title">
                                    <h4 class="title">Our Services</h4>
                                </div>
                                <ul>
                                    <li><a href="service-details-2.php"><i class="ri-arrow-right-fill"></i> B.Tech</a>
                                    </li>
                                    <li><a href="service-details-2.php"><i class="ri-arrow-right-fill"></i> MBA</a></li>
                                    <li><a href="service-details-2.php"><i class="ri-arrow-right-fill"></i> MCA</a></li>
                                    <li><a href="service-details-2.php"><i class="ri-arrow-right-fill"></i> Diploma</a>
                                    </li>
                                    <li><a href="service-details-2.php"><i class="ri-arrow-right-fill"></i> Other
                                            Courses</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="rs-footer__navigation rs-footer--navigation">
                                <div class="rs-footer-title">
                                    <h4 class="title">Information</h4>
                                </div>
                                <ul>
                                    <li><a href="about.html"><i class="ri-arrow-right-fill"></i> About</a></li>
                                    <li><a href="team.html"><i class="ri-arrow-right-fill"></i> Our Team</a></li>
                                    <li><a href="pricing.html"><i class="ri-arrow-right-fill"></i>Collaboration</a></li>
                                    <li><a href="project.html"><i class="ri-arrow-right-fill"></i> Blogs</a></li>
                                    <li><a href="appointment.html"><i class="ri-arrow-right-fill"></i> Gallery</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="rs-footer__newsletter">
                                <div class="rs-footer-title">
                                    <h4 class="title">Subscription</h4>
                                </div>
                                <p>Register now to get latest updates on promotions & coupons.</p>
                                <form action="#">
                                    <div class="input-box">
                                        <input type="email" placeholder="Your email address">
                                        <button class="main-btn">Subscribe <svg width="13" height="14"
                                                viewbox="0 0 13 14" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.5 7.8125H0V6.1875H6.5V0.5L13 7L6.5 13.5V7.8125Z"
                                                    fill="#fff"></path>
                                            </svg></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rs-footer__menu">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="rs-footer__copyright-text">
                                <p>© 2026 EDUTECH. Designed By <a target="_blank" href="https://rstheme.com/">Team
                                        DRS.</a></p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="rs-footer__menu-box">
                                <ul>
                                    <li><a href="contact.html">Privacy Policy</a></li>
                                    <li><a href="contact.html">Terms of use</a></li>
                                    <li><a href="contact.html">Sitemap</a></li>
                                    <li><a href="contact.html">Career</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--======== Footer 2 Ends ========-->
          <!--======== Scroll up and prograss start ========-->
        <div id="scrollUp">
            <svg class="arrowup" viewbox="0 0 24 24" width="18" height="18">
                <path d="M13 7.828V20h-2V7.828l-5.364 5.364-1.414-1.414L12 4l7.778 7.778-1.414 1.414L13 7.828z"
                    fill="#fff"></path>
            </svg>
            <svg class="scrollprogress" width="40" height="40">
                <circle class="progress-circle" cx="20" cy="20" r="18" stroke-width="2" fill="none" stroke="#fff"
                    stroke-dasharray="113.1" stroke-dashoffset="113.1"></circle>
            </svg>
        </div>
        <!--======== Scroll up and prograss Ends ========-->

        <!-- Custom Cursor Start -->
        <div id="rs-mouse">
            <div id="cursor-ball"></div>
        </div>
        <!-- Custom Cursor End -->

        <!-- JS Vendor, Plugins & Activation Script Files -->

        <!-- jquery Plugins JS -->
        <script src="assets/js/jquery.min.js"></script>

        <!-- jquery UI JS -->
        <script src="assets/js/jquery-ui.min.js"></script>

        <!-- bootstrap JS -->
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- ajax-contact JS -->
        <script src="assets/js/ajax-contact.js"></script>

        <!-- wow animation JS -->
        <script src="assets/js/wow.min.js"></script>

        <!-- appear JS -->
        <script src="assets/js/jquery.appear.min.js"></script>

        <!-- typer JS -->
        <script src="assets/js/typer.js"></script>

        <!-- PageScroll2id JS -->
        <script src="assets/js/jquery.malihu.PageScroll2id.min.js"></script>

        <!-- marquee JS -->
        <script src="assets/js/jquery.marquee.min.js"></script>

        <!-- Slick Slider JS -->
        <script src="assets/js/slick.min.js"></script>

        <!-- owl carousel JS -->
        <script src="assets/js/owl.carousel.min.js"></script>

        <!-- flickity JS -->
        <script src="assets/js/flickity.pkgd.min.js"></script>

        <!-- odometer JS -->
        <script src="assets/js/odometer.min.js"></script>

        <!-- skeletabs JS -->
        <script src="assets/js/skeletabs.js"></script>

        <!-- magnific popup JS -->
        <script src="assets/js/jquery.magnific-popup.min.js"></script>

        <!-- GSAP Interactions Start -->
        <script src="assets/js/interactions/gsap.min.js"></script>
        <script src="assets/js/interactions/rs-scroll-trigger.min.js"></script>
        <script src="assets/js/interactions/rs-splitText.min.js"></script>
        <script src="assets/js/interactions/rs-anim-int.js"></script>
        <!-- GSAP Interactions End -->

        <!-- Activation JS -->
        <script src="assets/js/main.js"></script>

    
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modal = document.getElementById("enquireModal");
                const modalContent = document.querySelector(".enquire-modal-content");
                const closeBtn = document.querySelector(".enquire-close");

                // --- NEW LOGIC: Always show on load/refresh ---
                if (modal) {
                    modal.style.display = "flex";
                }

                // Existing open buttons logic
                const openButtons = [
                    document.getElementById("openEnquire"),
                    document.getElementById("openEnquireNav")
                ];

                openButtons.forEach(function (btn) {
                    if (btn) {
                        btn.addEventListener("click", function (e) {
                            e.preventDefault();
                            modal.style.display = "flex";
                        });
                    }
                });

                // Close logic
                if (closeBtn) {
                    closeBtn.addEventListener("click", function () {
                        modal.style.display = "none";
                    });
                }

                modal.addEventListener("click", function (e) {
                    if (!modalContent.contains(e.target)) {
                        modal.style.display = "none";
                    }
                });
            });

            $(document).ready(function () {
                if ($(window).width() < 768) {
                    $(".featured-slider").owlCarousel({
                        items: 1,
                        loop: true,
                        margin: 20,
                        autoplay: true,
                        dots: true, // Enables the circles
                        nav: false,
                        stagePadding: 30 // Shows a peek of the next card
                    });
                }
            });

            $(document).ready(function () {
                // We only run this logic if the screen is mobile
                if ($(window).width() < 768) {
                    var $teamSlider = $('.rs-project__slider');

                    // Add the carousel class and initialize ONLY on mobile
                    $teamSlider.addClass('owl-carousel').owlCarousel({
                        items: 1,
                        loop: true,
                        margin: 20,
                        autoplay: true,
                        dots: true,
                        stagePadding: 40 // The "peek" effect
                    });
                }
                // On Desktop (>768px), this code does absolutely nothing, leaving your grid safe
            });
        </script>

    

    <script>
document.getElementById("contact-form").addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("save_inquiry.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("form-response").innerHTML = data;
        document.getElementById("contact-form").reset();
    })
    .catch(error => {
        document.getElementById("form-response").innerHTML = "Something went wrong!";
    });
});
</script>



        <!-- ENQUIRE MODAL -->
        <div id="enquireModal" class="enquire-modal">
            <div class="enquire-overlay"></div>

            <div class="enquire-modal-content">
                <button type="button" class="enquire-close">&times;</button>

                <!-- COPY SAME HERO FORM HERE -->
                <div class="hero-form-box compact-form shadow-lg">
                    <h3 class="form-title text-center text-dark fw-bold mb-4">Enquire Now</h3>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success text-center"><?= $success ?></div>
                    <?php endif; ?>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <!-- COPY YOUR FULL FORM FIELDS HERE EXACTLY SAME -->
                        <div class="row g-2">
                            <div class="col-md-6 mb-2">
                                <input type="text" name="full_name" class="form-control" placeholder="Full Name *"
                                    required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <input type="tel" name="mobile_number" class="form-control" placeholder="Mobile *"
                                    required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <input type="email" name="email" class="form-control" placeholder="Email Id *" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <select name="last_qualification" class="form-select" required>
                                    <option value="">Qualification *</option>
                                    <option value="12th">12th</option>
                                    <option value="Graduate">Graduate</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <select name="preferred_course" class="form-select" required>
                                    <option value="">Course *</option>
                                    <option value="B.Tech">B.Tech</option>
                                    <option value="MBA">MBA</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div
                                    class="hostel-toggle d-flex align-items-center justify-content-between p-2 rounded bg-light border">
                                    <span class="small fw-bold text-dark">Hostel Required?</span>
                                    <div class="btn-group btn-group-sm">
                                        <input type="radio" class="btn-check" name="hostel_required" id="h1" value="Yes"
                                            checked>
                                        <label class="btn btn-outline-primary" for="h1">Yes</label>
                                        <input type="radio" class="btn-check" name="hostel_required" id="h2" value="No">
                                        <label class="btn btn-outline-primary" for="h2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <select name="preferred_city" class="form-select" required>
                                    <option value="">Preferred City *</option>
                                    <option value="Bhubaneswar">Bhubaneswar</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Mumbai">Mumbai</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <select name="budget_range" class="form-select" required>
                                    <option value="">Budget Range *</option>
                                    <option value="1-3 Lakh">1-3 Lakh</option>
                                    <option value="3-5 Lakh">3-5 Lakh</option>
                                    <option value="5+ Lakh">5+ Lakh</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-2">
                                <textarea name="message" class="form-control"
                                    placeholder="Message (Optional)"></textarea>
                            </div>

                        </div>
                        <button type="submit" class="hero-submit-btn w-100 mt-3">Submit Application</button>
                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success text-center">
                                <?= $success ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger text-center">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>

            </div>
        </div>

        <div class="floating-contact">
            <a href="https://wa.me/919999999999" target="_blank" class="contact-icon-box" title="Contact Us">
                <i class="fa fa-whatsapp"></i> </a>
        </div>


    
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const observerOptions = {
                    threshold: 0.15, // Triggers when 15% of the section is visible
                    rootMargin: "0px 0px -50px 0px" // Triggers slightly before the section hits the top
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            // This adds the CSS class that runs the pop-up animation
                            entry.target.classList.add("active");
                            // Stop observing so it doesn't "re-pop" every time you scroll
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                // Attach the observer to every element with the 'reveal' class
                document.querySelectorAll(".reveal").forEach((el) => {
                    observer.observe(el);
                });
            });
        </script>
</body>

</html>