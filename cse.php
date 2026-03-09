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

        /* --- Scrollable Sidebar Container (Updated for 6 Items) --- */
        .course-list {
            list-style: none;
            /* Height adjusted to show exactly 6 items clearly */
            max-height: 410px;
            overflow-y: auto;
            /* Enables vertical scrolling */
            padding-right: 10px;
            /* Space for the scrollbar */
            margin-bottom: 20px;
            /* Smooth transition for active state changes */
            scroll-behavior: smooth;
        }

        /* --- Custom Scrollbar Styling --- */
        .course-list::-webkit-scrollbar {
            width: 6px;
        }

        .course-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .course-list::-webkit-scrollbar-thumb {
            background: #F26F20;
            /* Your Brand Orange */
            border-radius: 10px;
        }

        .course-list::-webkit-scrollbar-thumb:hover {
            background: #f28e26;
        }

        /* Sidebar behavior */
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
                            <img id="courseImg" src="assets/images/courses/Gemini_Generated_Image_4b73ka4b73ka4b73.png" alt="">
                        </div>

                        <h2 id="courseTitle" class="course-title">
                            B.Tech in Computer Science Engineering
                        </h2>

                        <p id="courseDesc" class="course-description">
                            Focuses on software engineering, Artificial Intelligence, Data Science, Cybersecurity, and next-generation technologies.
                        </p>

                    </div>

                    <!-- RIGHT SIDEBAR -->
                    <div class="stream-sidebar">

                        <h4 class="sidebar-title">CSE DOMAINS</h4>

                        <ul class="course-list">

                            <li class="active" onclick="changeCourse('cse',this)">Computer Science Engineering</li>
                            <li onclick="changeCourse('it',this)">Information Technology</li>
                            <li onclick="changeCourse('aiml',this)">Artificial Intelligence & ML</li>
                            <li onclick="changeCourse('ds',this)">Data Science</li>
                            <li onclick="changeCourse('cybersecurity',this)">Cyber Security</li>
