<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to CharityHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --accent-color: #e74a3b;
        }
        
        body {
            background: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
        }
        
        .welcome-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            max-width: 600px;
            width: 100%;
        }
        
        .welcome-text {
            color: #5a5c69;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        
        .btn-welcome {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0.5rem;
            min-width: 150px;
        }
        
        .logo-img {
            height: 120px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center p-3">

    <div class="welcome-card">
        <div class="text-center">
            <img src="/images/charityhublogo.png" alt="CharityHub Logo" class="logo-img">
            
            <p class="welcome-text">
                Join us in making a difference. Support causes you care about and connect with local charities.
            </p>
            
            <div class="d-flex flex-wrap justify-content-center">
                <button onclick="location.href='/donations'" class="btn btn-danger btn-welcome">
                    <i class="fas fa-donate me-2"></i> Donate Now
                </button>
                <button onclick="location.href='/charities'" class="btn btn-primary btn-welcome">
                    <i class="fas fa-search me-2"></i> Find Charities
                </button>
            </div>
            
            <div class="mt-4">
                <p class="mb-2">Already have an account?</p>
                <a href="/login" class="btn btn-outline-primary btn-welcome">
                    <i class="fas fa-sign-in-alt me-2"></i> Sign In
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>