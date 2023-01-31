    
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Login">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/login.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3 mt-2">
                            <label for="User" class="form-label">User</label>
                            <input type="text" id="User" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <?php if(!isset($_SESSION['usuario'])){?>
                            <button type="submit" class="btn btn-primary mb-2">login</button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <ul class="nav justify-content-center fixed-bottom">
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://github.com/AndresAlmi"><i class="fa-brands fa-github"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://www.linkedin.com/in/andres-almiron-b09a5421b/"><i class="fa-brands fa-linkedin"></i></a>
        </li>
    </ul>
</body>

</html>