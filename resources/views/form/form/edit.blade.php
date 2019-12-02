@extends('form.menu')

@section('form-styles')
    <style>
        .form-horizontal {
            margin-top: 10px;
        }

        .form-return {
            margin-top: 10px;
        }
    </style>
@endsection

@section('form-content')
    <div class="container form-content">
        <div>
            <a href="/form">
                <button class="btn btn-primary form-return">返回</button>
            </a>
        </div>
        @if(isset($form->template->groups))
            <form class="form-horizontal" action="/form/{{$form->id}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    @foreach($form->template->groups as $group)
                        <div class="panel panel-default component-panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$group->name}}
                                    @if($group->remark)
                                        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus"
                                           data-placement="left" data-container="body" title="备注"
                                           data-content="{{$group->remark}}"
                                           style="float: right">
                                            <span style="float: right"
                                                  class="glyphicon glyphicon-info-sign component-remark"
                                                  aria-hidden="true"></span>
                                        </a>
                                    @endif
                                </h3>
                            </div>
                            <div class="panel-body">
                                @if ($group->components)
                                    @foreach($group->components as $component)
                                        @php
                                            $id = 'component_' . $component->id;
                                        @endphp
                                        @component('form.components.'.$component->type, ['component' => $component, 'group' => $group, 'id' => $id, 'edit' => $edit])
                                        @endcomponent
                                    @endforeach
                                @endif
                            </div>
                        </div>

                    @endforeach
                    @if($edit)
                        <button class="btn btn-info" type="submit">提交</button>
                    @endif
                </div>
            </form>
        @endif
    </div>
@endsection

@section('form-scripts')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        });
        @if($edit)
        document.addEventListener('keydown', function (e) {
            if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                e.preventDefault();
                $('form').submit();
            }
        });
        @endif
    </script>
@endsection
