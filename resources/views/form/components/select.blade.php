<div class="form-group component-form-group">
    @include('form.components.label')
    <div class="col-sm-11">
        @if($edit)
            <select class="form-control component-value" name="{{$id}}">
                <option value="">请选择</option>
                @foreach($component->options as $option)
                    <option
                        value="{{$option['value']}}"
                        @if((isset($component->value->value) && $component->value->value == $option['value'])) selected @endif
                    >
                        {{ $option['name'] }}
                    </option>
                @endforeach
            </select>
        @else
            @include('form.components.value')
        @endif
    </div>
</div>
