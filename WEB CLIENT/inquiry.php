<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | EduTech Admission Experts</title>
    <link rel="stylesheet" href="css/inquiry.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div id="loader-wrapper">
        <div class="loader-content">
            <div class="progress-circle">
                <svg>
                    <circle cx="100" cy="100" r="70"></circle>
                    <circle cx="100" cy="100" r="70" id="progress-bar"></circle>
                </svg>
                <div class="inner-logo">
                    <img src="images/logo.png" alt="EduTech Logo">
                </div>
            </div>

            <div class="loader-stats">
                <h2 id="percentage">0%</h2>
                <p class="loading-text">INQUIRY FORM</p>
            </div>
        </div>
    </div>

    <header class="main-header" id="navbar">
        <div class="header-content">
            <div class="logo">
                <img src="images/logo.png" alt="EduTech Logo">
            </div>

            <nav>
                <ul class="nav-links">
                    <li class="dropdown">
                        <a href="index.php">Home</a>
                    </li>
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
                </ul>
            </nav>

            <div class="admin-icon">
                <a href="admin/login.php"><img src="images/ADMIN.png" alt="Admin"></a>
            </div>
        </div>
    </header>


    <main class="inquiry-wrapper">
        <div class="container">
            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; text-align: center; margin-bottom: 20px; font-weight: bold;">
                    Thank you! Your inquiry has been submitted successfully.
                </div>
            <?php endif; ?>
            <div class="form-card">
                <div class="form-header">
                    <h2>Plan Your Future With Us</h2>
                    <p>Fill out the details below and our experts will contact you shortly.</p>
                </div>

                <form action="process_inquiry.php" method="POST" class="styled-form">
                    <ul class="form-fields">
                        <li>
                            <label>Full Name</label>
                            <input type="text" name="name" placeholder="Enter your name" required>
                        </li>
                        <li>
                            <label>Mobile Number</label>
                            <input type="tel" name="mobile" placeholder="Enter mobile number" required>
                        </li>
                        <li>
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="Enter email address" required>
                        </li>
                        <li>
                            <label>Preferred Course</label>
                            <select name="course" required>
                                <option value="" disabled selected>Select a course</option>
                                <option value="btech">B.Tech</option>
                                <option value="mba">MBA</option>
                                <option value="mca">MCA</option>
                                <option value="diploma">Diploma</option>
                                <option value="data">Data Analytics</option>
                                <option value="web">Web Development</option>
                                <option value="uiux">UI/UX Design</option>
                            </select>
                        </li>
                        <li>
                            <label>Current Location</label>
                            <input type="text" name="location" placeholder="Your city/state" required>
                        </li>
                        <li>
                            <label>Estimated Budget</label>
                            <input type="text" name="budget" placeholder="e.g. 2-4 Lakhs" required>
                        </li>
                        <li class="full-width">
                            <label>Message / Additional Requirements</label>
                            <textarea name="message" rows="4" placeholder="How can we help you?"></textarea>
                        </li>
                        <li class="full-width">
                            <button type="submit" name="submit_inquiry" class="submit-btn">
                                Submit Inquiry <i class="fas fa-paper-plane"></i>
                            </button>
                        </li>
                    </ul>
                </form>
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
        window.addEventListener('load', () => {
            let percentage = document.getElementById('percentage');
            let progressBar = document.getElementById('progress-bar');
            let count = 0;

            let interval = setInterval(() => {
                count++;
                percentage.innerHTML = count + "%";

                // Calculate SVG stroke offset (440 is the circle circumference)
                let offset = 440 - (440 * count) / 100;
                progressBar.style.strokeDashoffset = offset;

                if (count === 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        document.getElementById('loader-wrapper').style.opacity = '0';
                        setTimeout(() => {
                            document.getElementById('loader-wrapper').style.display = 'none';
                        }, 500);
                    }, 500);
                }
            }, 20); // Speed of the loader
        });
    </script>
</body>

</html>