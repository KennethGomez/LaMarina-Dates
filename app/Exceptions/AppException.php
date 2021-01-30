<?php


namespace App\Exceptions;


use Exception;
use Illuminate\Http\RedirectResponse;

class AppException extends Exception
{
    /**
     * AppException constructor.
     *
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        parent::__construct($message ?? __('Error indeterminado, por favor, contacte con un administrador'));
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @return RedirectResponse
     */
    public function render(): RedirectResponse
    {
        return redirect()->back()->withInput()->withErrors(['error' => $this->message]);
    }
}
