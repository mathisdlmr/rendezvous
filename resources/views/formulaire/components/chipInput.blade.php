<div class="mb-3">
    <div class="input-group">
        <div class="form-floating">
            <input type="text"
                   id="chip-input-{{ $id }}"
                   class="form-control"
                   placeholder=""
                   style="background: transparent; border-color: #0D2339" >
            <label for="chip-input-{{ $id }}">
                {{ $label }}
                @if(!isset($optional))
                    <span class="text-muted">*</span>
                @endif
            </label>
        </div>
        <button class="btn btn-secondary" id="chip-button-{{ $id }}" type="button">Ajouter</button>
    </div>
    <div id="chip-container-{{ $id }}" class="chip-container"></div>
    <input type="text"
           id="{{ $id }}"
           name="{{ $id }}"
           class="chip-input"
           hidden
           @if (isset($old_value))
              value="{{ $old_value }}"
           @endif>

</div>