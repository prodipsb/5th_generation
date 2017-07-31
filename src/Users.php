<?php

namespace App;

use PDO;

if (!isset($_SESSION)) {
    session_start();
}

class Users {

    public $pdo;
    public $table = 'users';
    public $username = '';
    public $email = '';
    public $password = '';
    public $remember = '';
    public $unique_id = '';
    public $restore_value = NULL;
    public $is_user = 0;
    public $is_admin = 1;
    public $active = 1;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=db_owncms', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "connection failed!" . $e->getMessage();
        }
    }

    public function prepare_data($data = '') {
//        echo '<pre>';
//        print_r($data);
//        exit();
        
//        $p = md5($data['password']);
//        $r = md5(2);
//        $s = md5(123456);
//        $m = md5(123456);
//         echo '<pre>';

        if (array_key_exists('username', $data) && !empty($data['username'])) {
            $this->username = $data['username'];
        }
        if (array_key_exists('email', $data) && !empty($data['email'])) {
            $this->email = $data['email'];
        }
        if (array_key_exists('password', $data) && !empty($data['password'])) {
            $this->password = $data['password'];
        }
        if (array_key_exists('remember', $data) && !empty($data['remember'])) {
            $this->remember = $data['remember'];
        }


        $this->unique_id = uniqid();
    }

    public function insert() {
        $sql = "INSERT INTO $this->table (unique_id, username, email, password) VALUES (:unique_id, :username, :email, :password)";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':unique_id', $this->unique_id);
        $q->bindParam(':username', $this->username);
        $q->bindParam(':email', $this->email);
        $q->bindParam(':password', $this->password);
        $q->execute();

        $_SESSION['s_mgs'] = "Your are Successfully Register. Please Login Your account";
        header('location:login.php#tologin');
    }

    public function login_check() {
      //  session_start();
        $sql = "SELECT * FROM $this->table WHERE (username = :username || email = :useremail)";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':username', $this->username);
        $q->bindParam(':useremail', $this->username);
      //  $q->bindParam(':password', $this->password);
      //  $q->bindParam(':active', $this->active);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
//        echo '<pre>';
//        print_r($result);
//        exit();
        $id = $result['id'];
        $username = $result['username'];
        $useremail = $result['email'];
        $password = $result['password'];
        $active = $result['is_active'];


        if ((($this->username == $username) && ($this->password == $password) && ($active == $this->active)) || (($this->username == $useremail) && ($this->password == $password) && ($active == $this->active))) {
            $_SESSION['username'] = $this->username;
            $_SESSION['user_id'] = $id;
            $_SESSION['login_succ_mgs'] = "Welcome to Admin Panel";

            //  $cookie_name = array('username');
            //  $cookie_value = array($this->username);
            if ($this->remember === 'on') {
                setcookie('username', $this->username, time() + 300);
                setcookie('password', $this->password, time() + 300);
            }

            header('location:backend/dashboard.php');
        } elseif (($username == $this->username) && ($password == $this->password) && ($active != $this->active)) {

            $_SESSION['login_failed_mgs'] = "Wait to Admin Approve";
            header('location:login.php#tologin');
        } elseif (($username == $this->username) && $password != $this->password) {
            $_SESSION['login_failed_mgs'] = "Invalid Password!";
            header('location:login.php#tologin');
        } elseif (($this->password == $password) && ($username != $this->username)) {
            $_SESSION['login_failed_mgs'] = "Invalid Username!";
            header('location:login.php#tologin');
        } else {
            $_SESSION['login_failed_mgs'] = "Invalid Username or Password";
            header('location:login.php#tologin');
        }

    }


    public function reg_check()
    {


        $sql = "SELECT * FROM $this->table WHERE (email = :email OR username = :username)";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':username', $this->username);
        $q->bindParam(':email', $this->email);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        $username = $result['username'];
        $email = $result['email'];

        if (!isset($this->username) || empty($this->email) || empty($this->password)) {
            $_SESSION['login_failed_mgs'] = "Please fill up all fields.";
            header('location:login.php#toregister');
        } elseif (($this->username == $username) || ($this->email == $email)) {
            $_SESSION['login_failed_mgs'] = "You are already a member. So try to login";
            header('location:login.php#tologin');
        } else {
            return "Success";
        }
    }

    public function store() {
        //  print_r($this->password);
        //  die();
        $sql = "INSERT INTO $this->table (username, password) VALUES (:username, :password)";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':username', $this->username);
        $q->bindParam(':password', $this->password);

        $q->execute();

        $_SESSION['profile_save_mgs'] = "User saved successfully";
        header('location:users.php');
    }
    

    public function view_all_users_with_pagi($page = '') {
        $sql = "SELECT * FROM $this->table WHERE deleted_at IS NULL ORDER BY id DESC LIMIT $page,5";
        $q = $this->pdo->prepare($sql);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    
    public function select_all_users() {
        $sql = "SELECT * FROM $this->table WHERE is_admin = :admin_or_not";
        $q = $this->pdo->prepare($sql);
         $q->bindParam(':admin_or_not', $this->is_user);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function select_all_admins() {
        $sql = "SELECT * FROM $this->table WHERE is_admin = :admin_or_not";
        $q = $this->pdo->prepare($sql);
         $q->bindParam(':admin_or_not', $this->is_admin);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function select_all_admins_with_profile_details() {
        $sql = "SELECT u.*, p.firstname, p.lastname, p.image FROM $this->table AS u LEFT JOIN profiles AS p ON p.user_id = u.id WHERE u.is_admin = :admin_or_not";
        $q = $this->pdo->prepare($sql);
         $q->bindParam(':admin_or_not', $this->is_admin);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function view_user($user_id) {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $user_id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function status_update($id = '') {


        $sql = "UPDATE $this->table SET is_active = :active WHERE id = :id";
        //  print_r($id);
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':active', $this->inactive);
        $q->execute();

        header('location:users.php');
    }

    public function user_status_inactive($id = '') {


        $sql = "UPDATE $this->table SET is_active = :active WHERE id = :id";
        //  print_r($id);
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':active', $this->active);
        $q->execute();

        header('location:users.php');
    }
    public function deleted_users(){
        $sql = "SELECT * FROM $this->table WHERE deleted_at IS NOT NULL";
        $q = $this->pdo->prepare($sql);
        $q->execute();
        
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function delete($id = ''){
        $sql = "UPDATE $this->table SET deleted_at = :deleted_date WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':deleted_date', date('Y-m-d'));
        $q->execute();
        
        $_SESSION['profile_save_mgs'] = "User Deleted Successfully";
        header('location:users.php');
  }
    public function user_restore($id = ''){
        $sql = "UPDATE $this->table SET deleted_at = :deleted_date WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':deleted_date', $this->restore_value);
        $q->execute();
        
        $_SESSION['profile_save_mgs'] = "User Restore Successfully";
        header('location:../backend/users_trashed.php');
  }
  
  public function user_row_count_for_pagi(){
         $sql = "SELECT * FROM $this->table ";
         $q = $this->pdo->prepare($sql);
         $q->execute();
         $result = $q->rowCount();
         return $result;
     }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);

        header('location:index.php');
    }

}

?>