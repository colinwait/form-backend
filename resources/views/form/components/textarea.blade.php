<div class="form-group">
    @include('form.components.label')
    <div class="col-sm-11">
        <textarea class="form-control" name="{{$id}}" id="{{$id}}"
                  placeholder="{{ $component->placeholder ?? '' }}"
                  @if(isset($component->is_require) && $component->is_require) required @endif>{{ $component->value->value ?? '' }}</textarea>
    </div>
</div>
