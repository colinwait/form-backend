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
            <button class="btn btn-primary form-create" data-toggle="modal" data-target="#formCateCreateModal">创建分类
            </button>
            <!--创建分类-->
            <div class="modal fade" id="formCateCreateModal" tabindex="-1" role="dialog"
                 aria-labelledby="formCateCreateModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="/form/category" method="POST">
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
                                    <label for="form-category">父级分类</label>
                                    <select class="form-control" name="parent_id" id="form-category">
                                        <option value="0">选择分类</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
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
                <th class="col-sm-1">序号</th>
                <th class="col-sm-2">名称</th>
                <th class="col-sm-2">父级分类</th>
                <th class="col-sm-3">创建时间</th>
                <th class="col-sm-5">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th>{{$category->id}}</th>
                    <td onclick="showChildCategory({{$category->id}})">{{$category->name}}</td>
                    <td>{{$category->parent->name ?? ''}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>
                        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#formCateEditModal-{{$category->id}}">
                            编辑
                        </button>
                        <!--编辑分类-->
                        <div class="modal fade" id="formCateEditModal-{{$category->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="formCateEditModal-{{$category->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/form/category/{{$category->id}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            修改分类
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="form-name">名称</label>
                                                <input type="text" class="form-control" id="form-name"
                                                       name="name" placeholder="请输入名称" value="{{$category->name}}"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">创建</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                data-target="#formDeleteModal-{{$category->id}}">
                            删除
                        </button>
                        <div class="modal fade" id="formDeleteModal-{{$category->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="formDeleteModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        删除：{{ $category->name }}
                                    </div>
                                    <div class="modal-body">
                                        是否确认删除{{$category->name}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger"
                                                onclick="formDelete(this, {{$category->id}})">确认
                                        </button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @if($category->categories)
                    @foreach ($category->categories as $child)
                        <tr class="child-category child-category-{{$category->id}}" style="display: none">
                            <th>&nbsp;&nbsp;{{$child->id}}</th>
                            <td>&nbsp;&nbsp;{{$child->name}}</td>
                            <td>&nbsp;&nbsp;{{$child->parent->name ?? ''}}</td>
                            <td>{{$child->created_at}}</td>
                            <td>
                                <button class="btn btn-info" type="button" data-toggle="modal"
                                        data-target="#formCateEditModal-{{$child->id}}">编辑
                                </button>
                                <!--编辑分类-->
                                <div class="modal fade" id="formCateEditModal-{{$child->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="formCateEditModal-{{$child->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="/form/category/{{$child->id}}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-header">
                                                    修改分类
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="form-name">名称</label>
                                                        <input type="text" class="form-control" id="form-name"
                                                               name="name" placeholder="请输入名称"
                                                               value="{{ $child->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="form-category">父级分类</label>
                                                        <select class="form-control" name="parent_id"
                                                                id="form-category">
                                                            <option value="0">选择分类</option>
                                                            @foreach($categories as $select_category)
                                                                <option
                                                                    value="{{$select_category->id}}"
                                                                    @if($select_category->id == $child->parent_id) selected @endif>
                                                                    {{$select_category->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
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
                                <button class="btn btn-danger" type="button" data-toggle="modal"
                                        data-target="#formDeleteModal-{{$child->id}}">
                                    删除
                                </button>
                                <div class="modal fade" id="formDeleteModal-{{$child->id}}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="formDeleteModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                删除：{{ $child->name }}
                                            </div>
                                            <div class="modal-body">
                                                是否确认删除{{$child->name}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="formDelete(this, {{$child->id}})">确认
                                                </button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                    取消
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
        {{$categories->links()}}
    </div>

@endsection

@section('form-scripts')
    <script>
        function formDelete(_this, id) {
            $.ajax({
                type: 'DELETE',
                method: 'DELETE',
                url: '/api/form/category/' + id,
                success: function (data) {
                    if (data.data) {
                        window.location.reload()
                    }
                }
            })
        }

        function showChildCategory(id) {
            let cla = '.child-category-' + id;
            if ($(cla).css('display') == 'none') {
                $('.child-category').hide();
                $(cla).show();
            } else {
                $(cla).hide();
            }
        }
    </script>
@endsection
