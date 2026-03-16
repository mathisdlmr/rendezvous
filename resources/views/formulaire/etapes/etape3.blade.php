@extends('formulaire.layout.form')

@section('title')Formulaire | Détails du rendez-vous @endsection

@section('etape_num')@php
$etape_num = 3;
@endphp @endsection

@section('input_title')
Détails du rendez-vous
@endsection

@section('inputs')

@component('formulaire.components.select', [
    'id' => 'specialite',
    'label' => 'Spécialité Médicale',
    'options' => ['Cardiologie', 'Chirurgie', 'Dermatologie', 'Gériatrie', 'Gynécologie', 'Immunologie', 'Médecine générale', 'Neurologie',
                    'Oncologie', 'Ophtalmologie', 'Orthopédie', 'Odontologie', 'Pédiatrie', 'Psychiatrie', 'Radiologie', 'Urologie'],
    'old_value' => $form_data['specialite'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'date',
    'label' => 'Date',
    'type' => 'date',
    'old_value' => $form_data['date'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'time',
    'label' => 'Heure',
    'type' => 'time',
    'old_value' => $form_data['time'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'motif',
    'label' => 'Motif de la Consultation',
    'type' => 'text',
    'old_value' => $form_data['motif'] ?? null,
    'errors' => $errors
])@endcomponent

@endsection
