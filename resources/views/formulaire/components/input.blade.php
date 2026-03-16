<div class="form-floating mb-3 has-validation">
    <input type="{{ $type }}" 
            class="form-control @if($errors->has($id)) is-invalid @endif" 
            id="{{ $id }}" 
            name="{{ $id }}"
            placeholder="" 
            list="datalist_{{ $id }}"
            @if(!isset($optional))
                required
            @endif
            @if(isset($old_value))
                value="{{ $old_value }}"
            @endif>
    <label for="{{ $id }}">
        {{ $label }}
        @if(!isset($optional))
            <span class="text-muted">*</span>
        @endif
    </label>
    @if(isset($datalist))
        <datalist id="datalist_{{ $id }}">
            @foreach ($datalist as $item)
                <option value="{{ $item }}">
            @endforeach
        </datalist>
    @endif
</div>
  