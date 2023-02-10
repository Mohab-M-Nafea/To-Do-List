<?php include 'layout/header.php' ?>

<main class="container text-center">
    <div class="row">
        <aside class="col-4">
            <h2>Lists</h2>
            <div style="min-height: calc(100vh - 150px);">
                <div class="d-grid gap-2">

                    <?php foreach ($lists as $list) : ?>

                        <div class="list-row row btn-primary bg-dark  align-items-center">
                            <a href="<?php url("lists/index/$list[list_id]") ?>" class='btn btn-primary bg-dark' role='button'><?php echo $list['list_title'] ?></a>
                            <a href="<?php url("lists/delete/$list[list_id]") ?>" class='delete bg-dark text-dark border-0 rounded-circle col-1' name='delete_list'>
                                <i class='fa-solid fa-trash-can'></i>
                            </a>
                        </div>

                    <?php endforeach ?>

                </div>
            </div>
            <div class="form">
                <form class="row g-3 align-items-center" action="<?php url('lists/add') ?>" method="post">
                    <div class="col-10">
                        <input type="text" name="list_title" id="title" class="form-control bg-light text-dark border-0 rounded-pill" placeholder="Untitled">
                    </div>
                    <div class="col-auto">
                        <button class="bg-dark text-light border-0 rounded-circle" type="submit" name="add_list">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <?php if (isset($currentList['list_id'])) : ?>

            <section class="col-8" id="tasks">
                <h2><?php echo $currentList['list_title'] ?></h2>
                <div style="min-height: calc(100vh - 150px);">
                    <div class="d-grid gap-2 col-8 mx-auto">

                        <?php foreach ($tasks as $task) : ?>

                            <div class="task-row row btn-primary bg-dark  align-items-center">
                                <a href="<?php url("tasks/state/$task[list_id]/$task[task_id]") ?>" class='state bg-dark text-light border-0 rounded-circle col-1' name='task_state'>
                                    <i class='fa-regular fa-circle'></i>
                                </a>

                                <a class='btn btn-primary bg-dark' role='button' data-bs-toggle='offcanvas' data-bs-target='#task<?php echo $task['task_id'] ?>' aria-controls='offcanvasRight'><?php echo $task['completion_status'] ?  "<del>$task[task_name]</del>" : $task['task_name']; ?>
                                </a>
                            </div>

                            <div class="offcanvas offcanvas-end bg-dark text-light" tabindex="-1" id="task<?php echo $task['task_id'] ?>" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasRightLabel"><?php echo $task['task_name'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">

                                    <?php if ($task['task_description'] === '') : ?>

                                        <form class="row g-3 mx-auto align-items-center" action="<?php url("tasks/description/$task[list_id]/$task[task_id]") ?>" method="post">
                                            <div class="col-10">
                                                <textarea name="description" class="form-control bg-light text-dark border-0 rounded-pill" placeholder="Description"></textarea>
                                            </div>
                                            <div class="col-auto">
                                                <button class="bg-dark text-light border-0 rounded-circle" type="submit" name="add_description">
                                                    <i class="fa-solid fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </form>

                                    <?php else : ?>

                                        <div>
                                            <label> <?php echo $task['task_description'] ?> </label>
                                        </div>

                                    <?php endif ?>

                                    <div class="delete">
                                        <a href="<?php url("tasks/delete/$task[list_id]/$task[task_id]") ?>" class='btn btn-primary bg-dark text-light border-0 d-flex align-items-center' role='button'>
                                            <i class='fa-solid fa-trash-can me-3'></i>
                                            Delete Task
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach ?>

                    </div>
                </div>
                <div>
                    <form class="row g-3  col-8 mx-auto align-items-center" action="<?php url("tasks/add/$currentList[list_id]") ?>" method="post">
                        <div class="col-10">
                            <input type="text" name="task_name" id="title" class="form-control bg-light text-dark border-0 rounded-pill" placeholder="New Task">
                        </div>
                        <div class="col-auto">
                            <button class="bg-dark text-light border-0 rounded-circle" type="submit" name="add_task">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </section>

        <?php endif ?>

    </div>
</main>

<?php include 'layout/footer.php' ?>