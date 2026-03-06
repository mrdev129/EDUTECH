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




            $(document).ready(function () {
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
                $(window).on('resize', function () {
                    initBrandSlider();
                });


            });

            $(document).ready(function () {
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
            document.addEventListener('DOMContentLoaded', function () {
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

                window.switchCourseStream = function (evt, streamId) {
                    document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
                    document.querySelectorAll('.branch-panel').forEach(panel => panel.classList.remove('active'));

                    const activePanel = document.getElementById(streamId);
                    if (activePanel) {
                        activePanel.classList.add('active');
                        evt.currentTarget.classList.add('active');

                        setTimeout(function () {
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
            document.getElementById("contact-form").addEventListener("submit", function (e) {
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
                stateSel.onchange = function () {
                    districtSel.length = 1; // reset
                    citySel.length = 1; // reset
                    if (this.value == "") return;

                    for (var district in stateObject[this.value]) {
                        districtSel.options[districtSel.options.length] = new Option(district, district);
                    }
                };

                // District change logic
                districtSel.onchange = function () {
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