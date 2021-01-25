<?php

namespace App\Repositories\Appointment;

use App\Models\Appointment;
use App\Models\Date;
use App\Repositories\AbstractRepository;
use Carbon\Carbon;

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

    /**
     * @inheritDoc
     */
    public function fromValidationData(array $validationData, Date $date): array
    {
        return [
            'tutor' => $validationData['tutor'],
            'student' => $validationData['student'],
            'course' => $validationData['course'],
            'email' => $validationData['email'],
            'phone' => $validationData['phone'],
            'date' => Carbon::create(null, $validationData['month'], $validationData['day'], $validationData['hour']),
            'date_id' => $date->getKey()
        ];
    }
}
