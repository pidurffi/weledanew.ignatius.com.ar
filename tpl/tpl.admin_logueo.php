<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<? if(!empty($error)) { ?>
<span style="color:red"><?=$error?></span>
<? } ?>

<div class="tit_contenido bienvenidos">
    	<h3>Bienvenidos</h3>
    </div>

<div id="login">
	<div id="login_imagen"></div>
	<div id="login_campos">
		<form method="post" action="index.php?module=login">
            <div class="linea_formulario">
            <label for="user">Nombre:</label>
            <input type="text" name="user"/>
            </div>
            
            <div class="linea_formulario">
            <label for="pass">Contrase&ntilde;a:</label>
            <input type="password" name="pass"/>
            </div>
            <div class="linea_boton">
            <input type="submit" value="Ingresar" />
            </div>
        </form>
    </div>
</div>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>