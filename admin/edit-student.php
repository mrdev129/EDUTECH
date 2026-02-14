<?php
include('../config/db.php');

// 1. Fetch current student data
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $query = "SELECT * FROM students WHERE id = '$id'";
  $result = $conn->query($query);
  $student = $result->fetch_assoc();
} else {
  header("Location: student-list.php");
  exit();
}

// 2. Handle the Update form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
  $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $qualification = mysqli_real_escape_string($conn, $_POST['last_qualification']);
  $course = mysqli_real_escape_string($conn, $_POST['preferred_course']);
  $city = mysqli_real_escape_string($conn, $_POST['preferred_city']);
  $budget = mysqli_real_escape_string($conn, $_POST['budget_range']);
  $hostel = mysqli_real_escape_string($conn, $_POST['hostel_required']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $update_sql = "UPDATE students SET 
        full_name = '$full_name', 
        mobile = '$mobile', 
        email = '$email', 
        last_qualification = '$qualification', 
        preferred_course = '$course', 
        preferred_city = '$city', 
        budget_range = '$budget', 
        hostel_required = '$hostel', 
        message = '$message' 
        WHERE id = '$id'";

  if ($conn->query($update_sql)) {
    echo "<script>alert('Student updated successfully!'); window.location.href='student-list.php';</script>";
  } else {
    echo "Error updating: " . $conn->error;
  }
}
?>