<!-- 
                            <li onclick="changeCourse('mech',this)">Mechanical Engineering</li>
                            <li onclick="changeCourse('mechatronics',this)">Mechatronics Engineering</li> -->
                            <li onclick="changeCourse('robotics',this)">Robotics Engineering</li>
                            <!-- <li onclick="changeCourse('automobile',this)">Automobile Engineering</li> -->

                            <!-- <li onclick="changeCourse('civil',this)">Civil Engineering</li>
                            <li onclick="changeCourse('environmental',this)">Environmental Engineering</li>
                            <li onclick="changeCourse('agricultural',this)">Agricultural Engineering</li>

                            <li onclick="changeCourse('eee',this)">Electrical Engineering</li>
                            <li onclick="changeCourse('ece',this)">Electronics & Communication</li>

                            <li onclick="changeCourse('chemical',this)">Chemical Engineering</li>
                            <li onclick="changeCourse('biotech',this)">Biotechnology</li>
                            <li onclick="changeCourse('aerospace',this)">Aerospace Engineering</li>
                            <li onclick="changeCourse('petroleum',this)">Petroleum Engineering</li>
                            <li onclick="changeCourse('mining',this)">Mining Engineering</li>
                            <li onclick="changeCourse('marine',this)">Marine Engineering</li> -->

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
            btechCourses = {

                cse: {
                    img: "assets/images/courses/cse.png",
                    title: "B.Tech in Computer Science Engineering",
                    desc: "Focuses on AI, Machine Learning, Data Science, Software Engineering, Cyber Security, Cloud Computing and next-generation digital technologies."
                },

                it: {
                    img: "assets/images/courses/it.png",
                    title: "B.Tech in Information Technology",
                    desc: "Covers software development, database systems, networking, cloud platforms and enterprise IT infrastructure management."
                },

                // mech: {
                //     img: "assets/images/courses/mech.png",
                //     title: "B.Tech in Mechanical Engineering",
                //     desc: "Covers robotics, automobile engineering, manufacturing systems, thermal engineering and industrial automation."
                // },

                // civil: {
                //     img: "assets/images/courses/civil.png",
                //     title: "B.Tech in Civil Engineering",
                //     desc: "Includes structural engineering, smart city planning, construction technology, transportation systems and sustainable infrastructure development."
                // },

                // eee: {
                //     img: "assets/images/courses/eee.png",
                //     title: "B.Tech in Electrical Engineering",
                //     desc: "Focuses on renewable energy systems, electrical machines, smart grids and advanced power generation & distribution systems."
                // },

                // ece: {
                //     img: "assets/images/courses/ece.png",
                //     title: "B.Tech in Electronics & Communication Engineering",
                //     desc: "Includes VLSI design, embedded systems, IoT, signal processing and modern wireless communication technologies."
                // },

                aiml: {
                    img: "assets/images/courses/aiml.png",
                    title: "B.Tech in Artificial Intelligence & Machine Learning",
                    desc: "Specializes in deep learning, neural networks, computer vision, natural language processing and intelligent automation systems."
                },

                ds: {
                    img: "assets/images/courses/datascience.png",
                    title: "B.Tech in Data Science",
                    desc: "Focuses on big data analytics, predictive modeling, statistical computing, business intelligence and data-driven decision making."
                },

                cybersecurity: {
                    img: "assets/images/courses/cybersecurity.png",
                    title: "B.Tech in Cyber Security",
                    desc: "Covers ethical hacking, network security, digital forensics, cryptography and cyber threat management."
                },

                robotics: {
                    img: "assets/images/courses/robotics.png",
                    title: "B.Tech in Robotics Engineering",
                    desc: "Integrates mechanical design, electronics, AI and automation to develop intelligent robotic systems."
                },

                // mechatronics: {
                //     img: "assets/images/courses/mechatronics.png",
                //     title: "B.Tech in Mechatronics Engineering",
                //     desc: "Combines mechanical engineering, electronics, control systems and computer programming for smart product design."
                // },

                // biotech: {
                //     img: "assets/images/courses/biotech.png",
                //     title: "B.Tech in Biotechnology",
                //     desc: "Focuses on genetic engineering, molecular biology, bioinformatics and industrial biotechnology applications."
                // },

                // chemical: {
                //     img: "assets/images/courses/chemical.png",
                //     title: "B.Tech in Chemical Engineering",
                //     desc: "Deals with chemical processes, petrochemicals, process design, environmental engineering and industrial production systems."
                // },

                // aerospace: {
                //     img: "assets/images/courses/aerospace.png",
                //     title: "B.Tech in Aerospace Engineering",
                //     desc: "Covers aircraft design, aerodynamics, propulsion systems and space technology."
                // },

                // automobile: {
                //     img: "assets/images/courses/automobile.png",
                //     title: "B.Tech in Automobile Engineering",
                //     desc: "Focuses on vehicle design, electric vehicles, engine systems and automotive manufacturing technologies."
                // },

                // petroleum: {
                //     img: "assets/images/courses/petroleum.png",
                //     title: "B.Tech in Petroleum Engineering",
                //     desc: "Deals with oil & gas exploration, drilling engineering, reservoir management and energy production technologies."
                // },

                // mining: {
                //     img: "assets/images/courses/mining.png",
                //     title: "B.Tech in Mining Engineering",
                //     desc: "Focuses on mineral extraction, mine planning, safety engineering and resource management."
                // },

                // marine: {
                //     img: "assets/images/courses/marine.png",
                //     title: "B.Tech in Marine Engineering",
                //     desc: "Covers ship machinery, marine propulsion systems, offshore engineering and maritime technologies."
                // },

                // agricultural: {
                //     img: "assets/images/courses/agricultural.png",
                //     title: "B.Tech in Agricultural Engineering",
                //     desc: "Integrates farm machinery, irrigation systems, food processing and sustainable agricultural technologies."
                // },

                // environmental: {
                //     img: "assets/images/courses/environmental.png",
                //     title: "B.Tech in Environmental Engineering",
                //     desc: "Focuses on water treatment, waste management, pollution control and sustainable environmental solutions."
                // }

            };

            function changeCourse(courseKey, element) {

                const course = btechCourses[courseKey];
                if (!course) return;

                const title = document.getElementById("courseTitle");
                const desc = document.getElementById("courseDesc");
                const img = document.getElementById("courseImg");

                // Remove active class
                document.querySelectorAll(".course-list li").forEach(li => {
                    li.classList.remove("active");
                });
                element.classList.add("active");

                // Fade out text
                title.classList.add("fade-out");
                desc.classList.add("fade-out");

                // Hide image smoothly
                img.classList.add("image-hide");

                setTimeout(() => {

                    // Update content
                    title.innerText = course.title;
                    desc.innerText = course.desc;
                    img.src = course.img;

                    // Fade in text
                    title.classList.remove("fade-out");
                    desc.classList.remove("fade-out");

                    title.classList.add("fade-in");
                    desc.classList.add("fade-in");

                    // Show image smoothly
                    img.classList.remove("image-hide");
                    img.classList.add("image-show");

                }, 300);
            }
        </script>

</body>

</html>