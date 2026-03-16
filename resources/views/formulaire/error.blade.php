@extends('layout.app')

@section('title')
Formulaire | Erreur
@endsection

@section('content')

<div class="d-flex justify-content-center align-items-center" style="background-color: #f2fafd; height: 100vh">
    <div class="border rounded d-flex flex-column justify-content-center align-items-center p-3" style="border-color: #0D2339 !important">
        <div class="error-icon m-5">
            <div class="circle-border"></div>
            <div class="circle">
                <div class="error"></div>
            </div>
        </div>
        <h1>Une erreur est survenu pendant le traitement de votre demande</h1>
        <a href="{{ route('form_move', ['etape'=>1]) }}" class="btn btn-primary mt-3 d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-counterclockwise me-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
              </svg>
            Reprendre la demande
        </a>
    </div>
</div>

@endsection