<!DOCTYPE html>
<html>
<head>
    <title>High School Placement Services</title>
    <style>
        /* CSS for the landing page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            position: relative;
            min-height: 100vh;
            background-image: url("/images/Image1.jpg"), url("/images/Image2.jpg"), url("/images/Image3.jpg"),url("/images/Image4.jpg"),url("/images/Image5.jpg"),url("/images/Image6.jpg"),url("/images/Image7.jpg"),url("/images/Image8.jpg");
            background-size: 100% 100%;
            background-repeat: no-repeat;
            animation: shuffleBackground 15s linear infinite;
        }

        @keyframes shuffleBackground {
            0% { background-position: 0 0, 0 0, 0 0; }
            33% { background-position: -1200px 0, 0 0, 0 0; }
            66% { background-position: -2400px 0, -1200px 0, 0 0; }
            100% { background-position: -3600px 0, -2400px 0, -1200px 0; }
        }

        .container h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: red;
            font-weight: bold;
        }

        .container p {
            font-size: 16px;
            color: red;
            font-weight: bold;
        }

        .cta-container {
            margin-top: 20px;
        }

        .cta-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }

        .steps-container {
            margin-top: 50px;
            text-align: center;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background-color: transparent;
        }

        .steps-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: red;
            font-weight: bold;
        }

        .steps-container ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .steps-container li {
            flex: 1;
            margin: 0 10px;
        }

        .steps-container li span {
            font-size: 18px;
            font-weight: bold;
            color: #111;
        }

        .steps-container li p {
            margin-top: 10px;
            font-weight: bold;
            color: purple;
        }
        
        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("assets/images/school3.jpg"), url("assets/images/school4.jpg"), url("assets/images/school5.jpeg");
            background-size: 100% 100%;
            background-repeat: no-repeat;
            filter: blur(0.4px); /* Add blur effect to the background images */
            z-index: -1;
            animation: shuffleBackground 10s linear infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Welcome to High School Placement Services</h3>
        <p>Select your schools.</p>
        <div class="cta-container">
            <a href="{{ route('admin.login') }}">Admin-Login</a>
            <a href="{{ route('admin.register') }}">Admin-Register</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
        <section class="steps-container">
            <h2>Our Process</h2>
            <ul>
                <li>
                    <span>Step 1</span>
                    <p>Create an account by clicking the register button</p>
                </li>
                <li>
                    <span>Step 2</span>
                    <p>Select schools of your choice</p>
                </li>
                <li>
                    <span>Step 3</span>
                    <p>Submit the schools you selected</p>
                </li>
                <li>
                    <span>Step 4</span>
                    <p>Wait for Placement Confirmation</p>
                </li>
            </ul>
        </section>
    </div>
</body>
</html>