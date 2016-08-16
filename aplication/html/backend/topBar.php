<nav id="top-bar" class="collapse top-bar-collapse">
    <ul class="nav navbar-nav pull-left">
    </ul>

    <ul class="nav navbar-nav pull-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                <i class="fa fa-user"></i>
                    <?php 
                        $admin = new AdminController();
                        $userName = $admin->getLoggedUser();
                        echo $userName;
                    ?>
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li>
                    <?php 
                        echo Gui::href("user/profile", "<i class='fa fa-user'></i>&nbsp;&nbsp;Perfil", array("target" => "_blank"));
                    ?>
                </li>
                <li class="divider"></li>
                <li>
                    <?php 
                        $text = "<i class='fa fa-sign-out'></i>&nbsp;&nbsp;Cerrar Sesion";
                        echo Gui::href("admin/logout", $text); 
                    ?>
                </li>
            </ul>
        </li>
    </ul>
</nav> 