<label for="{{$id}}" class="col-sm-1 control-label">
    @if($component->remark)
        <span class="glyphicon glyphicon-info-sign component-remark" aria-hidden="true"></span>
        <div class="component-remark-show" hidden>{{$component->remark}}</div>
    @endif
    {{ $component->name }}
</label>
