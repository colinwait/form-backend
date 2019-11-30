@extends('form.menu')

@section('form-content')
    <div class="container form-content">
        @if(isset($form->template->groups))
            <form class="form-horizontal">
                <div class="form-group">
                    @foreach($form->template->groups as $group)
                        <div class="panel panel-default component-panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$group->name}}
                                    @if($group->remark)
                                        <span style="float: right"
                                              class="glyphicon glyphicon-info-sign component-remark"
                                              aria-hidden="true"></span>
                                        <div style="float: right" class="component-remark-show"
                                             hidden>{{$group->remark}}</div>
                                    @endif
                                </h3>
                            </div>
                            <div class="panel-body">
                                @if ($group->components)
                                    @foreach($group->components as $component)
                                        @php
                                            $id = $group->key .'_'. $component->key
                                        @endphp
                                        @component('form.components.'.$component->type, ['component' => $component, 'group' => $group, 'id' => $id])
                                        @endcomponent
                                    @endforeach
                                @endif
                            </div>
                        </div>

                    @endforeach
                    <button class="btn btn-info" type="submit">提交</button>
                </div>
            </form>
        @endif
    </div>
@endsection
