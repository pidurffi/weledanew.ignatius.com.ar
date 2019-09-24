<?
$seccion = "clientes";
$actual = "clientes";
include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");
$leftMenu = new MenuSimpleLevel(array());
include(TPL_FOLDER."tpl.front_template_arriba.php"); ?>

<table>
    <tr>
        <td><img src="../imagenes/estructura/agradecimiento_registro.jpg" /></td>
        <td style="padding-left:25px;">
            <p>
            <strong>Gracias por enviar sus datos.</strong>
            </p>
            <br />
            <p><a href="index.php">Volver a la p&aacute;gina de inicio</a></p>
        </td>
    </tr>
</table>

<? include(TPL_FOLDER."tpl.front_template_abajo.php"); ?>