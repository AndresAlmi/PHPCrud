<?php require_once '../../src/templates/layout/header.php' ?>
<?php require_once '../../class/Post.php' ?>
<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $post=Post::getPostById($id);
}
?>
<div class="container text-center">
    <div class="row mt-3 mx-auto">
        <div class="col border rounded">
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $post->getId()?>">
                <input type="hidden" name="csrf" value="<?php if(isset($_SESSION['csrf'])){echo $_SESSION['csrf'];}?>">
                <div class="mb-3 mt-2">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $post->getTitle()?>" placeholder="title">
                </div>
                <div class="mb-3">
                    <label for="resume" class="form-label">Resume</label>
                    <textarea class="form-control" id="resume" name="resume" rows="3"><?php echo $post->getResume()?></textarea>
                </div>
                <?php if(isset($_SESSION['usuario'])){?>
                    <?php if($_SESSION['usuario'] == $post->user->getUsername()){?>
                        <button type="submit" class="btn btn-primary mb-2">Update</button>
                    <?php } ?>
                    <?php if($_SESSION['usuario'] == $post->user->getUsername() or $_SESSION['role'] == 'admin'){?>
                        <a href="delete.php?id=<?php echo $post->getId()?>" class="btn btn-danger mb-2">Delete</a>
                    <?php } ?>

                <?php } else { ?>
                    <button type="submit" class="btn btn-secondary disabled mb-2">you need to login </button>
                <?php } ?>

            </form>
        </div>
    </div>
</div>

<?php require_once '../../src/templates/layout/footer.php' ?>
