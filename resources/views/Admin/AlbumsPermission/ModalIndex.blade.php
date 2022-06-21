<form id="form-group-permission" class="form-horizontal" method="POST" action="/Admin/AlbumsPermission/Store">
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th style="width: 20px">
                    <div class="form-group clearfix  icheck-center">
                        <div class="icheck-primary d-inline">
                            <input id="checkedAll" type="checkbox" name="checkedAll">
                            <label for="checkedAll">
                            </label>
                        </div>
                    </div>
                </th>
                <th style="width: 60px">序号</th>
                <th style="width: 140px">用户组</th>
                <th>说明</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $item)
            <tr>
                <td>
                    <div class="form-group clearfix  icheck-center">
                        <div class="icheck-primary d-inline">
                            <input id="chk{{$item->id}}" type="checkbox" name="chkId" value="{{$item->id}}">
                            <label for="chk{{$item->id}}">
                            </label>
                        </div>
                    </div>
                </td>
                <td>{{$item->id}}</td>
                <td>{{$item->group_name}}</td>
                <td>
                    {{$item->description}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
