<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/db.php';

$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

function clean_input($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = clean_input($_POST['full_name'] ?? '');
    $mobile = clean_input($_POST['mobile_number'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $state = clean_input($_POST['state'] ?? '');
    $district = clean_input($_POST['district'] ?? '');
    $city = clean_input($_POST['city'] ?? '');
    $message = clean_input($_POST['message'] ?? '');

    if (empty($full_name) || empty($mobile) || empty($email) || empty($state) || empty($district) || empty($city)) {
        $_SESSION['error'] = "All required fields must be filled.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $full_name)) {
        $_SESSION['error'] = "Full name should contain only letters.";
    } elseif (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $_SESSION['error'] = "Mobile number must be exactly 10 digits.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
    } else {
        // Duplicate Check
        $check = $conn->prepare("SELECT id FROM students WHERE mobile = ?");
        $check->bind_param("s", $mobile);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $_SESSION['error'] = "This mobile number is already registered.";
        } else {
            $stmt = $conn->prepare("INSERT INTO students (full_name, mobile, email, state, district, city, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sssssss", $full_name, $mobile, $email, $state, $district, $city, $message);
                if ($stmt->execute()) {
                    $_SESSION['success'] = "Application submitted successfully!";
                } else {
                    $_SESSION['error'] = "Something went wrong. Please try again.";
                }
                $stmt->close();
            } else {
                $_SESSION['error'] = "Database error.";
            }
        }
        $check->close();
    }
    header("Location: " . basename($_SERVER['PHP_SELF']) . "#hero");
    exit();
}
?>




