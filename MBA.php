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
:root{
    --primary:#1e3a8a;          /* Dark Blue */
    --secondary:#2563eb;        /* Bright Blue */
    --accent:#4f46e5;           /* Indigo Accent */
    --light-bg:#f1f5ff;         /* Light Background */
    --card-bg:#ffffff;
    --text-dark:#1f2937;
    --text-light:#6b7280;
}

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    background:var(--light-bg);
}

/* =========================
   SECTION
========================= */
.stream-section{
    padding:70px 20px;
}

.container{
    max-width:1200px;
    margin:auto;
}

.stream-wrapper{
    display:flex;
    gap:35px;
}

/* =========================
   LEFT CONTENT
========================= */
.stream-content{
    flex:2;
    background:var(--card-bg);
    padding:30px;
    border-radius:16px;
    box-shadow:0 15px 40px rgba(30,58,138,0.08);
    transition:0.4s ease;
}

.stream-content:hover{
    transform:translateY(-5px);
}

.course-image img{
    width:100%;
    height:380px;
    object-fit:cover;
    border-radius:12px;
}

.course-title{
    margin-top:25px;
    font-size:30px;
    font-weight:700;
    color:var(--primary);
}

.course-description{
    margin-top:15px;
    font-size:16px;
    line-height:1.8;
    color:var(--text-light);
}

/* =========================
   RIGHT SIDEBAR
========================= */
.stream-sidebar{
    flex:1;
    background:linear-gradient(180deg,var(--primary),var(--secondary));
    padding:30px;
    border-radius:16px;
    color:#fff;
    height:fit-content;
    box-shadow:0 15px 40px rgba(37,99,235,0.2);
}

.sidebar-title{
    font-size:22px;
    font-weight:600;
    margin-bottom:20px;
}

/* COURSE LIST */
.course-list{
    list-style:none;
}

.course-list li{
    background:rgba(255,255,255,0.15);
    padding:14px 18px;
    border-radius:10px;
    margin-bottom:14px;
    cursor:pointer;
    transition:0.3s ease;
    font-weight:500;
}

.course-list li:hover{
    background:#fff;
    color:var(--primary);
}

.course-list li.active{
    background:#fff;
    color:var(--primary);
    font-weight:600;
}

/* BUTTON */
.enquiry-btn{
    display:block;
    margin-top:25px;
    text-align:center;
    padding:14px;
    border-radius:40px;
    background:#fff;
    color:var(--primary);
    font-weight:600;
    text-decoration:none;
    transition:0.3s ease;
}

.enquiry-btn:hover{
    background:var(--accent);
    color:#fff;
}

/* =========================
   RESPONSIVE
========================= */
@media(max-width:992px){
    .stream-wrapper{
        flex-direction:column;
    }

    .course-image img{
        height:300px;
    }
}

