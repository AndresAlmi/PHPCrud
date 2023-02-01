<?php
    require_once 'sql.php';
    require_once 'User.php';
    
    class Post extends User{
        public $_id;
        protected $_title;
        protected $_resume;
        public $user; 
        
        public function getId(){
            return $this->_id;
        }
        public function getTitle(){
            return $this->_title;
        }
        public function setTitle($titleParameter){
            $this->_title = $titleParameter;
        }
        public function getResume(){
            return $this->_resume;
        }
        public function setResume($resumeParameter){
            $this->_resume = $resumeParameter;
        }
        public function getUser(){
            return $this->user;
        }
        public function setUser($userParameter){
            $this->user = $userParameter;
        }

        public static function getPosts($search = null){
            $database = new MySQL();
            $q="SELECT p.id, p.title, p.resumen, u.id as u_id, u.username FROM posts p JOIN user u ON p.user_id = u.id ";
            if($search != null){
                $q .="WHERE p.title LIKE '%$search%' or p.resumen LIKE '%$search%' or u.username LIKE '%$search%'";
            }
            $posts = $database->consult($q);
            $listadoPosts = [];
            while($fetch=$posts->fetch_assoc()){
                $post = new Post();
                $post->_id = $fetch['id'];
                $post->_title = $fetch['title'];
                $post->_resume = $fetch['resumen'];
                $post->user = User::getUserById($fetch['u_id']);
                $listadoPosts[]= $post;
            }

            return $listadoPosts;
        }

        public static function getPostById($id){
            $database = new MySQL();
            $q="SELECT p.id, p.title, p.resumen, u.id as u_id, u.username FROM posts p JOIN user u ON p.user_id = u.id WHERE p.id = $id ";
            $posts = $database->consult($q);
            $data = $posts->fetch_assoc();
            $postById = self::__createPost($data);
            return $postById;
        }

        private static function __createPost($data){
            $post = new Post();
            $post->_id = $data['id'];
            $post->_title = $data['title'];
            $post->_resume = $data['resumen'];
            $post->user = User::getUserById($data['u_id']);
            return $post;
        }
        public function insert(){
            $database = new MySQL();
            $q = "INSERT INTO posts(id, title, resumen, user_id) VALUES(NULL, '$this->_title', '$this->_resume', '$this->user')";
            $database->insert($q);
        }
        public function delete(){
            $database = new MySQL();
            $q = "DELETE FROM posts WHERE id = '{$this->_id}'";
            $database->delete($q);
        }

        public function update(){
            $database = new MySQL();
            $q = "UPDATE posts SET title = '$this->_title', resumen = '$this->_resume' WHERE id = $this->_id";
            $database->update($q);
        }

    }
    
?>