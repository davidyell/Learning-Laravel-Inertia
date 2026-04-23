<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdoptionRequest;
use App\Models\Adoption;
use App\Repositories\AnimalRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdoptionsController extends Controller
{
    public function __construct(
        private AnimalRepository $animalRepo
    ) {}

    public function store(StoreAdoptionRequest $request): NotFoundHttpException | RedirectResponse
    {
        try {
            $animal = $this->animalRepo->findOne($request->input('id'), true);
        } catch (\Throwable $th) {
            return new NotFoundHttpException('Pet cannot be found or is unavailable');
        }

        $adoption = new Adoption();
        $adoption->notes = $request->input('notes');
        $adoption->user_id = Auth::id();
        $adoption->animal_id = $animal->id;
        $adoption->approved = false;
        $adoption->save();

        // Add flash message for success feedback
        session()->flash('success', 'Your adoption request has been submitted successfully! We will contact you soon.');

        // Redirect to show the flash message
        return redirect()->route('pets.show', $animal->id);
    }
}
