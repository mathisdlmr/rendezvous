@extends('formulaire.layout.form')

@section('title')Formulaire | Informations médicales @endsection

@section('etape_num')@php
$etape_num = 4;
@endphp @endsection

@section('input_title')
Informations médicales
@endsection

@section('inputs')

@component('formulaire.components.chipInput', [
    'id' => 'allergies',
    'label' => 'Allergies Connu',
    'old_value' => $form_data['allergies'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.chipInput', [
    'id' => 'medicaments',
    'label' => 'Médicaments Actuels',
    'old_value' => $form_data['medicaments'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'antecendant',
    'label' => 'Antécédents Familiaux',
    'type' => 'text',
    'optional' => true,
    'old_value' => $form_data['antecendant'] ?? null,
    'errors' => $errors
])@endcomponent

@endsection