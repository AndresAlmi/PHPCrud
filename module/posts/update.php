<?php

require_once '../../class/Post.php';

if(isset($_POST['title'])){

    if(isset($_POST['resume'])){
        $id = $_POST['id'];

        ## variables POST ##
        $title = $_POST['title'];
        $resume = $_POST['resume'];
        $user = 1;
        ####################

        ## Validacion Vacios ##

        $GET = NULL;
        if(trim($title) == ""){
            $GET .= '&title=false';
        }
        if(trim($resume) == ""){
            $GET .= '&resume=false';
        }
        if($GET){
            header('location:/?success=false' . $GET);
            exit;
        }
        #######################
        $post=Post::getPostById($id);
        $post->setTitle($title);
        $post->setResume($title);
        $post->setUser($user);
        $post->update();
        
        header('location:/?success=true');
    }else{
        header('location:/?success=false&resume=false');
    }
}else{
    header('location:/?success=false&title=false');
}



?>