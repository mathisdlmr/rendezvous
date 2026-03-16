@extends('layout.app')

@section('content')
<div class="d-flex" style="height: 100vh">
    <div class="col-6 text-light d-flex flex-column justify-content-between h-100" style="background-color: #107ACA">
        @include('formulaire.layout.left')
    </div>
    <div class="col-6 p-5 d-flex align-items-center" style="background-color: #f2fafd; color: #0D2339">
        @include('formulaire.layout.right')
    </div>
</div>
@endsection