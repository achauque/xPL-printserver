<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrinterController extends Controller
{
    /**
    |--------------------------------------------------------------------------
    | Printer Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador sirve para administrar las llamadas a la impresoras de red.
    | Utiliza metodo POST y recibe un JSON con formato especifico
    |   {
    |       "template" : "template.zpl",
    |       "printer" : "192.168.X.X",
    |       "port" : 9100,
    |       "parms" : [
    |           "1000.00 kg",
    |           "200.00 m",
    |           "250 mic"
    |       ]
    |   }
    |   template : es la plantilla donde se encuentra el codigo zpl a imprimir
    |   printer : es la dirección IP de la impresora destino
    |   port : es el puerto de la impresora destino
    |   parms : es una coleccion de datos que se reemplazaran 1 a 1 en los tags 
    |   indicados en el template. Los mismos se indican con: ##1, ##2, ##3, etc.
    */

    public function print(Request $request)
    {
        $jd =  json_decode($request->getContent());
        //
        $imp = file_get_contents('templateZPL/'.$jd->template);
        $address = $jd->printer;
        if ($address == '0.0.0.0'){
            $address = $_SERVER['REMOTE_ADDR'];
        }
        
        $port = $jd->port;
        
        $count = 0;
        
        foreach ($jd->parms as $value) {
                $imp = str_replace("<##".$count.">", $value, $imp);
                $count++;
        }

        try {
            $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            $sockconnect = socket_connect($sock, $address, $port);
            socket_write($sock, $imp, strlen($imp));
            socket_close($sock);
            return response()->json('{Status:Success}', 200);
        } catch (\Exception $e) {
            return response()->json('{Status:Error}', 500);
        }

    }

    public static function printFactoy($template, $printer_ip, $printer_port, $parms){

        $imp = file_get_contents( public_path().'/templateZPL/'.$template );
        
        $address = $printer_ip;
        $port = $printer_port;
        
        $count = 0;
        
        foreach ($parms as $value) {
                $imp = str_replace("<##".$count.">", $value, $imp);
                $count++;
        }

        try {
            $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            $sockconnect = socket_connect($sock, $address, $port);
            socket_write($sock, $imp, strlen($imp));
            socket_close($sock);
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
