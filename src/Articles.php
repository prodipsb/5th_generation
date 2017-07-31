<?php
namespace App;
use PDO;
if(!isset($_SESSION)){
   session_start(); 
}

class Articles {
   // public $pdo;
    public $table = 'articles';
    public $user_id = '';
    public $menu_id ='';
    public $article_id = '';
    public $image_id = '';
    public $category_id = '';
    public $title = '';
    public $sub_title = '';
    public $summary = '';
    public $html_summary = '';
    public $details = '';
    public $html_details = '';
    public $image_name ='';
    public $extention = '';
    public $size = '';
    public $published = 1;
    public $unpublished = 0;
    public $publication_status = '';
    
    
    public function __construct(){
        try{
        $this->pdo = new PDO('mysql:host=localhost;dbname=db_owncms', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "connection failed!" . $e->getMessage();
        }
    }
    
//    public function __construct(){
//        try{
//            $this->pdo = new PDO('mysql:host=localhost;dbname=dbname', 'root', '');
//            $this->pdo = setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//        }catch(PDOException $e){
//            echo 'Connection failed !' . $e->message();
//        }
//    }
    
    public function prepare_data($data = ''){
//        echo '<pre>';
//        print_r($data);
//        exit();
        
        
       
        if(array_key_exists('user_id', $_SESSION) && !empty($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
        }
      
        if(array_key_exists('id', $data) && !empty($data['id'])){
            $this->article_id = $data['id'];
        }
        if(array_key_exists('title', $data) && !empty($data['title'])){
            $this->title = $data['title'];
        }
        if(array_key_exists('sub_title', $data) && !empty($data['sub_title'])){
            $this->sub_title = $data['sub_title'];
        }
        if(array_key_exists('summary', $data) && !empty($data['summary'])){
            $a_summary = strip_tags($data['summary']);
            $this->summary = $a_summary;
        }
        if(array_key_exists('summary', $data) && !empty($data['summary'])){
            $h_summary = htmlspecialchars($data['summary']);
            $this->html_summary = $h_summary;
        }
        if(array_key_exists('details', $data) && !empty($data['details'])){
            $a_details = strip_tags($data['details']);
            $this->details = $a_details;
        }
        if(array_key_exists('details', $data) && !empty($data['details'])){
            $h_details = htmlspecialchars($data['details']);
            $this->html_details = $h_details;
        }
        if(array_key_exists('menu_id', $data) && !empty($data['menu_id'])){
            $this->menu_id = $data['menu_id'];
        }
        if(array_key_exists('image_name', $data) && !empty($data['image_name'])){
            $this->image_name = $data['image_name'];
        }
        if(array_key_exists('extention', $data) && !empty($data['extention'])){
            $this->extention = $data['extention'];
        }
        if(array_key_exists('size', $data) && !empty($data['size'])){
            $this->size = $data['size'];
        }
        if(array_key_exists('publication_status', $data) && !empty($data['publication_status'])){
            $this->publication_status = $data['publication_status'];
        }
        
        $category_id = $data['category_id'];
        $cat = implode(',', $category_id);
        $data['category_id'] = $cat;
        
        if(array_key_exists('category_id', $data) && !empty($data['category_id'])){
            $this->category_id = $data['category_id'];
        }
  
    }
    
    public function search($id = ''){
        $sql = "SELECT * FROM `articles` WHERE title LIKE '%".$id."%'";
        $q = $this->pdo->prepare($sql);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function image_maping($id = ''){
        $sql = "SELECT * FROM `articles_images_mapping` WHERE article_id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function image($id = ''){
        $sql = "SELECT `image_name` FROM `images` WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    
     public function insert(){
 
         
        $sql = "INSERT INTO  $this->table(user_id, title, sub_title, summary, html_summary, details, html_details,publication_status) VALUES (:user_id, :title, :sub_title, :summary, :html_summary, :details, :html_details, :publication_status)";
        $q = $this->pdo->prepare($sql);
        
        $q->bindParam(':user_id', $this->user_id);
        $q->bindParam(':title', $this->title);
        $q->bindParam(':sub_title', $this->sub_title);
        $q->bindParam(':summary', $this->summary);
        $q->bindParam(':html_summary', $this->html_summary);
        $q->bindParam(':details', $this->details);
        $q->bindParam(':html_details', $this->html_details);
        $q->bindParam(':publication_status', $this->publication_status);
        
        $q->execute();
        
        $this->article_id = $this->pdo->lastInsertId();
      //  echo $this->article_id .'<br>';
        
        $sql2 = "INSERT INTO images (image_name, extention, size) VALUES (:image_name, :extention, :size)";
        $q2 = $this->pdo->prepare($sql2);
        $q2->bindParam(':image_name', $this->image_name);
        $q2->bindParam(':extention', $this->extention);
        $q2->bindParam(':size', $this->size);
        $q2->execute();
        
        $this->image_id = $this->pdo->lastInsertId();
      //  echo $this->image_id.'<br>';
       // exit();
        $sql3 = "INSERT INTO articles_categories_mapping (article_id, category_id) VALUES (:article_id, :category_id)";
        $q3 = $this->pdo->prepare($sql3);
        $q3->bindParam(':article_id', $this->article_id);
        $q3->bindParam(':category_id', $this->category_id);
        $q3->execute();
        
      //  echo $this->article_id.'<br>';
      //  echo $this->category_id.'<br>';
      //  exit();
        $sql4 = "INSERT INTO articles_images_mapping (article_id, image_id) VALUES (:article_id, :image_id)";
        $q4 = $this->pdo->prepare($sql4);
        $q4->bindParam(':article_id', $this->article_id);
        $q4->bindParam(':image_id', $this->image_id);
        $q4->execute();
      //  echo $this->article_id.'<br>';
      //  echo $this->image_id.'<br>';
      //  exit();
//        $sql5 = "INSERT INTO articles_menu_mapping (article_id, menu_id) VALUES (:article_id, :menu_id)";
//        $q5 = $this->pdo->prepare($sql5);
//        $q5->bindParam(':article_id', $this->article_id);
//        $q5->bindParam(':menu_id', $this->menu_id);
//        $q5->execute();
     //   echo $this->article_id.'<br>';
      //  echo $this->menu_id.'<br>';
      //  exit();
        $_SESSION['article_save_mgs'] = "Article saved successfully!";
        header('location:manage_article.php');
     }
     
     public function manage_article($page = ''){
         $sq = "SELECT a.id AS article_id, u.is_admin, p.firstname, p.lastname, p.image,  a.title, a.publication_status, a.created_at, ai.image_id, i.image_name FROM articles AS a LEFT JOIN profiles AS p ON p.user_id = a.user_id LEFT JOIN users AS u ON u.id = p.user_id LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id ORDER BY a.id DESC LIMIT $page,5";
         $q = $this->pdo->prepare($sq);
         $q->execute();
         $result = $q->fetchAll(PDO::FETCH_ASSOC);
         return $result;
     }
     
      public function edit_article($id = ''){
        //  echo $this->table;
        $sql = "SELECT a.*, cp.category_id, am.menu_id, ai.image_id FROM $this->table AS a LEFT JOIN articles_categories_mapping AS cp ON cp.article_id = a.id LEFT JOIN articles_menu_mapping AS am ON am.article_id = a.id LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id  WHERE a.id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function select_all_article_image(){
         $sql = "SELECT * FROM images";
         $q = $this->pdo->prepare($sql);
         $q->execute();
         $result = $q->fetchAll(PDO::FETCH_ASSOC);
         return $result;
     }
    public function select_all_articles(){
         $sql = "SELECT a.id AS article_id, a.title, a.summary, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id WHERE publication_status = :status ORDER BY a.id DESC LIMIT 10";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':status', $this->published);
         $q->execute();
         $result = $q->fetchAll(PDO::FETCH_ASSOC);
         return $result;
     }
    public function select_all_articles_for_pagi($page = ''){
         $sql = "SELECT a.id AS article_id, a.title, a.summary,a.created_at, u.id AS user_id, p.firstname, p.lastname, ac.category_id, c.title AS category_name, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN users AS u ON u.id = a.user_id LEFT JOIN profiles AS p ON p.user_id = a.user_id LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id  LEFT JOIN articles_categories_mapping AS ac ON ac.article_id = a.id LEFT JOIN categories AS c ON c.id = ac.category_id  WHERE a.publication_status = :status ORDER BY a.id DESC LIMIT $page,5";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':status', $this->published);
         $q->execute();
         $result = $q->fetchAll(PDO::FETCH_ASSOC);
         return $result;
     }
    public function select_all_articles_for_pagination(){
         $sql = "SELECT a.id AS article_id, a.title, a.summary, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id WHERE publication_status = :status";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':status', $this->published);
         $q->execute();
         $result = $q->rowCount();
         return $result;
     }
    public function count_all_articles_by_user_id($id = ''){
         $sql = "SELECT * FROM $this->table WHERE user_id = :id";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':id', $id);
         $q->execute();
         $result = $q->rowCount();
         return $result;
     }
    public function select_num_articles_for_manage_article_page(){
         $sql = "SELECT * FROM $this->table ";
         $q = $this->pdo->prepare($sql);
         $q->execute();
         $result = $q->rowCount();
         return $result;
     }
     public function count_articles_by_category_id($article_id = ''){
         $sql = "SELECT * FROM $this->table WHERE id = :article_id";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':article_id', $article_id);
         $q->execute();
         $result = $q->rowCount();
         return $result;
     }
     
     
     public function show_article_details_by_id($article_id = ''){
         $sql = "SELECT a.id AS article_id, a.title, a.html_details, a.created_at, u.is_admin, u.id AS user_id, p.firstname, p.lastname, ac.category_id, c.title AS category_name, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN users AS u ON u.id = a.user_id LEFT JOIN profiles AS p ON p.user_id = a.user_id LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id LEFT JOIN articles_categories_mapping AS ac ON ac.article_id = a.id LEFT JOIN categories AS c ON c.id = ac.category_id  WHERE a.id = :article_id ";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':article_id', $article_id);
         $q->execute();
         $result = $q->fetchAll(PDO::FETCH_ASSOC);
         return $result;
     }
     
     public function select_all_articles_by_category_id($category_id = ''){
        $sql = "SELECT a.id AS article_id, a.title, a.summary, a.created_at, u.id AS user_id, p.firstname, p.lastname, ac.category_id, c.id AS category_id, c.title AS category_name, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN users AS u ON u.id = a.user_id LEFT JOIN profiles AS p ON p.user_id = a.user_id LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id LEFT JOIN articles_categories_mapping AS ac ON ac.article_id = a.id  LEFT JOIN categories AS c ON c.id = ac.category_id WHERE category_id = :category_id ORDER BY a.id DESC ";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':category_id', $category_id);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
     public function select_all_articles_by_user_id($user_id = ''){
        $sql = "SELECT a.id AS article_id, a.title, a.summary, a.created_at, u.id AS user_id, p.firstname, p.lastname, ac.category_id, c.title AS category_name, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN users AS u ON u.id = a.user_id LEFT JOIN profiles AS p ON p.user_id = a.user_id LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id LEFT JOIN articles_categories_mapping AS ac ON ac.article_id = a.id  LEFT JOIN categories AS c ON c.id = ac.category_id WHERE a.user_id = :user_id ORDER BY a.id DESC";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':user_id', $user_id);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
     
    public function show_article_by_id($article_id = ''){
         $sql = "SELECT a.id AS article_id, a.title, a.summary, a.created_at, u.id AS user_id, p.firstname, p.lastname, ac.category_id, c.title AS category_name, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN users AS u ON u.id = a.user_id LEFT JOIN profiles AS p ON p.user_id = a.user_id LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id LEFT JOIN articles_categories_mapping AS ac ON ac.article_id = a.id  LEFT JOIN categories AS c ON c.id = ac.category_id WHERE (a.id = :article_id AND deleled_at IS NULL) ORDER BY a.id DESC";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':article_id', $article_id);
         $q->execute();
         $result = $q->fetch(PDO::FETCH_ASSOC);
         return $result;
     }
    public function show_releted_article_by_category_id($article_id = ''){
         $sql = "SELECT a.id AS article_id, a.title, a.summary, a.created_at, u.id AS user_id, p.firstname, p.lastname, ac.category_id, c.title AS category_name, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN users AS u ON u.id = a.user_id LEFT JOIN profiles AS p ON p.user_id = a.user_id LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id LEFT JOIN articles_categories_mapping AS ac ON ac.article_id = a.id  LEFT JOIN categories AS c ON c.id = ac.category_id WHERE (a.id = :article_id AND deleled_at IS NULL) ORDER BY a.id DESC LIMIT 4";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':article_id', $article_id);
         $q->execute();
         $result = $q->fetch(PDO::FETCH_ASSOC);
         return $result;
     }
     
     public function select_recent_posts(){
         $sql = "SELECT a.id AS article_id, a.title, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id WHERE publication_status = :status ORDER BY a.id DESC LIMIT 3";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':status', $this->published);
         $q->execute();
         $result = $q->fetchAll(PDO::FETCH_ASSOC);
         return $result;
     }
     
     public function select_old_posts(){
         $sql = "SELECT a.id AS article_id, a.title, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id WHERE publication_status = :status ORDER BY a.id ASC LIMIT 3";
         $q = $this->pdo->prepare($sql);
         $q->bindParam(':status', $this->published);
         $q->execute();
         $result = $q->fetchAll(PDO::FETCH_ASSOC);
         return $result;
     }
     
     public function single_view($id = ''){
        $sql = "SELECT * FROM images WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
     public function single_article_view($id = ''){
        $sql = "SELECT a.*, u.id AS user_id, p.firstname, p.lastname, ac.category_id, c.title AS category_name, ai.image_id, i.image_name FROM $this->table AS a LEFT JOIN users AS u ON user_id = a.user_id LEFT JOIN profiles AS p ON p.user_id = a.user_id LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN images AS i ON i.id = ai.image_id LEFT JOIN articles_categories_mapping AS ac ON ac.article_id = a.id  LEFT JOIN categories AS c ON c.id = ac.category_id WHERE a.id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
     
     public function article_published($id =''){
         $sql ="UPDATE $this->table SET publication_status = :status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':status', $this->published);
        $q->execute();

        header('location:manage_article.php');
     }
     public function article_unpublished($id =''){
         $sql ="UPDATE $this->table SET publication_status = :status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':status', $this->unpublished);
        $q->execute();

        header('location:manage_article.php');
     }
     
     
     public function update(){
//         echo '<pre>';
//         print_r($this->category_id);
//         print_r($this->article_id);
//         exit();
       
        $sql = "UPDATE $this->table SET title =:title , sub_title = :sub_title, summary = :summary, html_summary = :html_summary, details = :details, html_details = :html_details, publication_status = :publication_status WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $this->article_id);
        $q->bindParam(':title', $this->title);
        $q->bindParam(':sub_title', $this->sub_title);
        $q->bindParam(':summary', $this->summary);
        $q->bindParam(':html_summary', $this->html_summary);
        $q->bindParam(':details', $this->details);
        $q->bindParam(':html_details', $this->html_details);
        $q->bindParam(':publication_status', $this->publication_status);
        $q->execute();
        
        $sql2 = "UPDATE articles_categories_mapping SET category_id =:category_id WHERE article_id = :article_id";
        $q2 = $this->pdo->prepare($sql2);
        $q2->bindParam(':article_id', $this->article_id);
        $q2->bindParam(':category_id', $this->category_id);
        $q2->execute();
        
        $sql3 = "UPDATE articles_menu_mapping SET menu_id =:menu_id WHERE article_id = :article_id";
        $q3 = $this->pdo->prepare($sql3);
        $q3->bindParam(':article_id', $this->article_id);
        $q3->bindParam(':menu_id', $this->menu_id);
        $q3->execute();
        
        if(isset($this->image_name) && !empty($this->image_name)){
        $sql4 = "SELECT image_id FROM articles_images_mapping WHERE article_id = :article_id";
        $q4 = $this->pdo->prepare($sql4);
        $q4->bindParam(':article_id', $this->article_id);
        $q4->execute();
        $result = $q4->fetch(PDO::FETCH_ASSOC);
        $this->image_id = $result['image_id'];
        
        $sql1 = "UPDATE images SET image_name =:image_name, extention = :extention, size = :size WHERE id = :image_id";
        $q1 = $this->pdo->prepare($sql1);
        $q1->bindParam(':image_id', $this->image_id);
        $q1->bindParam(':image_name', $this->image_name);
        $q1->bindParam(':extention', $this->extention);
        $q1->bindParam(':size', $this->size);
        $q1->execute();
        }
        
        $_SESSION['article_mgs'] = "Information Updated successfully!";
        header('location:manage_article.php');
     }
     
     
    public function article_delete($id = ''){
        $sql = "DELETE a.*, ac.*, ai.*, am.* FROM $this->table AS a  LEFT JOIN articles_images_mapping AS ai ON ai.article_id = a.id LEFT JOIN articles_menu_mapping AS am ON am.article_id = a.id LEFT JOIN articles_categories_mapping AS ac ON ac.article_id = a.id  LEFT JOIN categories AS c ON c.id = ac.category_id WHERE a.id = :article_id ";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':article_id', $id);
        $q->execute();
        
        $_SESSION['article_mgs'] = "Aricle Deleted successfully!";
        header('location:manage_article.php');
        
    }
     
     

     
    
    
}
