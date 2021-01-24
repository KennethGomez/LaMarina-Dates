<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Repositories\Appointment\AppointmentRepositoryInterface;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * @var AppointmentRepositoryInterface
     */
    private AppointmentRepositoryInterface $repository;

    /**
     * AppointmentController constructor.
     * @param AppointmentRepositoryInterface $repository
     */
    public function __construct(AppointmentRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->middleware('auth')->except('store');
    }

    /**
     * Returns the appointment list view
     *
     * @return Renderable
     */
    public function index()
    {
        $appointments = $this->repository->paginated(20);

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Stores an appointment to database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|object
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tutor' => 'required',
            'student' => 'required',
            'course' => 'required',
            'email' => 'required|email',
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

            return redirect()
                ->route('index')
                ->setStatusCode(201)
                ->with(['success' => __('La cita se ha guardado exitosamente')]);
        } catch (Exception) {
            return redirect()
                ->route('index')
                ->setStatusCode(400)
                ->withErrors(['error' => __('Error indefinido, contacte con un administrador')]);
        }
    }

    /**
     * Destroys an appointment of the database
     *
     * @param Appointment $appointment
     * @return \Illuminate\Http\RedirectResponse|object
     */
    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->delete();

            return redirect()
                ->route('appointments.index')
                ->setStatusCode(201)
                ->with(['success' => __('La cita se ha eliminado exitosamente')]);
        } catch (\Exception) {
            return redirect()
                ->route('appointments.index')
                ->setStatusCode(400)
                ->withErrors(['error' => __('Error indefinido, contacte con un administrador')]);
        }
    }
}
