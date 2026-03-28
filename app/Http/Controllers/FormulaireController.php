<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\RendezVous;
use App\Models\Restaurant;
use App\Models\Parking;
use App\Models\Paiement;
use App\Models\Patients;
use App\DTO\RendezVousDTO;

use App\Services\DataStorageService;

class FormulaireController extends Controller
{
    protected $dataStorageService;

    public function __construct(DataStorageService $dataStorageService)
    {
        $this->dataStorageService = $dataStorageService;
    }

    public function index(Request $request)
    {
        $this->dataStorageService->setSession($request->session());
        $step = $this->dataStorageService->getFormProgress();

        if ($step == 10) {
            return redirect()->route('form_success');
        }
        elseif ($step > 10) {
            return redirect()->route('form_error');
        }


        $params = [
            'form_data' => $this->dataStorageService->getFormData()->toArray(),
            'form_state' => $this->dataStorageService->getStepsState(),
            'errors' => $this->dataStorageService->getFormErrors(),
        ];

        return view('formulaire.etapes.etape' . $step, $params);
    }

    public function process(Request $request)
    {
        $this->dataStorageService->setSession($request->session());

        $step = $this->dataStorageService->getFormProgress();

        $this->dataStorageService->updateFormData($request->all());

        if ($this->dataStorageService->checkFormData()) {
            $this->dataStorageService->setFormProgress($step + 1);
        }

        return redirect()->route('form_index');
    }

    public function error(Request $request)
    {
        $this->dataStorageService->setSession($request->session());
        $this->dataStorageService->setFormProgress(1);

        return view('formulaire.error');
    }

    public function prev(Request $request)
    {
        $this->dataStorageService->setSession($request->session());
        $step = $this->dataStorageService->getFormProgress();

        $this->dataStorageService->setFormProgress($step - 1);
        return redirect()->route('form_index');
    }

    public function move(Request $request, $step)
    {
        $this->dataStorageService->setSession($request->session());
        $this->dataStorageService->setFormProgress($step);

        return redirect()->route('form_index');
    }

    public function success(Request $request)
    {
        $this->dataStorageService->setSession($request->session());
        $step = $this->dataStorageService->getFormProgress();

        if ($step < 10) {
            return redirect()->route('form_index');
        }

        $dto = $this->dataStorageService->getFormData();

        if (!$this->dataStorageService->checkAllFormData()) {
            return redirect()->route('form_error');
        }

        $patient = new Patients();
        $patient->fromDTO($dto);
        $patient->save();

        $paiement = new Paiement();
        $paiement->patient_id = $patient->id;
        $paiement->fromDTO($dto);
        $paiement->save();

        $parkingId = null;
        $restaurantId = null;

        $options = $dto->options ?? 'Rien';

        if (in_array($options, ['Place de Parking', 'Place de Parking + Repas au restaurant'])) {
            $parking = new Parking();
            $parking->fromDTO($dto);
            $parking->save();
            $parkingId = $parking->id;
        }

        if (in_array($options, ['Repas au restaurant', 'Place de Parking + Repas au restaurant'])) {
            $restaurant = new Restaurant();
            $restaurant->fromDTO($dto);
            $restaurant->save();
            $restaurantId = $restaurant->id;
        }

        $rendezVous = new RendezVous();
        $rendezVous->fromDTO($dto);
        $rendezVous->patient_id = $patient->id;
        $rendezVous->parking_id = $parkingId;
        $rendezVous->restaurant_id = $restaurantId;
        $rendezVous->save();

        $request->session()->flush();

        return view('formulaire.success');
    }

    public function reset(Request $request)
    {
        $request->session()->flush();

        return redirect()->route('form_index');
    }
}