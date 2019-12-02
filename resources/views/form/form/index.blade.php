@extends('form.menu')

@section('form-styles')
    <style>
        .form-table {
            margin-top: 10px;
        }

        .form-create {
            margin-top: 10px;
        }
    </style>
@endsection

@section('form-content')
    <div class="container form-content">
        <div>
            <button class="btn btn-primary form-create" data-toggle="modal" data-target="#formCreateModal">新增表单</button>
            <div class="modal fade" id="formCreateModal" tabindex="-1" role="dialog"
                 aria-labelledby="formCreateModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="POST">
                            @csrf
                            <div class="modal-header">
                                创建表单
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="form-name">名称</label>
                                    <input type="text" class="form-control" id="form-name"
                                           name="name" placeholder="请输入名称" required>
                                </div>
                                <div class="form-group">
                                    <label for="form-introduction">简介</label>
                                    <textarea class="form-control" id="form-introduction" name="introduction"
                                              placeholder="请输入简介"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="form-category">分类</label>
                                    <select class="form-control" name="category_id" id="form-category">
                                        <option value="0">请选择分类</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="form-template">模板</label>
                                    <select class="form-control" name="template_id" id="form-template" required>
                                        <option value="0">请选择模板</option>
                                        @foreach($templates as $template)
                                            <option value="{{$template->id}}">{{$template->name}}</option>
                                        @endforeach
                                    </select>
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
        </div>
        <table class="table table-striped table-bordered form-table">
            <thead>
            <tr>
                <th>序号</th>
                <th>名称</th>
                <th>分类</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($forms as $form)
                <tr>
                    <th>{{$form->id}}</th>
                    <td>{{$form->name}}</td>
                    <td>{{$form->category->name ?? ''}}</td>
                    <td>{{$form->created_at}}</td>
                    <td>
                        <a href="/form/show/{{ $form->id }}">
                            <button class="btn btn-success" type="button">查看</button>
                        </a>
                        <a href="/form/{{ $form->id }}">
                            <button class="btn btn-info" type="button">编辑</button>
                        </a>
                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                data-target="#formDeleteModal-{{$form->id}}">
                            删除
                        </button>
                        <div class="modal fade" id="formDeleteModal-{{$form->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="formDeleteModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        删除：{{ $form->name }}
                                    </div>
                                    <div class="modal-body">
                                        是否确认删除{{$form->name}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger"
                                                onclick="formDelete(this, {{$form->id}})">确认
                                        </button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$forms->links()}}
    </div>

@endsection

@section('form-scripts')
    <script>
        function formDelete(_this, id) {
            $.ajax({
                type: 'DELETE',
                method: 'DELETE',
                url: '/api/form/forms/' + id,
                success: function (data) {
                    if (data.data) {
                        window.location.reload()
                    }
                }
            })
        }
    </script>
@endsection
