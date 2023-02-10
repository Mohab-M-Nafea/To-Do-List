<?php include 'layout/header.php' ?>

<main class="container d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
    <div class="w-25 text-center">
        <?php if (isset($err)) { ?>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>

                    <?php echo $err ?>

                </div>
            </div>

        <?php } ?>
        
        <h1 class="mb-3">Log In</h1>
        <form class="text-dark" id="login-form" method="POST">
            <div class="form-floating mb-3 ">
                <input type="text" id="username" class="form-control" name="username" placeholder="username" />
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" id="password" class="form-control" name="password" placeholder="password" />
                <label for="password">Password</label>
            </div>
            <input type="submit" name="login" class="btn btn-primary" value="Log In" />
        </form>
    </div>
</main>

<?php include 'layout/footer.php' ?>