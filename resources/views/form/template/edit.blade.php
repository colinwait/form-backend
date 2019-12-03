@extends('form.menu')

@section('form-styles')
    <style>
        .form-horizontal {
            margin-top: 10px;
        }

        .form-return {
            margin-top: 10px;
        }

        .component-add {
            text-align: center;
        }

        .component-add-form .form-group {
            margin-left: 0;
        !important;
            margin-right: 0;
        !important;
        }

        .panel-body .form-group {
            margin-left: 0;
        !important;
            margin-right: 0;
        !important;
        }

        .component-form-group {
            border: 1px #ccc solid;
            border-radius: 4px;
            padding: 20px;
            margin-top: 5px;
            box-shadow: 2px 3px 12px 0 rgba(82, 82, 82, 0.4)
        }

    </style>
@endsection

@section('form-content')
    <div class="container form-content">
        <div>
            <a href="/form/templates">
                <button class="btn btn-primary form-return">返回</button>
            </a>
        </div>
        <div class="form-horizontal">
            <div class="form-group">
                @foreach($template->groups as $group)
                    <div class="panel panel-default component-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$group->name}}（{{$group->key}}）
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
                                    <div class="component-edit">
                                        <button class="btn btn-primary component-edit-btn" data-toggle="modal"
                                                data-target="#componentEditModal"
                                                data-template-id="{{$template->id}}"
                                                data-parent-id="{{$group->id}}"
                                                data-component-id="{{$component->id}}"
                                                data-name="{{$component->name}}"
                                                data-key="{{$component->key}}"
                                                data-type="{{$component->type}}"
                                                data-remark="{{$component->remark}}"
                                                data-is-require="{{$component->is_require}}"
                                        >
                                            编辑
                                        </button>
                                        <button class="btn btn-danger component-edit-btn" data-toggle="modal"
                                                data-component-id="{{$component->id}}"
                                                data-name="{{$component->name}}"
                                                data-target="#componentDeleteModal">删除
                                        </button>
                                    </div>
                                    @component('form.components.'.$component->type, ['component' => $component, 'group' => $group, 'id' => $id, 'edit' => true, 'modify' => true])
                                    @endcomponent
                                @endforeach
                                <div class="component-add">
                                    <button class="btn btn-success" data-toggle="modal"
                                            data-template-id="{{$template->id}}"
                                            data-parent-id="{{$group->id}}"
                                            data-target="#componentCreateModal">
                                        添加组件
                                    </button>
                                    <button class="btn btn-primary" data-toggle="modal"
                                            data-template-id="{{$template->id}}"
                                            data-id="{{$group->id}}"
                                            data-name="{{$group->name}}"
                                            data-key="{{$group->key}}"
                                            data-remark="{{$group->remark}}"
                                            data-target="#groupEditModal">
                                        编辑分组
                                    </button>
                                    <button class="btn btn-danger" data-toggle="modal"
                                            data-group-id="{{$group->id}}"
                                            data-name="{{$group->name}}"
                                            data-target="#groupDeleteModal">
                                        删除分组
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="component-add">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#groupCreateModal">添加分组</button>
                </div>
            </div>
        </div>
    </div>

    <!--创建分组-->
    <div class="modal fade" id="groupCreateModal" tabindex="-1" role="dialog"
         aria-labelledby="groupCreateModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/form/components" method="POST" class="component-add-form">
                    @csrf
                    <input type="hidden" name="template_id" value="{{$template->id}}">
                    <input type="hidden" name="parent_id" value="0">
                    <div class="modal-header">
                        创建分组
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="group-name-add">名称</label>
                            <input type="text" class="form-control" id="group-name-add"
                                   name="name" placeholder="请输入名称" required>
                        </div>
                        <div class="form-group">
                            <label for="group-key-add">键名</label>
                            <input type="text" class="form-control" id="group-key-add"
                                   name="key" placeholder="请输入键名" required>
                        </div>
                        <div class="form-group">
                            <label for="group-remark-add">备注</label>
                            <textarea class="form-control" id="group-remark-add" name="remark"
                                      placeholder="请输入备注"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">创建</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--编辑组件-->
    <div class="modal fade" id="componentEditModal" tabindex="-1" role="dialog"
         aria-labelledby="componentEditModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" class="component-edit-form">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        创建组件
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="template_id" value="">
                        <input type="hidden" name="parent_id" value="">
                        <div class="form-group">
                            <label for="form-name">名称</label>
                            <input type="text" class="form-control" id="form-name"
                                   name="name" placeholder="请输入名称" required>
                        </div>
                        <div class="form-group">
                            <label for="form-key">键名</label>
                            <input type="text" class="form-control" id="form-key" name="key"
                                   placeholder="请输入键名">
                        </div>
                        <div class="form-group">
                            <label for="form-type">模板</label>
                            <select class="form-control" name="type" id="form-type"
                                    required>
                                <option value="text">文本框</option>
                                <option value="textarea">富文本</option>
                                <option value="password">密码框</option>
                                <option value="select">下拉框</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="form-is-require">是否必填</label>
                            <input name="is_require" value="1" type="radio"> 是
                            <input name="is_require" value="0" type="radio"> 否
                        </div>
                        <div class="form-group">
                            <label for="form-remark">备注</label>
                            <textarea class="form-control" id="form-remark" name="remark"
                                      placeholder="请输入备注"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--删除组件-->
    <div class="modal fade" id="componentDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="componentDeleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    删除：<span class="component-delete-panel-header"></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    是否确认删除<span class="component-delete-panel-body"></span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger component-delete-panel-btn"
                            onclick="componentDelete(this)" data-component-id="">确认
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">取消
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--创建组件-->
    <div class="modal fade" id="componentCreateModal" tabindex="-1" role="dialog"
         aria-labelledby="componentCreateModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/form/components" method="POST" class="component-add-form">
                    @csrf
                    <div class="modal-header">
                        创建组件
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="template_id" value="0">
                        <input type="hidden" name="parent_id" value="0">
                        <div class="form-group">
                            <label for="form-name-add">名称</label>
                            <input type="text" class="form-control" id="form-name-add"
                                   name="name" placeholder="请输入名称" required>
                        </div>
                        <div class="form-group">
                            <label for="form-key-add">键名</label>
                            <input type="text" class="form-control" id="form-key-add" name="key"
                                   placeholder="请输入键名">
                        </div>
                        <div class="form-group">
                            <label for="form-type-add">模板</label>
                            <select class="form-control" name="type" id="form-type-add"
                                    required>
                                <option value="text">文本框</option>
                                <option value="textarea">富文本</option>
                                <option value="password">密码框</option>
                                <option value="select">下拉框</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=".form-is-require-add">是否必填</label>
                            <input class="form-is-require-add" name="is_require" value="1" type="radio"> 是
                            <input class="form-is-require-add" name="is_require" value="0" type="radio" checked> 否
                        </div>
                        <div class="form-group">
                            <label for="form-remark-add">备注</label>
                            <textarea class="form-control" id="form-remark-add" name="remark"
                                      placeholder="请输入备注"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">创建</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--删除分组-->
    <div class="modal fade" id="groupDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="groupDeleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    删除：<span class="group-delete-panel-header"></span>
                </div>
                <div class="modal-body">
                    是否确认删除<span class="group-delete-panel-body"></span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger group-delete-panel-btn"
                            onclick="componentDelete(this)" data-component-id="">确认
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">取消
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--编辑分组-->
    <div class="modal fade" id="groupEditModal" tabindex="-1" role="dialog"
         aria-labelledby="groupEditModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST"
                      class="component-add-form">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        编辑分组
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="template_id" value="">
                        <input type="hidden" name="parent_id" value="0">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="form-name-edit">名称</label>
                            <input type="text" class="form-control" id="form-name-edit"
                                   name="name" placeholder="请输入名称" value=""
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="form-key-edit">键名</label>
                            <input type="text" class="form-control" id="form-key-edit"
                                   name="key" placeholder="请输入键名" value=""
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="form-remark-edit">备注</label>
                            <textarea class="form-control" id="form-remark-edit" name="remark"
                                      placeholder="请输入备注"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('form-scripts')
    <script>
        function componentDelete(_this) {
            $.ajax({
                type: 'DELETE',
                method: 'DELETE',
                url: '/api/form/components/' + $(_this).data('component-id'),
                success: function (data) {
                    if (data.data) {
                        window.location.reload()
                    }
                }
            })
        }

        $(function () {
            $('[data-toggle="popover"]').popover()
        });

        $('#componentEditModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var template_id = button.data('template-id');
            var parent_id = button.data('parent-id');
            var component_id = button.data('component-id');
            var name = button.data('name');
            var key = button.data('key');
            var remark = button.data('remark');
            var type = button.data('type');
            var is_require = button.data('is-require');
            var modal = $(this);
            modal.find('.modal-body input[name=template_id]').val(template_id);
            modal.find('.modal-body input[name=parent_id]').val(parent_id);
            modal.find('.modal-body input[name=component_id]').val(component_id);
            modal.find('.modal-body input[name=name]').val(name);
            modal.find('.modal-body input[name=key]').val(key);
            modal.find('.modal-body textarea[name=remark]').text(remark);
            modal.find('.modal-body input[name=is_require]').eq(!is_require).prop('checked', true);
            modal.find('.modal-body select option:contains("' + type + '")').prop('selected', true);
            modal.find('.modal-content form').attr('action', '/form/components/' + component_id);
        });

        $('#groupEditModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var template_id = button.data('template-id');
            var id = button.data('id');
            var name = button.data('name');
            var key = button.data('key');
            var remark = button.data('remark');
            var modal = $(this);
            modal.find('.modal-body input[name=template_id]').val(template_id);
            modal.find('.modal-body input[name=id]').val(id);
            modal.find('.modal-body input[name=name]').val(name);
            modal.find('.modal-body input[name=key]').val(key);
            modal.find('.modal-body textarea[name=remark]').text(remark);
            modal.find('.modal-content form').attr('action', '/form/components/' + id);
        });

        $('#componentDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var component_id = button.data('component-id');
            var name = button.data('name');
            var modal = $(this);
            console.log(component_id, name)
            modal.find('.component-delete-panel-header').text(name);
            modal.find('.component-delete-panel-body').text(name);
            modal.find('.component-delete-panel-btn').attr('data-component-id', component_id)
        });

        $('#groupDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var group_id = button.data('group-id');
            var name = button.data('name');
            var modal = $(this);
            console.log(group_id, name)
            modal.find('.group-delete-panel-header').text(name);
            modal.find('.group-delete-panel-body').text(name);
            modal.find('.group-delete-panel-btn').attr('data-component-id', group_id)
        });

        $('#componentCreateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var template_id = button.data('template-id');
            var parent_id = button.data('parent-id');
            var modal = $(this);
            modal.find('.modal-body input[name=template_id]').val(template_id);
            modal.find('.modal-body input[name=parent_id]').val(parent_id);
        });

    </script>
@endsection
