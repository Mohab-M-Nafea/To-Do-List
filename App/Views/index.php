<?php include 'layout/header.php' ?>

<main class="container d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
    <div class="text-center">
        <h1 class="mb-3"><?php echo $pageName ?></h1>
        <h4 class="mb-4">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas tempore omnis, voluptatibus nemo reiciendis iusto natus quibusdam deserunt suscipit quod veniam repudiandae earum nihil aperiam laborum assumenda delectus! Deserunt, sed!
        </h4>
        <a name="lists" id="lists" class="btn btn-primary" href=<?php url('lists') ?> role="button">Get Started</a>
    </div>
</main>

<?php include 'layout/footer.php' ?>