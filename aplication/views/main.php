<?php 
/* @var $user User */
$user;
/* @var $rol Rol */
$rol;
/* @var $group Group */
$group;

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php"; 
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php"; 
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php"; 
?>
<div id="content">		

    <div id="content-header">
        <h1>Bienvenido <?php echo $user->getName(); ?>!</h1>
    </div>

    <div id="content-container">
        <?php 
        $rol = $user->getRol();
        foreach($rol->getPermissions() as $permission){
            $group = $permission->getGroup();
            
            echo "<a class='dashboard-stat primary' href='../". $group->getRef() ."'>
                        <div class='visual'>
                            <i class='" . $group->getStyle() . "'></i>
                        </div> 
                        <div class='details'>
                            <span class='content'>". $group->getText() ."</span>
                        </div> 
                        <i class='fa fa-play-circle more'></i>
                    </a><br>";
        }
        
        ?>
    </div>
    
<?php 
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php"; 

