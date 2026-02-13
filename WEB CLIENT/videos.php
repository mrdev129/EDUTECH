<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Gallery | EduTech Admission Experts</title>
    <link rel="stylesheet" href="css/videos.css">
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
                    <li class="dropdown"><a href="company.php">Company Details</a></li>
                    <li class="dropdown">
                        <a href="#">Blogs</a>
                        <ul class="dropdown-menu">
                            <li><a href="blog-articles.php">Blog Articles</a></li>
                            <li><a href="gallery.php">Image Gallery</a></li>
                            <li><a href="videos.php">Video Sections</a></li>
                        </ul>
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
<main class="video-page-wrapper">
    <div class="container">
        
        <section class="video-row">
            <div class="video-container">
                <div class="video-thumbnail">
                    <video class="video-player" poster="images/poster_1.webp">
                        <source src="videos/video_1.mp4" type="video/mp4">
                    </video>
                    <a href="javascript:void(0)" class="play-btn"><i class="fas fa-play"></i></a>
                </div>
            </div>
            <div class="content-card">
                <span class="category-label">Career Counseling</span>
                <h3>The Path to Success in Engineering</h3>
                <p>Watch our expert consultants explain the future of B.Tech branches in 2026 and how to choose the right specialization for your career goals.</p>
            </div>
        </section>

        <section class="video-row reverse">
            <div class="content-card">
                <span class="category-label">Campus Life</span>
                <h3>Glimpses of Top Universities</h3>
                <p>Take a virtual tour of our partner campuses. Explore the infrastructure, labs, and student culture that make these institutions world-class.</p>
            </div>
            <div class="video-container">
                <div class="video-thumbnail">
                    <video class="video-player" poster="images/poster_1.webp">
                        <source src="videos/video_2.mp4" type="video/mp4">
                    </video>
                    <a href="javascript:void(0)" class="play-btn"><i class="fas fa-play"></i></a>
                </div>
            </div>
        </section>

        <section class="video-row">
            <div class="video-container">
                <div class="video-thumbnail">
                    <video class="video-player" poster="images/poster_1.webp">
                        <source src="videos/video_3.mp4" type="video/mp4">
                    </video>
                    <a href="javascript:void(0)" class="play-btn"><i class="fas fa-play"></i></a>
                </div>
            </div>
            <div class="content-card">
                <span class="category-label">Success Stories</span>
                <h3>Hear From Our Placed Students</h3>
                <p>EduTech has helped thousands achieve their dreams. Listen to our alumni share their journey from admission to high-paying job offers.</p>
            </div>
        </section>

    </div>
</main>

    <footer class="compact-footer">
        <div class="footer-container">
            <div class="footer-contact">
                <p><i class="fas fa-phone"></i> +91 9876543210</p>
                <p><i class="fas fa-envelope"></i> info@edutech.com</p>
            </div>
            <div class="footer-copyright">
                <p>&copy; 2026 EduTech Admission Experts</p>
            </div>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
        document.querySelectorAll('.play-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        // Find the video element in the same container
        const video = this.parentElement.querySelector('.video-player');
        
        if (video.paused) {
            video.play();
            this.style.opacity = '0'; // Hide button when playing
            video.setAttribute('controls', 'true'); // Show native controls (volume, seek)
        } else {
            video.pause();
            this.style.opacity = '1';
        }
    });
});
    </script>

</body>
</html>