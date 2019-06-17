<?php
namespace AN;
Class Nombre{
    // private static $devise=" FR";
    // public static function formatDz($nombre){
    //     if($nombre<10)
    //         return '0'.$nombre.self::$devise;//le self remplace le nom de la classe Nombre
    //     else
    //         return $nombre.self::$devise;
    // }

    //Ou
    const DEVISE=" FR";
    public static function formatDz($nombre){
        if($nombre<10)
            return '0'.$nombre.self::DEVISE;//le self remplace le nom de la classe Nombre
        else
            return $nombre.self::DEVISE;
    }
}