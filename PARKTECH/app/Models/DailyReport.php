<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    //Un reporte diario tiene muchos registro de parqueo
    //Se queda sin una relación implicita porque la llave no lo podemos poner como llave foranea en resgistro parqueo
    //Luego cuando hagamos lo de generar los reportes usamos Eloquent
}
