<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="form">
        <h2>Signup form</h2>
        <form action="signup.php" method="POST" enctype="multipart/form-data">
            <div class="error-text">Error</div>
            <div class="grid-details">
                <div class="input">
                    <label>First Name</label>
                    <input type="text" name="fname" placeholder="First Name" required>
                </div>
                <div class="input">
                    <label>Last Name</label>
                    <input type="text" name="lname" placeholder="Last Name" required>
                </div>
            </div>
            <div class="input">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter Your Email" required>
            </div>
            <div class="input">
                <label>Phone</label>
                <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{11}" required oninvalid="this.setCustomValidity('Enter 11 digit number')" oninput="this.setCustomValidity('')">
            </div>
            <div class="grid-details">
                <div class="input">
                    <label>Password</label>
                    <input type="password" name="pass" placeholder="Password" required">
                </div>
                <div class="input">
                    <label>Confirm Password</label>
                    <input type="password" name="cpass" placeholder="Confirm Password" required">
                </div>
            </div>
            <div class="profile-img">
                <img src="image/Profile.png" width="75" height="75">
                <div class="file-upload">
                    <input type="file" id="image-preview" name="image" class="file-input" required oninvalid="this.setCustomValidity('Select a Profile Picture')" oninput="this.setCustomValidity('')">
                </div>
                <div class="upload-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="camera-icon" viewBox="0 0 24 24" fill="white" width="14px" height="14px">
                        <path d="M12 9a3 3 0 100 6 3 3 0 000-6zm8-3h-3.17l-1.83-2H9L7.17 6H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V8a2 2 0 00-2-2zm-8 12a5 5 0 110-10 5 5 0 010 10z"/>
                    </svg>
                </div>
            </div>
            <div class="submit">
                <input type="submit" value="Signup Now" class="button">
            </div>
        </form>
        <div class="link">Already Signed up? <a href="">Login Now</a></div>
    </div>
    <script src="js/register.js"></script>
</body>
</html>