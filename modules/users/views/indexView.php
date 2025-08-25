<?php
//show_array($list_users);
?>
<!--<html>
    <head>
        <title>Danh sách thành viên</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <h1>Danh sách thành viên</h1>
        <table>
            <thead>
                <tr>
                    <td>STT</td>
                    <td>Tên</td>
                    <td>Email</td>
                    <td>Tuổi</td>
                    <td>Thu nhập</td>
                </tr>
            </thead>
            <tbody>
                //<?php
//                if (!empty($list_users)) {
//                    $t = 0;
//                    foreach ($list_users as $user) {
//                        $t ++;
//                        
?>
                        <tr>
                            <td>//<?php echo $t; ?></td>
                            <td>//<?php echo $user['fullname'] ?></td>
                            <td>//<?php echo $user['email'] ?></td>
                            <td>//<?php echo $user['age'] ?></td>
                            <td>//<?php echo currency_format($user['earn'], '$'); ?></td>
                        </tr>
                        //<?php
//                    }
//                }
//                
?>

            </tbody>
        </table>
    </body>
</html>-->

<html>    
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style.css" rel="stylesheet" type="text/css"/>
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
            <div id="footer">
                <p> FOOTER </p>
            </div>
        </div>
    </body>
</html>
