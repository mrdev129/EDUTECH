<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTech | Admission Experts</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <header class="main-header" id="navbar">
        <div class="header-content">
            <div class="logo">
                <img src="images/logo.png" alt="EduTech Logo">
            </div>

            <nav>
                <ul class="nav-links">
                    <li class="dropdown">
                        <a href="company.php">Company Details</a>
                    </li>
                    <li class="dropdown">
                        <a href="#">Blogs</a>
                        <ul class="dropdown-menu">
                            <li><a href="blog-articles.php">Blog Articles</a></li>
                            <li><a href="gallery.php">Image Gallery</a></li>
                            <li><a href="videos.php">Video Sections</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#">Courses</a>
                        <ul class="dropdown-menu">
                            <li><a href="b-tech.php">B.Tech</a></li>
                            <li><a href="b-tech.php">MBA</a></li>
                            <li><a href="b-tech.php">MCA</a></li>
                            <li class="nested-dropdown">
                                <a href="#">Other Courses ></a>
                                <ul class="nested-menu">
                                    <li><a href="b-tech.php">Data Analytics</a></li>
                                    <li><a href="b-tech.php">UI/UX Design</a></li>
                                    <li><a href="b-tech.php">Web Development</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="inquiry.php" class="inquiry-btn">Get Inquiry</a></li>
                </ul>
            </nav>

            <div class="admin-icon">
                <a href="admin/login.php"><img src="images/ADMIN.png" alt="Admin"></a>
            </div>
        </div>
    </header>

    <section class="slider-container">
        <div class="cta-overlay">
            <h1 id="cta-typing"></h1>
        </div>

        <div class="slide active">
            <img src="images/IIT Bhubaneswar.jpeg" alt="IIT">
            <div class="college-name-tag" data-name="IIT Bhubaneswar"></div>
        </div>
        <div class="slide">
            <img src="images/CUTM.jpeg" alt="Centurion">
            <div class="college-name-tag" data-name="Centurion University"></div>
        </div>
        <div class="slide">
            <img src="images/National Institute of Technology, Rourkela.jpeg" alt="NIT">
            <div class="college-name-tag" data-name="NIT Rourkela"></div>
        </div>
    </section>

    <section class="intro-section">
        <div class="container">
            <h2 class="intro-heading">Introduction</h2>
            <div class="intro-box">
                <p>
                    EduTech Admission Experts is a premier education consultancy agency dedicated to helping students navigate the complex path to higher education.
                    We specialize in providing expert guidance for students seeking admission in <strong>BTech, MBA, MCA, and Diploma</strong> courses[cite: 6].
                    Our mission is to help you choose the right college based on your course preference, fee structure, location, and long-term career goals.
                    With a vast network of partner colleges and a commitment to student success, we ensure that your transition into professional education is seamless and rewarding[cite: 8].
                </p>
            </div>
        </div>
    </section>

<section class="services-section">
    <div class="container">
        <h2 class="service-heading">Service Overview</h2>
        
        <div class="service-slider-wrapper">
            <div class="service-track">
                <div class="service-card" onclick="location.href='course.php?id=btech'">
                    <div class="card-icon"><i class="fas fa-microchip"></i></div>
                    <h3>B.Tech</h3>
                </div>
                <div class="service-card" onclick="location.href='course.php?id=mba'">
                    <div class="card-icon"><i class="fas fa-briefcase"></i></div>
                    <h3>MBA</h3>
                </div>
                <div class="service-card" onclick="location.href='course.php?id=mca'">
                    <div class="card-icon"><i class="fas fa-code"></i></div>
                    <h3>MCA</h3>
                </div>
                <div class="service-card" onclick="location.href='course.php?id=diploma'">
                    <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
                    <h3>Diploma</h3>
                </div>
                <div class="service-card" onclick="location.href='course.php?id=data'">
                    <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>Data Analytics</h3>
                </div>
                <div class="service-card" onclick="location.href='course.php?id=uiux'">
                    <div class="card-icon"><i class="fas fa-pencil-ruler"></i></div>
                    <h3>UI/UX Design</h3>
                </div>
                <div class="service-card" onclick="location.href='course.php?id=web'">
                    <div class="card-icon"><i class="fas fa-laptop-code"></i></div>
                    <h3>Web Development</h3>
                </div>

                <div class="service-card" onclick="location.href='course.php?id=btech'"><div class="card-icon"><i class="fas fa-microchip"></i></div><h3>B.Tech</h3></div>
                <div class="service-card" onclick="location.href='course.php?id=mba'"><div class="card-icon"><i class="fas fa-briefcase"></i></div><h3>MBA</h3></div>
                <div class="service-card" onclick="location.href='course.php?id=mca'"><div class="card-icon"><i class="fas fa-code"></i></div><h3>MCA</h3></div>
                <div class="service-card" onclick="location.href='course.php?id=data'"><div class="card-icon"><i class="fas fa-chart-line"></i></div><h3>Data Analytics</h3></div>
            </div>
        </div>
    </div>
</section>

    <section class="partners-section">
        <div class="container">
            <h2 class="partner-heading">Partner College Highlights</h2>
            <div class="partner-grid">
                <div class="college-card" onclick="window.open('https://www.iitbbs.ac.in/', '_blank')">
                    <div class="college-img">
                        <img src="images/IIT Bhubaneswar.jpeg" alt="IIT Bhubaneswar">
                    </div>
                    <div class="college-info">
                        <h4>IIT Bhubaneswar</h4>
                        <p><i class="fas fa-map-marker-alt"></i> Bhubaneswar, Odisha</p>
                        <span class="visit-link">Visit Website <i class="fas fa-external-link-alt"></i></span>
                    </div>
                </div>

                <div class="college-card" onclick="window.open('https://cutm.ac.in/', '_blank')">
                    <div class="college-img">
                        <img src="images/CUTM.jpeg" alt="Centurion University">
                    </div>
                    <div class="college-info">
                        <h4>Centurion University</h4>
                        <p><i class="fas fa-map-marker-alt"></i> Jatni, Odisha</p>
                        <span class="visit-link">Visit Website <i class="fas fa-external-link-alt"></i></span>
                    </div>
                </div>

                <div class="college-card" onclick="window.open('https://www.nitrkl.ac.in/', '_blank')">
                    <div class="college-img">
                        <img src="images/National Institute of Technology, Rourkela.jpeg" alt="NIT Rourkela">
                    </div>
                    <div class="college-info">
                        <h4>NIT Rourkela</h4>
                        <p><i class="fas fa-map-marker-alt"></i> Rourkela, Odisha</p>
                        <span class="visit-link">Visit Website <i class="fas fa-external-link-alt"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

<footer class="compact-footer">
    <div class="footer-container">
        <div class="footer-contact">
            <p><i class="fas fa-phone"></i> +91 9876543210</p>
            <p><i class="fas fa-map-marker-alt"></i> Jatni, Odisha</p>
            <p><i class="fas fa-envelope"></i> info@edutech.com</p>
        </div>

        <div class="footer-copyright">
            <p>&copy; 2026 EduTech Admission Experts</p>
        </div>

        <div class="footer-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</footer>

    <script src="js/slider.js"></script>
</body>

</html>