<?php
/* @var $usr User */
$usr;
$group = new Group(USER_GROUP);
$ac = new AdminController();

if ($usr != null) {
    $ac->controlUpdate($group, new RedirectResult());
} else {
    $ac->controlCreate($group, new RedirectResult());
}

require_once APPPATH . DS . "html" . DS . "backend" . DS . "header.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "topBar.php";
require_once APPPATH . DS . "html" . DS . "backend" . DS . "sideMenu.php";
?>
<div id="content">		

    <div id="content-header">
        <h1>Restablecer Password</h1>
    </div>

    <div id="content-container">

        <?php
        echo Gui::form("frmUsrPassword", "User/editPassword/" . $usr->getId());
        if ($error) {
            echo Gui::error($errorMsg);
        }
        ?>
        <table style="width: 100%;">
            <tr>
                <td>
                    <div class='col-md-6' style='margin-bottom:10px;'>
                        <h4 class='touchable'>Password</h4>
                        <input type='password'
                               id='password'
                               name='password' 
                               placeholder='Contrase&ntilde;a' 
                               class='form-control' 
                               value=''>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class='col-md-6' style='margin-bottom:10px;'>
                        <h4 class='touchable'>Confirmar Password</h4>
                        <input type='password' 
                               name='repassword' 
                               placeholder='Contrase&ntilde;a' 
                               class='form-control' 
                               value=''>
                    </div>
                </td>
            </tr>

        </table>
        <hr>
        <input type="submit" name="submit" class="btn btn-primary" value="Guardar">
        <?php echo Gui::href("User/all", "Volver", array("class" => "btn btn-default")); ?>
        </form>
    </div>
</div>

<?php
require_once APPPATH . DS . "html" . DS . "backend" . DS . "footer.php";

