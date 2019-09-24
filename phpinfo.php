<?php
// Prints something like: Monday 8th of August 2005 03:12:46 PM
echo date('l jS \of F Y h:i:s A');


define("CONSTANTE_PAIS2","Argentina",TRUE);

print('CONSTANTE_PAIS: '.CONSTANTE_PAIS.'<br />');

if (defined('CONSTANTE_PAIS')) {
    print('Constante definida.<br />');
}
else
{
    print('Constante no definida.<br />');
}

if(CONSTANTE_PAIS === 'Argentina')
{
    print("El país es Argentina.<br />");
}
else
{
    print("El país no es Argentina.<br />");
}

phpinfo();

?>