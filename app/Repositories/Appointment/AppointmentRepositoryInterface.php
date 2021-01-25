<?php

namespace App\Repositories\Appointment;

use App\Models\Date;
use App\Repositories\RepositoryInterface;

interface AppointmentRepositoryInterface extends RepositoryInterface
{
    /**
     * Converts validation data into insertable Appointment data
     *
     * @param array $validationData
     * @param Date $date
     * @return array
     *
     * @throws \Carbon\Exceptions\InvalidFormatException
     */
    public function fromValidationData(array $validationData, Date $date): array;
}
