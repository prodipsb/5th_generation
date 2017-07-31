<?php


namespace App;
use PDO;

class Settings
{
    public $title = '';
    public $subtitle = '';
    public $site_footer = '';
    public $admin_footer = '';
    public $reg_permission = '';
    public $user_activity = '';
    public $logo = '';
    public $table = 'settings';

    public function __construct(){
        try{
            $this->pdo = new PDO('mysql:host=localhost;dbname=db_owncms', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "connection failed!" . $e->getMessage();
        }
    }

    public function prepare($data = ''){
//        echo '<pre>';
//        print_r($data);
//        exit();
        if (isset($data['title']) && !empty($data['title'])){
            $this->title = $data['title'];
        }
        if (isset($data['subtitle']) && !empty($data['subtitle'])){
            $this->subtitle = $data['subtitle'];
        }
        if (isset($data['site_footer']) && !empty($data['site_footer'])){
            $this->site_footer = $data['site_footer'];
        }
        if (isset($data['admin_footer']) && !empty($data['admin_footer'])){
            $this->admin_footer = $data['admin_footer'];
        }
        if (isset($data['reg_permission']) && !empty($data['reg_permission'])){
            $this->reg_permission = $data['reg_permission'];
        }

        if (isset($data['user_activity']) && !empty($data['user_activity'])){
            $this->user_activity = $data['user_activity'];
        }

        if (isset($data['logo']) && !empty($data['logo'])){
            $this->logo = $data['logo'];
        }

    }

    public function insert(){
        $sql = "INSERT INTO $this->table (title, subtitle, site_footer, admin_footer, logo) VALUES (:title, :subtitle, :site_footer, :admin_footer, logo)";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':title', $this->title);
        $q->bindParam(':subtitles', $this->subtitle);
        $q->bindParam(':site_footer', $this->site_footer);
        $q->bindParam(':admin_footer', $this->admin_footer);
        $q->execute();
        header('location:setting.php');
    }

    public function update(){
        if (isset($this->logo) && !empty($this->logo)){
        $sql = "UPDATE $this->table SET title = :title, subtitle = :subtitles, site_footer = :site_footer, admin_footer = :admin_footer, logo = :logo";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':title', $this->title);
        $q->bindParam(':subtitles', $this->subtitle);
        $q->bindParam(':site_footer', $this->site_footer);
        $q->bindParam(':admin_footer', $this->admin_footer);
        $q->bindParam(':logo', $this->logo);
        $q->execute();
        header('location:settings.php');
        } else {
            $sql = "UPDATE $this->table SET title = :title, subtitle = :subtitles, site_footer = :site_footer, admin_footer = :admin_footer";
            $q = $this->pdo->prepare($sql);
            $q->bindParam(':title', $this->title);
            $q->bindParam(':subtitles', $this->subtitle);
            $q->bindParam(':site_footer', $this->site_footer);
            $q->bindParam(':admin_footer', $this->admin_footer);
            $q->execute();
            header('location:settings.php');
        }
    }

    public function show_settings(){
        $sql = "SELECT * FROM $this->table";
        $q = $this->pdo->prepare($sql);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}