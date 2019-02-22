<?php 
Session::get('pasajero')[0]->id = 90909;
print_r( Session::get('pasajero')[0]->name);
echo count(Session::get('pasajero')); ?>