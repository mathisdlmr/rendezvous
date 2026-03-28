@extends('formulaire.layout.form')

@section('title')Formulaire | Informations de paiement @endsection

@section('etape_num')@php
$etape_num = 6;
@endphp @endsection

@section('input_title')
Informations de paiement
@endsection

@section('inputs')

@component('formulaire.components.input', [
'id' => 'carte_bancaire',
'label' => 'Numéro de carte bancaire',
'type' => 'text',
'old_value' => $form_data['carte_bancaire'] ?? null,
'errors' => $errors
])@endcomponent

@component('formulaire.components.input', [
'id' => 'carte_titulaire',
'label' => 'Titulaire de la carte',
'type' => 'text',
'old_value' => $form_data['carte_titulaire'] ?? null,
'errors' => $errors
])@endcomponent

<div class="d-flex flex-row">
    <div class="col-6 pe-1">
        @component('formulaire.components.select', [
        'id' => 'carte_expiration_month',
        'label' => 'Mois d\'expiration',
        'options' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        'old_value' => $form_data['carte_expiration_month'] ?? null,
        'errors' => $errors
        ])@endcomponent
    </div>
    <div class="col-6 ps-1">
        @component('formulaire.components.select', [
        'id' => 'carte_expiration_year',
        'label' => 'Année d\'expiration',
        'options' => ['2024', '2025', '2026', '2027', '2028', '2029', '2030', '2031', '2032', '2033', '2034', '2035'],
        'old_value' => $form_data['carte_expiration_year'] ?? null,
        'errors' => $errors
        ])@endcomponent
    </div>
</div>

@endsection