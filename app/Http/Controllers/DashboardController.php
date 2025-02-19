<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            'petCount' => Animal::count(),
            'petsAvailable' => Animal::where('available', true)->count(),
        ]);
    }
}
