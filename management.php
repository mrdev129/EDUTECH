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

    <style>
        /* =========================
   THEME COLORS (EDIT HERE)
========================= */
        :root {
            --primary: #1e3a8a;
            /* Dark Blue */
            --secondary: #2563eb;
            /* Bright Blue */
            --accent: #4f46e5;
            /* Indigo Accent */
            --light-bg: #f1f5ff;
            /* Light Background */
            --card-bg: #ffffff;
            --text-dark: #1f2937;
            --text-light: #6b7280;
        }

        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--light-bg);
        }

        /* =========================
   SECTION
========================= */
        .stream-section {
            padding: 70px 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .stream-wrapper {
            display: flex;
            gap: 35px;
        }

        /* =========================
   LEFT CONTENT
========================= */
        .stream-content {
            flex: 2;
            background: var(--card-bg);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(30, 58, 138, 0.08);
            transition: 0.4s ease;
        }

        .stream-content:hover {
            transform: translateY(-5px);
        }

        .course-image img {
            width: 100%;
            height: 380px;
            object-fit: cover;
            border-radius: 12px;
        }

        .course-title {
            margin-top: 25px;
            font-size: 30px;
            font-weight: 700;
            color: var(--primary);
        }

        .course-description {
            margin-top: 15px;
            font-size: 16px;
            line-height: 1.8;
            color: var(--text-light);
        }

        /* =========================
   RIGHT SIDEBAR
========================= */
        .stream-sidebar {
            flex: 1;
            background: linear-gradient(180deg, var(--primary), var(--secondary));
            padding: 30px;
            border-radius: 16px;
            color: #fff;
            height: fit-content;
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.2);
        }

        .sidebar-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* COURSE LIST */
        .course-list {
            list-style: none;
        }

        .course-list li {
            background: rgba(255, 255, 255, 0.15);
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 14px;
            cursor: pointer;
            transition: 0.3s ease;
            font-weight: 500;
        }

        .course-list li:hover {
            background: #fff;
            color: var(--primary);
        }

        .course-list li.active {
            background: #fff;
            color: var(--primary);
            font-weight: 600;
        }

        /* BUTTON */
        .enquiry-btn {
            display: block;
            margin-top: 25px;
            text-align: center;
            padding: 14px;
            border-radius: 40px;
            background: #fff;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .enquiry-btn:hover {
            background: var(--accent);
            color: #fff;
        }

        /* =========================
   RESPONSIVE
========================= */
        @media(max-width:992px) {
            .stream-wrapper {
                flex-direction: column;
            }

            .course-image img {
                height: 300px;
            }
        }

        @media(max-width:576px) {
            .course-title {
                font-size: 22px;
            }

            .course-description {
                font-size: 14px;
            }
        }

        /* Fade animation */
        .fade-out {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .fade-in {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        /* Image smooth transition */
        #courseImg {
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .image-hide {
            opacity: 0;
            transform: scale(0.98);
        }

        .image-show {
            opacity: 1;
            transform: scale(1);
        }

        .main-btn {
            padding: 15px 40px;
            /* Original balanced padding */
            font-weight: 500;
            color: #ffffff;
            background-color: #f28e26;
            background-image: linear-gradient(130deg, #f28e26 0%, #f24c1a 45%, #f28e26 90%);
            background-position: 100% 0;
            background-size: 200% 200%;
            border-radius: 6px;
            /* Original slight rounding */
            transition: all linear 0.3s;
            display: inline-flex;
            gap: 7px;
        }

        /* Specific fix for the Header button to be more 'Oval' on mobile/desktop */
        #home .main-btn {
            border-radius: 30px !important;
            /* Forces the oval shape */
            padding: 8px 25px !important;
            /* Matches smaller header height */
            font-size: 12px !important;
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
                        <a href="javascript:void(0);"
                            onclick="document.getElementById('enquireModal').style.display='flex'"
                            class="main-btn">
                            ENQUIRE NOW
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="static-announcement">
            <div class="container">
                <p class="sliding-text">Jan'26 Admissions Closing Soon! Avail Up to 25% Scholarship on 1st Semester*.</p>
            </div>
        </div>


        <section class="stream-section py-5">
            <div class="container">
                <div class="text-center position-relative stream-pill-wrapper">
                    <span class="stream-floating-pill" id="currentStreamLabel">MBBS</span>
                </div>

                <div class="stream-grid-wrapper shadow-lg">
                    <div class="row g-0">

                        <div class="col-lg-8 left-content-panel p-4">
                            <div class="stream-orange-header text-center mb-3">
                                <h4 class="m-0 text-white fw-bold" id="courseTitleHeader">Medical Specializations</h4>
                            </div>

                            <!-- <div id="specializationContainer" class="mb-4 text-center">
                            </div> -->
                            <br><br><br>
                            <div class="description-box p-3 mb-4">
                                <h5 class="fw-bold text-navy"><i class="fa fa-info-circle"></i> Course Description</h5>
                                <p id="streamDescription" class="m-0 text-muted">
                                    Loading details...
                                </p>
                            </div>

                            <div class="text-center mt-auto">
                                <a href="MBBS.php" class="explore-more-btn">explore more <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 right-sidebar-panel reference-style">
                            <div class="sidebar-stream-menu p-4">
                                <div class="sidebar-pill" onclick="updateStream('btech', this)">Btech</div>
                                <div class="sidebar-pill active" onclick="updateStream('mbbs', this)">MBBS</div>
                                <div class="sidebar-pill" onclick="updateStream('mba', this)">MBA</div>
                                <div class="sidebar-pill" onclick="updateStream('mca', this)">MCA</div>
                                <div class="sidebar-pill" onclick="updateStream('bba', this)">BBA</div>
                                <div class="sidebar-pill" onclick="updateStream('bca', this)">BCA</div>
                            </div>

                            <div class="sidebar-enquiry-box text-center p-4">
                                <a href="javascript:void(0);"
                                    onclick="document.getElementById('enquireModal').style.display='flex'"
                                    class="sidebar-enquiry-btn-rounded">
                                    Enquiry Now
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
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
        <script>

/* ===============================
   STREAM DATA (Course Information)
================================= */

const streamData = {
    btech: {
        label: "B.TECH",
        header: "Engineering Specializations",
        desc: "Bachelor of Technology focuses on software, mechanical, civil, and electronic systems. It provides a foundation in engineering principles and practical problem-solving in industrial contexts.",
        specs: ["Computer Science", "IT", "Mechanical", "Civil", "Electronics", "AI & ML", "Data Science"]
    },

    mbbs: {
        label: "MBBS",
        header: "Medical Specializations",
        desc: "MBBS deals with the prevention, diagnosis, and treatment of human diseases. Students rotate through various clinical departments to gain comprehensive medical and surgical knowledge.",
        specs: ["General Medicine", "Pediatrics", "Dermatology", "Surgery", "Orthopedics", "Radiology", "ENT", "OB-GYN"]
    },

    mba: {
        label: "MBA",
        header: "Management Specializations",
        desc: "Master of Business Administration focuses on leadership, strategy, and organizational efficiency. It prepares professionals for management roles in global corporate environments.",
        specs: ["Finance", "Marketing", "Human Resources", "International Business", "Operations", "Digital Marketing"]
    },

    mca: {
        label: "MCA",
        header: "IT Specializations",
        desc: "Master of Computer Applications is designed for advanced software development and system management, focusing on modern computing technologies and enterprise applications.",
        specs: ["Software Development", "Cloud Computing", "Web Technologies", "Networking", "Database Management"]
    },

    bba: {
        label: "BBA",
        header: "Business Specializations",
        desc: "Bachelor of Business Administration provides a broad understanding of business functions, focusing on management, accounting, and professional communication for entry-level corporate roles.",
        specs: ["Finance", "Marketing", "HR", "Business Analytics", "Retail Management"]
    },

    bca: {
        label: "BCA",
        header: "Computer Specializations",
        desc: "Bachelor of Computer Applications focuses on fundamental software skills, data structures, and programming logic needed to excel in the growing IT industry.",
        specs: ["Web Dev", "Software Engineering", "Cyber Security", "Mobile App Dev", "Data Analytics"]
    }
};


/* ===============================
   MAIN STREAM SWITCH FUNCTION
================================= */

function updateStream(key, element) {

    const data = streamData[key];
    if (!data) return;

    // Update labels
    document.getElementById('currentStreamLabel').innerText = data.label;
    document.getElementById('courseTitleHeader').innerText = data.header;
    document.getElementById('streamDescription').innerText = data.desc;

    // Update Explore More button link
    const exploreBtn = document.querySelector('.explore-more-btn');
    if (exploreBtn) {
        exploreBtn.setAttribute('href', key.toUpperCase() + '.php');
    }

    // Update specialization tags
    const specContainer = document.getElementById('specializationContainer');

    if (specContainer) {
        specContainer.innerHTML = '';

        data.specs.forEach(spec => {

            const span = document.createElement('span');

            span.className = 'spec-tag';

            span.innerHTML = `<i class="fa fa-hand-o-right"></i> ${spec}`;

            specContainer.appendChild(span);
        });
    }

    // Manage sidebar active state
    document.querySelectorAll('.sidebar-pill').forEach(pill => {
        pill.classList.remove('active');
    });

    if (element) {
        element.classList.add('active');
    }
}


/* ===============================
   PAGE LOAD LOGIC
================================= */

document.addEventListener('DOMContentLoaded', () => {

    const params = new URLSearchParams(window.location.search);

    const course = params.get("course");

    if (course && streamData[course]) {

        const pill = document.querySelector(`[onclick="updateStream('${course}', this)"]`);

        if (pill) {
            updateStream(course, pill);
        }

    } else {

        // Default course
        const defaultPill = document.querySelector('.sidebar-pill:nth-child(2)');

        if (defaultPill) {
            updateStream('mbbs', defaultPill);
        }
    }

});

</script>

        <div id="enquireModal" class="enquire-modal">
            <div class="enquire-overlay" onclick="document.getElementById('enquireModal').style.display='none'"></div>

            <div class="enquire-modal-content">
                <button type="button" class="enquire-close" onclick="document.getElementById('enquireModal').style.display='none'">&times;</button>

                <div class="hero-form-box compact-form shadow-lg">
                    <h3 class="form-title text-center text-dark fw-bold mb-4">Enquire Now</h3>

                    <form method="POST" action="mail.php">
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
                                    <option value="MBBS">MBBS</option>
                                    <option value="MBA">MBA</option>
                                    <option value="MCA">MCA</option>
                                    <option value="BBA">BBA</option>
                                    <option value="BCA">BCA</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="hostel-toggle d-flex align-items-center justify-content-between p-2 rounded bg-light border">
                                    <span class="small fw-bold text-dark">Hostel Required?</span>
                                    <div class="btn-group btn-group-sm">
                                        <input type="radio" class="btn-check" name="hostel_required" id="h1" value="Yes" checked>
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
                                    <option value="Bangalore">Bangalore</option>
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
                                <textarea name="message" class="form-control" placeholder="Message (Optional)"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="hero-submit-btn w-100 mt-3">Submit Application</button>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>