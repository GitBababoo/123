<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase Auth</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-auth.js"></script>
    <script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>
    <link rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.css">
    <link rel="stylesheet" href="style_log.css">
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

        const uiConfig = {
            signInFlow: 'popup',
            signInSuccessUrl: 'dashboard.html',
            signInOptions: [firebase.auth.GoogleAuthProvider.PROVIDER_ID],
        };

        window.onload = function() {
            const ui = new firebaseui.auth.AuthUI(firebase.auth());
            firebase.auth().onAuthStateChanged(user => {
                if (user) {
                    document.getElementById('account-details').textContent = JSON.stringify(user, null, 2);
                    document.getElementById('signOut').style.display = 'inline-block';

                    const userData = {
                        google_id: user.uid,
                        name: user.displayName,
                        email: user.email,
                        profile_picture: user.photoURL,
                    };

                    // ส่งข้อมูลไปยังเซิร์ฟเวอร์ PHP
                    fetch('save_user.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(userData),
                    });
                } else {
                    ui.start('#firebaseui-auth-container', uiConfig);
                }
            });

            document.getElementById('signOut').addEventListener('click', () => {
                firebase.auth().signOut().then(() => location.reload());
            });
        };
    </script>
</head>

<body>
<div class="container center-align">
    <div id="firebaseui-auth-container"></div>
    <pre id="account-details" class="left-align"></pre>
    <button id="signOut" style="display: none;" class="btn">Sign Out</button>
    <br>
    <form id="loginForm" method="POST" action="process_login.php">
        <input type="text" placeholder="ชื่อผู้ใช้งาน หรือ อีเมล" name="username" id="username" required>
        <input type="password" placeholder="รหัสผ่าน" name="password" id="password" required>
        <p class="forgot">
            <a href="#" id="forgotPasswordLink">ลืมรหัสผ่านใช่ไหม?</a>
        </p>
        <button type="submit">เข้าสู่ระบบ</button>
    </form>
    <p>ยังไม่เป็นสมาชิกใช่ไหม? <a href="register.php">สมัครสมาชิกเลย!</a></p>
</div>
</body>
</html>
