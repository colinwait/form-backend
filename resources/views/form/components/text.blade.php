<div class="form-group">
    <label for="{{$id}}" class="col-sm-1 control-label">{{ $component->name }}</label>
    <div class="col-sm-11">
        <input class="form-control" type="text" name="{{$id}}" id="{{$id}}" value="{{ $component->value->value ?? '' }}"
               placeholder="{{ $component->placeholder ?? '' }}"
               @if(isset($component->is_require) && $component->is_require) required @endif>
    </div>
</div>
