<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management System</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        .body-logingForm {
            margin: 0;
            padding: 0;
            min-height: 100vh;
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
            width: 1000px;
            max-width: 95%;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
            margin: 40px 0;
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
            flex: 1.5;
            padding: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            background: transparent;
            box-shadow: none;
            padding: 0;
        }

        .login-card h2 {
            color: #1e293b;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .registration-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px 25px; 
        }

        .full-width {
            grid-column: span 2;
        }

        .input-group {
            margin-bottom: 5px;
            position: relative;
        }

        .input-group label {
            display: block;
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 6px;
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
            margin-top: 4px;
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
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            margin-top: 25px;
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

    <div class="body-logingForm" style="overflow: hidden;">
    
        <div class="login-container">
            <div class="left-side">
                <h1>Library</h1>
                <p>Management System</p>
                <div class="left-side-decorator"></div>
            </div>

            <div class="right-side">
                <div class="login-card">
                    <h2>Sign Up</h2>
                    <form method="POST" id="login-form">
                        <div class="registration-grid">
                            
                            <span class="error-msg full-width" id="backendErr" style="text-align: center; height: auto; margin-bottom: 10px; font-size: 0.85rem;"></span>
                            
                            <div class="input-group full-width">
                                <label for="userid">User ID</label>
                                <input type="text" id="userid" name="userid" placeholder="Enter User ID" required>
                                <span class="error-msg" id="userid-error"></span>
                            </div>
                            
                            <div class="input-group">
                                <label for="firstname">First Name</label>
                                <input type="text" id="firstname" name="firstname" placeholder="Enter first name" required>
                            </div>

                            <div class="input-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" id="lastname" name="lastname" placeholder="Enter last name" required>
                            </div>

                            <div class="input-group full-width">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Enter email" required>
                            </div>

                            <div class="input-group full-width">
                                <label for="username">User Name</label>
                                <input type="text" id="username" name="username" placeholder="Enter username" required>
                                <span class="error-msg" id="username-error"></span>
                            </div>
                            
                            <div class="input-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Enter password" required>
                                <span class="error-msg" id="password-Err"></span>
                            </div>

                            <div class="input-group">
                                <label for="re-password">Re Enter Password</label>
                                <input type="password" id="re-password" name="confirm_password" placeholder="Re-enter password" required>
                                <span class="error-msg" id="Re-password-Err"></span>
                            </div>
                        </div>

                        <button type="submit" class="login-btn">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const loginform = document.getElementById('login-form');
        
        function validateForm(){
            const useridInput = document.getElementById('userid');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('re-password');

            const userid = useridInput.value.trim();
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();

            let isValid = true;

            document.getElementById('userid-error').innerText = '';
            document.getElementById('password-Err').innerText = '';
            document.getElementById('Re-password-Err').innerText = '';
            document.getElementById('backendErr').innerText = '';
            
            useridInput.classList.remove('input-error');
            passwordInput.classList.remove('input-error');
            confirmPasswordInput.classList.remove('input-error');

            if(userid !== ''){
                if(userid[0].toUpperCase() !== 'U'){
                    document.getElementById('userid-error').innerText = 'Invalid User ID.';
                    useridInput.classList.add('input-error');
                    isValid = false;
                }
            }

            if(password.length < 8){
                document.getElementById('password-Err').innerText = 'Password must be at least 8 characters long';
                passwordInput.classList.add('input-error');
                isValid = false;
            }
            else if(password !== confirmPassword){
                document.getElementById('Re-password-Err').innerText = 'Password mismatch';
                confirmPasswordInput.classList.add('input-error');
                isValid = false;
            }

            return isValid;
        }

        loginform.addEventListener('submit', (e) => {
            e.preventDefault();

            const validation = validateForm();

            if(validation){
                const data = new FormData(loginform);

                fetch('handleUserREg.php', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json()) 
                .then(data => {
                    console.log(data);
                    if(data.status === 'success') {
                        console.log('Success');
                        window.location.href = '../index.php';
                    } else if(data.status == 'UidErr'){
                        document.getElementById('userid-error').innerText = data.message;
                        document.getElementById('userid').classList.add('input-error'); 
                    }
                    else if(data.status == 'passErr'){
                        document.getElementById('password-Err').innerText = data.message;
                        document.getElementById('password').classList.add('input-error');
                    }
                    else if(data.status == 'PasaMis'){
                        document.getElementById('Re-password-Err').innerText = data.message;
                        document.getElementById('re-password').classList.add('input-error');
                    }
                    else{
                        document.getElementById('backendErr').innerText = data.message;
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
            }
        });
    </script>

</body>
</html>