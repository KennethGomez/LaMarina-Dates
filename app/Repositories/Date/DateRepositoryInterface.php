<?php

namespace App\Repositories\Date;

use App\Exceptions\Date\DateNotAvailableException;
use App\Models\Date;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface DateRepositoryInterface extends RepositoryInterface
{
    /**
     * Get date for specified month, day and hour
     *
     * @param string $month
     * @param string $day
     * @param string $hour
     * @return Date
     *
     * @throws DateNotAvailableException
     */
    public function for(string $month, string $day, string $hour): Date;

    /**
     * Returns available dates collection
     *
     * @return Collection
     */
    public function available(): Collection;
}
