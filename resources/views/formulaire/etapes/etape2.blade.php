@extends('formulaire.layout.form')

@section('title')Formulaire | Votre adresse @endsection

@section('etape_num')@php
$etape_num = 2;
@endphp @endsection

@section('input_title')
Votre adresse
@endsection

@section('inputs')

@component('formulaire.components.input', [
    'id' => 'adresse', 
    'label' => 'Adresse', 
    'type' => 'text',
    'old_value' => $form_data['adresse'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'complement_adresse', 
    'label' => 'Complement d\'adresse', 
    'type' => 'text', 
    'optional' => true,
    'old_value' => $form_data['complement_adresse'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'code_postal', 
    'label' => 'Code Postal', 
    'type' => 'number',
    'old_value' => $form_data['code_postal'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'ville', 
    'label' => 'Ville', 
    'type' => 'text',
    'old_value' => $form_data['ville'] ?? null,
    'errors' => $errors
])@endcomponent

@endsection