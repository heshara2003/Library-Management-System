<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management System</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <style type="text/css">
        a:hover{
            color: #e650de;
            text-decoration: underline;
            text-decoration-color: #e650de;
        }

        .login-btn:hover {
            color: #fff;
            background-color: #e650de;
            box-shadow: 0 4px 15px rgba(230, 80, 222, 0.4);
        }

        .input-group input:focus {
            border-color: #e650de;
            box-shadow: 0 0 0 3px rgba(230, 80, 222, 0.1);
        }
        
        .error-msg {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
            height: 15px; 
        }

        .input-error {
            border: 1px solid #e74c3c !important;
        }

    </style>
</head>
<body>

    <div class="body-logingForm">
    
        <div class="login-container">
            <div class="left-side">
                <h1>Library</h1>
                <p>Management System</p>
                <div style="margin-top: 20px; width: 50px; height: 4px; background: #fff; border-radius: 2px;"></div>
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
                    <a href="../features/UserRegistation.php" style="margin-top: 15px; display: block; text-align: center; color: #666; text-decoration: none;">Don't have an account?</a>
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