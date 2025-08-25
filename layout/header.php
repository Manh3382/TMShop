<html>    
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style.css" rel="stylesheet" type="text/css"/>    
        <!--<link href="public/css/login.css" rel="stylesheet" type="text/css"/>--> 
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <a id="logo">UNITOP</a>
                <?php if (is_login()) {
                    ?>
                    <div id="user-login">
                        <p>Xin chào <strong><?php echo $_SESSION['user_login'] ?></strong>(<a href="?mod=users&action=logout">Thoát</a>)</p>
                    </div>
                    <?php
                }
                ?>
                <ul id="main-menu">
                    <li><a href="?">Trang chủ</a></li>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Tin tức</a></li>
                    <li><a href="#">Sản phẩm</a></li>
                    <li><a href="#">Khoa học</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>