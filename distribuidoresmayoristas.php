<?php
$title              = "Distribuidores";
$seccion            = "farmaciasbelladona";
//$archivoMenuIzq     = $_SERVER['DOCUMENT_ROOT']."/inc/inc.columna_izquierda_$seccion.php";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color              = "";
include("tpl/tpl.front_template_arriba_new.php"); ?>

<script type="text/javascript">
	function abrirCarritoMayorista() {
		ventana = window.open("index.php?module=login&tc=may", "carrito", "width=800,height=500,resizable=yes,scrollbars=yes");
		ventana.focus();
	}
</script>
    <div class="w-content">
        <div class="container">
            <div class="nav-noticias">
                <ul>

                    <li><a href="farmaciabelladonasaavedra.php" title="Belladona Saavedra">Belladona Saavedra</a></li>
                    <li><a href="index.php?module=fr_puntos_venta_ch" title="Otros puntos de venta">Otros puntos de venta</a></li>
                    <li><a href="javascript:abrirCarrito()" title="E-shop">E-shop</a></li>
                    <li><a href="distribuidoresmayoristas.php" title="Distribuidores mayoristas" class='destacado' style='font-weight:bold;'>Distribuidores mayoristas</a></li>
                </ul>
            </div>
            <div class="title">
                <h3>Mayoristas</h3>
            </div>
            <p style="width=100%; text-align:right;">
                <a href="javascript:abrirCarritoMayorista();"><img src="/imagenes/estructura/farmacias/boton_ingresoclientes.jpg" alt ="Ingreso clientes" border="0"/></a>
            </p>
            <div class="puntos-venta">
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en Buenos Aires</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">Distrinat</td>
                            <td class="address">Caseros</td>
                            <td class="address">4759-0280<br />15-5120-2686</td>
                            <td class="address">distrinat@gmail.com</td>
                        </tr>
                        <tr>
                            <td class="name">Maminia</td>
                            <td class="address">Florida</td>
                            <td class="address">4795-2828<br />4796-0843<br />15-6505-4807</td>
                            <td class="address">info@maminia.com</td>
                        </tr>
                        <tr>
                            <td class="name">Molinos Gili</td>
                            <td class="address">Villa Ballester</td>
                            <td class="address">4768-2883 / 3172<br />4847-3113</td>
                            <td class="address">molinosgili@arnetbiz.com.ar</td>
                        </tr>
                        <tr>
                            <td class="name">Distribuidora Agromenta</td>
                            <td class="address">Villa Lynch</td>
                            <td class="address">4713-9624</td>
                            <td class="address">agromenta@yahoo.com.ar</td>
                        </tr>
                        <tr>
                            <td class="name">Distruibidora Nueva Senda</td>
                            <td class="address">Villa Lynch</td>
                            <td class="address">4755-6273</td>
                            <td class="address">nueva_senda@yahoo.com.ar</td>
                        </tr>
                        <tr>
                            <td class="name">Distribuidora Liliana Rosales</td>
                            <td class="address">José Ingenieros</td>
                            <td class="address">4757-6906</td>
                            <td class="address">dist_liliana@yahoo.com.ar</td>
                        </tr>
                        <tr>
                            <td class="name">Saludiet</td>
                            <td class="address">San Antonio de Padua</td>
                            <td class="address">0220-482-3274</td>
                            <td class="address">info@saludiet.com.ar</td>
                        </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en Ciudad de Buenos Aires</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">Macrovida</td>
                            <td class="address">Capital Federal</td>
                            <td class="address">4302-1093<br />4302-3287</td>
                            <td class="address">macrovidaventas@gmail.com<br />violeta_ib75@hotmail.com</td>
                        </tr>
                        <tr>
                            <td class="name">Distrib. Beatriz Cosméticos S.</td>
                            <td class="address">Capital Federal</td>
                            <td class="address">4582-1353<br />4583-3352</td>
                            <td class="address">beatizcosmeticos@gmail.com</td>
                        </tr>
                        <tr>
                            <td class="name">Distribuidora Frusan</td>
                            <td class="address">Villa Urquiza</td>
                            <td class="address">4547-0012</td>
                            <td class="address">info@mupay.com.ar</td>
                        </tr>
                        <tr>
                            <td class="name"></td>
                            <td class="address"></td>
                            <td class="address"></td>
                            <td class="address"></td>
                        </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en Córdoba</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">Bio-salud</td>
                            <td class="address">Barrio Los Boulevares</td>
                            <td class="address">(03543)<br />40-5354</td>
                            <td class="address">info@bio-salud.com.ar</td>
                        </tr>
                        <tr>
                            <td class="name">Dietética Armonía</td>
                            <td class="address">Salsipuedes</td>
                            <td class="address">Belgrano y Santa Rosa - Local 3</td>
                            <td class="address">lic.marielamiranda@gmail.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en Entre Ríos</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">Luwer Distribuciones</td>
                            <td class="address">Paraná</td>
                            <td class="address">(0343) 4246686</td>
                            <td class="address">comercial@luwer.com.ar</td>
                        </tr>
                        <tr>
                            <td class="name">Ser Mamá</td>
                            <td class="address">Méjico 357 - Paraná</td>
                            <td class="address">(0343) 407-6667</td>
                            <td class="address"><a href="https://www.facebook.com/sermamaparana?__mref=message" target="_BLANK">Facebook</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en La Pampa</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">Kuyen Eco Almazen</td>
                            <td class="address">Santa Rosa</td>
                            <td class="address">03548 15 538136</td>
                            <td class="address">https://www.facebook.com/kuyen.alimentosnaturales/</td>
                        </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en Mendoza</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">El Naturalista</td>
                            <td class="address">Mendoza</td>
                            <td class="address">(0261) 4293262</td>
                            <td class="address">universoruiz@hotmail.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en Río Negro</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">Farmax</td>
                            <td class="address">Bariloche</td>
                            <td class="address">(02944) 420120</td>
                            <td class="address">farmax@speedy.com.ar</td>
                        </tr>
                        <tr>
                            <td class="name">Super Clin S.R.L</td>
                            <td class="address">Bariloche</td>
                            <td class="address">(02944) 425743</td>
                            <td class="address">superclin@bariloche.com.ar</td>
                        </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en Salta</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">Distribuidora Nutrinoa</td>
                            <td class="address">Salta</td>
                            <td class="address">(0387) 421-0808 / 0101</td>
                            <td class="address">nutrinoadistribuidora@gmail.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en Santa Fe</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">Nature Line</td>
                            <td class="address">Granadero Baigorria</td>
                            <td class="address">(0341) 4713983</td>
                            <td class="address">germanvinelli@arnet.com.ar</td>
                        </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="result"><br>
                    <h4 class="subtitle">Puntos de Venta en Tucumán</h4>
                    <table>
                        <thead>
                        <tr>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px;padding-bottom:5px;border-bottom:1px solid #0066FF;">Mayorista</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; padding-right:15px; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Localidad</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">Teléfono</td>
                            <td style="font-size:11px; font-weight:bold;color:#0066FF; text-align:left;padding-bottom:5px;border-bottom:1px solid #0066FF;">E-mail</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">Claudia Cermignani</td>
                            <td class="address">San Miguel de Tucumán</td>
                            <td class="address">(0381) 4332284</td>
                            <td class="address">claudiacerignani@gmail.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>