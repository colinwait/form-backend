<div class="form-group">
    @include('form.components.label')
    <div class="col-sm-11">
        @if($edit)
            <textarea class="form-control component-value" name="{{$id}}" id="{{$id}}"
                      placeholder="{{ $component->placeholder ?? '' }}"
                      @if(isset($component->is_require) && $component->is_require) required @endif>{{ $component->value->value ?? '' }}</textarea>
        @else
            @include('form.components.value')
        @endif
    </div>
</div>
