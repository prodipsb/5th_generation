<?php
namespace App;
use PDO;
if(!isset($_SESSION)){
   session_start(); 
}

class Profiles {
   // public $pdo;
    public $table = 'profiles';
    public $user_id = '';
    public $firstname = '';
    public $lastname = '';
    public $gender = '';
    public $mobile_no = '';
    public $address ='';
    public $country = '';
    public $image = '';
    public $active = 1;
    public $inactive = 0;
    
    
    public function __construct(){
        try{
        $this->pdo = new PDO('mysql:host=localhost;dbname=db_owncms', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "connection failed!" . $e->getMessage();
        }
    }
    
    public function prepare_data($data = ''){
    //    echo '<pre>';
   //     print_r($data);
    //    exit();
       
        if(array_key_exists('user_id', $data) && !empty($data['user_id'])){
            $this->user_id = $data['user_id'];
        }
      
        if(array_key_exists('firstname', $data) && !empty($data['firstname'])){
            $this->firstname = $data['firstname'];
        }
        if(array_key_exists('lastname', $data) && !empty($data['lastname'])){
            $this->lastname = $data['lastname'];
        }
        if(array_key_exists('email', $data) && !empty($data['email'])){
            $this->email = $data['email'];
        }
        if(array_key_exists('gender', $data) && !empty($data['gender'])){
            $this->gender = $data['gender'];
        }
        if(array_key_exists('mobile_no', $data) && !empty($data['mobile_no'])){
            $this->mobile_no = $data['mobile_no'];
        }
        if(array_key_exists('address', $data) && !empty($data['address'])){
            $this->address = $data['address'];
        }
        if(array_key_exists('country', $data) && !empty($data['country'])){
            $this->country = $data['country'];
        }
        if(array_key_exists('image', $data) && !empty($data['image'])){
            $this->image = $data['image'];
        }
        
    }
    
     public function insert(){
//         echo 'insert';
//         die();
         
        $sql = "INSERT INTO $this->table (user_id, firstname, lastname, gender, mobile_no, address, country, image) VALUES (:user_id, :firstname, :lastname, :gender, :mobile_no, :address, :country, :image)";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':user_id', $this->user_id);
        $q->bindParam(':firstname', $this->firstname);
        $q->bindParam(':lastname', $this->lastname);
        $q->bindParam(':gender', $this->gender);
        $q->bindParam(':mobile_no', $this->mobile_no);
        $q->bindParam(':address', $this->address);
        $q->bindParam(':country', $this->country);
        $q->bindParam(':image', $this->image);
        $q->execute();
        
        $_SESSION['profile_save_mgs'] = "Information saved successfully!";
        header('location:../backend/user_view.php?id='.$this->user_id);
     }
     public function update(){
//         echo 'update';
//         die();
        
         if(!empty($this->image)){
        $sql = "UPDATE $this->table SET firstname = :firstname, lastname = :lastname, gender = :gender, mobile_no = :mobile_no, address = :address, country =:country, image =:image WHERE user_id = :user_id ";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':user_id', $this->user_id);
        $q->bindParam(':firstname', $this->firstname);
        $q->bindParam(':lastname', $this->lastname);
        $q->bindParam(':gender', $this->gender);
        $q->bindParam(':mobile_no', $this->mobile_no);
        $q->bindParam(':address', $this->address);
        $q->bindParam(':country', $this->country);
        $q->bindParam(':image', $this->image);
        $q->execute();
        
        $_SESSION['profile_save_mgs'] = "Information saved successfully!";
        header('location:../backend/user_view.php?id='.$this->user_id);
         }else{
              $sql = "UPDATE $this->table SET firstname = :firstname, lastname = :lastname, gender = :gender, mobile_no = :mobile_no, address = :address, country =:country WHERE user_id = :user_id ";
        $q = $this->pdo->prepare($sql);
       // print_r($q);
      //  exit();
        $q->bindParam(':user_id', $this->user_id);
        $q->bindParam(':firstname', $this->firstname);
        $q->bindParam(':lastname', $this->lastname);
        $q->bindParam(':gender', $this->gender);
        $q->bindParam(':mobile_no', $this->mobile_no);
        $q->bindParam(':address', $this->address);
        $q->bindParam(':country', $this->country);
        $q->execute();
        
        $_SESSION['profile_save_mgs'] = "Information saved successfully!";
        header('location:../backend/user_view.php?id='.$this->user_id);
         }
      //  header('location:user-profile.php');
     }
     
     
     public function view_all_users(){
        $sql = "SELECT * FROM $this->table LIMIT 10";
        $q = $this->pdo->prepare($sql);
        $q->execute();
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
     
      public function get_info_from_profile_by_user_id($user_id = ''){
        $sql = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':user_id', $user_id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
      public function view_user_details($user_id = ''){
        $sql = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':user_id', $user_id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
      public function single_user_edit($id = ''){
        $sql = "SELECT * FROM $this->table WHERE user_id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
      public function view_user_details_by_id($id = ''){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
     
      public function status_update($id = ''){
          
          
        $sql = "UPDATE $this->table SET is_active = :active WHERE id = :id";
      //  print_r($id);
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':active', $this->inactive);
        $q->execute();
        
        header('location:users.php');
  }
      public function status_inactive($id = ''){
          
          
        $sql = "UPDATE $this->table SET is_active = :active WHERE id = :id";
      //  print_r($id);
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->bindParam(':active', $this->active);
        $q->execute();
        
        header('location:users.php');
  }
     
     /*
     public function delete($id = ''){
          
          
        $sql = "DELETE FROM $this->table WHERE id = :id";
      //  print_r($id);
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        
        header('location:users.php');
  }
    */
}
