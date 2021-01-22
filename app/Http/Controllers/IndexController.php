<?php

namespace App\Http\Controllers;

use App\Repositories\Appointment\AppointmentRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Show the application index page.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('index');
    }
}
