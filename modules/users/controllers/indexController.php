

<?php

function construct() {
    load_model('index');
    load('lib', 'validation');
}

function regAction() {
    global $error, $username, $password, $email, $fullname;
    if (isset($_POST['btn-reg'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ tên";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            $username = $_POST['username'];
        }
        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống Email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        #Kết luận
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token,
                    'reg_date' => time()
                );
                add_user($data);
                $link_active = base_url("?mod=users&action=active&active_token=$active_token");
                $content = "<p>Chào bạn {$fullname}</p>
                <p>Bạn vui lòng click vào đường link này để kích hoạt tài khoản: {$link_active}</p>
                <p>Nếu không phải bạn đăng ký tài khoản thì hãy bỏ qua email này</p>
                <p>Team Support Unitop.vn</p>";

                send_mail('sarangheax03@gmail.com', 'Nguyễn Tuấn Mạnh', 'Kích hoạt tài khoản PHPMaster', $content);

                // Thông báo
//                redirect("?mod=users&action=login");
            } else {
                $error['account'] = "Email hoặc username đã tồn tại trên hệ thống";
            }
        }
    }
    load_view('reg');
}

function loginAction() {
    global $error, $username, $password;
    if (isset($_POST['btn-login'])) {
        $error = array();

        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }

        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }

        #Kết luận
        if (empty($error)) {
            if (check_login($username, $password)) {
                // Lưu trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                // Chuyển hướng vào trong hệ thống
                redirect();
            } else {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không tồn tại";
            }
        }
    }
    load_view('login');
}

function indexAction() {
    //load('helper', 'format');
    //$list_users = get_list_users();
//    show_array($list_users);
    //$data['list_users'] = $list_users; //data đóng vai trò như chiếc xe di chuyển dữ liệu
    load_view('index'); // đẩy dữ liệu qua view
}

function addAction() {
    echo "Thêm dữ liệu";
}

function editAction() {
    $id = (int) $_GET['id'];
    $item = get_user_by_id($id);
    show_array($item);
}

function activeAction() {
    $link_login = base_url("?mod=users&action=login");

    $active_token = $_GET['active_token'];
//    echo $active_token;
    if (check_active_token($active_token)) {
        echo active_user($active_token);
        echo "Bạn dã kích hoạt thành công, vui lòng click vào đây để đăng nhập:<a href='{$link_login}'> Đăng nhập</a>";
    } else {
        echo "Yêu cầu kích hoạt không hợp lệ hoặc tài khoản đã kích hoạt trước đó! Vui lòng click vào đây để đăng nhập:<a href='{$link_login}'> Đăng nhập</a";
    }
}

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}

function resetAction() {
    global $error, $username, $password;

    $reset_token = $_GET['reset_token'] ?? $_POST['reset_token'] ?? null;
    if (!empty($reset_token)) {
//        echo $reset_token;
        if (check_reset_token($reset_token)) {
            // Làm việc sau khi submit
            if (isset($_POST['btn-new-pass'])) {
                $error = array();
                #Kiểm tra password
                if (empty($_POST['password'])) {
                    $error['password'] = "Không được để trống mật khẩu";
                } else {
                    if (!is_password($_POST['password'])) {
                        $error['password'] = "Mật khẩu không đúng định dạng";
                    } else {
                        $password = md5($_POST['password']);
                    }
                }
                if(empty($error)){
                    $data = array(
                      'password' => $password
                    );
                    update_pass($data, $reset_token);
                    redirect("?mod=users&action=resetOk");
                }
            }
            load_view('newPass');
        } else {
            echo "Lấy lại mật khẩu không hợp lệ";
        }
    } else {

        if (isset($_POST['btn-reset'])) {
            $error = array();

            #Kiểm tra email
            if (empty($_POST['email'])) {
                $error['email'] = "Không được để trống Email";
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "Email không đúng định dạng";
                } else {
                    $email = $_POST['email'];
                }
            }

            #Kết luận
            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5($email.time());
                    $data = array(
                        'reset_token' => $reset_token
                    );
                    // Cập nhật mã reset pass cho user cần khôi phục mật khẩu
                    update_reset_token($data, $email);
                    // Gửi link khôi phục vào email của người dùng
                    $link = base_url("?mod=users&action=reset&reset_token={$reset_token}");
                    $content = "<p>Bạn vui lòng click vào link sau để khôi phục mật khẩu: {$link}</p>
                <p>Nếu không phải yêu cầu của bạn, bạn vui lòng bỏ qua email này</p>
                <p>Unitop Team Support</p>";
                    send_mail($email, '', 'Khôi phục mật khẩu PHPMaster', $content);
                } else {
                    $error['account'] = "Email không tồn tại trên hệ thống";
                }
            }
        }
        load_view('reset');
    }
}

function resetOkAction(){
    load_view('resetOk');
}
