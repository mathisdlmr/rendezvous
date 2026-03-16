@extends('formulaire.layout.form')

@section('title')Formulaire | Options @endsection

@section('etape_num')@php
$etape_num = 8;
@endphp @endsection

@section('input_title')
Options
@endsection

@section('inputs')

@component('formulaire.components.select', [
    'id' => 'options', 
    'label' => 'Choix des options', 
    'options' => ['Rien', 'Place de Parking', 'Repas au restaurant', 'Place de Parking + Repas au restaurant'],
    'old_value' => $form_data['options'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'immatriculation', 
    'label' => 'Plaque d\'immatriculation (uniquement si l\'option "Place de Parking" est sélectionnée)', 
    'type' => 'text',
    'old_value' => $form_data['immatriculation'] ?? null,
    'optional' => true,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.select', [
    'id' => 'formule', 
    'label' => 'Formule du menu (uniquement si l\'option "Repas au restaurant" est sélectionnée)', 
    'options' => ['Entrée + Plat + Dessert', 'Entrée + Plat', 'Plat + Dessert'],
    'old_value' => $form_data['formule'] ?? null,
    'errors' => $errors
])@endcomponent


@endsection