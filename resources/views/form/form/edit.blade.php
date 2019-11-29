@extends('form.menu')

@section('form-content')
    <div class="container">
        @if(isset($form->template->groups))
            <form class="form-horizontal">
                <div class="form-group">
                    @foreach($form->template->groups as $group)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$group->name}}</h3>
                            </div>
                            <div class="panel-body">
                            @if ($group->components)
                                @foreach($group->components as $component)
                                    <!--{{$id = $group->key .'_'. $component->key}}-->
                                        @component('form.components.'.$component->type, ['component' => $component, 'group' => $group, 'id' => $id])
                                        @endcomponent
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        @endif
    </div>
@endsection
