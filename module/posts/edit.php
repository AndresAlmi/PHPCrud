<?php require_once '../../src/templates/layout/header.php' ?>
<?php require_once '../../conect.php' ?>
<?php
$q=$conn->query("SELECT * FROM posts") or die('No se pudo obtener la tabla');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $q=$conn->query("SELECT * FROM posts WHERE id = $id") or die('No se pudo obtener la tabla');
}

?>
<div class="container text-center">
    <div class="row mt-3 mx-auto">
        <div class="col border rounded">
            <form action="update.php" method="POST">
                <?php while($fetch=$q->fetchArray()){?>
                <input type="hidden" name="id" value="<?php echo $fetch["id"]?>">
                <div class="mb-3 mt-2">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $fetch["title"]?>" placeholder="title">
                </div>
                <div class="mb-3">
                    <label for="resume" class="form-label">Resume</label>
                    <textarea class="form-control" id="resume" name="resume" rows="3"> <?php echo $fetch["resumen"]?></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Update</button>
                <a href="delete.php?id=<?php echo $fetch["id"]?>" class="btn btn-danger mb-2">Delete</a>
                <?php } ?>
            </form>
        </div>
    </div>
</div>

<?php require_once '../../src/templates/layout/footer.php' ?>
