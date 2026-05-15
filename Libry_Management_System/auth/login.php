<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management System</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        .body-logingForm {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(-45deg, #0f172a, #1e1b4b, #312e81, #1e3a8a);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-container {
            display: flex;
            width: 900px;
            max-width: 95%;
            height: 550px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .left-side {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .left-side h1 {
            color: #ffffff;
            font-size: 3.5rem;
            font-weight: 700;
            margin: 0;
            line-height: 1.1;
            text-shadow: 0 4px 10px rgba(0,0,0,0.3);
            z-index: 1;
        }

        .left-side p {
            color: #a5b4fc;
            font-size: 1.5rem;
            margin: 10px 0 0 0;
            font-weight: 300;
            z-index: 1;
        }

        .right-side {
            flex: 1;
            padding: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
        }

        .login-card {
            width: 100%;
            max-width: 350px;
        }

        .login-card h2 {
            color: #1e293b;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            color: #334155;
            background: #f8fafc;
            box-sizing: border-box;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .input-group input:focus {
            background: #ffffff;
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        
        .error-msg {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 6px;
            display: block;
            min-height: 16px;
            font-weight: 500;
        }

        .input-error {
            border-color: #ef4444 !important;
            background: #fef2f2 !important;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            margin-top: 10px;
            font-family: 'Inter', sans-serif;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .signup-link {
            margin-top: 25px;
            display: block;
            text-align: center;
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .signup-link:hover {
            color: #6366f1;
        }

        .left-side-decorator {
            margin-top: 30px; 
            width: 60px; 
            height: 6px; 
            background: linear-gradient(90deg, #8b5cf6, #3b82f6); 
            border-radius: 3px;
            z-index: 1;
        }
    </style>
</head>
<body>

    <div class="body-logingForm">
    
        <div class="login-container">
            <div class="left-side">
                <h1>Library</h1>
                <p>Management System</p>
                <div class="left-side-decorator"></div>
            </div>

            <div class="right-side">
                <div class="login-card">
                    <h2>Login</h2>
                    <form method="POST" id="login-form">
                        <div class="input-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Enter username" required>
                        </div>
                        
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter password" required>
                        </div>

                        <button type="submit" class="login-btn">Sign In</button>
                    </form>
                    <a href="../features/UserRegistation.php" class="signup-link">Don't have an account? Sign up here</a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const loginform = document.getElementById('login-form');
        
        loginform.addEventListener('submit', (e) => {
            e.preventDefault();
            const data = new FormData(loginform);

            fetch('login_process.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json()) 
            .then(data => {                    
                console.log(data);
                if(data.status === 'success') {
                    console.log('Success');
                    window.location.href = '../index.php';
                } else {
                    console.log('Error');
                    alert(data.message || 'Invalid login details'); 
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
        });
    </script>

</body>
</html>