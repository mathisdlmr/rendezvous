<div class="form w-100">
    <h1 class="mb-5">@yield('input_title')</h1>
    <form action="{{ route('form_process') }}" method="POST" autocomplete="off">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        @yield('inputs')
        @if (count($errors) != 0)
        <div class="alert alert-danger">
            <div>
                Plusieurs erreurs se sont glissées dans le formulaire:
            </div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(count(array_filter($form_state, function($value) {
            return $value === true;
        })) != count($form_state) && $etape_num === 9)
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" width="16" height="16" role="img" aria-label="Warning:">
                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                  Le formulaire n'est pas encore complet.
                </div>
              </div>
        @endif
        <div class="d-flex justify-content-between">
            @if ($etape_num > 1)
                <a href="{{ route('form_prev') }}" class="btn btn-secondary d-flex flex-row align-items-center rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Précédent
                </a>
            @else
                <div></div>
            @endif
            <button type="submit" class="btn btn-primary d-flex flex-row align-items-center"
            @if (count(array_filter($form_state, function($value) {
                return $value === true;
            })) != count($form_state) && $etape_num === 9)
                disabled
            @endif>
                @if ($etape_num == 9)
                    Terminer
                @else
                    Suivant 
                @endif
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ms-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </button>
        </div>
    </form>
</div>