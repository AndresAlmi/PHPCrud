<?php require_once "../../class/User.php";?>
<?php

if(isset($_GET['search'])){
    $search = $_GET['search'];
    if($search==""){
        $listadoUsers=User::getUsers();
    }
    $listadoUsers=User::getUsers($search);
}else{
    $listadoUsers=User::getUsers();
}
?>
<?php include_once '../../src/templates/layout/header.php' ?>

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

    <div class="row mt-3">
        <div class="col border rounded">
            <form action="insert.php" method="POST">
                <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf'];?>">
                <div class="mb-3 mt-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
                </div>
                <div class="mb-3">
                    <label for="rPassword" class="form-label">Repeat Password</label>
                    <input type="password" id="rPassword" name="rPassword" class="form-control" placeholder="repeat password" required>
                </div>
                <?php if(isset($_SESSION['usuario'])){?>
                    <?php if($_SESSION['role'] == 'admin'){?>
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    <?php } else {?>
                        <button type="button" class="btn btn-secondary disabled mb-2">you need role to admin</button>
                    <?php } ?>
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
                        <th scope="col">username</th>
                        <th scope="col">Created_At</th>
                        <th scope="col">View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listadoUsers as $user){?>
                    <tr>
                        <th scope="row"><?php echo $user->getId()?></th>
                        <td><?php echo $user->getUsername()?></td>
                        <td><?php echo $user->getCreatedAt()?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $user->getId()?>" class="btn btn-light">
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

<?php include_once '../../src/templates/layout/footer.php' ?>