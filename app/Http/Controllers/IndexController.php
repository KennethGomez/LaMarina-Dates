<?php

namespace App\Http\Controllers;

use App\Repositories\Date\DateRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;

class IndexController extends Controller
{
    /**
     * @var DateRepositoryInterface
     */
    private DateRepositoryInterface $dateRepository;

    /**
     * IndexController constructor.
     *
     * @param DateRepositoryInterface $dateRepository
     */
    public function __construct(DateRepositoryInterface $dateRepository)
    {
        $this->dateRepository = $dateRepository;
    }

    /**
     * Show the application index page.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $available = $this->dateRepository->available();

        return view('index', compact('available'));
    }
}
