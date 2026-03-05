<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/db.php';

$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

// Reuse your clean_input function
function clean_input($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enquiry_form'])) {
    $full_name = clean_input($_POST['full_name'] ?? '');
    $mobile    = clean_input($_POST['mobile_number'] ?? '');
    $email     = clean_input($_POST['email'] ?? '');
    $state     = clean_input($_POST['state'] ?? '');
    $district  = clean_input($_POST['district'] ?? '');
    $city      = clean_input($_POST['city'] ?? '');
    $message   = clean_input($_POST['message'] ?? '');

    // Validation logic (Same as index.php)
    if (empty($full_name) || empty($mobile) || empty($email)) {
        $_SESSION['error'] = "Required fields must be filled.";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (full_name, mobile, email, state, district, city, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $full_name, $mobile, $email, $state, $district, $city, $message);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Application submitted successfully!";
        } else {
            $_SESSION['error'] = "Submission failed.";
        }
        $stmt->close();
    }
    header("Location: blog.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edutech - Blog & Events</title>
    <link rel="stylesheet" href="assets/css/blog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    <link rel="stylesheet" href="assets/css/team.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Poppins:wght@600;700;800&family=Outfit:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&display=swap"
        rel="stylesheet">

    <style>
        .edutech-main-header {
            padding: 5px 0;
            /* Reduced from original padding */
        }

        .logo-side {
            gap: 8px;
            /* Slightly tighter spacing for a compact look */
        }

        .logo-glow {
            height: 40px;
            /* Reduced logo size to fit slimmer header */
            width: auto;
        }

        .program-nav-bar {
            padding: 0;
            /* Remove extra padding */
        }

        .program-menu li a {
            padding: 10px 15px;
            /* Reduced vertical padding from top/bottom */
            font-size: 13px;
            /* Slightly smaller font for a compact bar */
            display: inline-block;
        }

        .nav-flex-wrapper {
            min-height: 35px;
            /* Force a specific slim height */
            display: flex;
            align-items: center;
        }

        /* 1. Main Modal Wrapper */
        .enquire-modal {
            display: none;
            /* Controlled via JS */
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 999999 !important;
            /* Highest layer on page */
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        /* 2. The Dark Background Overlay */
        .enquire-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(4px);
            z-index: 1;
            /* Stays at the bottom of the modal stack */
        }

        /* 3. The White Form Container */
        .enquire-modal-content {
            position: relative;
            /* Creates a new stacking context */
            background: #ffffff !important;
            /* Solid white background */
            padding: 35px 30px !important;
            border-radius: 20px;
            width: 450px;
            max-width: 90%;
            z-index: 10 !important;
            /* Leapfrogs the overlay */
            margin: 0 !important;
            float: none !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3) !important;
        }

        /* 4. The Close Button (The Cross) */
        .enquire-close {
            position: absolute;
            top: -15px !important;
            right: -15px !important;
            width: 35px;
            height: 35px;
            background: #ff4d4d !important;
            /* Bright red */
            color: #ffffff !important;
            border: 3px solid #ffffff;
            /* Contrast border */
            border-radius: 50%;
            font-size: 22px;
            font-weight: bold;
            cursor: pointer !important;
            z-index: 99 !important;
            /* Absolute highest layer for clickability */
            display: flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            pointer-events: auto !important;
            /* Forces capture of mouse clicks */
        }

        .enquire-close:hover {
            background: #e60000 !important;
            transform: scale(1.1);
        }

        /* Adjust form controls inside modal */
        .enquire-modal-content .form-control,
        .enquire-modal-content .form-select {
            border: 1px solid #e2e8f0;
            height: 42px;
            font-size: 14px;
        }
    </style>
</head>

