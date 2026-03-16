@extends('layout.app')

@section('title')
Confirmation de votre rendez-vous
@endsection

@section('content')

<div class="d-flex justify-content-center align-items-center" style="background-color: #f2fafd; height: 100vh">
    <div class="border rounded d-flex flex-column justify-content-center align-items-center p-3" style="border-color: #0D2339 !important">
        <div class="success-checkmark ms-3 me-4 mt-4">
            <div class="check-icon">
              <span class="icon-line line-tip"></span>
              <span class="icon-line line-long"></span>
              <div class="icon-circle"></div>
              <div class="icon-fix"></div>
            </div>
        </div>
        <h1>Enregistrement de votre rendez-vous</h1>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3 d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-house me-2" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
            </svg>
            Page d'acceuil
            </a>
    </div>
</div>

@endsection