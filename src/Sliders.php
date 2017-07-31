<?php

namespace App;

use PDO;

if (!isset($_SESSION)) {
    session_start();
}

class Sliders {

    public $pdo;
    public $table = 'sliders';
    
    public $caption = '';
    public $slider_image = '';
    public $extention = '';
    public $size = '';
    public $slider_id = '';
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
        if (array_key_exists('id', $data) && !empty($data['id'])) {
            $this->slider_id = $data['id'];
        }
        if (array_key_exists('title', $data) && !empty($data['title'])) {
            $this->title = $data['title'];
        }
       
        if (array_key_exists('caption', $data) && !empty($data['caption'])) {
            $caption = htmlspecialchars($data['caption']);
            $this->caption = $caption;
        }
        if (array_key_exists('slider_image', $data) && !empty($data['slider_image'])) {
            $this->slider_image = $data['slider_image'];
        }
        if (array_key_exists('extention', $data) && !empty($data['extention'])) {
            $this->extention = $data['extention'];
        }
        if (array_key_exists('size', $data) && !empty($data['size'])) {
            $this->size = $data['size'];
        }
        if (array_key_exists('publication_status', $data)) {
            $this->publication_status = $data['publication_status'];
        }
    }

    public function insert() {
//        echo '<pre>';
//        print_r($this);
//        exit();
     
           $sql = "INSERT INTO  $this->table(title, caption, slider_image, slider_extention, slider_size, publication_status) VALUES (:title, :caption, :slider_image, :extention, :size, :publication_status)";
            $q = $this->pdo->prepare($sql);
            $q->bindParam(':title', $this->title);
            $q->bindParam(':caption', $this->caption);
            $q->bindParam(':slider_image', $this->slider_image);
            $q->bindParam(':extention', $this->extention);
            $q->bindParam(':size', $this->size);
            $q->bindParam(':publication_status', $this->publication_status);
            $q->execute();

            $_SESSION['slider_saved_mgs'] = "Slider saved successfully!";
            header('location:slider_add.php');
    }

    public function update() {
//        echo '<pre>';
//        print_r($this->publication_status);
//        exit();
        if($this->slider_image){
        $sql = "UPDATE $this->table SET title =:title , caption = :caption, slider_image = :slider_image, slider_extention = :slider_extention, slider_size = :slider_size, publication_status = :publication_status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $this->slider_id);
        $q->bindParam(':title', $this->title);
        $q->bindParam(':caption', $this->caption);
        $q->bindParam(':slider_image', $this->slider_image);
        $q->bindParam(':slider_extention', $this->extention);
        $q->bindParam(':slider_size', $this->size);
        $q->bindParam(':publication_status', $this->publication_status);
        $q->execute();

        $_SESSION['slider_updated_mgs'] = "Slider updated successfully!";
        header('location:slider_manage.php');
        }else{
        $sql = "UPDATE $this->table SET title =:title , caption = :caption, slider_extention = :slider_extention, slider_size = :slider_size WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $this->slider_id);
        $q->bindParam(':title', $this->title);
        $q->bindParam(':caption', $this->caption);
        $q->bindParam(':slider_extention', $this->extention);
        $q->bindParam(':slider_size', $this->size);
        $q->execute();

        $_SESSION['slider_updated_mgs'] = "Slider updated successfully!";
        header('location:slider_manage.php');
        }
    }
    public function select_all_published_slider() {
        $sql = "SELECT * FROM $this->table WHERE publication_status = :status";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':status', $this->published);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function edit_slider_by_id($id = '') {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function slider_by_id($id = '') {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function select_all_sliders() {
        $sql = "SELECT * FROM $this->table WHERE deleted_at IS NULL";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':status', $this->published);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    

   

    public function slider_published($id = '') {
        $sql = "UPDATE $this->table SET publication_status = :status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':status', $this->published);
        $q->execute();

        header('location:slider_manage.php');
    }

    public function slider_unpublished($id = '') {
        $sql = "UPDATE $this->table SET publication_status = :status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':status', $this->unpublished);
        $q->execute();

        header('location:slider_manage.php');
    }

   
    public function single_view($id = '') {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function delete($id = ''){
        $sql = "UPDATE $this->table SET deleted_at =:date WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':date', time());
        $q->execute();

        $_SESSION['slider_mgs'] = "Slider deleted successfully!";
        header('location:slider_manage.php');
    }
    
    
    

}
