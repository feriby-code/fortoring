<header>
    <nav class="container-fluid border-bottom d-flex align-items-center justify-content-between fixed-top" style="font-family: Poppins, sans-serif; height: 70px; z-index: 99; background-color: white; box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">
        <div class="d-flex justify-content-center col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6" style="font-size: 30px;">
            <span style="font-family: Nunito Sans, sans serif; font-style: italic;"><span style="color: #2857FF;">FOR</span>TORING</span>
        </div>
        <div class="col-md-2 col-sm-2 col-2 d-lg-none d-flex justify-content-center align-items-center" data-bs-toggle="offcanvas" data-bs-target="#menu_sidebar" style="font-size: 30px;">
            <button class="fas fa-bars border-0" style="background-color: white;" id="menuNavbar" onclick="menu()"></button>
        </div>
        <div class="col-xl-3 col-lg-4 d-none d-lg-flex justify-content-start align-items-center" style="gap: 30px; max-height: 50px;">
            <?php
            if (isset($_GET['pagination'])) {
                $pagination = $_GET['pagination'];
                if ($pagination == 'code_reader' && $_SESSION['id_admin'] == '1') {
            ?>
                    <button class="px-3 d-flex align-items-center rounded-0 btn btn-light" style="border: 2px solid #5271FF; box-shadow: 0px 0px 20px rgba(82, 113, 255, 0.3); gap: 10px; font-size: 14px; max-height: 40px;" data-bs-toggle="modal" data-bs-target="#add_activity"><Span style="font-weight: bold;">Add Activity</Span></button>
            <?php
                }
            }
            ?>
            <div class="dropdown">
                <button type="button" class="btn btn-primary rounded-pill bg-light border d-flex align-items-center justify-content-center text-dark" style="width: 50px; height: 50px;" data-bs-toggle="dropdown">
                    <i class="fas fa-user"></i>
                </button>
                <ul class="dropdown-menu border mt-2 ">
                    <li class="p-2"><a class="dropdown-item border-bottom" style="font-weight: 500;" data-bs-target="#show_profile" data-bs-toggle="modal">Profile</a></li>
                    <li class="p-2"><a class="dropdown-item border-bottom" style="font-weight: 500;" href="./logout/">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height: 70px; width: 100%;"></div>
</header>