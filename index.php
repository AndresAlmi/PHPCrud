<?php require_once 'src/templates/layout/header.php' ?>
<?php require_once 'conect.php' ?>
<?php
$q=$conn->query("SELECT * FROM posts") or die('No se pudo obtener la tabla');

if(isset($_GET['search'])){
    $search = $_GET['search'];
    if($search==""){
        $q=$conn->query("SELECT * FROM posts") or die('No se pudo obtener la tabla');
    }
    $q=$conn->query("SELECT * FROM posts WHERE title LIKE '%$search%' or resumen LIKE '%$search%'") or die('No se pudo obtener la tabla');
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
    <?php if(isset($_GET["success"])){?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Exito!</strong> Operacion completada.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="row mt-3">
        <div class="col border rounded">
            <form action="module/posts/insert.php" method="POST">
                <div class="mb-3 mt-2">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="title">
                </div>
                <div class="mb-3">
                    <label for="resume" class="form-label">Resume</label>
                    <textarea class="form-control" id="resume" name="resume" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
        </div>
        <div class="col border rounded">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">title</th>
                        <th scope="col">Resume</th>
                        <th scope="col">View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($fetch=$q->fetchArray()){?>
                    <tr>
                        <th scope="row"><?php echo $fetch['id']?></th>
                        <td><?php echo $fetch['title']?></td>
                        <td><?php echo $fetch['resumen']?></td>
                        <td>
                            <form action="module/posts/edit.php" method="POST">
                                <input type="hidden" value="<?php echo $fetch['id']?>" name="id">
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

<?php require_once 'src/templates/layout/footer.php' ?>
