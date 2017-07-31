<?php
namespace App;

use PDO;

if (!isset($_SESSION)) {
    session_start();
}

class Categories
{
    public $id;
    public $pdo;
    public $table = 'categories';
    public $user_id = '';
    public $parent_id = '';
    public $menu_id = '';
    public $article_id = '';
    public $category_id = '';
    public $category_des = '';
    public $published = 1;
    public $unpublished = 0;
    public $publication_status = '';


    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=db_owncms', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "connection failed!" . $e->getMessage();
        }
    }

    public function prepare_data($data = '')
    {
//       echo '<pre>';
//        print_r($data);
//        exit();


        if (array_key_exists('user_id', $_SESSION) && !empty($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
        }
        if (array_key_exists('id', $data) && !empty($data['id'])) {
            $this->id = $data['id'];
        }
        if (array_key_exists('title', $data) && !empty($data['title'])) {
            $this->title = $data['title'];
        }
        if (array_key_exists('parent_id', $data) && !empty($data['parent_id'])) {
            $this->parent_id = $data['parent_id'];
        }
        //       $category_id = $data['category_id'];
//        $cat = implode(',', $category_id);
//        $data['category_id'] = $cat;

        if (array_key_exists('category_id', $data) && !empty($data['category_id'])) {
            $this->category_id = $data['category_id'];
        }
        if (array_key_exists('category_des', $data) && !empty($data['category_des'])) {
            $a_category_des = strip_tags($data['category_des']);
            $this->category_des = $a_category_des;
        }
        if (array_key_exists('publication_status', $data) && !empty($data['publication_status'])) {
            $this->publication_status = $data['publication_status'];
        }

    }

    public function insert()
    {


        if (isset($this->id) && !empty($this->id)) {
            $sql = "UPDATE $this->table SET title = :title, parent_id = :parent_id, category_des = :category_des, publication_status = :publication_status WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':parent_id', $this->parent_id);
            $stmt->bindParam(':category_des', $this->category_des);
            $stmt->bindParam(':publication_status', $this->publication_status);
            $stmt->execute();
            $_SESSION['category_save_mgs'] = "Category update successfully!";
            header('location:category_manage.php');
        } else {
            $sql = "INSERT INTO $this->table (title, parent_id, category_des, publication_status)" . "VALUES (:title, :parent_id, :category_des, :publication_status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':parent_id', $this->parent_id);
            $stmt->bindParam(':category_des', $this->category_des);
            $stmt->bindParam(':publication_status', $this->publication_status);
            $stmt->execute();


            $_SESSION['category_save_mgs'] = "Category saved successfully!";
            header('location:add_category.php');
        }
    }

    public function pagi_for_search($title = ''){
         $sql = "SELECT * FROM `articles` WHERE title LIKE '%".$title."%'";
         $q = $this->pdo->prepare($sql);
         $q->execute();
         $result = $q->rowCount();
         return $result;
     }
    
    public function select_all_categories()
    {
        $sql = "SELECT * FROM $this->table WHERE deleted_at IS NULL ORDER BY id DESC";
        $q = $this->pdo->prepare($sql);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function select_published_categories()
    {
        $sql = "SELECT * FROM $this->table WHERE publication_status =:status";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':status', $this->published);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function select_one_categories($id = '')
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function maping_table(){
        $sql = "SELECT * FROM `articles_categories_mapping`";
        $q = $this->pdo->prepare($sql);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete_category()
    {
            $sql = "UPDATE $this->table SET deleted_at = :date";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $_SESSION['category_save_mgs'] = "Category update successfully!";
            header('location:category_manage.php');
    }

    public function manage_categories()
    {
        $sq = "SELECT a.id AS article_id, u.is_admin, p.firstname, p.lastname, p.image,  a.title, a.publication_status, a.created_at FROM users AS u LEFT JOIN profiles AS p ON p.user_id = u.id LEFT JOIN articles AS a ON a.user_id = u.id";
        $q = $this->pdo->prepare($sq);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function edit_category($id = '')
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function category_published($id = '')
    {
        $sql = "UPDATE $this->table SET publication_status = :status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':status', $this->published);
        $q->execute();

        header('location:category_manage.php');
    }

    public function category_unpublished($id = '')
    {
        $sql = "UPDATE $this->table SET publication_status = :status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':status', $this->unpublished);
        $q->execute();

        header('location:category_manage.php');
    }


    public function category_update()
    {

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
    
     public function select_categories_for_footer()
    {
        $sql = "SELECT * FROM $this->table WHERE publication_status =:status LIMIT 5";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':status', $this->published);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function single_view($id = '')
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


}
