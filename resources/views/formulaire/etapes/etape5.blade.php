@extends('formulaire.layout.form')

@section('title')Formulaire | Sécurité sociale et mutuelle @endsection

@section('etape_num')@php
$etape_num = 5;
@endphp @endsection

@section('input_title')
Sécurité sociale et mutuelle
@endsection

@section('inputs')

@component('formulaire.components.input', [
    'id' => 'securite_sociale', 
    'label' => 'Numéro de Sécurité Sociale', 
    'type' => 'number',
    'old_value' => $form_data['securite_sociale'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'mutuelle', 
    'label' => 'Numéro DRE de votre mutuelle', 
    'type' => 'number',
    'optional' => true,
    'old_value' => $form_data['mutuelle'] ?? null,
    'errors' => $errors
])@endcomponent

@endsection