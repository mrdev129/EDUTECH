<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Management System - Admin Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #b0b8c3;
            --btn-blue: #438eb9;
            --text-muted: #777;
            --border-color: #d5d5d5;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
        }

        .wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            background: #ffffff;
            border-radius: 2px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }

        /* HEADER: Logo on Left, Title Centered */
        .card-header {
            background-color: #f7f7f7;
            border-bottom: 1px solid var(--border-color);
            padding: 25px 15px;
            display: flex;
            justify-content: center; /* Centers the title text */
            align-items: center;
            position: relative;     /* Allows absolute positioning of logo */
            min-height: 100px;
        }

        .header-logo {
            position: absolute;      /* Detaches logo from text flow */
            left: 20px;              /* Fixes logo to the left side */
            width: 60px;
            height: auto;
        }

        .header-title {
            color: #0056b3;
            font-weight: 700;
            font-size: 1.1rem;
            line-height: 1.5;        /* Added height for vertical gap */
            text-transform: uppercase;
            margin: 0;
            text-align: center;
        }

        .header-title small {
            display: block;          /* Ensures it sits on a new line */
            margin-top: 5px;         /* Creates the requested gap */
            font-weight: 600;
        }

        /* Body Styling */
        .card-body {
            padding: 40px 35px;
        }

        .system-label {
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }

        /* Input Customization */
        .input-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 0;
            border-right: none;
            padding: 10px 15px;
            font-size: 1rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #999;
        }

        .input-group-text {
            background: #fff;
            border-radius: 0;
            border-left: none;
            color: #888;
            min-width: 45px;
            justify-content: center;
        }

        /* Buttons & Actions */
        .btn-login {
            background-color: var(--btn-blue);
            color: white;
            border: none;
            border-radius: 0;
            padding: 8px 25px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #3579a3;
            color: #fff;
        }

        .form-check-label {
            color: var(--text-muted);
            font-size: 0.9rem;
            cursor: pointer;
        }

        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .header-logo {
                width: 45px;
                left: 10px;
            }
            .header-title {
                font-size: 0.95rem;
                padding-left: 40px; /* Prevents text from hitting logo on small screens */
            }
            .btn-login {
                width: 100%;
                margin-top: 15px;
            }
            .action-row {
                flex-direction: column;
                align-items: flex-start !important;
            }
        }

        .footer-copy {
            margin-top: 20px;
            font-size: 0.85rem;
            color: #333;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="login-card">
        <div class="card-header">
            <img src="../assets/images/EDU-LOGO.jpeg" alt="Logo" class="header-logo">
            
            <div class="header-title">
                <span class="text-primary">EDUTECH</span> MANAGEMENT SYSTEM
                <small class="text-danger">ADMISSION EXPERT</small>
            </div>
        </div>

        <div class="card-body">
            <div class="system-label">Admin Portal Access</div>
            
            <form action="process.php" method="POST" id="loginForm">
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                </div>

                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                </div>

                <div class="d-flex justify-content-between align-items-center action-row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-login shadow-sm">Login</button>
                </div>
            </form>
        </div>
    </div>

    <div class="footer-copy">
        Copyright © 2026 <a href="#" class="text-decoration-none fw-bold">EDUTECH</a>. All rights reserved.
    </div>
</div>

</body>
</html>