<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-auth.js"></script>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background: linear-gradient(to right, #f0f2f5, #d6e0e8);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
            max-width: 400px;
            text-align: center;
        }
        button {
            background: #007bff;
            color: #fff;
            padding: 15px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
            font-weight: 700;
            transition: background-color .3s;
        }
        button:hover {
            background: #0056b3;
        }
        input {
            width: 100%;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1em;
        }
    </style>
    <script>
        // Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyCiwcgVJ7dhbrcCa5G44jGjTAsn-jEF6DQ",
            authDomain: "login-web-app-b68fd.firebaseapp.com",
            projectId: "login-web-app-b68fd",
            storageBucket: "login-web-app-b68fd.appspot.com",
            messagingSenderId: "380080158599",
            appId: "1:380080158599:web:0f9a550ae69365f4c88522",
        };
        firebase.initializeApp(firebaseConfig);

        function sendPasswordResetEmail() {
            const email = document.getElementById('email').value;
            firebase.auth().sendPasswordResetEmail(email)
                .then(() => {
                    alert('Password reset email sent!');
                    window.location.href = 'index.html'; // Change to your login page
                })
                .catch((error) => {
                    alert(error.message);
                });
        }
    </script>
</head>

<body>
<div class="container">
    <h2>Reset Password</h2>
    <input type="email" id="email" placeholder="Enter your email" required>
    <button onclick="sendPasswordResetEmail()">Send Reset Email</button>
</div>
</body>
</html>