<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description"
    content="Modern Education Admin Dashboard for schools, colleges, universities, and eLearning platforms. Includes student and course management, attendance, exams, payments, analytics, and a fully responsive clean UI—ideal for LMS, coaching centers, and academic admin systems.">
  <meta name="keywords"
    content="Education Admin Dashboard, School Admin Panel, College Dashboard, University Dashboard, LMS Dashboard, eLearning Admin Template, Student Management System, Course Management, Education Template, Study Dashboard, Online Learning Dashboard, Academic Admin Panel, Bootstrap Dashboard, React Education Dashboard, Next.js Education Template">
  <meta name="robots" content="INDEX,FOLLOW">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Title -->
  <title>Edudash - School, College & LMS Admin Dashboard Template | Bootstrap 5</title>
  <link rel="icon" type="image/png" href="assets/images/favicon.png" sizes="16x16">
  <!-- remix icon font css  -->
  <link rel="stylesheet" href="assets/css/remixicon.css">
  <!-- BootStrap css -->
  <link rel="stylesheet" href="assets/css/lib/bootstrap.min.css">
  <!-- Apex Chart css -->
  <link rel="stylesheet" href="assets/css/lib/apexcharts.css">
  <!-- Data Table css -->
  <link rel="stylesheet" href="assets/css/lib/dataTables.min.css">
  <!-- Date picker css -->
  <link rel="stylesheet" href="assets/css/lib/flatpickr.min.css">
  <!-- Calendar css -->
  <link rel="stylesheet" href="assets/css/lib/full-calendar.css">
  <!-- calendar -->
  <link rel="stylesheet" href="assets/css/lib/calendar.css">
  <!-- main css -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <!-- Theme Customization Structure Start -->
  <div class="body-overlay"></div>

  <button type="button"
    class="theme-customization__button w-48-px h-48-px bg-primary-600 text-white rounded-circle d-flex justify-content-center align-items-center position-fixed end-0 bottom-0 mb-40 me-40 text-2xxl bg-hover-primary-700" aria-label="Theme Customization Button">
    <i class="ri-settings-3-line animate-spin"></i>
  </button>
  <div class="theme-customization-sidebar w-100 bg-base h-100vh overflow-y-auto position-fixed end-0 top-0">
    <div class="d-flex align-items-center gap-3 py-16 px-24 justify-content-between border-bottom">
      <div>
        <h6 class="text-sm dark:text-white">Theme Settings</h6>
        <p class="text-xs mb-0 text-neutral-500 dark:text-neutral-200">Customize and preview instantly</p>
      </div>
      <button data-slot="button"
        class="theme-customization-sidebar__close text-neutral-900 bg-transparent text-hover-primary-600 d-flex text-xl">
        <i class="ri-close-fill"></i>
      </button>
    </div>

    <div class="d-flex flex-column gap-48 p-24 overflow-y-auto flex-grow-1">

      <div class="theme-setting-item">
        <h6 class="fw-medium text-primary-light text-md mb-3">Theme Mode</h6>
        <div class="d-grid grid-cols-3 gap-3 dark-light-mode">
          <button type="button"
            class="theme-btn theme-setting-item__btn d-flex align-items-center justify-content-center h-64-px rounded-3 text-xl active"
            data-theme="light" aria-label="light">
            <i class="ri-sun-line"></i>
          </button>
          <button type="button"
            class="theme-btn theme-setting-item__btn d-flex align-items-center justify-content-center h-64-px rounded-3 text-xl"
            data-theme="dark" aria-label="dark">
            <i class="ri-moon-line"></i>
          </button>
          <button type="button"
            class="theme-btn theme-setting-item__btn d-flex align-items-center justify-content-center h-64-px rounded-3 text-xl"
            data-theme="system" aria-label="system">
            <i class="ri-computer-line"></i>
          </button>
        </div>
      </div>

      <div class="theme-setting-item">
        <h6 class="fw-medium text-primary-light text-md mb-3">Page Direction</h6>
        <div class="d-grid grid-cols-2 gap-3">
          <button type="button"
            class="theme-setting-item__btn ltr-mode-btn d-flex align-items-center justify-content-center gap-2 h-56-px rounded-3 text-xl" aria-label="LTR">
            <span><i class="ri-align-item-left-line"></i></span>
            <span class="h6 text-sm font-medium mb-0">LTR</span>
          </button>

          <button type="button"
            class="theme-setting-item__btn rtl-mode-btn d-flex align-items-center justify-content-center gap-2 h-56-px rounded-3 text-xl" aria-label="RTL">
            <span class="h6 text-sm font-medium mb-0">RTL</span>
            <span><i class="ri-align-item-right-line"></i></span>
          </button>
        </div>
      </div>

      <div class="theme-setting-item">
        <h6 class="fw-medium text-primary-light text-md mb-3">Color Schema</h6>
        <div class="d-grid grid-cols-3 gap-3">
          <button type="button"
            class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
            data-color="base" aria-label="Base">
            <span class="color-picker-btn__box h-40-px w-100 rounded-3"
              style="background-color: #25A194;"></span>
            <span class="fw-medium mt-1" style="color: #25A194;">Base</span>
          </button>
          <button type="button"
            class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
            data-color="red" aria-label="Red">
            <span class="color-picker-btn__box h-40-px w-100 rounded-3"
              style="background-color: #dc2626;"></span>
            <span class="fw-medium mt-1" style="color: #dc2626;">Red</span>
          </button>
          <button type="button"
            class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
            data-color="blue" aria-label="Blue">
            <span class="color-picker-btn__box h-40-px w-100 rounded-3"
              style="background-color: #2563eb;"></span>
            <span class="fw-medium mt-1" style="color: #2563eb;">Blue</span>
          </button>
          <button type="button"
            class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
            data-color="yellow" aria-label="Yellow">
            <span class="color-picker-btn__box h-40-px w-100 rounded-3"
              style="background-color: #ff9f29;"></span>
            <span class="fw-medium mt-1" style="color: #ff9f29;">Yellow</span>
          </button>
          <button type="button"
            class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
            data-color="cyan" aria-label="Cyan">
            <span class="color-picker-btn__box h-40-px w-100 rounded-3"
              style="background-color: #00b8f2;"></span>
            <span class="fw-medium mt-1" style="color: #00b8f2;">Cyan</span>
          </button>
          <button type="button"
            class="color-picker-btn d-flex flex-column justify-content-center align-items-center"
            data-color="violet" aria-label="Violet">
            <span class="color-picker-btn__box h-40-px w-100 rounded-3"
              style="background-color: #7c3aed;"></span>
            <span class="fw-medium mt-1" style="color: #7c3aed;">Violet</span>
          </button>
        </div>
      </div>

    </div>
  </div>
  <!-- Theme Customization Structure End -->

  <div class="overlay bg-black bg-opacity-50 w-100 h-100 position-fixed z-9 visibility-hidden opacity-0 duration-300">
  </div>
  <aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
      <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div class="">
      <div class="sidebar-logo d-flex align-items-center justify-content-between">
        <a href="index.php" class="">
          <img src="assets/images/logo.png" alt="site logo" class="light-logo">
          <img src="assets/images/logo-light.png" alt="site logo" class="dark-logo">
          <img src="assets/images/logo-icon.png" alt="site logo" class="logo-icon">
        </a>
        <button type="button" class="text-xxl d-xl-flex d-none line-height-1 sidebar-toggle text-neutral-500"
          aria-label="Collapse Sidebar">
          <i class="ri-contract-left-line"></i>
        </button>
      </div>
    </div>
    <!-- User Info start -->
    <div class="mx-16 py-12">
      <div class="dropdown profile-dropdown">
        <button type="button"
          class="profile-dropdown__button d-flex align-items-center justify-content-between p-10 w-100 overflow-hidden bg-neutral-50 radius-12 "
          data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
          <span class="d-flex align-items-start gap-10">
            <img src="assets/images/thumbs/leave-request-img2.png" alt="Thumbnail"
              class="w-40-px h-40-px rounded-circle object-fit-cover flex-shrink-0">
            <span class="profile-dropdown__contents">
              <span class="h6 mb-0 text-md d-block text-primary-light">Jone Copper</span>
              <span class="text-secondary-light text-sm mb-0 d-block">Admin</span>
            </span>
          </span>
          <span class="profile-dropdown__icon pe-8 text-xl d-flex line-height-1">
            <i class="ri-arrow-right-s-line"></i>
          </span>
        </button>
        <ul class="dropdown-menu dropdown-menu-lg-end border p-12">
          <li>
            <a href="student-details.php"
              class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
              <i class="ri-user-3-line"></i>
              My Profile
            </a>
          </li>
          <li>
            <a href="general.php"
              class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
              <i class="ri-settings-3-line"></i>
              Setting
            </a>
          </li>
          <li>
            <a href="login.php"
              class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
              <i class="ri-shut-down-line"></i>
              Log Out
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- User Info end -->
    <div class="sidebar-menu-area">
      <ul class="sidebar-menu" id="sidebar-menu">
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-home-4-line"></i>
            <span>Dashboard </span>
          </a>
          <ul class="sidebar-submenu">
            <!-- <li>
            <a href="index.php">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              School
            </a>
          </li> -->
            <li>
              <a href="index-2.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Student
              </a>
            </li>
            <!-- <li>
            <a href="index-3.php">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Teacher
            </a>
          </li>
          <li>
            <a href="index-4.php">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Parent
            </a>
          </li> -->
            <!-- <li>
            <a href="index-5.php">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              LMS 
            </a>
          </li> -->
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-graduation-cap-line"></i>
            <span>Students</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="add-new-student.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Add New Student
              </a>
            </li>
            <li>
              <a href="student-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Student List
              </a>
            </li>
            <li>
              <a href="suspended-student.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Suspend Student
              </a>
            </li>
            <!-- <li>
            <a href="student-category.php">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Student Categories
            </a>
          </li> -->
            <!-- <li>
            <a href="edit-student.php">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Edit Student
            </a>
          </li> -->
            <li>
              <a href="student-details.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Student Details
              </a>
            </li>
          </ul>
        </li>
        <!-- <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-user-follow-line"></i>
            <span>Teachers</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="add-new-teacher.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Add New Teacher
              </a>
            </li>
            <li>
              <a href="teacher-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Teacher List
              </a>
            </li>
            <li>
              <a href="edit-teacher.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Edit Teacher
              </a>
            </li>
            <li>
              <a href="teacher-details.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Teacher Details
              </a>
            </li>
            <li>
              <a href="teacher-timetable.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Teacher Timetable
              </a>
            </li>
          </ul>
        </li> -->
        <!-- <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-account-circle-line"></i>
            <span>Guardian</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="add-new-guardian.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Add New Guardians
              </a>
            </li>
            <li>
              <a href="guardian-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Guardians List
              </a>
            </li>
            <li>
              <a href="edit-guardian.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Edit Guardian
              </a>
            </li>
            <li>
              <a href="guardian-details.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Guardian Details
              </a>
            </li>
          </ul>
        </li> -->
        <!-- <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-list-view"></i>
            <span>Classes</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="section-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Section
              </a>
            </li>
            <li>
              <a href="subject-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Subjects
              </a>
            </li>
            <li>
              <a href="class-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Class List
              </a>
            </li>
            <li>
              <a href="class-room-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Class Room
              </a>
            </li>
          </ul>
        </li> -->
        <!-- <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-file-edit-line"></i>
            <span>Examinations</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="exam.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Exam
              </a>
            </li>
            <li>
              <a href="exam-schedule.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Exam Schedule
              </a>
            </li>
            <li>
              <a href="exam-result.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Exam Result
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-money-dollar-circle-line"></i>
            <span>Fees Collection</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="fees-collect.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Fees Collect
              </a>
            </li>
            <li>
              <a href="fees-type.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Fees Type
              </a>
            </li>
            <li>
              <a href="fees-group.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Fees Group
              </a>
            </li>
            <li>
              <a href="fees-discount.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Fees Discount
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-calendar-check-line"></i>
            <span>Attendance</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="student-attendance.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Student Attendance
              </a>
            </li>
            <li>
              <a href="teacher-attendance.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Teacher Attendance
              </a>
            </li>
            <li>
              <a href="employee-attendance.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Employee Attendance
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-time-line"></i>
            <span>Leaves</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="leave-types.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Leave Types
              </a>
            </li>
            <li>
              <a href="leave-request.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Leave Request
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="certificate.php">
            <i class="ri-home-4-line"></i>
            <span>Certificate </span>
          </a>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-book-2-line"></i>
            <span>Library</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="books-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Books List
              </a>
            </li>
            <li>
              <a href="members-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Members List
              </a>
            </li>
            <li>
              <a href="member-details.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Members Details
              </a>
            </li>
            <li>
              <a href="issue-return.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Issue Return
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-money-dollar-circle-line"></i>
            <span>Accounts</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="income-head.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Income Head
              </a>
            </li>
            <li>
              <a href="income-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Income List
              </a>
            </li>
            <li>
              <a href="expense-head.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Expense Head
              </a>
            </li>
            <li>
              <a href="expense-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Expense List
              </a>
            </li>
            <li>
              <a href="transaction.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Transaction
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-user-settings-line"></i>
            <span>HRM</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="employee-list.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Employee List
              </a>
            </li>
            <li>
              <a href="employee-details.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Employee Details
              </a>
            </li>
            <li>
              <a href="add-new-employee.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Add New Employee
              </a>
            </li>
            <li>
              <a href="payroll.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Payroll
              </a>
            </li>
            <li>
              <a href="designation.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Designation
              </a>
            <li>
              <a href="department.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Department
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="notice-board.php">
            <i class="ri-booklet-line"></i>
            <span>Notice Board </span>
          </a>
        </li>
        <li>
          <a href="event.php">
            <i class="ri-calendar-event-line"></i>
            <span>Event </span>
          </a>
        </li>
        <li>
          <a href="message.php">
            <i class="ri-message-2-line"></i>
            <span>Message </span>
          </a>
        </li>
        <li>
          <a href="subscription-plan.php">
            <i class="ri-price-tag-3-line"></i>
            <span>Subscription Plan </span>
          </a>
        </li>
        <li>
          <a href="role-access.php">
            <i class="ri-macbook-line"></i>
            <span>Role & Access</span>
          </a>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-shield-check-line"></i>
            <span>Authentication</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="login.php"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Login</a>
            </li>
            <li>
              <a href="register.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Register</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="assign-role-plan.php">
            <i class="ri-user-follow-line"></i>
            <span>Assign Role</span>
          </a>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <i class="ri-user-settings-line"></i>
            <span>Settings</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="general.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                General
              </a>
            </li>
            <li>
              <a href="notification.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Notification
              </a>
            </li>
            <li>
              <a href="currencies.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Currencies
              </a>
            </li>
            <li>
              <a href="languages.php">
                <i class="ri-circle-fill circle-icon w-auto"></i>
                Languages
              </a>
            </li>
          </ul>
        </li> -->
      </ul>
    </div>
  </aside>

  <main class="dashboard-main">
    <div class="navbar-header shadow-1">
      <div class="row align-items-center justify-content-between">
        <div class="col-auto">
          <div class="d-flex flex-wrap align-items-center gap-4">
            <button type="button" class="sidebar-mobile-toggle" aria-label="Sidebar Mobile Toggler Button">
              <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
            </button>
            <form class="navbar-search">
              <input type="text" class="bg-transparent" name="search" placeholder="Search">
              <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
          </div>
        </div>
        <div class="col-auto">
          <div class="d-flex flex-wrap align-items-center gap-3">
            <button type="button" data-theme-toggle
              class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" aria-label="Dark & Light Mode Button"></button>
            <div class="dropdown d-inline-block">
              <button
                class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                type="button" data-bs-toggle="dropdown" aria-label="Language Change Button">
                <img src="assets/images/flags/flag1.png" alt="image" class="w-24 h-24 object-fit-cover rounded-circle">
              </button>
              <div class="dropdown-menu to-top dropdown-menu-sm">
                <div
                  class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                  <div>
                    <h6 class="text-lg text-primary-light fw-semibold mb-0">Choose Your Language</h6>
                  </div>
                </div>

                <div class="max-h-400-px overflow-y-auto scroll-sm pe-8">
                  <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="english">
                      <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                        <img src="assets/images/flags/flag1.png" alt="Image"
                          class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                        <span class="text-md fw-semibold mb-0">English</span>
                      </span>
                    </label>
                    <input class="form-check-input" type="radio" name="crypto" id="english">
                  </div>

                  <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="japan">
                      <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                        <img src="assets/images/flags/flag2.png" alt="Image"
                          class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                        <span class="text-md fw-semibold mb-0">Japan</span>
                      </span>
                    </label>
                    <input class="form-check-input" type="radio" name="crypto" id="japan">
                  </div>

                  <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="france">
                      <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                        <img src="assets/images/flags/flag3.png" alt="Image"
                          class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                        <span class="text-md fw-semibold mb-0">France</span>
                      </span>
                    </label>
                    <input class="form-check-input" type="radio" name="crypto" id="france">
                  </div>

                  <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="germany">
                      <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                        <img src="assets/images/flags/flag4.png" alt="Image"
                          class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                        <span class="text-md fw-semibold mb-0">Germany</span>
                      </span>
                    </label>
                    <input class="form-check-input" type="radio" name="crypto" id="germany">
                  </div>

                  <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="korea">
                      <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                        <img src="assets/images/flags/flag5.png" alt="Image"
                          class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                        <span class="text-md fw-semibold mb-0">South Korea</span>
                      </span>
                    </label>
                    <input class="form-check-input" type="radio" name="crypto" id="korea">
                  </div>

                  <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="bangladesh">
                      <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                        <img src="assets/images/flags/flag6.png" alt="Image"
                          class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                        <span class="text-md fw-semibold mb-0">Bangladesh</span>
                      </span>
                    </label>
                    <input class="form-check-input" type="radio" name="crypto" id="bangladesh">
                  </div>

                  <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="india">
                      <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                        <img src="assets/images/flags/flag7.png" alt="Image"
                          class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                        <span class="text-md fw-semibold mb-0">India</span>
                      </span>
                    </label>
                    <input class="form-check-input" type="radio" name="crypto" id="india">
                  </div>
                  <div class="form-check style-check d-flex align-items-center justify-content-between">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="canada">
                      <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                        <img src="assets/images/flags/flag8.png" alt="Image"
                          class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                        <span class="text-md fw-semibold mb-0">Canada</span>
                      </span>
                    </label>
                    <input class="form-check-input" type="radio" name="crypto" id="canada">
                  </div>
                </div>
              </div>
            </div><!-- Language dropdown end -->

            <div class="dropdown">
              <button
                class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center position-relative"
                type="button" data-bs-toggle="dropdown" aria-label="Notification Button">
                <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                <span class="w-8-px h-8-px bg-danger-600 position-absolute end-0 top-0 rounded-circle mt-2 me-2"></span>
              </button>
              <div class="dropdown-menu to-top dropdown-menu-lg p-0">
                <div
                  class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                  <div>
                    <h6 class="text-lg text-primary-light fw-semibold mb-0">Notifications</h6>
                  </div>
                  <span
                    class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">05</span>
                </div>

                <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
                  <a href="javascript:void(0)"
                    class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                    <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                      <span
                        class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                        <iconify-icon icon="bitcoin-icons:verify-outline" class="icon text-xxl"></iconify-icon>
                      </span>
                      <div>
                        <h6 class="text-md fw-semibold mb-4">Congratulations</h6>
                        <p class="mb-0 text-sm text-secondary-light text-w-200-px">Your profile has been Verified. Your
                          profile has been Verified</p>
                      </div>
                    </div>
                    <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
                  </a>

                  <a href="javascript:void(0)"
                    class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between bg-neutral-50">
                    <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                      <span
                        class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                        <img src="assets/images/notification/profile-1.png" alt="Image">
                      </span>
                      <div>
                        <h6 class="text-md fw-semibold mb-4">Ronald Richards</h6>
                        <p class="mb-0 text-sm text-secondary-light text-w-200-px">You can stitch between artboards</p>
                      </div>
                    </div>
                    <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
                  </a>

                  <a href="javascript:void(0)"
                    class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                    <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                      <span
                        class="w-44-px h-44-px bg-info-subtle text-info-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                        AM
                      </span>
                      <div>
                        <h6 class="text-md fw-semibold mb-4">Arlene McCoy</h6>
                        <p class="mb-0 text-sm text-secondary-light text-w-200-px">Invite you to prototyping</p>
                      </div>
                    </div>
                    <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
                  </a>

                  <a href="javascript:void(0)"
                    class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between bg-neutral-50">
                    <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                      <span
                        class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                        <img src="assets/images/notification/profile-2.png" alt="Image">
                      </span>
                      <div>
                        <h6 class="text-md fw-semibold mb-4">Robiul Hasan</h6>
                        <p class="mb-0 text-sm text-secondary-light text-w-200-px">Invite you to prototyping</p>
                      </div>
                    </div>
                    <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
                  </a>

                  <a href="javascript:void(0)"
                    class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                    <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                      <span
                        class="w-44-px h-44-px bg-info-subtle text-info-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                        DR
                      </span>
                      <div>
                        <h6 class="text-md fw-semibold mb-4">Darlene Robertson</h6>
                        <p class="mb-0 text-sm text-secondary-light text-w-200-px">Invite you to prototyping</p>
                      </div>
                    </div>
                    <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
                  </a>
                </div>

                <div class="text-center py-12 px-16">
                  <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md hover-underline">See All Notification</a>
                </div>

              </div>
            </div><!-- Notification dropdown end -->

          </div>
        </div>
      </div>
    </div>

    <div class="dashboard-main-body">

      <div class="breadcrumb d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <div class="">
          <h1 class="fw-semibold mb-4 h6 text-primary-light">Edit Student</h1>
          <div class="">
            <a href="index.php" class="text-secondary-light hover-text-primary hover-underline">Dashboard </a>
            <a href="student-list.php" class="text-secondary-light hover-text-primary hover-underline "> /
              Student</a>
            <span class="text-secondary-light">/ Edit Student</span>
          </div>
        </div>
        <a href="add-new-student.php" class="btn btn-primary-600 d-flex align-items-center gap-6 d-none">
          <span class="d-flex text-md">
            <i class="ri-add-large-line"></i>
          </span>
          Add Student
        </a>
      </div>

      <form method="POST" class="mt-24">
        <div class="row gy-3">
          <div class="col-lg-12">
            <div class="shadow-1 radius-12 bg-base h-100 overflow-hidden">
              <div class="card-header border-bottom bg-base py-16 px-24">
                <h6 class="text-lg fw-semibold mb-0">Admission Lead Details</h6>
              </div>
              <div class="card-body p-20">
                <div class="row gy-3">
                  <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Full Name</label>
                    <input type="text" name="full_name" class="form-control" value="<?= $student['full_name'] ?>" required>
                  </div>
                  <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $student['email'] ?>" required>
                  </div>
                  <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" value="<?= $student['mobile'] ?>" required>
                  </div>
                  <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Last Qualification</label>
                    <input type="text" name="last_qualification" class="form-control" value="<?= $student['last_qualification'] ?>">
                  </div>
                  <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Preferred Course</label>
                    <input type="text" name="preferred_course" class="form-control" value="<?= $student['preferred_course'] ?>">
                  </div>
                  <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Preferred City</label>
                    <input type="text" name="preferred_city" class="form-control" value="<?= $student['preferred_city'] ?>">
                  </div>
                  <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Budget Range</label>
                    <input type="text" name="budget_range" class="form-control" value="<?= $student['budget_range'] ?>">
                  </div>
                  <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Hostel Required</label>
                    <select name="hostel_required" class="form-control form-select">
                      <option value="Yes" <?= ($student['hostel_required'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
                      <option value="No" <?= ($student['hostel_required'] == 'No') ? 'selected' : '' ?>>No</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="text-sm fw-semibold text-primary-light mb-8">Message</label>
                    <textarea name="message" class="form-control" rows="4"><?= $student['message'] ?></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 text-center mt-24">
            <button type="submit" class="btn btn-primary-600 px-40">Update Student Data</button>
            <a href="student-list.php" class="btn btn-outline-danger px-40 ms-2">Cancel</a>
          </div>
        </div>
      </form>
    </div>

    <footer class="d-footer">
      <div class="">
        <p class="mb-0 text-center"> &copy; <span class="current-year"></span> Made With ❤️ by Wowtheme7.</p>
      </div>
    </footer>
  </main>

  <!-- jQuery library js -->
  <script src="assets/js/lib/jquery-3.7.1.min.js"></script>
  <!-- Bootstrap js -->
  <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
  <!-- Apex Chart js -->
  <script src="assets/js/lib/apexcharts.min.js"></script>
  <!-- Iconify Font js -->
  <script src="assets/js/lib/iconify-icon.min.js"></script>
  <!-- Data Table js -->
  <script src="assets/js/lib/dataTables.min.js"></script>

  <!-- jQuery UI js -->
  <script src="assets/js/lib/jquery-ui.min.js"></script>

  <!-- main js -->
  <script src="assets/js/app.js"></script>

  <script>
    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
      $(toggleSelector).on('click', function() {
        $(this).toggleClass("ri-eye-off-line");
        var input = $($(this).attr("data-toggle"));
        if (input.attr("type") === "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
    // ========================= Password Show Hide Js End ===========================

    // ========================== Drag & Drop Upload photo Js start ========================
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
      const dropZoneElement = inputElement.closest(".drop-zone");

      dropZoneElement.addEventListener("click", (e) => {
        inputElement.click();
      });

      inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
          updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
      });

      dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
      });

      ["dragleave", "dragend"].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
          dropZoneElement.classList.remove("drop-zone--over");
        });
      });

      dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();

        if (e.dataTransfer.files.length) {
          inputElement.files = e.dataTransfer.files;
          updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove("drop-zone--over");
      });
    });

    /**
     * Updates the thumbnail on a drop zone element.
     *
     * @param {HTMLElement} dropZoneElement
     * @param {File} file
     */
    function updateThumbnail(dropZoneElement, file) {
      let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

      // First time - remove the prompt
      if (dropZoneElement.querySelector(".drop-zone__prompt")) {
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
      }

      // First time - there is no thumbnail element, so lets create it
      if (!thumbnailElement) {
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailElement);
      }

      thumbnailElement.dataset.label = file.name;

      // Show thumbnail for image files
      if (file.type.startsWith("image/")) {
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => {
          thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
        };
      } else {
        thumbnailElement.style.backgroundImage = null;
      }
    }
    // ========================== Drag & Drop Upload photo Js end ========================
  </script>

</body>

</html>