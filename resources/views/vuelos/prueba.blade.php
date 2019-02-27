<?php 
//print_r( Session::get('pasajero')[0]->name);
echo count(Session::get('reservaVuelo'));
echo " ";
print_r(Session::get('pasajero')[1]);
$i = 0; 
foreach(Session::get('reservaVuelo') as $rv){
    $i = $i + 1;
}
echo $i;?>