<!DOCTYPE html>
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

    <link rel="stylesheet" href="assets/css/style.css?v=1.3">
    <link rel="stylesheet" href="assets/css/card-swipe.css?v=1.3">
    <link rel="stylesheet" href="assets/css/brand.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/team.css">

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
                            <img src="assets/images/EDU-LOGO.jpeg" alt="Logo" class="logo-glow">
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
                                Your Dream, <br>
                                Our <span class="typing-text"
                                    data-words='["Mission"]'></span>
                            </h1>
                            <p class="journey-sub fs-4">START YOUR JOURNEY TODAY</p>
                            <!-- <a href="#" class="brochure-btn btn btn-warning rounded-pill px-4">DOWNLOAD BROCHURE <i
                                    class="ri-arrow-down-line"></i></a> -->
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
                                        <select name="state" id="stateSelHero" class="form-select" required>
                                            <option value="">Select State *</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <select name="district" id="districtSelHero" class="form-select" required>
                                            <option value="">Select District *</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <select name="city" id="citySelHero" class="form-select" required>
                                            <option value="">Select City *</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <textarea name="message" class="form-control"
                                            placeholder="Message (Optional)"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="hero-submit-btn w-100 mt-3">Submit Application</button>

                                <?php if (!empty($success)): ?>
                                    <div class="alert alert-success text-center mt-2"><?= $success ?></div>
                                <?php endif; ?>
                                <?php if (!empty($error)): ?>
                                    <div class="alert alert-danger text-center mt-2"><?= $error ?></div>
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


        <div class="program-nav-bar">
            <div class="container">
                <div class="nav-flex-wrapper">
                    <ul class="program-menu">
                        <li><a href="#home">HOME</a></li>
                        <li><a href="#about">ABOUT US</a></li>
                        <li><a href="management.php">COURSE</a></li>
                        <li><a href="blog.php">BLOGS</a></li>
                        <li><a href="#team">TEAM MEMBERS</a></li>
                        <li><a href="#gallery">GALLERY</a></li>
                        <li><a href="contact_us.php">CONTACT US</a></li>
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

        <section class="dashboard-info-section py-5 reveal">
            <div class="container">
                <div class="row g-4">

                    <div class="col-lg-8 col-md-12">
                        <div class="info-card h-100 notice-board-card shadow-sm">
                            <div class="card-header-custom d-flex justify-content-between align-items-center mb-4">
                                <h3 class="m-0 fw-bold">Notice Board</h3>
                                <a href="all-notices.php" class="view-all-text">View All</a>
                            </div>

                            <div class="notice-list">
                                <?php
                                // Array for Admin Panel Integration: 
                                // Replace this array later with a SQL fetch loop.
                                $notices = [
                                    ['d' => '17', 'm' => 'Feb', 'y' => '2026', 'title' => 'Information for candidates of B.Tech Admission Expert counseling 2026', 'pdf_size' => '22.15 KB'],
                                    ['d' => '16', 'm' => 'Feb', 'y' => '2026', 'title' => 'Tentative vacancies for EDUTECH Admission Experts list for session Jan 2026', 'pdf_size' => '431.81 KB'],
                                    ['d' => '13', 'm' => 'Feb', 'y' => '2026', 'title' => 'New partnership with Top Management Colleges in Bhubaneswar', 'pdf_size' => '62.66 KB'],
                                    ['d' => '13', 'm' => 'Feb', 'y' => '2026', 'title' => 'Important Notice: Scholarship results regarding 1st semester admissions', 'pdf_size' => '178.75 KB'],
                                    ['d' => '09', 'm' => 'Feb', 'y' => '2026', 'title' => 'Hostel orientation and allocation for Graduate candidates', 'pdf_size' => '131.61 KB']
                                ];
                                foreach ($notices as $n): ?>
                                    <div class="notice-row d-flex align-items-center mb-4 border-bottom pb-3">
                                        <div class="date-badge-box text-center me-3">
                                            <span class="badge-now">Now</span>
                                            <div class="date-inner">
                                                <span class="day"><?php echo $n['d']; ?></span>
                                                <span class="mon"><?php echo $n['m']; ?></span>
                                                <span class="year"><?php echo $n['y']; ?></span>
                                            </div>
                                        </div>

                                        <div class="notice-content flex-grow-1">
                                            <p class="notice-title m-0"><?php echo $n['title']; ?></p>
                                        </div>

                                        <div class="notice-actions d-flex align-items-center gap-2 ms-auto">
                                            <span
                                                class="small text-muted d-none d-sm-inline">(<?php echo $n['pdf_size']; ?>)</span>
                                            <a href="#" class="icon-btn pdf-btn" title="Download PDF">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                            <a href="#" class="icon-btn view-btn" title="View Details">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <nav class="mt-4">
                                <ul
                                    class="custom-pagination d-flex justify-content-center align-items-center list-unstyled gap-2">
                                    <li><a href="#" class="page-arrow"><i class="fa fa-chevron-left"></i></a></li>
                                    <li><a href="#" class="page-num active">1</a></li>
                                    <li><a href="#" class="page-num">2</a></li>
                                    <li><a href="#" class="page-num">3</a></li>
                                    <li><span class="page-dots">...</span></li>
                                    <li><a href="#" class="page-num">53</a></li>
                                    <li><a href="#" class="page-arrow"><i class="fa fa-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="side-wrapper h-100 d-flex flex-column gap-4">

                            <div class="quick-links-section">
                                <h4 class="fw-bold mb-3">Quick Links</h4>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <a href="#" class="quick-link-item">
                                            <i class="fa fa-pencil text-danger"></i>
                                            <span>Apply</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="quick-link-item">
                                            <i class="fa fa-id-card text-primary"></i>
                                            <span>Admit Card</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="quick-link-item">
                                            <i class="fa fa-key text-warning"></i>
                                            <span>Answer Key</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="quick-link-item">
                                            <i class="fa fa-chart-line text-success"></i>
                                            <span>Result</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="info-card calendar-card shadow-sm">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="m-0 fw-bold">Admission Calendar</h5>
                                    <div class="cal-nav small text-muted">
                                        <i class="fa fa-chevron-left pointer"></i>
                                        <span class="mx-2 fw-bold text-dark">Feb, 2026</span>
                                        <i class="fa fa-chevron-right pointer"></i>
                                    </div>
                                </div>

                                <div class="calendar-timeline border-left-line">
                                    <?php
                                    $events = [
                                        ['d' => '16', 'm' => 'MAR', 'title' => 'B.Tech Entrance Examination, 2026'],
                                        ['d' => '16', 'm' => 'MAR', 'title' => 'SSA / UDC Grade Limited Competitive Exam'],
                                        ['d' => '31', 'm' => 'MAR', 'title' => 'Selection Posts Examination Registration']
                                    ];
                                    foreach ($events as $e): ?>
                                        <div class="calendar-item d-flex align-items-center mb-4">
                                            <div class="cal-date-badge text-center">
                                                <span class="cal-d"><?php echo $e['d']; ?></span>
                                                <span class="cal-m"><?php echo $e['m']; ?></span>
                                            </div>
                                            <div class="cal-content ps-3 flex-grow-1 border-bottom pb-2">
                                                <p class="small fw-bold mb-0 text-navy"><?php echo $e['title']; ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="text-center mt-3">
                                    <a href="full-calendar.php" class="view-all-text text-danger">View All</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!--======== Four Card Start ========-->
        <section class="rs-featured-cards pt-100 pb-100 reveal">
            <div class="container">
                <div class="row reveal mobile-card-slider">
                    <div class="col-lg-3 col-md-6 mb-30">
                        <div class="rs-featured-5__item"
                            style="background: linear-gradient(130deg, #002147 0%, #004080 100%);">
                            <div class="rs-thumb">
                                <img src="assets/images/featured/ex1.png" alt="Exams">
                            </div>
                            <div class="rs-content">
                                <h4 class="title" style="color: #fff;">Exams</h4>
                                <p style="color: #fff; font-size: 14px;">Stay updated with entrance exam dates,
                                    patterns and preparation tips.</p>
                                <a class="main-btn" href="#" style="padding: 10px 20px; font-size: 14px;">Find Exams</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-30">
                        <div class="rs-featured-5__item"
                            style="background: linear-gradient(130deg, #28a745 0%, #34d058 100%);">
                            <div class="rs-thumb">
                                <img src="assets/images/featured/clg1.png" alt="Colleges">
                            </div>
                            <div class="rs-content">
                                <h4 class="title" style="color: #fff;">Colleges</h4>
                                <p style="color: #fff; font-size: 14px;">Discover colleges that match your interests,
                                    budget and career goals.</p>
                                <br>
                                <a class="main-btn" href="#" style="padding: 10px 20px; font-size: 14px;">Find
                                    College</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-30">
                        <div class="rs-featured-5__item"
                            style="background: linear-gradient(130deg, #F26F20 0%, #FFA500 100%);">
                            <div class="rs-thumb">
                                <img src="assets/images/featured/co11.png" alt="Courses">
                            </div>
                            <div class="rs-content">
                                <h4 class="title" style="color: #fff;">Courses</h4>
                                <p style="color: #fff; font-size: 14px;">Browse industry-relevant courses designed for
                                    your future success.</p>
                                <br>
                                <a class="main-btn" href="management.php"
                                    style="padding: 10px 20px; font-size: 14px;">Find Courses</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-30">
                        <div class="rs-featured-5__item"
                            style="background: linear-gradient(130deg, #6f42c1 0%, #8959e0 100%);">
                            <div class="rs-thumb">
                                <img src="assets/images/featured/jb1.jpeg" alt="Jobs">
                            </div>
                            <div class="rs-content">
                                <h4 class="title" style="color: #fff;">Jobs</h4>
                                <p style="color: #fff; font-size: 14px;">Explore career paths and placement
                                    opportunities after graduation.</p>
                                <a class="main-btn" href="#" style="padding: 10px 20px; font-size: 14px;">Find Jobs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--======== Service 2 Start ========-->
        <!-- <div class="rs-service-2 pt-90 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rs-carousel owl-carousel service-slider-bottom" data-loop="true" data-items="5"
                            data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000"
                            data-smart-speed="800" data-dots="false" data-nav="true" data-nav-speed="false"
                            data-center-mode="false" data-mobile-device="1.2" data-mobile-device-nav="true"
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
        </div> -->
        <!--======== Service 2 Ends ========-->

        <section id="rs-course-explorer-unique" class="pt-20 pb-60 reveal" style="background: #fff; overflow: hidden;">
            <div class="container" id="course">
                <div class="rs-section-title black text-center mb-50">
                    <div class="top-sub-heading">
                        <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                        <span>Program Finder</span>
                        <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                    </div>
                    <h2 class="title">Explore Courses by Stream</h2>
                </div>

                <?php
                // Multi-dimensional array mapping Streams -> Branches -> Images
                $courseData = [
                    "B.Tech" => [
                        ["name" => "CSE", "img" => "assets/images/courses/cse.jpg"],
                        ["name" => "IT", "img" => "assets/images/courses/it.jpg"],
                        ["name" => "Mechanical", "img" => "assets/images/courses/mech.jpg"],
                        ["name" => "Civil", "img" => "assets/images/courses/civil.jpg"],
                        ["name" => "EE", "img" => "assets/images/courses/ee.jpg"],
                        ["name" => "ECE", "img" => "assets/images/courses/ece.jpg"],
                        ["name" => "EEE", "img" => "assets/images/courses/eee.jpg"],
                        ["name" => "Chemical", "img" => "assets/images/courses/chemical.png"],
                        ["name" => "AI & ML", "img" => "assets/images/courses/aiml.jpg"],
                        ["name" => "Data Science", "img" => "assets/images/courses/datascience.jpg"],
                        ["name" => "Cyber Security", "img" => "assets/images/courses/cyber.webp"],
                        ["name" => "Robotics", "img" => "assets/images/courses/robotics.webp"]
                    ],
                    "MBBS" => [
                        ["name" => "General Medicine", "img" => "assets/images/courses/med-gen.jpg"],
                        ["name" => "Pediatrics", "img" => "assets/images/courses/med-pedia.webp"],
                        ["name" => "Dermatology", "img" => "assets/images/courses/med-derma.jpg"],
                        ["name" => "Psychiatry", "img" => "assets/images/courses/med-psych.jpg"],
                        ["name" => "Radiology", "img" => "assets/images/courses/med-radio.jpg"],
                        ["name" => "General Surgery", "img" => "assets/images/courses/med-surgery.avif"],
                        ["name" => "Orthopedics", "img" => "assets/images/courses/med-ortho.png"],
                        ["name" => "ENT", "img" => "assets/images/courses/med-ent.jpg"],
                        ["name" => "OB-GYN", "img" => "assets/images/courses/med-gyn.jpg"]
                    ],
                    "BDS" => [
                        ["name" => "Orthodontics", "img" => "assets/images/courses/bds-ortho.jpg"],
                        ["name" => "Oral Surgery", "img" => "assets/images/courses/bds-surgery.jpg"],
                        ["name" => "Prosthodontics", "img" => "assets/images/courses/bds-prostho.jpg"],
                        ["name" => "Periodontics", "img" => "assets/images/courses/bds-perio.jpg"],
                        ["name" => "Conservative Dentistry", "img" => "assets/images/courses/bds-con.jpg"],
                        ["name" => "Pediatric Dentistry", "img" => "assets/images/courses/bds-pedia.jpg"]
                    ],
                    "MD/MS" => [
                        ["name" => "Pathology", "img" => "assets/images/courses/md-path.jpg"],
                        ["name" => "Microbiology", "img" => "assets/images/courses/md-micro.jpg"],
                        ["name" => "Pharmacology", "img" => "assets/images/courses/md-pharm.jpg"],
                        ["name" => "General Surgery", "img" => "assets/images/courses/ms-surg.jpg"],
                        ["name" => "ENT", "img" => "assets/images/courses/ms-ent.jpg"],
                        ["name" => "Ophthalmology", "img" => "assets/images/courses/ms-ophth.jpg"],
                        ["name" => "MDS", "img" => "assets/images/courses/mds.jpg"]
                    ],
                    "Agriculture" => [
                        ["name" => "Agronomy", "img" => "assets/images/courses/agri-agro.jpg"],
                        ["name" => "Horticulture", "img" => "assets/images/courses/agri-horti.jpg"],
                        ["name" => "Soil Science", "img" => "assets/images/courses/agri-soil.jpg"],
                        ["name" => "Plant Pathology", "img" => "assets/images/courses/agri-plant.jpg"],
                        ["name" => "Forestry", "img" => "assets/images/courses/agri-forest.jpg"],
                        ["name" => "Seed Tech", "img" => "assets/images/courses/agri-seed.jpg"]
                    ],
                    "Veterinary" => [
                        ["name" => "Animal Nutrition", "img" => "assets/images/courses/vet-nutri.jpg"],
                        ["name" => "Genetics", "img" => "assets/images/courses/vet-gen.jpg"],
                        ["name" => "Surgery", "img" => "assets/images/courses/vet-surg.jpg"],
                        ["name" => "Medicine", "img" => "assets/images/courses/vet-med.jpg"],
                        ["name" => "Dairy Science", "img" => "assets/images/courses/vet-dairy.jpg"],
                        ["name" => "Poultry", "img" => "assets/images/courses/vet-poultry.jpg"]
                    ],
                    "MBA" => [
                        ["name" => "Finance", "img" => "assets/images/courses/mba-fin.avif"],
                        ["name" => "Marketing", "img" => "assets/images/courses/mba-mkt.avif"],
                        ["name" => "HR", "img" => "assets/images/courses/mba-hr.jpg"],
                        ["name" => "Operations", "img" => "assets/images/courses/mba-ops.jpeg"],
                        ["name" => "International Business", "img" => "assets/images/courses/mba-ib.jpg"],
                        ["name" => "Business Analytics", "img" => "assets/images/courses/mba-ana.jpg"],
                        ["name" => "Supply Chain", "img" => "assets/images/courses/mba-scm.jpg"]
                    ],
                    "MCA" => [
                        ["name" => "Software Development", "img" => "assets/images/courses/mca-dev.jpg"],
                        ["name" => "Data Science", "img" => "assets/images/courses/mca-ds.jpg"],
                        ["name" => "AI", "img" => "assets/images/courses/mca-ai.jpg"],
                        ["name" => "Cloud Computing", "img" => "assets/images/courses/mca-cloud.webp"],
                        ["name" => "Cyber Security", "img" => "assets/images/courses/mca-cyber.jpg"],
                        ["name" => "Web Dev", "img" => "assets/images/courses/mca-web.jpg"]
                    ],
                    "BBA" => [
                        ["name" => "Finance", "img" => "assets/images/courses/bba-fin.avif"],
                        ["name" => "Marketing", "img" => "assets/images/courses/bba-mkt.avif"],
                        ["name" => "HR", "img" => "assets/images/courses/bba-hr.jpg"],
                        ["name" => "International Business", "img" => "assets/images/courses/bba-ib.jpg"],
                        ["name" => "Business Analytics", "img" => "assets/images/courses/bba-ana.jpg"],
                        ["name" => "Retail", "img" => "assets/images/courses/bba-retail.jpg"]
                    ],
                    "BCA" => [
                        ["name" => "Software Development", "img" => "assets/images/courses/bca-dev.jpg"],
                        ["name" => "Data Analytics", "img" => "assets/images/courses/bca-ana.jpg"],
                        ["name" => "Cyber Security", "img" => "assets/images/courses/bca-cyber.jpg"],
                        ["name" => "Cloud Computing", "img" => "assets/images/courses/bca-cloud.webp"],
                        ["name" => "Web Dev", "img" => "assets/images/courses/bca-web.jpg"]
                    ],
                    "Nursing" => [
                        ["name" => "General Nursing", "img" => "assets/images/courses/nur-gen.jpg"],
                        ["name" => "Pediatric", "img" => "assets/images/courses/nur-pedia.jpg"],
                        ["name" => "Psychiatric", "img" => "assets/images/courses/nur-psych.jpg"],
                        ["name" => "Community Health", "img" => "assets/images/courses/nur-comm.jpg"],
                        ["name" => "Critical Care", "img" => "assets/images/courses/nur-care.jpg"]
                    ],
                    "B.Pharm" => [
                        ["name" => "Pharmaceutical Chem", "img" => "assets/images/courses/pharm-chem.jpg"],
                        ["name" => "Pharmacology", "img" => "assets/images/courses/pharm-logy.jpg"],
                        ["name" => "Pharmaceutics", "img" => "assets/images/courses/pharm-ceutics.jpg"],
                        ["name" => "Pharmacognosy", "img" => "assets/images/courses/pharm-nosy.jpg"],
                        ["name" => "Industrial", "img" => "assets/images/courses/pharm-indus.jpg"]
                    ],
                    "Biotech" => [
                        ["name" => "Medical", "img" => "assets/images/courses/bio-med.jpg"],
                        ["name" => "Agricultural", "img" => "assets/images/courses/bio-agri.jpg"],
                        ["name" => "Genetic Engineering", "img" => "assets/images/courses/bio-gen.jpg"],
                        ["name" => "Molecular", "img" => "assets/images/courses/bio-mol.jpg"],
                        ["name" => "Bioinformatics", "img" => "assets/images/courses/bio-info.jpg"]
                    ],
                    "BHMS" => [
                        ["name" => "Materia Medica", "img" => "assets/images/courses/bhms-mat.jpg"],
                        ["name" => "Organon", "img" => "assets/images/courses/bhms-org.jpg"],
                        ["name" => "Repertory", "img" => "assets/images/courses/bhms-rep.jpg"],
                        ["name" => "Pharmacy", "img" => "assets/images/courses/bhms-pharm.jpg"]
                    ],
                    "BAMS" => [
                        ["name" => "Kayachikitsa", "img" => "assets/images/courses/bams-kaya.jpg"],
                        ["name" => "Panchakarma", "img" => "assets/images/courses/bams-pancha.jpg"],
                        ["name" => "Shalya", "img" => "assets/images/courses/bams-shalya.jpg"],
                        ["name" => "Shalakya", "img" => "assets/images/courses/bams-shala.jpg"],
                        ["name" => "Dravyaguna", "img" => "assets/images/courses/bams-dravya.jpg"]
                    ]
                ];
                ?>

                <div class="category-slider-wrapper reveal">
                    <div class="category-track" id="categoryDragTrack">
                        <?php $count = 0;
                        foreach ($courseData as $stream => $branches): ?>
                            <button class="category-btn <?= $count === 0 ? 'active' : '' ?>"
                                onclick="switchCourseStream(event, 'course-<?= str_replace([' ', '/', '.'], '', $stream) ?>')">
                                <?= $stream ?>
                            </button>
                        <?php $count++;
                        endforeach; ?>
                    </div>
                </div>

                <div class="branch-grid-container mt-50 reveal">
                    <?php $count = 0;
                    foreach ($courseData as $stream => $branches):
                        $cleanId = 'course-' . str_replace([' ', '/', '.'], '', $stream);
                    ?>
                        <div id="<?= $cleanId ?>" class="branch-panel <?= $count === 0 ? 'active' : '' ?>">

                            <div class="rs-carousel owl-carousel branch-slider" data-loop="true" data-items="3"
                                data-margin="30" data-autoplay="true" data-hoverpause="true" data-smart-speed="800"
                                data-dots="false" data-nav="true"
                                data-nav-text='["<span class=\"nav-btn prev-btn\"><i class=\"fa fa-arrow-left\"></i> Prev</span>","<span class=\"nav-btn next-btn\">Next <i class=\"fa fa-arrow-right\"></i></span>"]'
                                data-md-device="3" data-ipad-device="2" data-mobile-device="1">

                                <?php foreach ($branches as $branch): ?>
                                    <div class="branch-item">
                                        <div class="rs-featured-2__item branch-card-mini"
                                            style="margin: 10px; padding: 0; overflow: hidden; border: 1px solid #eee; border-radius: 12px; background: #fff;">

                                            <div class="rs-thumb" style="height: 180px; overflow: hidden; position: relative;">
                                                <img src="<?= $branch['img'] ?>" alt="<?= $branch['name'] ?>"
                                                    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                            </div>

                                            <div class="rs-content text-center" style="padding: 20px;">
                                                <h4 class="title"
                                                    style="font-size: 18px; margin-bottom: 8px; font-weight: 800; color: #002147;">
                                                    <?= $branch['name'] ?>
                                                </h4>
                                                <a class="rs-link" href="#"
                                                    style="font-size: 14px; font-weight: 700; color: #F26F20; text-decoration: none;">
                                                    View Details <i class="ri-arrow-right-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php $count++;
                    endforeach; ?>
                </div>
            </div>
        </section>


        <!--======== About 2 Start ========-->
        <section id="rs-about" class="rs-about-2 pt-60 pb-10 reveal">
            <div id="about" class="container">
                <div class="row align-items-center">

                    <!-- LEFT IMAGE -->
                    <div class="col-lg-6">
                        <div class="max-w-lg w-full mx-auto">
                            <div class="flex justify-center mb-6 space-x-3">
                                <div class="progress-dot w-3 h-3 rounded-full bg-slate-300" data-index="0"></div>
                                <div class="progress-dot w-3 h-3 rounded-full bg-slate-300" data-index="1"></div>
                                <div class="progress-dot w-3 h-3 rounded-full bg-slate-300" data-index="2"></div>
                            </div>

                            <div class="card-stack mb-12">
                                <div class="card active bounce-in" data-index="0">
                                    <div class="card-front p-0 overflow-hidden">
                                        <img src="assets/images/about/process-1.png" alt="Process 1" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div class="card next" data-index="1">
                                    <div class="card-front p-0 overflow-hidden">
                                        <img src="assets/images/about/process-2.png" alt="Process 2" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div class="card next-2" data-index="2">
                                    <div class="card-front p-0 overflow-hidden">
                                        <img src="assets/images/about/process-3.png" alt="Process 3" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            </div>

                            <div class="nav-button-wrapper" style="display: flex !important; justify-content: center !important; width: 100% !important; margin-top: 25px !important; position: relative !important; z-index: 100 !important;">
                                <div class="glass-pill-container">
                                    <button id="prev-btn" class="circle-btn">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button id="flip-btn-main" class="circle-btn center-large" style="visibility: hidden !important;">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <button id="next-btn" class="circle-btn">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT CONTENT -->
                    <div class="col-lg-6">
                        <div class="rs-about-2__main-content">
                            <div class="rs-section-title black">

                                <!-- TOP HEADING -->
                                <div class="top-sub-heading">
                                    <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="icon">
                                    <span>Welcome To EDUTECH</span>
                                    <img src="assets/images/heart-pulse-rate-orange.svg" alt="icon">
                                </div>

                                <!-- MAIN TITLE -->
                                <h2 class="title split-in-fade">
                                    Guiding Students Towards the Right Career Path
                                </h2>

                                <br>

                                <!-- TABS -->
                                <div id="rs-tabs" class="skltbs-theme-light use-drop skltbs-mode-tabs skltbs-init">

                                    <!-- TAB BUTTONS -->
                                    <ul class="skltbs-tab-group">
                                        <li class="skltbs-tab-item">
                                            <button class="skltbs-tab about-tab-sync" data-tab-index="0">Our Mission</button>
                                        </li>
                                        <li class="skltbs-tab-item">
                                            <button class="skltbs-tab about-tab-sync" data-tab-index="1">Our Vision</button>
                                        </li>
                                        <li class="skltbs-tab-item">
                                            <button class="skltbs-tab about-tab-sync" data-tab-index="2">Core Value</button>
                                        </li>
                                    </ul>

                                    <!-- TAB PANELS -->
                                    <div class="skltbs-panel-group">

                                        <!-- MISSION -->
                                        <div class="skltbs-panel">
                                            <p>
                                                Our mission is to guide students and professionals toward the right
                                                educational and career opportunities through personalized counselling,
                                                modern technology, and transparent support.
                                            </p>

                                            <ul>
                                                <li><i class="ri-share-forward-fill"></i> Personalized mentorship to
                                                    help students choose the right course and college.</li>

                                                <li><i class="ri-share-forward-fill"></i> Career-focused guidance that
                                                    connects education with future opportunities.</li>
                                            </ul>

                                            <a class="main-btn" href="about_us.php">
                                                Know More About Us
                                                <i class="ri-arrow-right-fill"></i>
                                            </a>

                                            <div class="play-icon">
                                                <a class="rs-popup-videos"
                                                    href="https://www.youtube.com/watch?v=example">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- VISION -->
                                        <div class="skltbs-panel">
                                            <p>
                                                Our vision is to become a trusted education guidance platform that helps
                                                students
                                                confidently choose the right academic path and build successful careers.
                                                We aim to
                                                bridge the gap between students and quality institutions through
                                                reliable guidance
                                                and modern counselling methods.
                                            </p>

                                            <ul>
                                                <li>
                                                    <i class="ri-share-forward-fill"></i>
                                                    Making quality education accessible to students everywhere.
                                                </li>

                                                <li>
                                                    <i class="ri-share-forward-fill"></i>
                                                    Supporting students from admission guidance to career readiness.
                                                </li>
                                            </ul>

                                            <a class="main-btn" href="about_us.php">
                                                Know More About Us
                                                <i class="ri-arrow-right-fill"></i>
                                            </a>

                                            <div class="play-icon">
                                                <a class="rs-popup-videos"
                                                    href="https://www.youtube.com/watch?v=example">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- CORE VALUE -->
                                        <div class="skltbs-panel">

                                            <p>
                                                Our core values define how we guide students and build trust with
                                                families.
                                                We focus on integrity, dedication, and student success in every step of
                                                the
                                                education consulting journey.
                                            </p>

                                            <ul>
                                                <li>
                                                    <i class="ri-share-forward-fill"></i>
                                                    Student-First Approach – Every student’s success is our priority.
                                                </li>

                                                <li>
                                                    <i class="ri-share-forward-fill"></i>
                                                    Transparency & Integrity – Honest guidance in every admission
                                                    process.
                                                </li>
                                            </ul>


                                            <a class="main-btn" href="about_us.php">
                                                Know More About Us
                                                <i class="ri-arrow-right-fill"></i>
                                            </a>

                                            <div class="play-icon ms-3">
                                                <a class="rs-popup-videos"
                                                    href="https://www.youtube.com/watch?v=example">
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
        <div class="rs-brand reveal">
            <div class="container">

                <div class="rs-brand__top-title text-center">
                    <img src="assets/images/heart-pulse-rate-orange-2.svg" alt="">
                    <span>Our College Partners</span>
                    <img src="assets/images/heart-pulse-rate-orange.svg" alt="">
                </div>

                <div class="logos">
  <div class="logos-slide">
    <img src="assets/images/brand/alluri.png" />
    <img src="assets/images/brand/balaji.jpg" />
    <img src="assets/images/brand/bharath.png" />
    <img src="assets/images/brand/dy.png" />
    <img src="assets/images/brand/great.jpeg" />
    <img src="assets/images/brand/gvp.png" />
    <img src="assets/images/brand/kasturabha.jpeg" />
    <img src="assets/images/brand/kims.png" />
    <img src="assets/images/brand/maharaja.jpeg" />
    <img src="assets/images/brand/vinayak.png" />
    <img src="assets/images/brand/sri.png" />
    <img src="assets/images/brand/bits.png" />
    <img src="assets/images/brand/cvraman.png" />
    <img src="assets/images/brand/christ.jpeg" />
    <img src="assets/images/brand/kiit.png" />
    <img src="assets/images/brand/manipal.png" />
    <img src="assets/images/brand/rv.png" />
    <img src="assets/images/brand/soa.png" />
    <img src="assets/images/brand/srm.png" />
    <img src="assets/images/brand/vit.jpg" />
  </div>
  <!-- <div class="logos-slide">
    <img src="assets/images/brand/alluri.png" />
    <img src="assets/images/brand/balaji.jpg" />
    <img src="assets/images/brand/bharath.png" />
    <img src="assets/images/brand/dy.png" />
    <img src="assets/images/brand/great.jpeg" />
    <img src="assets/images/brand/gvp.png" />
    <img src="assets/images/brand/kasturabha.jpeg" />
    <img src="assets/images/brand/kims.png" />
    <img src="assets/images/brand/maharaja.jpeg" />
    <img src="assets/images/brand/vinayak.png" />
    <img src="assets/images/brand/sri.png" />
    <img src="assets/images/brand/bits.png" />
    <img src="assets/images/brand/cvraman.png" />
    <img src="assets/images/brand/christ.jpeg" />
    <img src="assets/images/brand/kiit.png" />
    <img src="assets/images/brand/manipal.png" />
    <img src="assets/images/brand/rv.png" />
    <img src="assets/images/brand/soa.png" />
    <img src="assets/images/brand/srm.png" />
    <img src="assets/images/brand/vit.jpg" />
  </div> -->
  
  
