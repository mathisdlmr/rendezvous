<a href="{{ route('home') }}" class="text-decoration-none text-light">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left ms-2 mt-2" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
    </svg>
</a>

<h1 class="ps-5">Prise de rendez-vous</h1>

<ul class="nav flex-column ms-5">
    @component('formulaire.components.navlink', [
        'ref_num' => $etape_num,
        'target_num' => 1,
        'placeholder' => 'Vos informations',
        'state' => $form_state[0]
    ])@endcomponent
    @component('formulaire.components.navlink', [
        'ref_num' => $etape_num,
        'target_num' => 2,
        'placeholder' => 'Votre adresse',
        'state' => $form_state[1]
    ])@endcomponent
    @component('formulaire.components.navlink', [
        'ref_num' => $etape_num,
        'target_num' => 3,
        'placeholder' => 'Détails du rendez-vous',
        'state' => $form_state[2]
    ])@endcomponent
    @component('formulaire.components.navlink', [
        'ref_num' => $etape_num,
        'target_num' => 4,
        'placeholder' => 'Informations médicales',
        'state' => $form_state[3]
    ])@endcomponent
    @component('formulaire.components.navlink', [
        'ref_num' => $etape_num,
        'target_num' => 5,
        'placeholder' => 'Sécurité sociale et mutuelle',
        'state' => $form_state[4]
    ])@endcomponent
    @component('formulaire.components.navlink', [
        'ref_num' => $etape_num,
        'target_num' => 6,
        'placeholder' => 'Informations de paiement',
        'state' => $form_state[5]
    ])@endcomponent
    @component('formulaire.components.navlink', [
        'ref_num' => $etape_num,
        'target_num' => 7,
        'placeholder' => 'Contacts',
        'state' => $form_state[6]
    ])@endcomponent
    @component('formulaire.components.navlink', [
        'ref_num' => $etape_num,
        'target_num' => 8,
        'placeholder' => 'Options',
        'state' => $form_state[7]
    ])@endcomponent
    @component('formulaire.components.navlink', [
        'ref_num' => $etape_num,
        'target_num' => 9,
        'placeholder' => 'Validation',
        'state' => False
    ])@endcomponent
</ul>

<img src="{{ asset('images/doctor.png') }}" alt="doctor illustration" style="width: auto;max-height:100%">