<html>
    <head>
        <title>Thiết lập mật khẩu mới</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style.css" rel="stylesheet" type="text/css"/>    
        <link href="public/css/login.css" rel="stylesheet" type="text/css"/>    
    </head>
    <body>
        <div id="wp-form-login">
            <h1 class="page-title">MẬT KHẨU MỚI</h1>
            <form id="form-login" action="" method="POST">
                <input type="password" name="password" id="password" value="<?php echo set_value('password') ?>" placeholder="Password" autocomplete="false"/>
                <?php echo form_error('password'); ?>
                <input type="submit" class="btn-login" name="btn-new-pass" value="LƯU MẬT KHẨU" />
                <?php echo form_error('account'); ?>
            </form>
            <a href="<?php echo base_url('?mod=users&action=login'); ?>" id="lost-pass">Đăng nhập</a> | 
            <a href="<?php echo base_url('?mod=users&action=reg'); ?>" id="lost-pass">Đăng ký</a>
        </div>
    </body>
</html>
