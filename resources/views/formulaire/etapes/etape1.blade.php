@extends('formulaire.layout.form')

@section('title')Formulaire | Vos informations @endsection

@section('etape_num')@php
$etape_num = 1;
@endphp @endsection

@section('input_title')
Vos informations
@endsection

@section('inputs')

@component('formulaire.components.input', [
    'id' => 'nom', 
    'label' => 'Nom', 
    'type' => 'text', 
    'datalist' => $datalist_nom,
    'old_value' => $form_data['nom'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'prenom', 
    'label' => 'Prénom', 
    'type' => 'text', 
    'datalist'=>$datalist_prenom,
    'old_value' => $form_data['prenom'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'age', 
    'label' => 'Âge', 
    'type' => 'number',
    'old_value' => $form_data['age'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.select', [
    'id' => 'sexe', 
    'label' => 'Sexe', 
    'options' => ['Homme', 'Femme', 'Autre'],
    'old_value' => $form_data['sexe'] ?? null,
    'errors' => $errors
]) @endcomponent

@endsection