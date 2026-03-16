<?php

namespace App\Services;
use App\DTO\RendezVousDTO;
use App\Models\RendezVous;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

class DataStorageService
{
    private mixed $session;

    public function setSession(\Illuminate\Contracts\Session\Session $session): void {
        $this->session = $session;
    }

    public function getFormProgress(): int {
        return $this->session->get('form_progress', 1);
    }

    public function setFormProgress(int $progress): void {
        $progress = min(max($progress, 1), 10);
        $this->session->put('form_progress', $progress);
    }

    public function getFormData(): RendezVousDTO {
        return $this->session->get('form_data', new RendezVousDTO());
    }

    private function setFormData(RendezVousDTO $dto): void {
        $this->session->put('form_data', $dto);
    }

    public function updateFormData(mixed $form_data): void {
        $dto = $this->getFormData();
        $dto->fromArray($form_data);
        $this->setFormData($dto);
    }

    public function checkFormData(): bool {
        $dto = $this->getFormData($this->session);
        $progress = $this->getFormProgress($this->session);

        $validator = $this->checkFormDataStep($dto, $progress);

        $fails = $validator->fails();

        if ($fails) {
            $this->updateFormErrors($validator->errors());
        } else {
            $this->updateFormErrors(new MessageBag());
        }

        $this->updateStepsState($progress, !$fails);

        return !$fails;
    }

    public function checkAllFormData(): bool {
        $previousProgress = $this->getFormProgress($this->session);

        $check = true;
        for ($i = 1; $i <= 8; $i++) {
            $this->setFormProgress($i);
            if (!$this->checkFormData()) {
                $check = false;
                break;
            }
        }

        $this->setFormProgress($previousProgress);
        return $check;
    }

    private function checkFormDataStep(RendezVousDTO $dto, int $step): \Illuminate\Contracts\Validation\Validator {

        $validator = Validator::make($dto->toArray(),
            array_intersect_key(RendezVous::$rules, array_flip(RendezVous::$steps[$step])),
            array_intersect_key(RendezVous::$errors, array_flip(RendezVous::$steps[$step]))
        );

        if ($step == 8) {
            if ($dto->options === 'Place de Parking' || $dto->options === 'Place de Parking + Repas au restaurant') {
                if ($dto->immatriculation === null || $dto->immatriculation === '') {
                    $validator->after(function ($validator) {
                        $validator->errors()->add('immatriculation', 'L\'immatriculation est obligatoire avec l\'option "Place de Parking"');
                    });
                }
            }
        }

        return $validator;
    }

    public function getFormErrors(): MessageBag {
        $step = $this->getFormProgress();

        $errors = $this->session->get('form_errors', [null, null, null, null, null, null, null, null]);

        if ($step == 9 || $errors[$step - 1] === null) {
            return new MessageBag();
        }

        return $errors[$step - 1];
    }

    private function updateFormErrors(MessageBag $errorsMsg): void {
        $step = $this->getFormProgress();

        $errors = $this->session->get('form_errors', [null, null, null, null, null, null, null, null]);

        $errors[$step - 1] = $errorsMsg;

        $this->session->put('form_errors', $errors);
    }

    public function getStepsState(): array {
        return $this->session->get('form_state', [false, false, false, false, false, false, false, false]);
    }

    private function updateStepsState(int $step, bool $state): void {
        $stepsState = $this->getStepsState();

        $stepsState[$step - 1] = $state;

        $this->session->put('form_state', $stepsState);
    }
}