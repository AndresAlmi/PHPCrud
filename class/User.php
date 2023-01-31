<?php
require_once 'sql.php';
class User{

    public $_id;
    public $_username;
    private $_password;
    public $logged;

    public function getId(){
        return $this->_id;
    }
    public function getUsername(){
        return $this->_username;
    }
    public function setUsername($userParameter){
        $this->_username = $userParameter;
    }

    public function setPassword($passwordParameter){
        $this->_password = $passwordParameter;
    }
    public function isLogged(){
        return $this->logged;
    }
    public static function getUserById($id){
        $database = new MySQL();
        $q="SELECT * FROM user WHERE id = $id";
        $users = $database->consult($q);
        $data = $users->fetch_assoc();
        $userById = self::__createUser($data);
        $userById->logged = true;
        return $userById;
    }

    private static function __createUser($data){
        $user = new User();
        $user->_id = $data['id'];
        $user->_username = $data['username'];
        return $user;
    }

    public static function login($username, $password){
        $database = new MySQL();
        $q="SELECT * FROM user WHERE username = '$username' AND pass = '$password' ";
        $users = $database->consult($q);
        $data = $users->fetch_assoc();
        $userById = self::__createUser($data);
        return $userById;
    }
}

?>