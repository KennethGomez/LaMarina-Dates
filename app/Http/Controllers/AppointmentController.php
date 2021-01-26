<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Exceptions\Date\DateNotAvailableException;
use App\Http\Requests\Appointments\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Repositories\Appointment\AppointmentRepositoryInterface;
use App\Repositories\Date\DateRepositoryInterface;
use Carbon\Exceptions\Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
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
    public function index(): Renderable
    {
        $appointments = $this->repository->paginated(20, 'date');

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Stores an appointment to database
     *
     * @param Request $request
     * @return RedirectResponse|object
     *
     * @throws AppException|DateNotAvailableException
     */
    public function store(StoreAppointmentRequest $request)
    {
        $validated = $request->validated();

        try {
            $date = $this->dateRepository->for($validated['month'], $validated['day'], $validated['hour']);
            $data = $this->repository->fromValidationData($validated, $date);

            $this->repository->create($data);

            return redirect()
                ->route('index')
                ->setStatusCode(201)
                ->with(['success' => __('La cita se ha guardado exitosamente')]);
        } catch (Exception) {
            throw new AppException();
        }
    }

    /**
     * Destroys an appointment of the database
     *
     * @param Appointment $appointment
     * @return RedirectResponse|object
     *
     * @throws AppException
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
            throw new AppException();
        }
    }
}
