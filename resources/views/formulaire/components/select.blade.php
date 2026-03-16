<div class="form-floating mb-3">
    <select class="form-select"
            id="{{ $id }}"
            name="{{ $id }}"
            aria-label="{{ $label }}"
            title="{{ $label }}">
        @foreach ($options as $item)
            <option value="{{ $item }}"
                @if(isset($old_value) && $old_value == $item)
                    selected
                @endif
            >{{ $item }}</option>
        @endforeach
    </select>
    <label for="{{ $id }}">{{ $label }}</label>
</div>
  