<?php
/* @var $pkl Parkinglot */
$pkl;

/* @var $city City */
$city = $pkl->getCity();

/* @var $state State */
$state = $city->getState();

/* @var $province Province */
$province = $state->getProvince();

/* @var $country Country */
$country = $province->getCountry();

$group = new Group(PARKINGLOT_EDITION_GROUP);
$ac = new AdminController();
$ac->controlUpdate($group, new RedirectResult());

$pklCity = $pkl->getCity();
$pklState = $pklCity->getState();
$pklProvince = $pklState->getProvince();
$pklCountry = $pklProvince->getCountry();

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>

<div id="content">		

    <div id="content-header">
        <h1>
            Mi Establecimiento
        </h1>
    </div>

    <div id="content-container">

        <?php
        if ($error) {
            echo Gui::error($errorMsg);
        }
        ?>

        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    
                    <div class="col-md-3 col-sm-5">
                        <div class="thumbnail">
                            <?php echo Gui::img("parking.png"); ?>
                        </div> <!-- /.thumbnail -->
                        <br />
                    </div>
                    
                    <div class="col-md-9 col-sm-7">
                        <h2><?php echo $pkl->getName(); ?></h2>
                        <hr />
                        <ul class="icons-list">
                            <li>
                                <i class="icon-li fa fa-clock-o"></i>
                                <?php echo $pkl->getOpenTime(); ?> a <?php echo $pkl->getCloseTIme();?> Hs.
                            </li>
                            <li>
                                <i class="icon-li fa fa-cloud"></i>
                                <?php echo $pkl->getIsCovered() ? "Establecimiento con Cocheras Cubiertas" : "Establecimiento sin Cocheras Cubiertas" ; ?>
                            </li>
                            <li>
                                <i class="icon-li fa fa-map-marker"></i> 
                                <?php 
                                    echo $pkl->getAddress() . " " 
                                    . $city->getDescription() . ", " 
                                    . $state->getDescription() . ", " 
                                    . $province->getDescription() . ", " 
                                    . $country->getDescription();
                                ?>
                            </li>
                        </ul>

                        <br />

                        <p>
                            <?php echo $pkl->getDescription();?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            echo Gui::href("parkinglot/updClient/" . $pkl->getId(), "Editar", array("class" => "btn btn-primary"));
            echo "&nbsp;";
            echo Gui::href("admin/main", "Volver", array("class" => "btn btn-default")); 
        ?>
    </div>

</div>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";



