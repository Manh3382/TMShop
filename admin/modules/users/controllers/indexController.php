
<?php

function construct() {
    load_model('index');
    load('lib', 'validation');
//    load('lib', 'email');
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

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}

function updateAction() {
/*Cập nhật tài khoản
 * B1: Tạo giao diện
 * B2: Load lại thông tin cũ
 * B3: Validation form
 * B4: Cập nhật thông tin
 */
    if(isset($_POST['btn-update'])){
//        show_array($_POST);
        $error = array();
        // Kiem tra
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        if(empty($error)){
            $data = array(
                'fullname' => $fullname,
                'address' => $address,
                'phone_number' => $phone_number
            );
//            show_array($data);
            update_user_login(user_login(), $data);
        }
    }
    
    $info_user = get_user_by_usernames(user_login());
    $data['info_user'] = $info_user;
    load_view('update', $data);
}


function resetAction(){
    
}

