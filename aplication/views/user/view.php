<?php
/* @var $user User */
$user;

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>

<div id="content">		

    <div id="content-header">
        <h1>
            Perfil
        </h1>
    </div>

    <div id="content-container">

        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    
                    <div class="col-md-2 col-sm-3">
                        <div class="thumbnail">
                            <?php echo Gui::img("user.png"); ?>
                        </div> <!-- /.thumbnail -->
                        <br />
                    </div>
                    
                    <div class="col-md-10 col-sm-8">
                        <h2><?php echo ucfirst($user->getName()) . " " . ucfirst($user->getLastName()); ?></h2>
                        <hr />
                        <ul class="icons-list">
                            <li>
                                <i class="icon-li fa fa-user"></i>
                                <?php echo $user->getUser(); ?>
                            </li>
                            <li>
                                <i class="icon-li fa fa-envelope"></i>
                                <?php echo $user->getEmail() ?>
                            </li>
                            <li>
                                <i class="icon-li fa fa-calendar"></i> 
                                <?php 
                                    echo "Ultimo Acceso <b>" . $user->getLastLogin()->format("d.m.Y H:i:s") . "</b> desde <b>" . $user->getLastIp() . "</b>";
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <?php echo Gui::href("user/updPasswordClient/" . $user->getId(), "Restablecer Contrase&ntilde;a", array("class" =>"btn btn-primary")); ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";



