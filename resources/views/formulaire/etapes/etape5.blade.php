@extends('formulaire.layout.form')

@section('title')Formulaire | Sécurité sociale @endsection

@section('etape_num')@php
$etape_num = 5;
@endphp @endsection

@section('input_title')
Sécurité sociale
@endsection

@section('inputs')

@component('formulaire.components.input', [
'id' => 'securite_sociale',
'label' => 'Numéro de Sécurité Sociale',
'type' => 'text',
'old_value' => $form_data['securite_sociale'] ?? null,
'errors' => $errors
])@endcomponent

@endsection