<?php include 'layout/header.php' ?>

<main class="container d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
    <div class="profile w-25 text-center">
        <h1 class="mb-3">Edit Profile</h1>
        <?php if (isset($err)) : ?>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>

                    <?php foreach ($err as $row) {
                        echo $row . "<br>";
                    }
                    ?>

                </div>
            </div>

        <?php endif ?>

        <form class="text-dark" method="post">
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="firstname" id="firstname" placeholder="First Name" required="required" value="<?php echo $data["first_name"] ?>">
                <label for="firstname">First Name</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Last Name" required="required" value="<?php echo $data["last_name"] ?>">
                <label for="lastname">Last Name</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="username" id="username" placeholder="Username" required="required" value="<?php echo $data["user_name"] ?>">
                <label for="Username">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="email" name="email" id="email" placeholder="Email" required="required" value="<?php echo $data["email"] ?>">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" autocomplete="new-password">
                <label for="password">Password</label>
            </div>
            <div class="ms-auto">
                <input class="btn btn-success" type="submit" name="profile" value="Save">
            </div>
        </form>
    </div>
</main>

<?php include 'layout/footer.php' ?>