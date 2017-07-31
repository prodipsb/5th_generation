<?php

namespace App;

use PDO;

if (!isset($_SESSION)) {
    session_start();
}

class Menus {

    public $pdo;
    public $table = 'menus';
    public $parent_id = '';
    public $sub_id = '';
    public $not_sub_id = 2;
    public $menu_id = '';
    public $row_id = '';
    public $parent_id_for_query = 0;
    public $url = '';
    public $menu_des = '';
    public $published = 1;
    public $unpublished = 0;
    public $publication_status = '';

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
        if (array_key_exists('title', $data) && !empty($data['title'])) {
            $this->title = $data['title'];
        }
        if (array_key_exists('parent_id', $data) && !empty($data['parent_id'])) {
            $this->parent_id = $data['parent_id'];
        }
        if (array_key_exists('parent_id', $data) && !empty($data['parent_id'])) {
            $this->sub_id = 1;
        }
        if (array_key_exists('id', $data) && !empty($data['id'])) {
            $this->menu_id = $data['id'];
        }
        if (array_key_exists('url', $data) && !empty($data['url'])) {
            $this->url = $data['url'];
        }
        if (array_key_exists('menu_des', $data) && !empty($data['menu_des'])) {
            $menu_des = strip_tags($data['menu_des']);
            $this->menu_des = $menu_des;
        }
        if (array_key_exists('publication_status', $data) && !empty($data['publication_status'])) {
            $this->publication_status = $data['publication_status'];
        }
    }

    public function insert() {
        $sq = "SELECT * FROM $this->table WHERE id = :parent_id";
        $p = $this->pdo->prepare($sq);
        $p->bindParam(':parent_id', $this->parent_id);
        $p->execute();
        $row = $p->fetch(PDO::FETCH_ASSOC);
        $this->row_id = $row['id'];
//          echo '<pre>';
//         print_r($row);
//         exit();
        if ($row['sub_id'] == 0) {
            $sqlr = "UPDATE $this->table SET sub_id = :sub_id WHERE id = :id";
            $r = $this->pdo->prepare($sqlr);
            $r->bindParam(':sub_id', $this->sub_id);
            $r->bindParam(':id', $this->row_id);
            $r->execute();
        }
        if ($this->parent_id) {
            
            $sql = "INSERT INTO  $this->table(title, sub_id, parent_id, url, menu_des, publication_status) VALUES (:title, :sub_id, :parent_id, :url, :menu_des, :publication_status)";
            $q = $this->pdo->prepare($sql);
            $q->bindParam(':title', $this->title);
            $q->bindParam(':sub_id', $this->not_sub_id);
            $q->bindParam(':parent_id', $this->parent_id);
            $q->bindParam(':url', $this->url);
            $q->bindParam(':menu_des', $this->menu_des);
            $q->bindParam(':publication_status', $this->publication_status);
            $q->execute();

            $_SESSION['menu_save_mgs'] = "Menu saved successfully!";
            header('location:menu_add.php');
        } else {
           
            $sql = "INSERT INTO  $this->table(title, parent_id, url, menu_des, publication_status) VALUES (:title, :parent_id, :url, :menu_des, :publication_status)";
            $q = $this->pdo->prepare($sql);
            $q->bindParam(':title', $this->title);
            $q->bindParam(':parent_id', $this->parent_id);
            $q->bindParam(':url', $this->url);
            $q->bindParam(':menu_des', $this->menu_des);
            $q->bindParam(':publication_status', $this->publication_status);
            $q->execute();

            $_SESSION['menu_save_mgs'] = "Menu saved successfully!";
            header('location:menu_add.php');
        }
    }

    public function update() {

        $sql = "UPDATE $this->table SET title =:title , parent_id = :parent_id, url = :url, menu_des = :menu_des, publication_status = :status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $this->menu_id);
        $q->bindParam(':title', $this->title);
        $q->bindParam(':parent_id', $this->parent_id);
        $q->bindParam(':url', $this->url);
        $q->bindParam(':menu_des', $this->menu_des);
        $q->bindParam(':status', $this->publication_status);
        $q->execute();

        $_SESSION['menu_updated_mgs'] = "Menu updated successfully!";
        header('location:menus_manage.php');
    }

    public function single_menu($id = '') {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function menu($id = '') {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function select_all_menus() {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':status', $this->published);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function select_all_published_menus() {
        $sql = "SELECT * FROM $this->table WHERE (publication_status = :status AND deleted_at IS NULL)";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':status', $this->published);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function select_parent_menus() {
        $sql = "SELECT * FROM $this->table WHERE publication_status = :status && parent_id = :parent_id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':status', $this->published);
        $q->bindParam(':parent_id', $this->parent_id_for_query);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function menu_published($id = '') {
        $sql = "UPDATE $this->table SET publication_status = :status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':status', $this->published);
        $q->execute();

        header('location:menus_manage.php');
    }

    public function menu_unpublished($id = '') {
        $sql = "UPDATE $this->table SET publication_status = :status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':status', $this->unpublished);
        $q->execute();

        header('location:menus_manage.php');
    }

    public function manage_categories() {
        $sq = "SELECT a.id AS article_id, u.is_admin, p.firstname, p.lastname, p.image,  a.title, a.publication_status, a.created_at FROM users AS u LEFT JOIN profiles AS p ON p.user_id = u.id LEFT JOIN articles AS a ON a.user_id = u.id";
        $q = $this->pdo->prepare($sq);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function edit_category($id = '') {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function category_update() {

        $sql = "UPDATE $this->table SET user_id =:user_id , firstname = :firstname, lastname = :lastname, email = :email, gender = :gender, mobile_no = :mobile_no, address = :address, country =:country, image =:image ";
        $q = $this->pdo->prepare($sql);
        // print_r($q);
        //  exit();
        $q->bindParam(':user_id', $this->user_id);
        $q->bindParam(':firstname', $this->firstname);
        $q->bindParam(':lastname', $this->lastname);
        $q->bindParam(':email', $this->email);
        $q->bindParam(':gender', $this->gender);
        $q->bindParam(':mobile_no', $this->mobile_no);
        $q->bindParam(':address', $this->address);
        $q->bindParam(':country', $this->country);
        $q->bindParam(':image', $this->image);
        $q->execute();

        $_SESSION['profile_save_mgs'] = "Information saved successfully!";
        header('location:user-profile.php');
    }

    public function select_menus_for_footer() {
        $sql = "SELECT * FROM $this->table WHERE (publication_status = :status AND deleted_at IS NULL)";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':status', $this->published);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function single_view($id = '') {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}
