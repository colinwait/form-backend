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
            <a href="/form/forms">
                <button class="btn btn-primary form-create">返回</button>
            </a>
            <button class="btn btn-primary form-create" data-toggle="modal" data-target="#formTempCreateModal">创建模板
            </button>
            <!--创建模板-->
            <div class="modal fade" id="formTempCreateModal" tabindex="-1" role="dialog"
                 aria-labelledby="formTempCreateModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="/form/templates" method="POST">
                            @csrf
                            <div class="modal-header">
                                创建分类
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="form-name">名称</label>
                                    <input type="text" class="form-control" id="form-name"
                                           name="name" placeholder="请输入名称" required>
                                </div>
                                <div class="form-group">
                                    <label for="form-introduction">简介</label>
                                    <textarea class="form-control" id="form-introduction"
                                              name="introduction" placeholder="请输入简介"></textarea>
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
                <th>简介</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($templates as $template)
                <tr>
                    <th>{{$template->id}}</th>
                    <td>{{$template->name}}</td>
                    <td>{{$template->introduction}}</td>
                    <td>{{$template->created_at}}</td>
                    <td>
                        <a href="/form/templates/{{ $template->id }}">
                            <button class="btn btn-info" type="button">编辑</button>
                        </a>
                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                data-target="#formDeleteModal-{{$template->id}}">
                            删除
                        </button>
                        <div class="modal fade" id="formDeleteModal-{{$template->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="formDeleteModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        删除：{{ $template->name }}
                                    </div>
                                    <div class="modal-body">
                                        是否确认删除{{$template->name}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger"
                                                onclick="formDelete(this, {{$template->id}})">确认
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
        {{$templates->links()}}
    </div>

@endsection

@section('form-scripts')
    <script>
        function formDelete(_this, id) {
            $.ajax({
                type: 'DELETE',
                method: 'DELETE',
                url: '/api/form/templates/' + id,
                success: function (data) {
                    if (data.data) {
                        window.location.reload()
                    }
                }
            })
        }
    </script>
@endsection
