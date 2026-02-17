<?php
include 'config/db.php';
$aboutQuery = $conn->query("SELECT * FROM about_section WHERE id=1");
$about = $aboutQuery->fetch_assoc();
?>


<?php
session_start();
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
    <link rel="stylesheet" href="assets/css/style.css">

</head>


<body class="home-page-2">

    <!--======== Header Onepage 2 start ========-->
    <div class="header-announcement-wrapper">
        <header class="edutech-main-header">
            <div class="container">
                <div class="header-container">
                    <div class="logo-side">
                        <img src="assets/images/cliet_logo.png" alt="Logo">
                        <div class="logo-text">
                            <span class="brand-name">EDUTECH</span>
                            <span class="brand-tagline">ADMISSION EXPERT</span>
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
                <p>Jan'26 Admissions Closing Soon! Avail Up to 25% Scholarship on 1st Semester*.</p>
            </div>
        </div>

        <section class="split-hero d-flex align-items-center">
            <div class="hero-bg-slider owl-carousel">
                <div class="item" style="background-image: url('assets/images/banner/hero-1.jpg');"></div>
                <div class="item" style="background-image: url('assets/images/banner/hero-2.jpg');"></div>
                <div class="item" style="background-image: url('assets/images/banner/hero-3.jpg');"></div>
                <div class="item" style="background-image: url('assets/images/banner/hero-4.jpg');"></div>
            </div>

            <div class="container position-relative z-index-2">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content-left text-white">
                            <!-- <span class="ug-tag fw-bold">UG PROGRAM</span> -->
                            <h1 class="expanding-text">
                                Your Future, <br>
                                Our <span class="typing-text"
                                    data-words='["Guidance", "Expertise", "Support", "Solution"]'></span>
                            </h1>
                            <p class="journey-sub fs-4">START YOUR JOURNEY TODAY</p>
                            <a href="#" class="brochure-btn btn btn-warning rounded-pill px-4">DOWNLOAD BROCHURE <i
                                    class="ri-arrow-down-line"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-5 offset-lg-1">
                        <div id="heroFormBox" class="hero-form-box compact-form shadow-lg">
                            <h3 class="form-title text-center text-dark fw-bold mb-4">Enquire Now</h3>
                            <form action="" method="POST">
                                <div class="row g-2">
                                    <div class="col-md-6 mb-2">
                                        <input type="text" name="full_name" class="form-control"
                                            placeholder="Full Name *" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="tel" name="mobile_number" class="form-control"
                                            placeholder="Mobile *" required>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="email" name="email" class="form-control" placeholder="Email Id *"
                                            required>
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
                                                <input type="radio" class="btn-check" name="hostel_required" id="h1"
                                                    value="Yes" checked>
                                                <label class="btn btn-outline-primary" for="h1">Yes</label>
                                                <input type="radio" class="btn-check" name="hostel_required" id="h2"
                                                    value="No">
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
            </div>
        </section>

        <div class="sliding-info-bar">
            <marquee behavior="scroll" direction="left" scrollamount="7">
                Official website of EDUTECH University Online. | Secure & Confidential: only through the secure link on
                this safe us. | Admissions for 2026 are now open! Apply Today.
            </marquee>
        </div>
        </section>

        <div class="program-nav-bar">
            <div class="container">
                <div class="nav-flex-wrapper">
                    <ul class="program-menu">
                        <li><a href="#home">HOME</a></li>
                        <li><a href="#about">ABOUT US</a></li>
                        <li><a href="#course">COURSE</a></li>
                        <li><a href="#blogs">BLOGS</a></li>
                        <li><a href="#team">TEAM MEMBERS</a></li>
                        <li><a href="#collab">COLLABORATIONS</a></li>
                        <li><a href="#gallery">GALLERY</a></li>
                        <!-- <li><a href="#faculty">FACULTY</a></li> -->
                    </ul>
                    <div class="nav-action">
                        <a href="javascript:void(0);" id="openEnquireNav" class="navy-enquire-btn">
                            ENQUIRE NOW
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <!--======== Header Onepage 2 start ========-->

        <!-- ======== Offcanvas Menu start ========-->
        <!-- <div class="offcanvas-menu offcanvas-menu-2">
        <div class="menu-canvas-close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="offcanvas-menu-inner">
            <div class="offc-logo mb-40">
                <a href="index.html"><img src="assets/images/logo_home_4.png" alt="Logo"></a>
            </div>
            <ul class="nav-menu">
                <li>
                    <a class="page-scroll" href="#rs-header">Home</a>
                </li>
                <li>
                    <a class="page-scroll" href="#rs-about">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="#rs-service">Services</a>
                </li>
                <li>
                    <a class="page-scroll" href="#rs-portfolios">Portfolios</a>
                </li>
                <li>
                    <a class="page-scroll" href="#rs-blog">Blog</a>
                </li>
                <li>
                    <a class="page-scroll" href="#rs-contact">Contact</a>
                </li>
            </ul> <! //.nav-menu -->
        <!-- </div>
    </div> 
    ======== Offcanvas Menu Ends ======== -->

        <!--======== Preloader area start ========-->
        <!-- <div id="pre-load">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class='loader-icon'><img src="assets/images/favicon.png" alt=""></div>
            </div>
        </div>
    </div> -->
        <!--======== Preloader area Ends ========-->

        <!--======== Banner 2 Start ========-->
        <!-- <section class="rs-banner-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="rs-banner-2__content">
                        <img class="wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="0s" src="assets/images/banner/image-year.png" alt="">
                        <div class="rs-sub-heading wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                            <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="">
                            <span> Welcome To EDUTECH </span>
                            <img src="assets/images/heart-pulse-rate-orange.svg" alt="">
                        </div>
                        <h1 class="title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.8s">Your Future, Our <span>Guidance</span></h1>
                        <p class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.2s">We help students make the right career decisions by providing expert guidance, college insights, and personalized admission support for a brighter future.</p>
                        <a class="main-btn wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.6s" href="about.html">Discover More <i class="ri-arrow-right-fill"></i></a>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section> -->
        <!--======== Banner 2 Ends ========-->

        <!--======== Service 2 Start ========-->
        <div class="rs-service-2 pt-90 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-carousel owl-carousel service-slider-bottom" data-loop="true" data-items="5"
                            data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000"
                            data-smart-speed="800" data-dots="false" data-nav="true" data-nav-speed="false"
                            data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="true"
                            data-mobile-device-dots="false" data-ipad-device="3" data-ipad-device-nav="true"
                            data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="true"
                            data-ipad-device-dots2="false" data-md-device="4" data-lg-device="5"
                            data-md-device-nav="true" data-md-device-dots="false">


                            <div class="rs-service-2__item">
                                <div class="rs-service-2__icon">
                                    <img src="assets/images/service/service_icon1.png" alt="">
                                </div>
                                <h5 class="title"><a href="#">B.Tech</a></h5>
                            </div>

                            <div class="rs-service-2__item">
                                <div class="rs-service-2__icon">
                                    <img src="assets/images/service/service_icon2.png" alt="">
                                </div>
                                <h5 class="title"><a href="#">MBA</a></h5>
                            </div>

                            <div class="rs-service-2__item">
                                <div class="rs-service-2__icon">
                                    <img src="assets/images/service/service_icon3.png" alt="">
                                </div>
                                <h5 class="title"><a href="#">MCA</a></h5>
                            </div>

                            <div class="rs-service-2__item">
                                <div class="rs-service-2__icon">
                                    <img src="assets/images/service/service_icon4.png" alt="">
                                </div>
                                <h5 class="title"><a href="#">Diploma</a></h5>
                            </div>

                            <div class="rs-service-2__item">
                                <div class="rs-service-2__icon">
                                    <img src="assets/images/service/service_icon5.png" alt="">
                                </div>
                                <h5 class="title"><a href="#">Data Analytics</a></h5>
                            </div>

                            <div class="rs-service-2__item">
                                <div class="rs-service-2__icon">
                                    <img src="assets/images/service/service_icon1.png" alt="">
                                </div>
                                <h5 class="title"><a href="#">Web Development</a></h5>
                            </div>

                            <div class="rs-service-2__item">
                                <div class="rs-service-2__icon">
                                    <img src="assets/images/service/service_icon1.png" alt="">
                                </div>
                                <h5 class="title"><a href="#">UI/UX Design</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--======== Service 2 Ends ========-->

        <!--======== Featured 2 Start ========-->
        <section id="rs-service" class="rs-featured-2 pt-115 pb-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="rs-section-title black">
                            <div class="top-sub-heading">
                                <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                                <span>Our Feachered Services</span>
                                <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                            </div>
                            <h2 class="title split-in-fade">We provide best choice for you Technical carrier</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="rs-featured-2__item">
                            <div class="rs-thumb">
                                <img src="assets/images/featured/BTech-clg.jpeg" alt="">
                            </div>
                            <div class="rs-content">
                                <div class="rs-icon">
                                    <img src="assets/images/featured/BTech-clg.jpeg" alt="">
                                </div>
                                <h4 class="title"><a href="service-details.html">B.Tech</a></h4>
                                <p>Make a carrier in B.Tech.</p>
                                <a class="rs-link" href="service-details.html">Read More <i
                                        class="ri-arrow-right-fill"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="rs-featured-2__item">
                            <div class="rs-thumb">
                                <img src="assets/images/featured/MBA-clg.png" alt="">
                            </div>
                            <div class="rs-content">
                                <div class="rs-icon">
                                    <img src="assets/images/featured/MBA-clg.png" alt="">
                                </div>
                                <h4 class="title"><a href="service-details.html">MBA</a></h4>
                                <p>Make a carrier in MBA.</p>
                                <a class="rs-link" href="service-details.html">Read More <i
                                        class="ri-arrow-right-fill"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="rs-featured-2__item last-item">
                            <div class="rs-thumb">
                                <img src="assets/images/featured/MCA-clg.jpg" alt="">
                            </div>
                            <div class="rs-content">
                                <div class="rs-icon">
                                    <img src="assets/images/featured/MCA-clg.jpg" alt="">
                                </div>
                                <h4 class="title"><a href="service-details.html">MCA</a></h4>
                                <p>Make a carrier in MCA.</p>
                                <a class="rs-link" href="service-details.html">Read More <i
                                        class="ri-arrow-right-fill"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-featured-2__btn">
                            <a class="main-btn" href="service-1.html"> View All Services <i
                                    class="ri-arrow-right-fill"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--======== Featured 2 Ends ========-->

        <!--======== About 2 Start ========-->
        <section id="rs-about" class="rs-about-2 pt-120 pb-30">
            <div class="container">
                <div class="row align-items-center">

                    <!-- LEFT IMAGE -->
                    <div class="col-lg-6">
                        <div class="rs-about-2__thumb">
                            <img src="uploads/about/<?php echo $about['main_image']; ?>" alt="About Image">
                        </div>
                    </div>

                    <!-- RIGHT CONTENT -->
                    <div class="col-lg-6">
                        <div class="rs-about-2__main-content">
                            <div class="rs-section-title black">

                                <!-- TOP HEADING -->
                                <div class="top-sub-heading">
                                    <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                                    <span><?php echo $about['top_heading']; ?></span>
                                    <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                                </div>

                                <!-- MAIN TITLE -->
                                <h2 class="title split-in-fade">
                                    <?php echo $about['main_title']; ?>
                                </h2>

                                <!-- SHORT DESCRIPTION -->
                                <p>
                                    <?php echo $about['short_description']; ?>
                                </p>

                                <!-- TABS -->
                                <div id="rs-tabs" class="skltbs-theme-light use-drop skltbs-mode-tabs skltbs-init">

                                    <!-- TAB BUTTONS -->
                                    <ul class="skltbs-tab-group">
                                        <li class="skltbs-tab-item">
                                            <button class="skltbs-tab">Our Mission</button>
                                        </li>
                                        <li class="skltbs-tab-item">
                                            <button class="skltbs-tab">Our Vision</button>
                                        </li>
                                        <li class="skltbs-tab-item">
                                            <button class="skltbs-tab">Core Value</button>
                                        </li>
                                    </ul>

                                    <!-- TAB PANELS -->
                                    <div class="skltbs-panel-group">

                                        <!-- MISSION -->
                                        <div class="skltbs-panel">
                                            <p><?php echo $about['mission_text']; ?></p>
                                            <ul>
                                                <li><i class="ri-share-forward-fill"></i>
                                                    <?php echo $about['mission_point1']; ?></li>
                                                <li><i class="ri-share-forward-fill"></i>
                                                    <?php echo $about['mission_point2']; ?></li>
                                            </ul>

                                            <a class="main-btn" href="<?php echo $about['button_link']; ?>">
                                                Know More About Us
                                                <i class="ri-arrow-right-fill"></i>
                                            </a>

                                            <div class="play-icon">
                                                <a class="rs-popup-videos" href="<?php echo $about['video_link']; ?>">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- VISION -->
                                        <div class="skltbs-panel">
                                            <p><?php echo $about['vision_text']; ?></p>
                                            <ul>
                                                <li><i class="ri-share-forward-fill"></i>
                                                    <?php echo $about['vision_point1']; ?></li>
                                                <li><i class="ri-share-forward-fill"></i>
                                                    <?php echo $about['vision_point2']; ?></li>
                                            </ul>

                                            <a class="main-btn" href="<?php echo $about['button_link']; ?>">
                                                Know More About Us
                                                <i class="ri-arrow-right-fill"></i>
                                            </a>

                                            <div class="play-icon">
                                                <a class="rs-popup-videos" href="<?php echo $about['video_link']; ?>">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- CORE VALUE -->
                                        <div class="skltbs-panel">
                                            <p><?php echo $about['core_text']; ?></p>
                                            <ul>
                                                <li><i class="ri-share-forward-fill"></i>
                                                    <?php echo $about['core_point1']; ?></li>
                                                <li><i class="ri-share-forward-fill"></i>
                                                    <?php echo $about['core_point2']; ?></li>
                                            </ul>

                                            <a class="main-btn" href="<?php echo $about['button_link']; ?>">
                                                Know More About Us
                                                <i class="ri-arrow-right-fill"></i>
                                            </a>

                                            <div class="play-icon">
                                                <a class="rs-popup-videos" href="<?php echo $about['video_link']; ?>">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- END TABS -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--======== About 2 Ends ========-->


        <!--======== Brand Start ========-->
        <div class="rs-brand pb-90 pt-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-brand__top-title">
                            <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="">
                            <span>Our College Partners</span>
                            <img src="assets/images/heart-pulse-rate-orange.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-brand__slider">
                            <div class="rs-carousel owl-carousel nav-style1" data-loop="true" data-items="5"
                                data-margin="0" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="3000"
                                data-smart-speed="500" data-dots="false" data-nav="false" data-nav-speed="false"
                                data-center-mode="false" data-mobile-device="2" data-mobile-device-nav="false"
                                data-mobile-device-dots="false" data-ipad-device="4" data-ipad-device-nav="false"
                                data-ipad-device-dots="false" data-ipad-device2="3" data-ipad-device-nav2="false"
                                data-ipad-device-dots2="false" data-md-device="4" data-lg-device="5"
                                data-md-device-nav="false" data-md-device-dots="false" data-doteach="false">
                                <div class="rs-brand-slider-item">
                                    <a href="#">
                                        <img src="assets\images\brand\image-Photoroom (1).png" alt="">
                                        <img class="item-2" src="assets/images/brand/partner-white-1.png" alt="">
                                    </a>
                                </div>
                                <div class="rs-brand-slider-item">
                                    <a href="#">
                                        <img src="assets\images\brand\image-Photoroom.png" alt="">
                                        <img class="item-2" src="assets/images/brand/partner-white-2.png" alt="">
                                    </a>
                                </div>
                                <div class="rs-brand-slider-item">
                                    <a href="#">
                                        <img src="assets\images\brand\images-Photoroom (1).png" alt="">
                                        <img class="item-2" src="assets/images/brand/partner-white-3.png" alt="">
                                    </a>
                                </div>
                                <div class="rs-brand-slider-item">
                                    <a href="#">
                                        <img src="assets\images\brand\logo-896x1024-Photoroom.png" alt="">
                                        <img class="item-2" src="assets/images/brand/partner-white-4.png" alt="">
                                    </a>
                                </div>
                                <div class="rs-brand-slider-item">
                                    <a href="#">
                                        <img src="assets\images\brand\university-college-school-badge-logo-free-vector-Photoroom.png"
                                            alt="">
                                        <img class="item-2" src="assets/images/brand/partner-white-5.png" alt="">
                                    </a>
                                </div>
                                <div class="rs-brand-slider-item">
                                    <a href="#">
                                        <img src="assets\images\brand\University-Logo-backup-Photoroom.png" alt="">
                                        <img class="item-2" src="assets/images/brand/partner-white-6.png" alt="">
                                    </a>
                                </div>
                                <div class="rs-brand-slider-item">
                                    <a href="#">
                                        <img src="assets\images\brand\images-Photoroom (2).png" alt="">
                                        <img class="item-2" src="assets/images/brand/partner-white-7.png" alt="">
                                    </a>
                                </div>
                                <div class="rs-brand-slider-item">
                                    <a href="#">
                                        <img src="assets\images\brand\images-Photoroomxx.png" alt="">
                                        <img class="item-2" src="assets/images/brand/partner-white-8.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--======== Brand Ends ========-->

        <!--======== Project Start ========-->
        <section id="rs-portfolios" class="rs-project">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-top-line mb-110"></div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="rs-section-title black">
                            <div class="top-sub-heading">
                                <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                                <span>Our Team Members</span>
                                <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                            </div>
                            <h2 class="title split-in-fade">See our Team Members</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="rs-project__btn">
                            <a class="main-btn" href="project.html">View All Team Members <i
                                    class="ri-arrow-right-fill"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-carousel owl-carousel rs-project__slider mt-30" data-loop="true" data-items="3"
                            data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000"
                            data-smart-speed="800" data-dots="true" data-nav="false" data-nav-speed="false"
                            data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false"
                            data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="false"
                            data-ipad-device-dots="true" data-ipad-device2="1" data-ipad-device-nav2="false"
                            data-ipad-device-dots2="true" data-md-device="2" data-lg-device="3"
                            data-md-device-nav="false" data-md-device-dots="true" data-doteach="false">
                            <div class="rs-project__items">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-1.jpg" alt="">
                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Sibani</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets\images\Socialmedia.png"
                                                    style="width:40%; height:auto;" alt=""> <i
                                                    class="ri-arrow-right-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rs-project__items">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-2.jpg" alt="">
                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Satya</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets\images\Socialmedia.png"
                                                    style="width:40%; height:auto;" alt=""> <i
                                                    class="ri-arrow-right-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rs-project__items">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-3.jpg" alt="">
                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Dev</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets\images\Socialmedia.png"
                                                    style="width:40%; height:auto;" alt=""> <i
                                                    class="ri-arrow-right-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rs-project__items">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-4.jpg" alt="">
                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Hari</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets\images\Socialmedia.png"
                                                    style="width:40%; height:auto;" alt=""> <i
                                                    class="ri-arrow-right-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rs-project__items">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-5.jpg" alt="">
                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Ram</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets\images\Socialmedia.png"
                                                    style="width:40%; height:auto;" alt=""> <i
                                                    class="ri-arrow-right-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rs-shape">
                <img src="assets/images/project/port-cube.svg" alt="">
            </div>
        </section>
        <!--======== Project Ends ========-->

        <!--======== Why Choose 2 Start ========-->
        <section class="rs-why-choose-2 pb-85">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="why-choose-2__content">
                            <div class="rs-section-title black">
                                <div class="top-sub-heading">
                                    <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                                    <span>Why Choose Us</span>
                                    <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                                </div>
                                <h2 class="title split-in-fade">
                                    Trusted Admission Guidance for a Brighter Academic Future
                                </h2>
                                <p>
                                    We help students make confident career decisions by providing personalized
                                    counseling,
                                    trusted college partnerships, and complete admission support from start to finish.
                                </p>
                            </div>

                            <div class="skill-bars">

                                <div class="rs-progress-skill why-choose-two__progress">
                                    <h4 class="rs-progress__title">Student Counseling & Career Guidance</h4>
                                    <div class="rs-progress__bar">
                                        <div class="rs-progress__inner rs-count-bar counted" data-percent="95%">
                                            <p class="rs-progress__number count-text">95%</p>
                                        </div>
                                    </div>
                                </div><!-- /.rs-progress -->

                                <div class="rs-progress-skill why-choose-two__progress">
                                    <h4 class="rs-progress__title">College Tie-ups & Admission Support</h4>
                                    <div class="rs-progress__bar">
                                        <div class="rs-progress__inner rs-count-bar counted" data-percent="90%">
                                            <p class="rs-progress__number count-text">90%</p>
                                        </div>
                                    </div>
                                </div><!-- /.rs-progress -->

                                <div class="rs-progress-skill why-choose-two__progress">
                                    <h4 class="rs-progress__title">Transparent Fee & Budget Planning</h4>
                                    <div class="rs-progress__bar">
                                        <div class="rs-progress__inner rs-count-bar counted" data-percent="92%">
                                            <p class="rs-progress__number count-text">92%</p>
                                        </div>
                                    </div>
                                </div><!-- /.rs-progress -->

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="rs-why-choose-2__thumb wow fadeInRight" data-wow-duration="1.5s"
                            data-wow-delay="0.4s">
                            <div class="rs-thumb-1">
                                <img src="assets/images/why-choose/chose-right-left.jpg" alt="">
                            </div>
                            <div class="rs-thumb-2">
                                <img src="assets/images/why-choose/chose-right-right.jpg" alt="">
                                <img src="assets/images/why-choose/chose-right-bottom.png" alt="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--======== Why Choose 2 Ends ========-->


        <!--======== Counter 2 Start ========-->
        <section class="rs-counter-2 pb-125">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-counter-2__title">
                            <h5 class="title">Our Student Success Journey</h5>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- BTech -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="rs-counter-2__item">
                            <div class="rs-counter-2__icon">
                                <img src="assets/images/counter/counter-icon-1.svg" alt="">
                            </div>
                            <div class="rs-counter-2__content">
                                <h4 class="title">
                                    <span class="rs-count odometer" data-count="850">00</span> +
                                </h4>
                                <span>BTech Admissions</span>
                            </div>
                        </div>
                    </div>

                    <!-- MBA -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="rs-counter-2__item item-2">
                            <div class="rs-counter-2__icon">
                                <img src="assets/images/counter/counter-icon-2.svg" alt="">
                            </div>
                            <div class="rs-counter-2__content">
                                <h4 class="title">
                                    <span class="rs-count odometer" data-count="520">00</span> +
                                </h4>
                                <span>MBA Admissions</span>
                            </div>
                        </div>
                    </div>

                    <!-- MCA -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="rs-counter-2__item item-3">
                            <div class="rs-counter-2__icon">
                                <img src="assets/images/counter/counter-icon-3.svg" alt="">
                            </div>
                            <div class="rs-counter-2__content">
                                <h4 class="title">
                                    <span class="rs-count odometer" data-count="430">00</span> +
                                </h4>
                                <span>MCA Admissions</span>
                            </div>
                        </div>
                    </div>

                    <!-- Diploma -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="rs-counter-2__item item-4">
                            <div class="rs-counter-2__icon">
                                <img src="assets/images/counter/counter-icon-4.svg" alt="">
                            </div>
                            <div class="rs-counter-2__content">
                                <h4 class="title">
                                    <span class="rs-count odometer" data-count="670">00</span> +
                                </h4>
                                <span>Diploma Admissions</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--======== Counter 2 Ends ========-->


        <!--======== Newsletter 2 Start ========-->
        <section class="rs-newsletter-2 pt-95 pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="rs-newsletter-2__box">
                            <h2 class="title split-in-fade">Need any kind of IT solution for <span>your business?</span>
                            </h2>
                            <div class="rs-newsletter-2__btn">
                                <a class="main-btn" href="contact.html">Contact Us <i
                                        class="ri-arrow-right-fill"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
            <div class="rs-newsletter-2__shape-1">
                <img class="gsap-rotate" src="assets/images/newsletter/close-ico-yeloow-grad.svg" alt="">

            </div>
            <div class="rs-newsletter-2__shape-2">
                <img class="gsap-move down-100 start-91" src="assets/images/newsletter/circle-white.svg" alt="">
            </div>
        </section>
        <!--======== Newsletter 2 Ends ========-->

        <!--======== Pricing Start ========-->
        <!-- <section class="rs-pricing pt-110 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-section-title black">
                            <div class="top-sub-heading">
                                <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                                <span>Start Business</span>
                                <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                            </div>
                            <h2 class="title split-in-fade">Our popular pricing package</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="rs-pricing__item">
                            <div class="rs-pricing__top-header">
                                <span>Silver Package</span>
                                <div class="rs-pricing__price-box">
                                    <h3 class="title">$29.00 <span>Per Month</span></h3>
                                </div>
                            </div>
                            <div class="rs-pricing__body">
                                <ul>
                                    <li class="list"><i class="ri-checkbox-circle-line"></i> 30 Days Trial Features</li>
                                    <li class="list"><i class="ri-checkbox-circle-line"></i> Unlimited Features</li>
                                    <li class="list disabled"><i class="ri-checkbox-blank-circle-line"></i> Multi-Language Content</li>
                                    <li class="list disabled"><i class="ri-checkbox-blank-circle-line"></i> Data backup and recovery</li>
                                    <li class="list disabled"><i class="ri-checkbox-blank-circle-line"></i> Synced To Cloud Database</li>
                                </ul>
                                <a class="main-btn" href="contact.html">Get Started <i class="ri-arrow-right-fill"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="rs-pricing__item">
                            <div class="rs-pricing__top-header">
                                <span>Gold Package</span>
                                <div class="rs-pricing__price-box">
                                    <h3 class="title">$49.00 <span>Per Month</span></h3>
                                </div>
                            </div>
                            <div class="rs-pricing__body">
                                <ul>
                                    <li class="list disabled"><i class="ri-checkbox-blank-circle-line"></i> 30 Days Trial Features</li>
                                    <li class="list"><i class="ri-checkbox-circle-line"></i> Unlimited Features</li>
                                    <li class="list"><i class="ri-checkbox-circle-line"></i> Multi-Language Content</li>
                                    <li class="list"><i class="ri-checkbox-circle-line"></i> Data backup and recovery</li>
                                    <li class="list disabled"><i class="ri-checkbox-blank-circle-line"></i> Synced To Cloud Database</li>
                                </ul>
                                <a class="main-btn" href="contact.html">Get Started <i class="ri-arrow-right-fill"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="rs-pricing__item last-item">
                            <div class="rs-pricing__top-header">
                                <span>Platinum Package</span>
                                <div class="rs-pricing__price-box">
                                    <h3 class="title">$99.00 <span>Per Month</span></h3>
                                </div>
                            </div>
                            <div class="rs-pricing__body">
                                <ul>
                                    <li class="list"><i class="ri-checkbox-circle-line"></i> 30 Days Trial Features</li>
                                    <li class="list disabled"><i class="ri-checkbox-blank-circle-line"></i> Unlimited Features</li>
                                    <li class="list disabled"><i class="ri-checkbox-blank-circle-line"></i> Multi-Language Content</li>
                                    <li class="list disabled"><i class="ri-checkbox-blank-circle-line"></i> Data backup and recovery</li>
                                    <li class="list"><i class="ri-checkbox-circle-line"></i> Synced To Cloud Database</li>
                                </ul>
                                <a class="main-btn" href="contact.html">Get Started <i class="ri-arrow-right-fill"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!--======== Pricing Ends ========-->

        <!--======== Faq Start ========-->
        <div class="rs-faq pb-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="rs-faq__thumb wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="0.4s">
                            <img src="assets/images/faq/faq-left-img.png" alt="faq">
                            <div class="rs-shape">
                                <img src="assets/images/faq/couple-ball-layer.svg" alt="faq">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="rs-faq__content">
                            <div class="rs-section-title black">
                                <div class="top-sub-heading">
                                    <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                                    <span>FAQ</span>
                                    <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                                </div>
                                <h2 class="title split-in-fade">Frequently Asked Questions</h2>
                            </div>

                            <div class="rs-faq__wrapper">

                                <!-- FAQ 1 -->
                                <div class="accordion active">
                                    <div class="accordion_tab active">
                                        01 How can I apply for college admission through your platform?
                                        <div class="accordion_arrow">
                                            <i class="ri-add-fill"></i>
                                        </div>
                                    </div>
                                    <div class="accordion_content">
                                        <div class="accordion_item">
                                            <p>
                                                You can fill out the inquiry form on our website with your academic
                                                details, preferred course, and city.
                                                Our admission experts will contact you, guide you with suitable
                                                colleges, and assist you throughout the complete admission process.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- FAQ 2 -->
                                <div class="accordion">
                                    <div class="accordion_tab">
                                        02 Do you charge any registration or consultation fees?
                                        <div class="accordion_arrow">
                                            <i class="ri-add-fill"></i>
                                        </div>
                                    </div>
                                    <div class="accordion_content">
                                        <div class="accordion_item">
                                            <p>
                                                Our basic counseling and guidance services are completely free. In some
                                                cases, specific premium services
                                                may involve minimal charges, which will always be communicated
                                                transparently before proceeding.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- FAQ 3 -->
                                <div class="accordion">
                                    <div class="accordion_tab">
                                        03 What documents are required for admission?
                                        <div class="accordion_arrow">
                                            <i class="ri-add-fill"></i>
                                        </div>
                                    </div>
                                    <div class="accordion_content">
                                        <div class="accordion_item">
                                            <p>
                                                Generally, you will need your academic mark sheets, ID proof,
                                                passport-size photographs,
                                                and transfer/migration certificates. Our team will provide a complete
                                                checklist based on your selected course and college.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- FAQ 4 -->
                                <div class="accordion">
                                    <div class="accordion_tab">
                                        04 Can you help with hostel and accommodation facilities?
                                        <div class="accordion_arrow">
                                            <i class="ri-add-fill"></i>
                                        </div>
                                    </div>
                                    <div class="accordion_content">
                                        <div class="accordion_item">
                                            <p>
                                                Yes, we assist students in finding suitable hostel and accommodation
                                                options based on their
                                                budget and preferred city. We ensure safe and comfortable living
                                                arrangements near the college campus.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- FAQ 5 -->
                                <div class="accordion">
                                    <div class="accordion_tab">
                                        05 How long does the admission process take?
                                        <div class="accordion_arrow">
                                            <i class="ri-add-fill"></i>
                                        </div>
                                    </div>
                                    <div class="accordion_content">
                                        <div class="accordion_item">
                                            <p>
                                                The duration depends on the college and course selection. Typically, the
                                                process may take
                                                7 to 21 working days after document submission. Our team ensures
                                                fast-track processing wherever possible.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="rs-faq__link">
                                <a class="main-btn" href="contact.html">
                                    Any Questions? <i class="ri-arrow-right-fill"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--======== Faq Ends ========-->


        <!--======== Testimonial 2 Start ========-->
        <section class="rs-testimonial-2 pt-110 pb-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="rs-testimonial-2__left-content">
                            <div class="rs-section-title black">
                                <div class="top-sub-heading">
                                    <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                                    <span>Student Testimonials </span>
                                    <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                                </div>
                                <h2 class="title split-in-fade">What our admitted students say about us?</h2>
                                <div class="rs-thumb">
                                    <img src="assets/images/testimonial/testimonial-left-img.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="rs-testimonial-2__slider-box">
                            <div class="rs-carousel owl-carousel" data-loop="true" data-items="1" data-margin="0"
                                data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000"
                                data-smart-speed="800" data-dots="true" data-nav="false" data-nav-speed="false"
                                data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false"
                                data-mobile-device-dots="true" data-ipad-device="1" data-ipad-device-nav="false"
                                data-ipad-device-dots="true" data-ipad-device2="1" data-ipad-device-nav2="false"
                                data-ipad-device-dots2="true" data-md-device="1" data-lg-device="1"
                                data-md-device-nav="false" data-md-device-dots="true" data-doteach="true">

                                <!-- Testimonial 1 -->
                                <div class="rs-testimonial-2__items">
                                    <div class="testimonial-content">
                                        <img src="assets/images/testimonial/quote_orange.svg" alt="">
                                        <p>I was confused about selecting the right college for B.Tech, but the team
                                            guided me properly and helped me secure admission without any hassle.</p>
                                    </div>
                                    <div class="testimonial-author">
                                        <div class="author-thumb">
                                            <img src="assets/images/testimonial/testi1.jpg" alt="">
                                        </div>
                                        <div class="author-content">
                                            <h5 class="title">Rahul Sharma</h5>
                                            <span>B.Tech Computer Science, Delhi Technical University</span>
                                            <img src="assets/images/testimonial/testimonial-brsnd-2.png" alt="">
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 2 -->
                                <div class="rs-testimonial-2__items">
                                    <div class="testimonial-content">
                                        <img src="assets/images/testimonial/quote_orange.svg" alt="">
                                        <p>The counseling support was excellent. I got admission in MBA Marketing at my
                                            preferred college smoothly and quickly.</p>
                                    </div>
                                    <div class="testimonial-author">
                                        <div class="author-thumb">
                                            <img src="assets/images/testimonial/testi2.jpg" alt="">
                                        </div>
                                        <div class="author-content">
                                            <h5 class="title">Priya Verma</h5>
                                            <span>MBA (Marketing), Pune Institute of Business Management</span>
                                            <img src="assets/images/testimonial/testimonial-brsnd-2.png" alt="">
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 3 -->
                                <div class="rs-testimonial-2__items">
                                    <div class="testimonial-content">
                                        <img src="assets/images/testimonial/quote_orange.svg" alt="">
                                        <p>From application to final confirmation, everything was handled
                                            professionally. I highly recommend their admission support services.</p>
                                    </div>
                                    <div class="testimonial-author">
                                        <div class="author-thumb">
                                            <img src="assets/images/testimonial/testi3.jpg" alt="">
                                        </div>
                                        <div class="author-content">
                                            <h5 class="title">Amit Kumar</h5>
                                            <span>BCA, Chandigarh Group of Colleges</span>
                                            <img src="assets/images/testimonial/testimonial-brsnd-2.png" alt="">
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 4 -->
                                <div class="rs-testimonial-2__items">
                                    <div class="testimonial-content">
                                        <img src="assets/images/testimonial/quote_orange.svg" alt="">
                                        <p>I also needed hostel support, and they arranged everything within my budget.
                                            The process was smooth and stress-free.</p>
                                    </div>
                                    <div class="testimonial-author">
                                        <div class="author-thumb">
                                            <img src="assets/images/testimonial/testi4.jpg" alt="">
                                        </div>
                                        <div class="author-content">
                                            <h5 class="title">Sneha Patel</h5>
                                            <span>B.Sc Nursing, Apollo College of Nursing</span>
                                            <img src="assets/images/testimonial/testimonial-brsnd-2.png" alt="">
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 5 -->
                                <div class="rs-testimonial-2__items">
                                    <div class="testimonial-content">
                                        <img src="assets/images/testimonial/quote_orange.svg" alt="">
                                        <p>The team compared multiple colleges for me and helped me make the best
                                            decision based on my budget and preferences.</p>
                                    </div>
                                    <div class="testimonial-author">
                                        <div class="author-thumb">
                                            <img src="assets/images/testimonial/testi5.jpg" alt="">
                                        </div>
                                        <div class="author-content">
                                            <h5 class="title">Vikram Singh</h5>
                                            <span>Diploma Mechanical Engineering, Government Polytechnic Jaipur</span>
                                            <img src="assets/images/testimonial/testimonial-brsnd-2.png" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--======== Testimonial 2 Ends ========-->


        <!--======== Blog 2 Start ========-->
        <section id="rs-blog" class="rs-blog-2 pt-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-section-title black">
                            <div class="top-sub-heading">
                                <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                                <span>Insights & Updates</span>
                                <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                            </div>
                            <h2 class="title split-in-fade">Latest Admission News & Guidance</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-carousel owl-carousel nav-style1" data-loop="true" data-items="3"
                            data-margin="20" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000"
                            data-smart-speed="800" data-dots="true" data-nav="false" data-nav-speed="false"
                            data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false"
                            data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="false"
                            data-ipad-device-dots="true" data-ipad-device2="2" data-ipad-device-nav2="false"
                            data-ipad-device-dots2="true" data-md-device="2" data-lg-device="3"
                            data-md-device-nav="false" data-md-device-dots="true" data-doteach="false">

                            <!-- Blog 1 -->
                            <div class="rs-blog-2__item">
                                <div class="rs-thumb">
                                    <img src="assets/images/blog/blog-6.jpg" alt="">
                                </div>
                                <div class="rs-content">
                                    <div class="rs-category">
                                        <a href="#">Admission Guide</a>
                                    </div>
                                    <h3 class="title"><a href="blog-single.html">Step-by-Step College Admission Process
                                            for 2025</a></h3>
                                    <p>Learn the complete admission process including documentation, eligibility
                                        criteria, and important deadlines for top colleges.</p>
                                    <div class="rs-blog-footer">
                                        <span>Updated Guidance</span>
                                        <a href="blog-single.html">Read More <i class="ri-arrow-right-fill"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog 2 -->
                            <div class="rs-blog-2__item">
                                <div class="rs-thumb">
                                    <img src="assets/images/blog/blog-8.png" alt="">
                                </div>
                                <div class="rs-content">
                                    <div class="rs-category">
                                        <a href="#">Career Counseling</a>
                                    </div>
                                    <h3 class="title"><a href="blog-single.html">How to Choose the Right Course After
                                            12th?</a></h3>
                                    <p>Confused about course selection? Explore the best career options based on your
                                        interests, eligibility, and future opportunities.</p>
                                    <div class="rs-blog-footer">
                                        <span>Expert Advice</span>
                                        <a href="blog-single.html">Read More <i class="ri-arrow-right-fill"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog 3 -->
                            <div class="rs-blog-2__item">
                                <div class="rs-thumb">
                                    <img src="assets/images/blog/blog-5.jpg" alt="">
                                </div>
                                <div class="rs-content">
                                    <div class="rs-category">
                                        <a href="#">Top Colleges</a>
                                    </div>
                                    <h3 class="title"><a href="blog-single.html">Top Engineering & Management Colleges
                                            in India</a></h3>
                                    <p>Discover the best colleges offering B.Tech, MBA, BCA, Nursing and other
                                        professional courses across major cities.</p>
                                    <div class="rs-blog-footer">
                                        <span>College Updates</span>
                                        <a href="blog-single.html">Read More <i class="ri-arrow-right-fill"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog 4 -->
                            <div class="rs-blog-2__item">
                                <div class="rs-thumb">
                                    <img src="assets/images/blog/blog-4.jpg" alt="">
                                </div>
                                <div class="rs-content">
                                    <div class="rs-category">
                                        <a href="#">Scholarships</a>
                                    </div>
                                    <h3 class="title"><a href="blog-single.html">Scholarship Opportunities for Students
                                            in 2025</a></h3>
                                    <p>Check out the latest scholarship programs and financial aid options available for
                                        eligible students.</p>
                                    <div class="rs-blog-footer">
                                        <span>Financial Support</span>
                                        <a href="blog-single.html">Read More <i class="ri-arrow-right-fill"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog 5 -->
                            <div class="rs-blog-2__item">
                                <div class="rs-thumb">
                                    <img src="assets/images/blog/blog-7.jpg" alt="">
                                </div>
                                <div class="rs-content">
                                    <div class="rs-category">
                                        <a href="#">Hostel & Facilities</a>
                                    </div>
                                    <h3 class="title"><a href="blog-single.html">How to Find Safe & Affordable Student
                                            Accommodation</a></h3>
                                    <p>Everything you need to know about hostel facilities, rental options, and budget
                                        planning for students.</p>
                                    <div class="rs-blog-footer">
                                        <span>Student Support</span>
                                        <a href="blog-single.html">Read More <i class="ri-arrow-right-fill"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--======== Blog 2 Ends ========-->


        <!--======== Footer 2 Start ========-->
        <footer id="rs-contact" class="rs-footer rs-footer-2">
            <div class="rs-footer__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="rs-footer__info-box">
                                <div class="icon">
                                    <img src="assets/images/footer/info-3.png" alt="">
                                </div>
                                <div class="content">
                                    <span>Contact Us</span>
                                    <a href="tel:+004555012065">+91 9999999999</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="rs-footer__info-box">
                                <div class="icon">
                                    <img src="assets/images/footer/info-1.png" alt="">
                                </div>
                                <div class="content">
                                    <span>Email Us</span>
                                    <a href="mailto:edutech@gmail.com">edutech@gmail.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="rs-footer__info-box">
                                <div class="icon">
                                    <img src="assets/images/footer/info-2.png" alt="">
                                </div>
                                <div class="content">
                                    <span>Address</span>
                                    <h4 class="title"> Bhubaneswar, Odisha, 752054 </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            $(window).on('load', function () {
                // 1. Initialize Background Slider (Sliding Left to Right)
                var bgSlider = $('.hero-bg-slider');

                if (bgSlider.length) {
                    bgSlider.owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 1000, // Stay on image for 1s
                        smartSpeed: 800, // Sliding animation speed
                        nav: false,
                        dots: false,
                        margin: 0,
                        animateOut: false, // MUST be false for sliding left-to-right
                        animateIn: false, // MUST be false for sliding left-to-right
                        mouseDrag: false,
                        touchDrag: false
                    });

                    // Force a refresh after a short delay to calculate widths correctly
                    setTimeout(function () {
                        bgSlider.trigger('refresh.owl.carousel');
                    }, 200);
                }

                // 2. Typing Effect (Writes and Deletes)
                const typingElement = document.querySelector(".typing-text");
                if (typingElement) {
                    const words = JSON.parse(typingElement.getAttribute("data-words"));
                    let wordIndex = 0,
                        charIndex = 0,
                        isDeleting = false;

                    function typeEffect() {
                        const currentWord = words[wordIndex];

                        if (isDeleting) {
                            typingElement.textContent = currentWord.substring(0, charIndex--);
                        } else {
                            typingElement.textContent = currentWord.substring(0, charIndex++);
                        }

                        let typeSpeed = isDeleting ? 70 : 150;

                        if (!isDeleting && charIndex === currentWord.length + 1) {
                            typeSpeed = 2000; // Pause at full word
                            isDeleting = true;
                        } else if (isDeleting && charIndex === 0) {
                            isDeleting = false;
                            wordIndex = (wordIndex + 1) % words.length;
                            typeSpeed = 500;
                        }

                        setTimeout(typeEffect, typeSpeed);
                    }
                    typeEffect();
                }
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                const modal = document.getElementById("enquireModal");
                const modalContent = document.querySelector(".enquire-modal-content");
                const closeBtn = document.querySelector(".enquire-close");

                // All open buttons
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

                // Close using cross
                if (closeBtn) {
                    closeBtn.addEventListener("click", function () {
                        modal.style.display = "none";
                    });
                }

                // Close when clicking outside form
                modal.addEventListener("click", function (e) {
                    if (!modalContent.contains(e.target)) {
                        modal.style.display = "none";
                    }
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

</body>

</html>