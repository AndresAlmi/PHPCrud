<?php
require_once 'sql.php';
class User{

    protected $_id;
    protected $_username;
    private $_password;
    protected $_createdAt;
    protected $_role;
    protected $logged;

    public function getId(){
        return $this->_id;
    }
    public function getUsername(){
        return $this->_username;
    }
    public function setUsername($userParameter){
        $this->_username = $userParameter;
    }
    public function getCreatedAt(){
        return $this->_createdAt;
    }
    public function setCreatedAt($createdAtParameter){
        $this->_createdAt = $createdAtParameter;
    }
    public function getRole(){
        return $this->_role;
    }
    public function setRole($roleParameter){
        $this->_role = $roleParameter;
    }

    public function setPassword($passwordParameter){
        $this->_password = $passwordParameter;
    }
    public function isLogged(){
        return $this->logged;
    }

    public function insert(){
        $database = new MySQL();
        $q = "INSERT INTO user(id, username, pass, created_at, role) VALUES(NULL, '$this->_username', '$this->_password', '$this->_createdAt', '$this->_role')";
        $database->insert($q);
    }

    public function update(){
        $database = new MySQL();
        $q = "UPDATE user SET username = '$this->_username', pass = '$this->_password' WHERE id = $this->_id";
        $database->update($q);
    }
    public function delete(){
        $database = new MySQL();
        $q = "DELETE FROM posts WHERE user_id = '{$this->_id}'";
        $database->delete($q);
        $q = "DELETE FROM user WHERE id = $this->_id";
        $database->delete($q);
    }

    public static function getUsers($search = null){
        $database = new MySQL();
        $q="SELECT * FROM user ";
        if($search != null){
            $q .="WHERE username LIKE '%$search%' or created_at LIKE '%$search%'";
        }
        $users = $database->consult($q);
        $listadoUsers = [];
        while($fetch=$users->fetch_assoc()){
            $user = new User();
            $user->_id        = $fetch['id'];
            $user->_username  = $fetch['username'];
            $user->_createdAt = $fetch['created_at'];
            $user->_role      = $fetch['role'];
            $listadoUsers[]=$user;
        }
        return $listadoUsers;
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
        $user->_id        = $data['id'];
        $user->_username  = $data['username'];
        $user->_createdAt = $data['created_at'];
        $user->_role      = $data['role'];
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