</div>

            </div>
        </div>

        <!--======== Brand End ========-->

        <!--======== TEAM MEMBERS ========-->
        <section id="rs-portfolios" class="rs-project reveal">
            <div id="team" class="container">
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

                            <div class="rs-project__items team-card-glass">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-1.jpg" alt="">

                                    <div class="team-glass-layer">
                                        <div class="glass-text">
                                            <h4 class="name">Dr. Pragati Sahai</h4>
                                            <p class="sub">Assistant Professor | 10+ Years Experience</p>
                                            <p class="bio">Expert career counselor specializing in management admissions
                                                and academic research with a proven track record.</p>
                                        </div>
                                    </div>

                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Sibani</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets/images/Socialmedia.png"
                                                    style="width:40%; height:auto;" alt=""> <i
                                                    class="ri-arrow-right-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rs-project__items team-card-glass">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-2.jpg" alt="">

                                    <div class="team-glass-layer">
                                        <div class="glass-text">
                                            <h4 class="name">Dr. Rashmi Saxena</h4>
                                            <p class="sub">Assistant Professor | PhD in Management</p>
                                            <p class="bio">Dedicated academician focusing on management strategies and
                                                student success pathways.</p>
                                        </div>
                                    </div>

                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Satya</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets/images/Socialmedia.png"
                                                    style="width:40%; height:auto;" alt=""> <i
                                                    class="ri-arrow-right-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rs-project__items team-card-glass">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-3.jpg" alt="">

                                    <div class="team-glass-layer">
                                        <div class="glass-text">
                                            <h4 class="name">Dr. Sachit Paliwal</h4>
                                            <p class="sub">Assistant Professor | 12+ Years Experience</p>
                                            <p class="bio">Leading expert in agriculture and medical stream admissions
                                                with extensive industrial knowledge.</p>
                                        </div>
                                    </div>

                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Dev</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets/images/Socialmedia.png"
                                                    style="width:40%; height:auto;" alt=""> <i
                                                    class="ri-arrow-right-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rs-project__items team-card-glass">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-4.jpg" alt="">

                                    <div class="team-glass-layer">
                                        <div class="glass-text">
                                            <h4 class="name">Ms. Mona Chaudhary</h4>
                                            <p class="sub">Assistant Professor | 9+ Years Experience</p>
                                            <p class="bio">Academic advisor specializing in postgraduate strategies and
                                                student mentoring.</p>
                                        </div>
                                    </div>

                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Hari</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets/images/Socialmedia.png"
                                                    style="width:40%; height:auto;" alt=""> <i
                                                    class="ri-arrow-right-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rs-project__items team-card-glass">
                                <div class="wrapping">
                                    <img src="assets/images/project/project-5.jpg" alt="">

                                    <div class="team-glass-layer">
                                        <div class="glass-text">
                                            <h4 class="name">Dr. Sunil Kumar</h4>
                                            <p class="sub">Assistant Professor | PhD in Management</p>
                                            <p class="bio">Senior expert in vocational training and diploma pathways for
                                                technical students.</p>
                                        </div>
                                    </div>

                                    <div class="rs-project__content">
                                        <ul>
                                            <li><a href="#">Consultation</a></li>
                                            <li><a href="#">Design</a></li>
                                            <li><a href="#">Strategy</a></li>
                                        </ul>
                                        <h3 class="title"><a href="project-details.html">Ram</a></h3>
                                        <div class="rs-link">
                                            <a href="project-details.html"><img src="assets/images/Socialmedia.png"
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
        </section>
        <!--======== TEAM MEMBERS ========-->

        <!--======== Why Choose 2 Start ========-->
        <section class="rs-why-choose-2 pb-85 reveal">
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
        <section class="rs-counter-2 pb-125 reveal">
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
        <!-- <section class="rs-newsletter-2 pt-95 pb-110 reveal">
            <div id="contact" class="container">
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
        </section> -->
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
        <div class="rs-faq pb-120 reveal">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="rs-faq__thumb wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="0.4s">
                            <img src="assets/images/faq/faqpic.png" alt="faq">
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
        <section class="rs-testimonial-2 pt-110 pb-120 reveal">
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
        <section id="rs-blog" class="rs-blog-2 pt-120 reveal">
            <div id="blogs" class="container">
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

        <footer id="rs-contact" class="rs-footer rs-footer-2 reveal">
            <section class="rs-contact-page pt-120 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="rs-contact-page__info">
                                <div class="rs-section-title black">
                                    <h3 class="title split-in-fade">Get in touch with us</h3>
                                    <p>Fill out the form below and our admission experts will contact you to discuss
                                        suitable courses, colleges, budget options .</p>
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
                                                    <h5 class="title"><a href="tel:+919438850101">+91 9438850101</a>
                                                    </h5>
                                                    <h5 class="title"><a href="tel:+918637274841">+91 8637274841</a>
                                                    </h5>
                                                    <h5 class="title"><a href="tel:+917205150641">+91 7205150641</a>
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
                    src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3743.325324883753!2d85.74879577734762!3d20.245338265813242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjDCsDE0JzQzLjIiTiA4NcKwNDUnMTMuMiJF!5e0!3m2!1sen!2sin!4v1772709818674!5m2!1sen!2sin"
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
                                    <h4 class="title">Quick Links</h4>
                                </div>
                                <ul>
                                    <li><a href="#home"><i class="ri-arrow-right-fill"></i> Home</a></li>
                                    <li><a href="#about"><i class="ri-arrow-right-fill"></i> About</a></li>
                                    <li><a href="#course"><i class="ri-arrow-right-fill"></i>Course</a></li>
                                    <li><a href="blog.php"><i class="ri-arrow-right-fill"></i> Blogs</a></li>
                                    <li><a href="#team"><i class="ri-arrow-right-fill"></i> Team Members</a></li>
                                    <li><a href="#gallery"><i class="ri-arrow-right-fill"></i> Gallery</a></li>
                                    <li><a href="#contact"><i class="ri-arrow-right-fill"></i> Contact Us</a></li>
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
            $(window).on('load', function() {
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
                    setTimeout(function() {
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




            $(document).ready(function() {
                var brandSlider = $('.mobile-brand-grid');

                function initBrandSlider() {
                    var isMobile = $(window).width() < 768;

                    if (isMobile) {
                        // 1. If we are on mobile, kill the carousel completely
                        if (brandSlider.hasClass('owl-loaded')) {
                            brandSlider.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
                            brandSlider.find('.owl-stage-outer').children().unwrap();
                        }
                        // 2. Ensure the class used for Grid CSS is present
                        brandSlider.addClass('mobile-grid-active');
                    } else {
                        // 3. Re-initialize for desktop sliding
                        brandSlider.removeClass('mobile-grid-active').addClass('owl-carousel');
                        if (!brandSlider.hasClass('owl-loaded')) {
                            brandSlider.owlCarousel({
                                items: 5,
                                loop: true,
                                autoplay: true,
                                dots: false,
                                nav: false
                            });
                        }
                    }
                }

                initBrandSlider();
                $(window).on('resize', function() {
                    initBrandSlider();
                });


            });

            $(document).ready(function() {
                // Only initialize the blog slider for mobile users
                if ($(window).width() < 768) {
                    $(".rs-blog-2 .owl-carousel").owlCarousel({
                        items: 1,
                        loop: true,
                        margin: 20,
                        autoplay: true,
                        dots: true,
                        stagePadding: 30 // Enables the card "peek"
                    });
                }
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
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

                openButtons.forEach(function(btn) {
                    if (btn) {
                        btn.addEventListener("click", function(e) {
                            e.preventDefault();
                            modal.style.display = "flex";
                        });
                    }
                });

                // Close logic
                if (closeBtn) {
                    closeBtn.addEventListener("click", function() {
                        modal.style.display = "none";
                    });
                }

                modal.addEventListener("click", function(e) {
                    if (!modalContent.contains(e.target)) {
                        modal.style.display = "none";
                    }
                });
            });

            $(document).ready(function() {
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

            $(document).ready(function() {
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
            document.addEventListener('DOMContentLoaded', function() {
                const slider = document.querySelector('.category-slider-wrapper');
                let isDown = false;
                let startX;
                let scrollLeft;

                // Mouse Drag Logic
                slider.addEventListener('mousedown', (e) => {
                    isDown = true;
                    startX = e.pageX - slider.offsetLeft;
                    scrollLeft = slider.scrollLeft;
                });
                slider.addEventListener('mouseleave', () => {
                    isDown = false;
                });
                slider.addEventListener('mouseup', () => {
                    isDown = false;
                });
                slider.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - slider.offsetLeft;
                    const walk = (x - startX) * 2;
                    slider.scrollLeft = scrollLeft - walk;
                });

                window.switchCourseStream = function(evt, streamId) {
                    document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
                    document.querySelectorAll('.branch-panel').forEach(panel => panel.classList.remove('active'));

                    const activePanel = document.getElementById(streamId);
                    if (activePanel) {
                        activePanel.classList.add('active');
                        evt.currentTarget.classList.add('active');

                        setTimeout(function() {
                            var $carousel = $(activePanel).find('.branch-slider');
                            if ($carousel.hasClass('owl-loaded')) {
                                $carousel.trigger('refresh.owl.carousel');
                            } else {
                                // Inside your switchCourseStream function, update the owlCarousel initialization:
                                $carousel.owlCarousel({
                                    loop: true,
                                    margin: 30,
                                    nav: true,
                                    dots: false,
                                    autoplay: true,
                                    // Use the same SPAN structure here
                                    navText: [
                                        "<span class='nav-btn prev-btn'><i class='fa fa-arrow-left'></i> Prev</span>",
                                        "<span class='nav-btn next-btn'>Next <i class='fa fa-arrow-right'></i></span>"
                                    ],
                                    responsive: {
                                        0: {
                                            items: 1
                                        },
                                        768: {
                                            items: 2
                                        },
                                        992: {
                                            items: 3
                                        }
                                    }
                                });
                            }
                        }, 100);
                    }
                    evt.currentTarget.scrollIntoView({
                        behavior: 'smooth',
                        inline: 'center',
                        block: 'nearest'
                    });
                };
            });
        </script>

        <script>
            document.getElementById("contact-form").addEventListener("submit", function(e) {
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



        <div id="enquireModal" class="enquire-modal">
            <div class="enquire-overlay"></div>

            <div class="enquire-modal-content">
                <button type="button" class="enquire-close">&times;</button>

                <div class="hero-form-box compact-form shadow-lg">
                    <h3 class="form-title text-center text-dark fw-bold mb-4">Enquire Now</h3>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success text-center"><?= $success ?></div>
                    <?php endif; ?>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
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
                                <select name="state" id="stateSel" class="form-select" required>
                                    <option value="">Select State *</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <select name="district" id="districtSel" class="form-select" required>
                                    <option value="">Select District *</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-2">
                                <select name="city" id="citySel" class="form-select" required>
                                    <option value="">Select City *</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-2">
                                <textarea name="message" class="form-control"
                                    placeholder="Message (Optional)"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="hero-submit-btn w-100 mt-3">Submit Application</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            var stateObject = {
                "ODISHA": {
                    "KHORDHA": ["BHUBANESWAR", "JATANI", "KHORDHA TOWN"],
                    "CUTTACK": ["CUTTACK CITY", "CHOUDWAR", "ATHAGARH"],
                    "PURI": ["PURI CITY", "KONARK", "PIPLI"]
                },
                "BIHAR": {
                    "PATNA": ["PATNA CITY", "DANAPUR"],
                    "GAYA": ["GAYA CITY", "BODH GAYA"],
                    "MUZAFFARPUR": ["MUZAFFARPUR TOWN"]
                },
                "JHARKHAND": {
                    "RANCHI": ["RANCHI CITY", "HATIA"],
                    "EAST SINGHBHUM": ["JAMSHEDPUR"],
                    "DHANBAD": ["DHANBAD TOWN"]
                }
            }

            window.addEventListener('DOMContentLoaded', (event) => {
                var stateSel = document.getElementById("stateSel");
                var districtSel = document.getElementById("districtSel");
                var citySel = document.getElementById("citySel");

                // Load States
                for (var state in stateObject) {
                    stateSel.options[stateSel.options.length] = new Option(state, state);
                }

                // State change logic
                stateSel.onchange = function() {
                    districtSel.length = 1; // reset
                    citySel.length = 1; // reset
                    if (this.value == "") return;

                    for (var district in stateObject[this.value]) {
                        districtSel.options[districtSel.options.length] = new Option(district, district);
                    }
                };

                // District change logic
                districtSel.onchange = function() {
                    citySel.length = 1; // reset
                    if (this.value == "") return;

                    var cities = stateObject[stateSel.value][this.value];
                    for (var i = 0; i < cities.length; i++) {
                        citySel.options[citySel.options.length] = new Option(cities[i], cities[i]);
                    }
                };
            });
        </script>
        <div class="floating-contact">
            <a href="https://wa.me/919999999999" target="_blank" class="contact-icon-box" title="Contact Us">
                <i class="fa fa-whatsapp"></i> </a>
        </div>


        <script>
            $('.brand-carousel').owlCarousel({
                loop: true,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: false,
                smartSpeed: 800,
                dots: false,
                nav: false,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.card');
                const progressDots = document.querySelectorAll('.progress-dot');
                const prevBtn = document.getElementById('prev-btn');
                const nextBtn = document.getElementById('next-btn');
                const flipBtn = document.getElementById('flip-btn');
                let currentIndex = 0;
                const totalCards = cards.length; // Store total count for loop logic

                let startX = 0;
                let currentX = 0;
                let isDragging = false;

                // Initialize cards
                updateCards();

                // Updated Next card function with infinite loop
                function nextCard() {
                    // Add swipe animation to current card
                    cards[currentIndex].classList.add('swipe-left');

                    setTimeout(() => {
                        // Loop: if at index 2 (third card), next is 0 (first card)
                        currentIndex = (currentIndex + 1) % totalCards;
                        updateCards();
                    }, 400);
                }

                // Updated Previous card function with infinite loop
                function prevCard() {
                    // Add swipe animation to current card
                    cards[currentIndex].classList.add('swipe-right');

                    setTimeout(() => {
                        // Loop: if at index 0, previous is 2 (totalCards - 1)
                        currentIndex = (currentIndex - 1 + totalCards) % totalCards;
                        updateCards();
                    }, 400);
                }

                // Update card positions and progress
                function updateCards() {
                    cards.forEach((card, index) => {
                        card.classList.remove('active', 'next', 'next-2', 'next-3', 'previous', 'previous-2', 'previous-3', 'hidden', 'swipe-left', 'swipe-right');

                        if (index === currentIndex) {
                            card.classList.add('active');
                        } else if (index === (currentIndex + 1) % totalCards) {
                            card.classList.add('next');
                        } else if (index === (currentIndex + 2) % totalCards) {
                            card.classList.add('next-2');
                        } else if (index === (currentIndex + 3) % totalCards) {
                            card.classList.add('next-3');
                        } else {
                            card.classList.add('hidden');
                        }
                    });

                    // Update progress indicators
                    progressDots.forEach((dot, index) => {
                        if (index === currentIndex) {
                            dot.classList.add('active', 'bg-white');
                            dot.classList.remove('bg-white/30');
                        } else {
                            dot.classList.remove('active', 'bg-white');
                            dot.classList.add('bg-white/30');
                        }
                    });

                    // Button states: Disabled for infinite loop is usually false, 
                    // but we keep them active so user can click indefinitely.
                    prevBtn.disabled = false;
                    nextBtn.disabled = false;
                    prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }

                // Flip current card
                function flipCurrentCard() {
                    cards[currentIndex].classList.toggle('flipped');
                }

                // Event listeners for navigation buttons
                prevBtn.addEventListener('click', prevCard);
                nextBtn.addEventListener('click', nextCard);
                flipBtn.addEventListener('click', flipCurrentCard);

                // Event listeners for card buttons
                cards.forEach(card => {
                    const flipBtnItem = card.querySelector('.flip-btn');
                    const swipeLeftBtn = card.querySelector('.swipe-left-btn');
                    const swipeRightBtn = card.querySelector('.swipe-right-btn');

                    if (flipBtnItem) {
                        flipBtnItem.addEventListener('click', (e) => {
                            e.stopPropagation();
                            card.classList.toggle('flipped');
                        });
                    }

                    if (swipeLeftBtn) {
                        swipeLeftBtn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            if (card.classList.contains('active')) {
                                prevCard();
                            }
                        });
                    }

                    if (swipeRightBtn) {
                        swipeRightBtn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            if (card.classList.contains('active')) {
                                nextCard();
                            }
                        });
                    }
                });

                // Click on card to navigate (if it's not active)
                cards.forEach(card => {
                    card.addEventListener('click', (e) => {
                        if (!card.classList.contains('active') && !card.classList.contains('flipped')) {
                            const index = parseInt(card.getAttribute('data-index'));
                            currentIndex = index;
                            updateCards();
                        }
                    });
                });

                // Touch events for mobile swipe
                const cardStack = document.querySelector('.card-stack');

                cardStack.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                    isDragging = true;
                });

                cardStack.addEventListener('touchmove', (e) => {
                    if (!isDragging) return;
                    currentX = e.touches[0].clientX;
                    const diff = currentX - startX;
                    if (cards[currentIndex]) {
                        cards[currentIndex].style.transform = `translateX(${diff}px) rotateZ(${diff * 0.1}deg)`;
                    }
                });

                cardStack.addEventListener('touchend', () => {
                    if (!isDragging) return;
                    isDragging = false;
                    if (cards[currentIndex]) {
                        cards[currentIndex].style.transform = '';
                    }

                    const diff = currentX - startX;
                    const swipeThreshold = 50;

                    if (Math.abs(diff) > swipeThreshold) {
                        if (diff > 0) {
                            prevCard();
                        } else {
                            nextCard();
                        }
                    }
                });

                // Mouse events for desktop drag
                cardStack.addEventListener('mousedown', (e) => {
                    startX = e.clientX;
                    isDragging = true;
                    cardStack.style.cursor = 'grabbing';
                });

                document.addEventListener('mousemove', (e) => {
                    if (!isDragging) return;
                    currentX = e.clientX;
                    const diff = currentX - startX;
                    if (cards[currentIndex]) {
                        cards[currentIndex].style.transform = `translateX(${diff}px) rotateZ(${diff * 0.1}deg)`;
                    }
                });

                document.addEventListener('mouseup', () => {
                    if (!isDragging) return;
                    isDragging = false;
                    cardStack.style.cursor = '';
                    if (cards[currentIndex]) {
                        cards[currentIndex].style.transform = '';
                    }

                    const diff = currentX - startX;
                    const swipeThreshold = 50;

                    if (Math.abs(diff) > swipeThreshold) {
                        if (diff > 0) {
                            prevCard();
                        } else {
                            nextCard();
                        }
                    }
                });

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        prevCard();
                    } else if (e.key === 'ArrowRight') {
                        nextCard();
                    } else if (e.key === ' ' || e.key === 'Spacebar') {
                        e.preventDefault();
                        flipCurrentCard();
                    }
                });
            });


            document.addEventListener('DOMContentLoaded', function() {
                // Existing variables
                const cards = document.querySelectorAll('.card');
                const progressDots = document.querySelectorAll('.progress-dot');
                const tabButtons = document.querySelectorAll('.about-tab-sync');
                const tabPanels = document.querySelectorAll('.skltbs-panel');

                let currentIndex = 0;
                const totalCards = cards.length;

                // --- FUNCTION: Sync Tabs when Card Swipes ---
                function syncTabs(index) {
                    tabButtons.forEach((btn, i) => {
                        if (i === index) {
                            btn.classList.add('skltbs-active');
                            // Trigger the skeletal tabs internal display logic
                            if (tabPanels[i]) {
                                tabPanels.forEach(p => p.classList.remove('skltbs-active'));
                                tabPanels[i].classList.add('skltbs-active');
                            }
                        } else {
                            btn.classList.remove('skltbs-active');
                        }
                    });
                }

                // --- FUNCTION: Update Cards (Modified to include tab sync) ---
                function updateCards() {
                    cards.forEach((card, index) => {
                        card.classList.remove('active', 'next', 'next-2', 'previous', 'hidden', 'swipe-left', 'swipe-right');

                        if (index === currentIndex) {
                            card.classList.add('active');
                        } else if (index === (currentIndex + 1) % totalCards) {
                            card.classList.add('next');
                        } else if (index === (currentIndex + 2) % totalCards) {
                            card.classList.add('next-2');
                        } else {
                            card.classList.add('hidden');
                        }
                    });

                    // Sync Dots
                    progressDots.forEach((dot, i) => {
                        dot.classList.toggle('bg-white', i === currentIndex);
                        dot.classList.toggle('bg-white/30', i !== currentIndex);
                    });

                    // NEW: Sync the Tabs
                    syncTabs(currentIndex);
                }

                // --- EVENT: Sync Card when Tab is Clicked ---
                tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const targetIndex = parseInt(this.getAttribute('data-tab-index'));

                        if (targetIndex !== currentIndex) {
                            // Add swipe animation to old card
                            cards[currentIndex].classList.add(targetIndex > currentIndex ? 'swipe-left' : 'swipe-right');

                            setTimeout(() => {
                                currentIndex = targetIndex;
                                updateCards();
                            }, 300);
                        }
                    });
                });

                // --- Existing Nav Buttons (Remain the same) ---
                document.getElementById('next-btn').addEventListener('click', () => {
                    cards[currentIndex].classList.add('swipe-left');
                    setTimeout(() => {
                        currentIndex = (currentIndex + 1) % totalCards;
                        updateCards();
                    }, 400);
                });

                document.getElementById('prev-btn').addEventListener('click', () => {
                    cards[currentIndex].classList.add('swipe-right');
                    setTimeout(() => {
                        currentIndex = (currentIndex - 1 + totalCards) % totalCards;
                        updateCards();
                    }, 400);
                });

                updateCards(); // Initial run
            });
        </script>
</body>

</html>