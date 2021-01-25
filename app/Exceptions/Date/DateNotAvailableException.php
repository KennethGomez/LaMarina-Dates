<?php


namespace App\Exceptions\Date;


use Exception;
use Illuminate\Http\RedirectResponse;

class DateNotAvailableException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @return RedirectResponse
     */
    public function render(): RedirectResponse
    {
        return redirect()->back()->withInput()->withErrors(['error' => __('La cita seleccionada no está disponible')]);
    }
}
