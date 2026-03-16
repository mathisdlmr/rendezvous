<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

use App\Models\RendezVous;
use App\Models\Departement;
use App\Models\Restaurant;
use App\Models\Parking;
use App\Models\Paiement;
use App\Models\Patients;
use App\DTO\RendezVousDTO;

use App\Services\DataStorageService;

class FormulaireController extends Controller
{
    protected $dataStorageService;

    public function __construct(DataStorageService $dataStorageService) {
        $this->dataStorageService = $dataStorageService;
    }

    public function index(Request $request) {
        $this->dataStorageService->setSession($request->session());
        $step = $this->dataStorageService->getFormProgress();

        if ($step == 10) {
            return redirect()->route('form_success');
        } elseif ($step > 10) {
            return redirect()->route('form_error');
        }
        
        $params = [];
        switch ($step) {
            case 1:
                $patients = Patients::all();

                $params = [
                    'datalist_nom' => $patients->pluck('nom')->unique()->toArray(),
                    'datalist_prenom' => $patients->pluck('prenom')->unique()->toArray(),
                ];
                break;
        }

        $params['form_data'] = $this->dataStorageService->getFormData()->toArray();
        $params['form_state'] = $this->dataStorageService->getStepsState();
        $params['errors'] = $this->dataStorageService->getFormErrors();

        return view('formulaire.etapes.etape' . $step, $params);
    }

    public function process(Request $request) {
        $this->dataStorageService->setSession($request->session());

        $step = $this->dataStorageService->getFormProgress();

        $this->dataStorageService->updateFormData($request->all());

        if ($this->dataStorageService->checkFormData()) {
            $this->dataStorageService->setFormProgress($step + 1);
        }

        return redirect()->route('form_index');
    }

    public function error(Request $request) {
        $this->dataStorageService->setSession($request->session());
        $this->dataStorageService->setFormProgress(1);

        return view('formulaire.error');
    }

    public function prev(Request $request) {
        $this->dataStorageService->setSession($request->session());
        $step = $this->dataStorageService->getFormProgress();

        $this->dataStorageService->setFormProgress($step - 1);
        return redirect()->route('form_index');
    }

    public function move(Request $request, $step) {
        $this->dataStorageService->setSession($request->session());
        $this->dataStorageService->setFormProgress($step);

        return redirect()->route('form_index');
    }

    public function success(Request $request) {
        $this->dataStorageService->setSession($request->session());
        $step = $this->dataStorageService->getFormProgress();

        if ($step < 10) {
            return redirect()->route('form_index');
        }

        $form_data = $this->dataStorageService->getFormData();
        if (!$this->dataStorageService->checkAllFormData()) {
            return redirect()->route('form_error');
        }

        $rendezVous = new RendezVous();
        $rendezVous->fromDTO($form_data);
        $rendezVous->save();

        $patient = new Patients();
        $patient->fromRendezVous($rendezVous);
        $patient->save();

        $paiement = new Paiement();
        $paiement->fromRendezVous($rendezVous);
        $paiement->save();

        if ($rendezVous->options === 'Place de Parking' || $rendezVous->options === 'Place de Parking + Repas au restaurant') {
            $parking = new Parking();
            $parking->fromRendezVous($rendezVous);
            $parking->save();
        }

        if ($rendezVous->options === 'Repas au restaurant' || $rendezVous->options === 'Place de Parking + Repas au restaurant') {
            $restaurant = new Restaurant();
            $restaurant->fromRendezVous($rendezVous);
            $restaurant->save();
        }

        $request->session()->flush();

        return view('formulaire.success');
    }

    public function reset(Request $request) {
        $request->session()->flush();

        return redirect()->route('form_index');
    }
}
