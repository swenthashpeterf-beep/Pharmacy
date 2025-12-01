<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaGuide Pro 💊</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-color: #0f766e; /* Teal 700 */
            --primary-light: #14b8a6; /* Teal 500 */
            --bg-color: #f0fdfa;      /* Very light teal bg */
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
        }

        h1, h2, h3, h4, h5, .navbar-brand {
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar Glassmorphism */
        .navbar {
            background: rgba(15, 118, 110, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(15, 118, 110, 0.15);
        }

        /* Pro Cards */
        .medicine-card {
            border: none;
            border-radius: 16px;
            background: var(--card-bg);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .medicine-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }

        .medicine-img-wrapper {
            height: 180px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .medicine-img {
            height: 100%;
            width: 100%;
            object-fit: cover; /* Use cover for better filling */
            transition: transform 0.5s ease;
        }
        
        .medicine-card:hover .medicine-img {
            transform: scale(1.05);
        }

        /* Badges */
        .badge-category {
            background-color: rgba(20, 184, 166, 0.15);
            color: var(--primary-color);
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Form Controls */
        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 12px 15px;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.2);
            border-color: var(--primary-light);
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-light);
        }

        .btn-action-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: 0.2s;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-5 sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4" href="index.php">
        <i class="bi bi-capsule-pill me-2"></i>PharmaGuide
    </a>
    </div>
</nav>