<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Repositories\Appointment\AppointmentRepositoryInterface;
use App\Repositories\Date\DateRepositoryInterface;
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
     * @var DateRepositoryInterface
     */
    private DateRepositoryInterface $dateRepository;

    /**
     * AppointmentController constructor.
     *
     * @param AppointmentRepositoryInterface $repository
     * @param DateRepositoryInterface $dateRepository
     */
    public function __construct(AppointmentRepositoryInterface $repository, DateRepositoryInterface $dateRepository)
    {
        $this->repository = $repository;
        $this->dateRepository = $dateRepository;

        $this->middleware('auth')->except('store');
    }

    /**
     * Returns the appointment list view
     *
     * @return Renderable
     */
    public function index()
    {
        $appointments = $this->repository->paginated(20, 'date');

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
            'phone' => 'required',
            'month' => 'required|numeric',
            'day' => 'required|numeric',
            'hour' => 'required|numeric',
        ]);

        try {
            $date = $this->dateRepository->for($validated['month'], $validated['day'], $validated['hour']);
            $data = $this->repository->fromValidationData($validated, $date);

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
