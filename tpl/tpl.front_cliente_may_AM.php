<?
$seccion = "clientes";
$actual = "clientes";
include_once(GALIX_FOLDER . "class.MenuSimpleLevel.php");
$leftMenu = new MenuSimpleLevel(array());
include(TPL_FOLDER . "tpl.front_template_arriba.php");
?>

<script type="text/javascript">
    function abrirTyC() {
        ventana = window.open("TyC.php", "TyC", "width=800,height=500,resizable=yes,scrollbars=yes");
        ventana.focus();
    }
</script>


<p>Aquí puede modificar sus datos.</p>
<br/>
<? foreach ($errores as $error) {
    ?>
    <p style="color:#FF0000; text-align:left; font-weight:bold; font-size:12px;"><?= $error ?></p>
<? } ?>



<?
$action = "index.php?module=fr_cl_may_modificacion";
?>

<form method="post" enctype="multipart/form-data" action="<?= $action ?>">

    <table border="0" align="center" width="100%">
        <tr>
            <td>Nombre</td>
            <td><? $em->fields['nombre']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Apellido</td>
            <td><? $em->fields['apellido']->showFormField(null) ?></td>
        </tr>
        <tr>
            <td>Correo electr&oacute;nico</td>
            <td>
				<? $em->fields['email']->showFormField(null,null,true) ?>
            </td>
        </tr>
        <tr>
            <td>Contrase&ntilde;a</td>
            <td><? $em->fields['password']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Contrase&ntilde;a nuevamente</td>
            <td><? $em->fields['password']->showFormFieldValidation(null) ?></td>
        </tr>
        <tr>
            <td style="text-align:left;">
                <input name="submit" type="submit" value="Enviar datos" />
            </td>
            <td style="text-align:right;">
                <span style="color:#FF0000;">* Campos obligatorios</span>
            </td>
        </tr>

        <? if (CONSTANTE_PAIS == 'Argentina') { ?>
            <tr>
                <td colspan="2" style="text-align:justify; font-size:9px; padding-top:15px;" >
                    El titular de los datos personales podrá en cualquier momento solicitar el retiro o bloqueo de su nombre de los bancos de datos de Weleda S.A. a los que se refiere el artículo 27 inc. 3 de la Ley 25.326. Para ello deberá hacer conocer su deseo a Weleda S.A. remitiendo un email a unsubscribe@weleda.com.ar.
                    En toda comunicación con fines de publicidad que se realice por correo, teléfono, correo electrónico, Internet u otro medio a distancia a conocer, se deberá indicar, en forma expresa y destacada, la posibilidad del titular del dato de solicitar el retiro o bloqueo, total o parcial, de su nombre de la base de datos. A pedido del interesado, se deberá informar el nombre del responsable o usuario del banco de datos que proveyó la información.
                </td>
            </tr>
        <? } ?>

    </table>

    <? if (CONSTANTE_PAIS != "Chile") {
        ?>
        <input type="hidden" id="rut" name="rut" value="" />
    <? } ?>
    <? if (CONSTANTE_PAIS != "Argentina") { ?>

        <?
    }
	?>




</form>




<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>