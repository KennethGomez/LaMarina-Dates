<?php

namespace App\Repositories\Appointment;

use App\Models\Appointment;
use App\Repositories\AbstractRepository;

class AppointmentRepository extends AbstractRepository implements AppointmentRepositoryInterface
{
    /**
     * AppointmentRepository constructor.
     *
     * @param Appointment $appointment
     */
    public function __construct(Appointment $appointment)
    {
        parent::__construct($appointment);
    }
}
