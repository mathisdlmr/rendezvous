@extends('formulaire.layout.form')

@section('title')Formulaire | Contacts @endsection

@section('etape_num')@php
$etape_num = 7;
@endphp @endsection

@section('input_title')
Contacts
@endsection

@section('inputs')

@component('formulaire.components.input', [
    'id' => 'email', 
    'label' => 'Adresse email', 
    'type' => 'email',
    'old_value' => $form_data['email'] ?? null,
    'errors' => $errors
])@endcomponent
@component('formulaire.components.input', [
    'id' => 'telephone', 
    'label' => 'Numéro de téléphone', 
    'type' => 'tel',
    'old_value' => $form_data['telephone'] ?? null,
    'errors' => $errors
])@endcomponent


@endsection