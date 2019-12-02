<div class="col-sm-1 control-label">
    @if($component->remark)
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="right"
           data-container="body" title="备注" data-content="{{$component->remark}}"><span
                class="glyphicon glyphicon-info-sign component-remark" aria-hidden="true"></span></a>
    @endif
    <label for="{{$id}}">
        {{ $component->name }}
    </label>
</div>
