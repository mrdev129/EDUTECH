<?php
// optional: if you use session
// session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Section - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (if already included in student page, keep same links) -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<div id="layout-wrapper">

    <!-- ========== LEFT SIDEBAR START ========== -->
    <div class="vertical-menu">

        <div class="h-100">
            <div class="user-wid text-center py-4">
                <h5 class="mt-3 mb-1">Admin Panel</h5>
            </div>

            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled">

                    <li>
                        <a href="dashboard.php">
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="student-list.php">
                            <span>Students</span>
                        </a>
                    </li>

                    <!-- NEW MENU -->
                    <li class="mm-active">
                        <a href="about-section.php">
                            <span>About Section</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!-- ========== LEFT SIDEBAR END ========== -->



    <!-- ================= MAIN CONTENT ================= -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- Page Title -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="card-title">Manage About Section</h4>
                        <p class="text-muted">Update website About page content from here.</p>
                    </div>
                </div>

                <!-- About Form Card -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Edit About Section</h5>
                            </div>

                            <div class="card-body">

                                <form action="" method="POST" enctype="multipart/form-data">

                                    <!-- Image Upload -->
                                    <div class="mb-3">
                                        <label class="form-label">About Image</label>
                                        <input type="file" name="about_image" class="form-control">
                                    </div>

                                    <!-- Main Title -->
                                    <div class="mb-3">
                                        <label class="form-label">Main Title</label>
                                        <input type="text" name="main_title" class="form-control"
                                               placeholder="Enter main heading">
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea name="description" class="form-control" rows="3"
                                                  placeholder="Enter short description"></textarea>
                                    </div>

                                    <hr>

                                    <!-- Mission -->
                                    <div class="mb-3">
                                        <label class="form-label">Our Mission</label>
                                        <textarea name="mission" class="form-control" rows="3"></textarea>
                                    </div>

                                    <!-- Vision -->
                                    <div class="mb-3">
                                        <label class="form-label">Our Vision</label>
                                        <textarea name="vision" class="form-control" rows="3"></textarea>
                                    </div>

                                    <!-- Core Value -->
                                    <div class="mb-3">
                                        <label class="form-label">Core Value</label>
                                        <textarea name="core_value" class="form-control" rows="3"></textarea>
                                    </div>

                                    <!-- Video Link -->
                                    <div class="mb-3">
                                        <label class="form-label">YouTube Video Link</label>
                                        <input type="text" name="video_link" class="form-control"
                                               placeholder="https://youtube.com/...">
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" name="save_about" class="btn btn-primary">
                                            Update About Section
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <footer class="footer text-center py-3">
            © <?php echo date('Y'); ?> Admin Panel
        </footer>

    </div>
    <!-- ================= END MAIN CONTENT ================= -->

</div>


<!-- JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
