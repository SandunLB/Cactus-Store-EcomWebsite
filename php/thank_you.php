<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(../images/main.jpg);
            background-size: cover;
            background-position: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
        }
        .container {
            text-align: center;
            position: relative;
            z-index: 1;
            color: #fff;
        }
        h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        p {
            font-size: 24px;
            margin-bottom: 40px;
        }
        .button {
            background-color: #ff4b39;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 20px;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            outline: none;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
        }
        .button:hover {
            background-color: #ff4b39;
        }
        .button::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background-color: rgba(255, 255, 255, 0.1);
            transition: transform 0.5s cubic-bezier(0.5, 1.6, 0.4, 0.8);
            z-index: -1;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
        .button:hover::before {
            transform: scale(5);
        }
        .button .icon {
            margin-right: 10px;
            transition: margin-right 0.3s ease;
        }
        .button:hover .icon {
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <h1>Thank You for Your Purchase!</h1>
        <p>We appreciate your business and hope you enjoy your purchase.</p>
        <a href="user_panel.php" class="button">
            Browse More
        </a>
    </div>
</body>
</html>
