<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Details | EduTech Admission Experts</title>
    <link rel="stylesheet" href="css/company.css">
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
                    <li><a href="index.php">Home</a></li>
                    
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

    <!-- <section class="breadcrumb-area">
        <div class="container">
            <h1>About Us</h1>
            <p>Home | <span>About</span></p>
        </div>
    </section> -->

<section class="welcome-section">
    <div class="container">
        <h2 class="welcome-heading">About EduTech</h2>
        
        <div class="welcome-grid">
            <div class="welcome-img-box">
                <img src="images/logo.png" alt="EduTech Logo" class="welcome-logo-img">
            </div>
            <div class="welcome-text">
                <h2>Welcome To EduTech Admission Experts</h2>
                <p>
                    We provide comprehensive counseling and admission assistance for <strong>BTech, MBA, and MCA</strong>. 
                    With over a decade of experience, we guide you to the right campus for your career goals.
                </p>
                <ul class="check-list">
                    <li><i class="fas fa-check-circle"></i> Personalized College Selection</li>
                    <li><i class="fas fa-check-circle"></i> Direct Admission Guidance</li>
                    <li><i class="fas fa-check-circle"></i> Career Pathway Mapping</li>
                </ul>
            </div>
        </div>
    </div>
</section>

    <section class="team-section">
    <div class="container">
        <h2 class="team-heading">Our Team Members</h2>
        
        <div class="team-grid">
            <div class="team-card">
                <div class="img-container">
                    <img src="images/member1.jpg" alt="Member 1">
                </div>
                <h4>Member 1</h4>
                <p>Founder & CEO</p>
                <div class="team-socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="team-card">
                <div class="img-container">
                    <img src="images/member2.jpg" alt="Member 2">
                </div>
                <h4>Member Name</h4>
                <p>Academic Counselor</p>
                <div class="team-socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="team-card">
                <div class="img-container">
                    <img src="images/member3.jpg" alt="Member 3">
                </div>
                <h4>Member Name</h4>
                <p>Admission Head</p>
                <div class="team-socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial-section">
    <div class="container">
        <h2 class="intro-heading">Past Work and clients feedback</h2>
        
        <div class="testimonial-flex">
            <div class="testimonial-intro">
                <p>
                    EduTech Admission Experts has a proven track record of helping students secure seats in top-tier institutions. 
                    Our success is measured by the success of our students and the positive feedback we receive from the community.
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="student-info">
                    <div class="img-container-testimonial">
                        <img src="images/student.jpg" alt="Student">
                    </div>
                    <div class="student-details">
                        <h5>Eity Akhter</h5>
                        <p>Student</p>
                    </div>
                    <i class="fas fa-quote-right quote-icon"></i>
                </div>
                <p class="comment">"The guidance I received was life-changing. I am now studying at my dream college thanks to EduTech."</p>
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

    <script>
        // Header scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>