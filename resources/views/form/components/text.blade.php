<div class="form-group">
    <label for="{{$id}}" class="col-sm-1 control-label">{{ $component->name }}</label>
    <div class="col-sm-11">
        @if($component->remark)
            <div class="input-group">
                @endif
                <input class="form-control" type="text" name="{{$id}}" id="{{$id}}"
                       value="{{ $component->value->value ?? '' }}"
                       placeholder="{{ $component->placeholder ?? '' }}"
                       @if(isset($component->is_require) && $component->is_require) required @endif>
                @if($component->remark)
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" aria-label="Right Align">
                            <span class="glyphicon" aria-hidden="true"><span class="glyphicon-align-left"></span></span>
                        </button>
                    </span>
                @endif
                @if($component->remark)
            </div>
        @endif
    </div>
</div>
