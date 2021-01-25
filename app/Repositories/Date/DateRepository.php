<?php

namespace App\Repositories\Date;

use App\Exceptions\Date\DateNotAvailableException;
use App\Models\Appointment;
use App\Models\Date;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DateRepository extends AbstractRepository implements DateRepositoryInterface
{
    /**
     * DateRepository constructor.
     *
     * @param Date $appointment
     */
    public function __construct(Date $appointment)
    {
        parent::__construct($appointment);
    }

    /**
     * @inheritDoc
     */
    public function for(string $month, string $day, string $hour): Date
    {
        try {
            $date = $this->model->where(compact('month', 'day', 'hour'))->with('appointments')->sole();

            $appointmentCount = $date
                ->appointments
                ->count();

            if ($date->quantity_of_appointments > $appointmentCount) {
                return $date;
            }

            throw new DateNotAvailableException();
        } catch (ModelNotFoundException) {
            throw new DateNotAvailableException();
        }
    }

    /**
     * @inheritDoc
     */
    public function available(): Collection
    {
        return $this
            ->model
            ->withCount('appointments')
            ->get()
            ->groupBy('order')
            ->map(function (Collection $dates) {
                return $dates->filter(function (Date $date) {
                    return $date->appointments_count < $date->quantity_of_appointments;
                });
            })->filter(function (Collection $dates) {
                return $dates->count() > 0;
            })->first() ?? Collection::empty();
    }
}
