<?php require_once '../../src/templates/layout/header.php' ?>
<?php require_once '../../class/User.php' ?>
<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user=User::getUserById($id);

}
?>
<div class="container text-center">
    <div class="row mt-3 mx-auto">
        <div class="col border rounded">
            <form action="update.php" method="POST">
                <div class="row">
                    <div class="col-6">
                        <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf'];?>">
                        <input type="hidden" name="id" value="<?php echo $user->getId()?>">
                        <?php if($user->getUsername() == $_SESSION['usuario']){?>
                            <div class="my-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control" value="<?php echo $user->getUsername()?>" placeholder="Username">
                            </div>
                            <div class="my-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="password">
                            </div>
                            <div class="my-3">
                                <label for="rPassword" class="form-label">Repeat Password</label>
                                <input type="password" id="rPassword" name="rPassword" class="form-control" placeholder="Repeat Password">
                            </div>
                        <?php } else { ?>
                            <div class="my-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control" value="<?php echo $user->getUsername()?>" placeholder="Username" readonly>
                            </div>
                        <?php }?>
                    </div>
                    <div class="col-6">
                        <div class="my-3">
                            <label for="created_at" class="form-label">Created_at</label>
                            <input type="date" id="created_at" name="created_at" class="form-control" value="<?php echo $user->getCreatedAt()?>" readonly>
                        </div>
                        <div class="my-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" id="role" name="role" class="form-control" value="<?php echo $user->getRole()?>" readonly>
                        </div>
                    </div>
                    
                </div>
                <?php if(isset($_SESSION['usuario'])){?>
                    <?php if($user->getUsername() == $_SESSION['usuario']){?>
                        <button type="submit" class="btn btn-primary mb-2">Update</button>
                    <?php } else if($_SESSION['role'] == 'admin'){ ?>
                        <a href="delete.php?id=<?php echo $user->getId()?>" class="btn btn-danger mb-2">Delete</a>
                    <?php } ?>
                <?php } ?>
            </form>
        </div>
    </div>
</div>

<?php require_once '../../src/templates/layout/footer.php' ?>
