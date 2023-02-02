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

?>
<?php include_once 'src/templates/layout/header.php' ?>

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

    <div class="row mt-3">
        <div class="col border rounded">
            <form action="module/posts/insert.php" method="POST">
                <input type="hidden" name="csrf" value="<?php if(isset($_SESSION['csrf'])){ echo $_SESSION['csrf'];}?>">
                <input type="hidden"name="idUser" value="<?php if(isset($_SESSION['id'])){ echo $_SESSION['id'];}?>" readonly>
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
                            <a href="module/posts/edit.php?id=<?php echo $post->getId()?>" class="btn btn-light">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include_once 'src/templates/layout/footer.php' ?>
