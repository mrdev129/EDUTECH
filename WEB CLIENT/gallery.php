<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | EduTech Admission Experts</title>
    <link rel="stylesheet" href="css/gallery.css">
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

    <main class="gallery-wrapper">
        <div class="container">
            <div class="gallery-grid">
                <div class="gallery-card">
                    <div class="zoom-box">
                        <img src="images/g-1.webp" alt="Gallery Image 1">
                    </div>
                </div>
                <div class="gallery-card">
                    <div class="zoom-box">
                        <img src="images/g-2.avif" alt="Gallery Image 2">
                    </div>
                </div>
                <div class="gallery-card">
                    <div class="zoom-box">
                        <img src="images/g-3.jpg" alt="Gallery Image 3">
                    </div>
                </div>
                <div class="gallery-card">
                    <div class="zoom-box">
                        <img src="images/g-4.jpg" alt="Gallery Image 4">
                    </div>
                </div>
                <div class="gallery-card">
                    <div class="zoom-box">
                        <img src="images/g-5.jpg" alt="Gallery Image 5">
                    </div>
                </div>
                <div class="gallery-card">
                    <div class="zoom-box">
                        <img src="images/g-6.jpg" alt="Gallery Image 6">
                    </div>
                </div>
                <div class="gallery-card">
                    <div class="zoom-box">
                        <img src="images/g-7.jpg" alt="Gallery Image 7">
                    </div>
                </div>
                <div class="gallery-card">
                    <div class="zoom-box">
                        <img src="images/g-8.jpg" alt="Gallery Image 8">
                    </div>
                </div>
                <div class="gallery-card">
                    <div class="zoom-box">
                        <img src="images/g-9.jpg" alt="Gallery Image 9">
                    </div>
                </div>
            </div>
        </div>
    </main>

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
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>