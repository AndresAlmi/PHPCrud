<?php include_once 'src/templates/layout/header.php' ?>
<?php require_once 'class/Post.php' ?>
<?php
if(isset($_GET['search'])){
    $search = $_GET['search'];
    if($search==""){
        $listadoPosts=Post::getPosts();
    }
    $listadoPosts=Post::getPosts($search);
}else{
    $listadoPosts=Post::getPosts();
}
$error = [];
$alert = null;
if(isset($_GET['title'])){
    $error[]='-Title Empty  ';
    $message = '<strong>Error!</strong> Ocurrio un problema: ';
    $alert = 'warning';
}
if(isset($_GET['resume'])){
    $error[]='-Resume Empty  ';
    $message = '<strong>Error!</strong> Ocurrio un problema: ';
    $alert = 'warning';
}
if(isset($_GET['success'])){
    if($_GET['success'] == 'true'){
        $error = null;
        $message = '<strong>Exito!</strong> Operacion completada.';
        $alert = 'success';
    }
}

?>
<div class="container text-center">
    
    <div class="row align-items-center">
        <div class="col">
            <form action="" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass border-end rounded"></i></button>
                </div>
            </form>
        </div>
    </div>
    <?php if($alert){?>
        <div class="alert alert-<?php echo $alert;?> alert-dismissible fade show" role="alert">
            <?php echo $message; if($error){foreach($error as $error):  echo "<strong>" . $error . "</strong>"; endforeach;}?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="row mt-3">
        <div class="col border rounded">
            <form action="module/posts/insert.php" method="POST">
                <div class="mb-3 mt-2">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="title" required>
                </div>
                <div class="mb-3">
                    <label for="resume" class="form-label">Resume</label>
                    <textarea class="form-control" id="resume" name="resume" rows="3" required></textarea>
                </div>
                <?php if(isset($_SESSION['usuario'])){?>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                <?php } else { ?>
                    <button type="button" class="btn btn-secondary disabled mb-2">you need to login</button>
                <?php } ?>
            </form>
        </div>
        <div class="col border rounded">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">title</th>
                        <th scope="col">Resume</th>
                        <th scope="col">Posted By</th>
                        <th scope="col">View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listadoPosts as $post){?>
                    <tr>
                        <th scope="row"><?php echo $post->getId()?></th>
                        <td><?php echo $post->getTitle()?></td>
                        <td><?php echo $post->getResume()?></td>
                        <td><?php echo $post->user->getUsername()?></td>
                        <td>
                            <form action="module/posts/edit.php" method="POST">
                                <input type="hidden" value="<?php echo $post->getId()?>" name="id">
                                <button class="btn btn-light" type="submit"><i class="fa-regular fa-eye"></i></button>
                            </form>

                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>


<?php include_once 'src/templates/layout/footer.php' ?>
