<div class="offcanvas offcanvas-start position-fixed fixed-top" id="menu_sidebar" style=" margin-top: 70px; width: 250px;">
    <button type="button" class="btn btn-light d-none d-lg-block p-1 pe-2 border rounded-end-pill mt-3 position-absolute end-0" style="font-weight: bold; top: 20px; top: 0; margin-right: -58.5px;" data-bs-toggle="offcanvas" data-bs-target="#menu_sidebar">MENU</button>
    <section class="offcanvas-body border-end border-2 d-flex flex-column align-items-center" style="height: 100vh; font-weight: bold;">
        <div class="d-lg-none d-flex flex-column align-items-center" style="gap: 10px;">
            <button type="button" class="btn btn-primary rounded-pill bg-light border d-flex align-items-center justify-content-center text-dark" style="width: 70px; height: 70px;" data-bs-toggle="dropdown">
                <i class="fas fa-user"></i>
            </button>
            <?php
            if ($_SESSION['id_admin'] == '1') {
            ?>
            <button class="py-2 px-3 d-flex align-items-center rounded-0 btn btn-light" style="border: 2px solid #5271FF; box-shadow: 0px 0px 20px rgba(82, 113, 255, 0.3); gap: 10px; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#add_activity"><i class="fas fa-plus"></i> <Span style="font-weight: bold;">Add Activity</Span></button>
            <?php    
            }
            ?>
        </div>
        <div class="list-group list-group-flush mt-3 p-0 border-0" id="accordion">
            <a href="?pagination=home" class="list-group-item list-group-item-action">HOME</a>
            <a  href="?pagination=code_reader" class="list-group-item list-group-item-action">CODE READER</a>
            <a href="?pagination=activity" class="list-group-item list-group-item-action">ACTIVITY</a>
            <?php
            if($_SESSION['id_admin'] == '1') {
                ?>
                <a href="../?pagination=add%users" class="list-group-item list-group-item-action">ADD USERS</span></a>
                <?php
            }
            ?>
            <a data-bs-target="#show_profile" data-bs-toggle="modal" class="d-lg-none list-group-item list-group-item-action">PROFILE</a>
            <a href="./logout/" class="d-lg-none list-group-item list-group-item-action">LOGOUT</a>
        </div>
    </section>
</div>

<button type="button" class="btn btn-light d-none d-lg-block p-1 pe-2 border rounded-end-pill mt-5 position-fixed" style="font-weight: bold; top: 38px;" data-bs-toggle="offcanvas" data-bs-target="#menu_sidebar">MENU</button>