<html>
    <head>
        <title>Trang đăng nhập</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wp-form-login">
            <h1 class="page-title">ĐĂNG NHẬP</h1>
            <form id="form-login" action="" method="POST">
                <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="Username"/>
                <?php echo form_error('username'); ?>
                <input type="password" name="password" id="password" value="<?php echo set_value('password') ?>" placeholder="Password"/>
                <?php echo form_error('password'); ?>
                <input type="submit" id="btn-login" name="btn-login" value="ĐĂNG NHẬP" />
                <?php echo form_error('account'); ?>
            </form>
            <a href="<?php echo base_url("?mod=users&action=reset"); ?>" id="lose-pass">Quên mật khẩu |</a>
            <a href="<?php echo base_url("?mod=users&action=reg"); ?>" id="lose-pass">Đăng ký</a>
        </div>
    </body>
</html>