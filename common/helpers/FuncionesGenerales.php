<?php

namespace common\helpers;

use common\models\Params;
use DateTime;

class FuncionesGenerales
{

    static function TiposInstituciones()
    {
        return [
            '' => 'Seleccionar',
            'primaria' => 'Primaria',
            'secundaria' => 'Secundaria',
            'bachillerato' => 'Bachillerato',
            'tercernivel' => 'Tercer nivel',
            'cuartoNivel' => 'Cuarto nivel'
        ];
    }

    static function TiposEscuelas()
    {
        return [
            '' => 'Seleccionar',
            'Privada' => 'Privada',
            'Publica' => 'Pública',
            'Fiscomisional' => 'Fiscomisional'
        ];
    }
    static function TiposNivelEducacion()
    {
        return [
            '' => 'Seleccionar',
            'subnivelInicial3' => 'Subnivel inicial 2 (3 años)',
            'subnivelInicial4' => 'Subnivel inicial 2 (4 años)',
            'primerA' => 'Primer año de EGB',
            'segundoA' => 'Segundo año de EGB',
            'tercerA' => 'Tercer año de EGB',
            'cuartoA' => 'Cuarto año de EGB'
        ];
    }
    static function TiposDiscapacidades()
    {
        return [
            '' => 'Seleccionar',
            'ninguna' => 'Ninguna',
            'discapacidadFísica' => 'Discapacidad física',
            'discapacidadIntelectual' => 'Discapacidad intelectual',
            'discapacidadMental' => 'Discapacidad mental',
            'discapacidadPsicosocial' => 'Discapacidad psicosocial',
            'discapacidadMultiple' => 'Discapacidad múltiple',
            'discapacidadSensorial' => 'Discapacidad sensorial',
            'discapacidadAuditiva' => 'Discapacidad auditiva',
            'discapacidadVisual' => 'Discapacidad visual'
        ];
    }
    static function TiposPreguntas()
    {
        return [
            '' => 'Seleccionar',
            'ambos' => 'Imagen o Voz',
            'imagen' => 'Imagen',
            'voz' => 'Voz',
        ];
    }
    static function TiposRespuestas()
    {
        return [
            '' => 'Seleccionar',
            'true' => 'Correcta',
            'false' => 'Incorrecta',
        ];
    }
    static function TiposEstados()
    {
        return [
            '' => 'Seleccionar',
            Params::ESTADOOK => 'Activo',
            Params::ESTADOINACTIVO => 'Inactivo'
        ];
    }

    // Calcula la edad (formato: año/mes/dia)
    static function calcularEdad($edad)
    {
        if ($edad != "") {
            $nacimiento = new DateTime($edad);
            $ahora = new DateTime(date("Y-m-d"));
            $diferencia = $ahora->diff($nacimiento);
            return $diferencia->format("%y");
        }
    }
    static function TiposActividades()
    {
        return [
            '' => 'Seleccionar',
            '1' => 'Actividad 1',
            '2' => 'Actividad 2',
            '3' => 'Actividad 3',
            '4' => 'Actividad 4',
            '5' => 'Actividad 5',
        ];
    }

    static function obtenerTiempoTrascurido($tiempoSegundos)
    {
        $segundos = $tiempoSegundos;
        $horas = floor($segundos / 3600);
        $minutos = floor(($segundos - ($horas * 3600)) / 60);
        $segundos = $segundos - ($horas * 3600) - ($minutos * 60);
        if (strlen($horas) == 1) {
            $horas = '0' . $horas;
        }
        if (strlen($minutos) == 1) {
            $minutos = '0' . $minutos;
        }
        if (strlen($segundos) == 1) {
            $segundos = '0' . $segundos;
        }
        return $horas . ':' . $minutos . ":" . $segundos;
    }
}
