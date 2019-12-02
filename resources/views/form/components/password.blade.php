<div class="form-group">
    @include('form.components.label')
    <div class="col-sm-11">
        @if($edit)
            <input class="form-control component-value" type="password" name="{{$id}}" id="{{$id}}"
                   value="{{ $component->value->value ?? '' }}"
                   placeholder="{{ $component->placeholder ?? '' }}"
                   @if(isset($component->is_require) && $component->is_require) required @endif>
        @else
            @include('form.components.value')
        @endif
    </div>
</div>
