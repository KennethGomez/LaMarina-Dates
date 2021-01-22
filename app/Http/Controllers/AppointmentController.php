<?php

namespace App\Http\Controllers;

use App\Repositories\Appointment\AppointmentRepositoryInterface;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * @var AppointmentRepositoryInterface
     */
    private $repository;

    /**
     * AppointmentController constructor.
     * @param AppointmentRepositoryInterface $repository
     */
    public function __construct(AppointmentRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->middleware('auth')->except('store');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tutor' => 'required',
            'student' => 'required',
            'course' => 'required',
            'email' => 'required|email|unique:appointments',
            'month' => 'required|numeric',
            'day' => 'required|numeric',
            'hour' => 'required|numeric',
        ]);

        try {
            $data = [
                'tutor' => $validated['tutor'],
                'student' => $validated['student'],
                'course' => $validated['course'],
                'email' => $validated['email'],
                'date' => Carbon::create(null, $validated['month'], $validated['day'], $validated['hour'])
            ];

            $this->repository->create($data);

            return redirect()->route('index')->setStatusCode(201)->with(['success' => true]);
        } catch (Exception $e) {
            return redirect()->route('index')->setStatusCode(400)->withErrors(['error' => __('Error indefinido, contacte con un administrador')]);
        }
    }
}
