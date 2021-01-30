<?php


namespace App\Exceptions\Date;


use App\Exceptions\AppException;

class DateNotAvailableException extends AppException
{
    /**
     * DateNotAvailableException constructor.
     */
    public function __construct()
    {
        parent::__construct(__('La cita seleccionada no está disponible'));
    }
}
