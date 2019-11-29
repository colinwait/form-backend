<div class="form-group">
    <label>{{ $component->name }}：</label>
    <select class="form-control" name="{{$group->key .'_'. $component->key}}">
        <option value="">请选择</option>
        @foreach($component->options as $option)
            <option
                value="{{$option['value']}}"
                @if((isset($component->value->value) && $component->value->value == $option->value)) selected @endif>
                {{ $option['name'] }}
            </option>
        @endforeach
    </select>
</div>
