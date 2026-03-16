@extends('formulaire.layout.form')

@section('title')Formulaire | Validation @endsection

@section('etape_num')@php
$etape_num = 9;
@endphp @endsection

@section('input_title')
Validation
@endsection

@section('inputs')

<div class="form-check my-3">
    <input class="form-check-input" type="checkbox" value="true" id="validation_data" name="validation_data" style="border-color: #0D2339">
    <label class="form-check-label" for="validation_data">
        Je confirme que les informations fournies ci-dessus sont exactes et complètes à ma connaissance. Je comprends que toute inexactitude intentionnelle pourrait affecter négativement la procédure en cours.
    </label>
</div>
<div class="form-check my-3">
    <input class="form-check-input" type="checkbox" value="true" id="validation_rgpd" name="validation_rgpd" style="border-color: #0D2339">
    <label class="form-check-label" for="validation_rgpd">
        En soumettant ce formulaire, je confirme avoir lu, compris et accepté les conditions de confidentialité et de traitement des données personnelles conformément au Règlement général sur la protection des données (RGPD). J'autorise l'utilisation de mes informations pour le traitement de ma demande et je consens à la collecte, au stockage et au traitement de mes données conformément à la politique de confidentialité en vigueur.
    </label>
</div>
  


@endsection