@media(max-width:576px){
    .course-title{
        font-size:22px;
    }
    .course-description{
        font-size:14px;
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
/* --- SCROLLABLE SIDEBAR CONTAINER --- */
.course-list {
    list-style: none;
    /* Height adjusted for 6 visible options before scrolling */
    max-height: 410px; 
    overflow-y: auto;  /* Enables vertical scrolling */
    padding-right: 10px; /* Space for the scrollbar */
    margin-bottom: 20px;
    scroll-behavior: smooth;
}

/* --- Custom Scrollbar Styling (Matches Theme) --- */
.course-list::-webkit-scrollbar {
    width: 6px;
}

.course-list::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

.course-list::-webkit-scrollbar-thumb {
    background: #F26F20; /* Your Brand Orange */
    border-radius: 10px;
}

.course-list::-webkit-scrollbar-thumb:hover {
    background: #f28e26;
}

/* Ensure the Sidebar remains sticky while scrolling content */
.stream-sidebar {
    position: sticky;
    top: 100px; 
    height: fit-content;
    max-height: 85vh; 
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
                <p class="sliding-text">Jan'26 Admissions Closing Soon! Avail Up to 25% Scholarship on 1st Semester*.</p>
            </div>
        </div>


<section class="stream-section">
<div class="container">
<div class="stream-wrapper">

<!-- LEFT CONTENT -->
<div class="stream-content">

    <div class="course-image">
        <img id="courseImg" src="assets/images/courses/mba-finance.png" alt="">
    </div>

    <h2 id="courseTitle" class="course-title">
        MBA in Finance
    </h2>

    <p id="courseDesc" class="course-description">
        Focuses on financial management, investment banking, corporate finance and global financial systems.
    </p>

</div>

<!-- RIGHT SIDEBAR -->
<div class="stream-sidebar">

    <h4 class="sidebar-title">MBA Specializations</h4>

    <ul class="course-list">
        <li class="active" onclick="changeCourse('finance',this)">Finance</li>
        <li onclick="changeCourse('marketing',this)">Marketing</li>
        <li onclick="changeCourse('hr',this)">Human Resource</li>
        <li onclick="changeCourse('operations',this)">Operations</li>
        <li onclick="changeCourse('businessAnalytics',this)">Business Analytics</li>
        <li onclick="changeCourse('internationalBusiness',this)">International Business</li>
        <li onclick="changeCourse('entrepreneurship',this)">Entrepreneurship</li>
        <li onclick="changeCourse('digitalMarketing',this)">Digital Marketing</li>
    </ul>

    <a href="#" class="enquiry-btn">Enquiry Now</a>

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

const mbaCourses = {

    finance:{
        img:"assets/images/courses/mba-finance.png",
        title:"MBA in Finance",
        desc:"Focuses on financial management, investment banking, risk analysis, corporate finance and global markets."
    },

    marketing:{
        img:"assets/images/courses/mba-marketing.png",
        title:"MBA in Marketing",
        desc:"Covers digital marketing, branding, consumer behavior, advertising strategy and market research."
    },

    hr:{
        img:"assets/images/courses/mba-hr.png",
        title:"MBA in Human Resource Management",
        desc:"Focuses on recruitment, employee engagement, payroll systems, leadership development and HR strategy."
    },

    operations:{
        img:"assets/images/courses/mba-operations.png",
        title:"MBA in Operations Management",
        desc:"Covers supply chain management, logistics, quality control and production planning systems."
    },

    businessAnalytics:{
        img:"assets/images/courses/mba-analytics.png",
        title:"MBA in Business Analytics",
        desc:"Focuses on data-driven decision making, predictive analytics, business intelligence and strategic insights."
    },

    internationalBusiness:{
        img:"assets/images/courses/mba-ib.png",
        title:"MBA in International Business",
        desc:"Covers global trade management, export-import, foreign exchange and international marketing strategies."
    },

    entrepreneurship:{
        img:"assets/images/courses/mba-entrepreneurship.png",
        title:"MBA in Entrepreneurship",
        desc:"Focuses on startup development, innovation management, venture capital funding and business leadership skills."
    },

    digitalMarketing:{
        img:"assets/images/courses/mba-digital.png",
        title:"MBA in Digital Marketing",
        desc:"Covers SEO, social media marketing, Google Ads, performance marketing and online brand growth strategies."
    }

};


function changeCourse(courseKey, element){

    const course = mbaCourses[courseKey];
    if(!course) return;

    const title = document.getElementById("courseTitle");
    const desc = document.getElementById("courseDesc");
    const img = document.getElementById("courseImg");

    // Remove active class
    document.querySelectorAll(".course-list li").forEach(li=>{
        li.classList.remove("active");
    });

    element.classList.add("active");

    // Fade out animation
    title.classList.add("fade-out");
    desc.classList.add("fade-out");
    img.classList.add("image-hide");

    setTimeout(() => {

        title.innerText = course.title;
        desc.innerText = course.desc;
        img.src = course.img;

        title.classList.remove("fade-out");
        desc.classList.remove("fade-out");
        img.classList.remove("image-hide");

        title.classList.add("fade-in");
        desc.classList.add("fade-in");
        img.classList.add("image-show");

    }, 300);
}

</script>

</body>
</html>