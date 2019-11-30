<div class="form-group">
    @include('form.components.label')
    <div class="col-sm-11">
        <input class="form-control" type="password" name="{{$id}}" id="{{$id}}"
               value="{{ $component->value->value ?? '' }}"
               placeholder="{{ $component->placeholder ?? '' }}"
               @if(isset($component->is_require) && $component->is_require) required @endif>
    </div>
</div>
