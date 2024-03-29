

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon rotate-n-15">
                <img src="<?= base_url()?>/assets/img/gambarban_paud.png" width="60px" >

            </div>
            <div class="sidebar-brand-text mx-3">Akreditasi</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider ">

        <!--  Query Menu  -->
        <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu="SELECT `user_menu`.`id`, `menu`
                      FROM `user_menu` JOIN `user_access_menu` 
                        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                     WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC 
                         ";

        $menu = $this->db->query($queryMenu)->result_array();
        ?>

        <!-- Looping Menu -->
        <?php foreach ($menu as $m) : ?>
            <div class="sidebar-heading">
                <?= $m['menu'] ;?>
            </div>


        <!--    Siapkan Sub Menu Sesuai Menu-->
        <?php
            $menuId = $m['id'];
            $querySubMenu ="SELECT * FROM user_sub_menu
                            WHERE menu_id = $menuId
                            AND is_active = 1
                            ";

            $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

            <?php foreach ($subMenu as $sm) : ?>
                <?php if ($title == $sm['title']) :               ?>
                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <?php else: ?>
                <li class="nav-item ">
                    <?php endif; ?>
                    <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <span><?= $sm['title'] ;?></span></a>
                </li>
            <?php endforeach; ?>
            <!-- Divider -->
            <hr class="sidebar-divider mt-3">
        <?php endforeach;?>





        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout');?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>

        <!-- Heading -->
        <!--                <div class="sidebar-heading">-->
        <!--                    Addons-->
        <!--                </div>-->

        <!-- Nav Item - Pages Collapse Menu -->
        <!--                <li class="nav-item active">-->
        <!--                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">-->
        <!--                        <i class="fas fa-fw fa-folder"></i>-->
        <!--                        <span>Pages</span>-->
        <!--                    </a>-->
        <!--                    <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">-->
        <!--                        <div class="bg-white py-2 collapse-inner rounded">-->
        <!--                            <h6 class="collapse-header">Login Screens:</h6>-->
        <!--                            <a class="collapse-item" href="login.html">Login</a>-->
        <!--                            <a class="collapse-item" href="register.html">Register</a>-->
        <!--                            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>-->
        <!--                            <div class="collapse-divider"></div>-->
        <!--                            <h6 class="collapse-header">Other Pages:</h6>-->
        <!--                            <a class="collapse-item" href="404.html">404 Page</a>-->
        <!--                            <a class="collapse-item active" href="blank.html">Blank Page</a>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </li>-->

        <!-- Nav Item - Charts -->
        <!--                <li class="nav-item">-->
        <!--                    <a class="nav-link" href="charts.html">-->
        <!--                        <i class="fas fa-fw fa-chart-area"></i>-->
        <!--                        <span>Charts</span></a>-->
        <!--                </li>-->

        <!-- Nav Item - Tables -->
        <!--                <li class="nav-item">-->
        <!--                    <a class="nav-link" href="tables.html">-->
        <!--                        <i class="fas fa-fw fa-table"></i>-->
        <!--                        <span>Tables</span></a>-->
        <!--                </li>-->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
