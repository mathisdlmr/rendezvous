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
'old_value' => $form_data['nom'] ?? null,
'errors' => $errors
])@endcomponent

@component('formulaire.components.input', [
'id' => 'prenom',
'label' => 'Prénom',
'type' => 'text',
'old_value' => $form_data['prenom'] ?? null,
'errors' => $errors
])@endcomponent

@component('formulaire.components.input', [
'id' => 'date_naissance',
'label' => 'Date de naissance',
'type' => 'date',
'old_value' => $form_data['date_naissance'] ?? null,
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