<body>

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
    </div>

    <div class="program-nav-bar">
        <div class="container">
            <div class="nav-flex-wrapper">
                <ul class="program-menu">
                    <li><a href="#home">HOME</a></li>
                    <li><a href="#about">ABOUT US</a></li>
                    <li><a href="management.php">COURSE</a></li>
                    <li><a href="#blogs">BLOGS</a></li>
                    <li><a href="#team">TEAM MEMBERS</a></li>
                    <li><a href="#gallery">GALLERY</a></li>
                    <li><a href="#contact">CONTACT US</a></li>
                </ul>
                <div class="nav-action">
                    <a href="javascript:void(0);" id="openEnquireNav" class="navy-enquire-btn">
                        ENQUIRE NOW
                    </a>
                </div>
            </div>
        </div>
    </div>

    <main class="container">
        <div class="banner-container">
            <div class="banner-text">
                <h1>Blog & Events</h1>
                <p>Stay Updated with Our Latest Events, Tips & Success Stories</p>
            </div>
        </div>

        <div class="content-layout">
            <aside class="sidebar">
                <div class="sidebar-card">
                    <h3 class="sidebar-title"><span class="dot"></span> Categories</h3>
                    <ul class="category-list">
                        <li class="active">
                            <i class="fas fa-file-alt"></i> All Posts
                            <span class="active-indicator"></span>
                        </li>
                        <li><i class="fas fa-briefcase"></i> Workshops</li>
                        <li><i class="fas fa-users"></i> Seminars</li>
                        <li><i class="fas fa-university"></i> College Visits</li>
                        <li><i class="fas fa-star orange-star"></i> Success Stories</li>
                    </ul>

                    <h3 class="sidebar-title"><span class="dot-teal"></span> Filter by Stream</h3>
                    <div class="filter-group">
                        <label class="custom-checkbox">
                            <input type="checkbox"> <span class="checkmark"></span> B.Tech
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox"> <span class="checkmark"></span> MBA
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox"> <span class="checkmark"></span> Career Tips
                        </label>
                    </div>
                    <button class="btn-apply-filter">Apply Filter</button>
                </div>

                <div class="sidebar-card subscribe-section">
                    <h3 class="sidebar-title"><i class="fas fa-leaf"></i> Subscribe For Updates</h3>
                    <div class="subscribe-input-wrapper">
                        <i class="far fa-envelope"></i>
                        <input type="email" placeholder="Your Email">
                    </div>
                    <button class="btn-subscribe-orange">Subscribe</button>
                    <!-- <img src="assets/images/mascot.png" alt="Mascot" class="mascot-img"> -->
                </div>
            </aside>

            <section class="main-feed">
                <div class="latest-videos-header">
                    <h2 class="section-title">Latest Videos</h2>
                    <a href="#" class="btn-see-all">
                        See All Videos <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <div class="grid-3">
                    <div class="video-card">
                        <div class="thumbnail">
                            <video class="video-preview" preload="metadata" muted playsinline>
                                <source src="assets/images/career-guidance.mp4" type="video/mp4">
                            </video>
                            <div class="play-overlay"><i class="fas fa-play"></i></div>
                            <span class="duration">0:00</span>
                        </div>
                        <h4>Career Guidance Seminar 2024</h4>
                        <p>1.2K Views • 2 days ago</p>
                    </div>

                    <div class="video-card">
                        <div class="thumbnail">
                            <video class="video-preview" preload="metadata" muted playsinline>
                                <source src="assets/images/Btech_vs_MBA.mp4" type="video/mp4">
                            </video>
                            <div class="play-overlay"><i class="fas fa-play"></i></div>
                            <span class="duration">9:00</span>
                        </div>
                        <h4>B.Tech vs MCA - Which is Better?</h4>
                        <p>900 Views • 1 week ago</p>
                    </div>

                    <div class="video-card">
                        <div class="thumbnail">
                            <video class="video-preview" preload="metadata" muted playsinline>
                                <source src="assets/images/Campus_Visit.mp4" type="video/mp4">
                            </video>
                            <div class="play-overlay"><i class="fas fa-play"></i></div>
                            <span class="duration">10:15</span>
                        </div>
                        <h4>Campus Visit: VIT Vellore</h4>
                        <p>750 Views • 2 weeks ago</p>
                    </div>
                </div>

                <div class="section-header">
                    <h2>Featured Blogs & Events</h2>
                </div>
                <div class="grid-3">
                    <!-- <div class="blog-card dark-gradient-card">
                        <div class="date-badge-pill orange">15 <span>Apr 2024</span></div>
                        <div class="card-content">
                            <h4 class="event-title"><i class="fas fa-lightbulb"></i> National Education Fair - 2024</h4>
                            <p class="location-text"><i class="fas fa-map-marker-alt"></i> Bhubaneswar</p>
                            <p class="description-text">Over 2000+ students attended our mega education fair with top colleges & live counselling.</p>
                            <a href="#" class="read-more-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div> -->

                    <div class="featured-card event-gradient">
                        <div class="event-date-badge">
                            <span class="day">15</span>
                            <span class="month-year">Apr 2024</span>
                        </div>

                        <div class="featured-card-content">
                            <h3 class="event-main-title">
                                <span class="icon-glow"></span> National Education Fair - 2024
                            </h3>

                            <p class="event-location">
                                <i class="fas fa-map-marker-alt"></i> Bhubaneswar
                            </p>

                            <p class="event-summary">
                                Over <span class="highlight">2000+</span> students attended our mega education fair with top colleges & live counselling.
                            </p>

                            <div class="event-footer">
                                <a href="#" class="btn-read-more-event">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="blog-card white-card">
                        <div class="card-thumb-wrapper">
                            <div class="blog-date-badge">
                                <span class="day">10</span>
                                <span class="month-year">Apr 2024</span>
                            </div>
                            <img src="assets/images/bg-satya-2.jpg" alt="B.Tech vs MCA" class="card-img">
                        </div>

                        <div class="card-content">
                            <h4 class="card-title">How to Choose Between B.Tech vs MCA</h4>
                            <p class="description-text">Struggling to decide? Here's a detailed comparison to help you choose the right path.</p>

                            <div class="card-footer-meta">
                                <div class="read-more-group">
                                    <i class="fas fa-check-circle orange-icon"></i>
                                    <span class="read-more-text">Read More</span>
                                </div>
                                <div class="divider">|</div>
                                <div class="time-group">
                                    <i class="far fa-clock"></i>
                                    <span>2 min read</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="blog-card white-card success-bg">
                        <div class="card-thumb-wrapper">
                            <div class="success-date-badge">
                                05 Apr 2024
                            </div>
                            <img src="assets/images/bg-satya-3.jpg" alt="Success Story" class="card-img">
                        </div>

                        <div class="card-content">
                            <h4 class="card-title">Success Story: From Science to IISc Bangalore!</h4>

                            <div class="author-row">
                                <img src="assets/images/bg-satya-3.jpg" alt="Author" class="author-img">
                                <span class="author-name">Ramesh Patra</span>
                            </div>

                            <button class="btn-watch-story">
                                <i class="fas fa-play-circle"></i> Watch Story
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!--======== Footer 2 Start ========-->

    <footer id="rs-contact" class="rs-footer rs-footer-2">

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
    <script>
        document.querySelectorAll('.thumbnail').forEach(container => {
            const video = container.querySelector('video');
            const overlay = container.querySelector('.play-overlay');
            const durationDisplay = container.querySelector('.duration');

            // 1. Automatically get duration from the file
            video.addEventListener('loadedmetadata', function() {
                const minutes = Math.floor(video.duration / 60);
                const seconds = Math.floor(video.duration % 60);
                durationDisplay.innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            });

            // 2. Click to Play/Pause toggle
            container.addEventListener('click', function() {
                if (video.paused) {
                    // Unmute when the user explicitly clicks to play
                    video.muted = false;
                    video.play().then(() => {
                        overlay.style.opacity = '0'; // Smoothly hide play button
                        overlay.style.pointerEvents = 'none';
                    }).catch(error => {
                        console.error("Playback failed:", error);
                    });
                } else {
                    video.pause();
                    overlay.style.opacity = '1'; // Show play button
                    overlay.style.pointerEvents = 'auto';
                }
            });
        });

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
    </script>

    <div id="enquireModal" class="enquire-modal">
        <div class="enquire-overlay"></div>

        <div class="enquire-modal-content hero-form-box compact-form shadow-lg">
            <button type="button" class="enquire-close" aria-label="Close form">×</button>

            <h3 class="form-title text-center text-dark fw-bold mb-4">Enquire Now</h3>

            <form method="POST" action="">
                <input type="hidden" name="enquiry_form" value="1">
                <div class="row g-2">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="full_name" class="form-control" placeholder="Full Name *" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="tel" name="mobile_number" class="form-control" placeholder="Mobile *" required>
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
                        <textarea name="message" class="form-control" placeholder="Message (Optional)"></textarea>
                    </div>
                </div>
                <button type="submit" class="hero-submit-btn w-100 mt-3">Submit Application</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("enquireModal");
            const closeBtn = document.querySelector(".enquire-close");
            const overlay = document.querySelector(".enquire-overlay");

            // 1. Force centering and display flex on load
            if (modal) {
                modal.style.setProperty('display', 'flex', 'important');
            }

            // 2. CLOSE LOGIC (Button)
            if (closeBtn) {
                closeBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation(); // Prevents click from traveling to the background
                    modal.style.setProperty('display', 'none', 'important');
                });
            }

            // 3. CLOSE LOGIC (Background Click)
            if (overlay) {
                overlay.addEventListener("click", function() {
                    modal.style.setProperty('display', 'none', 'important');
                });
            }

            // 4. DYNAMIC DROPDOWNS
            var stateObject = {
                "ODISHA": {
                    "KHORDHA": ["BHUBANESWAR", "JATANI"],
                    "CUTTACK": ["CUTTACK CITY"]
                },
                "BIHAR": {
                    "PATNA": ["PATNA CITY"]
                }
            };

            var stateSel = document.getElementById("stateSel"),
                districtSel = document.getElementById("districtSel"),
                citySel = document.getElementById("citySel");

            if (stateSel && districtSel && citySel) {
                for (var state in stateObject) {
                    stateSel.options[stateSel.options.length] = new Option(state, state);
                }

                stateSel.onchange = function() {
                    districtSel.length = 1;
                    citySel.length = 1;
                    if (this.value == "") return;
                    for (var district in stateObject[this.value]) {
                        districtSel.options[districtSel.options.length] = new Option(district, district);
                    }
                };

                districtSel.onchange = function() {
                    citySel.length = 1;
                    if (this.value == "") return;
                    var cities = stateObject[stateSel.value][this.value];
                    for (var i = 0; i < cities.length; i++) {
                        citySel.options[citySel.options.length] = new Option(cities[i], cities[i]);
                    }
                };
            }
        });
    </script>
</body>

</html>