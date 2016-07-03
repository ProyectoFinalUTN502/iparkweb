<nav id="top-bar" class="collapse top-bar-collapse">
    <ul class="nav navbar-nav pull-left">
    </ul>

    <ul class="nav navbar-nav pull-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                <i class="fa fa-user"></i>
                    <?php 
                        $sc = new AdminController();
                        $val = $sc->loadFromSession("userUser");
                        if($val != false){
                            echo $val;
                        }
                    ?>
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="perfil" target="_blank">
                        <i class="fa fa-user"></i> 
                        &nbsp;&nbsp;Perfil
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="logout">
                        <i class="fa fa-sign-out"></i> 
                        &nbsp;&nbsp;Cerrar Sesion
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav> 