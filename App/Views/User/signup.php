<?php include 'layout/header.php' ?>

<main class="container d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
    <div class="signup-form w-25 text-center">

        <?php if (isset($err)) : ?>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>

                    <?php echo $err ?>

                </div>
            </div>

        <?php endif ?>

        <h1 class="mb-3">Sign Up</h1>
        <form class="text-dark" id="signup-form" method="POST">
            <div class="form-floating mb-3">
                <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Firstname" required />
                <label for="firstname">Firstname</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Lastname" required />
                <label for="lastname">Lastname</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" id="username" class="form-control" name="username" placeholder="Username" required />
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" id="email" class="form-control" name="email" placeholder="Email" required />
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required />
                <label for="password">Password</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" id="password-confirm" class="form-control" name="password-confirm" placeholder="Confirm Password" required />
                <label for="password-confirm">Confirm Password</label>
            </div>
            <input type="submit" name="signup" class="btn btn-primary" value="Sign Up" />
        </form>
    </div>
</main>

<?php include 'layout/footer.php' ?>