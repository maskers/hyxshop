@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    <!-- 提交返回用的url参数 -->
    <input type="hidden" name="ref" value="{!! $ref !!}">
    <div class="row">
        <div class="col-xs-4">

            <div class="form-group">
                <label for="name">用户名：{{ $info->name }}</label>
            </div>
            <div class="form-group">
                <label for="section_id">
                    部门：
                    <span class="color-red">*</span>
                </label>
                <select name="data[section_id]" id="data[section_id]" class="form-control">
                    <option value="">请选择</option>
                    @foreach($section as $r)
                    <option value="{{ $r->
                        id }}"@if($r->id == $info->section_id) selected="selected"@endif>{{ $r->name }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('data.section_id'))
                <span class="help-block">{{ $errors->first('data.section_id') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="role_id">
                    角色：
                    <span class="color-red">*</span>
                </label>
                @foreach($rolelist as $r)
                <label class="checkbox-inline"><input type="checkbox" name="role_id[]" value="{{ $r->
                    id }}" class="check-mr"> {{ $r->name }}</label>
            @endforeach
            </div>
            <div class="form-group">
                <label for="name">
                    真实姓名：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="data[realname]" class="form-control" value="{{ $info->
                realname }}">
            @if ($errors->has('data.realname'))
                <span class="help-block">{{ $errors->first('data.realname') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="name">
                    邮箱：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="data[email]" class="form-control" value="{{ $info->
                email }}">
            @if ($errors->has('data.email'))
                <span class="help-block">{{ $errors->first('data.email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="name">
                    电话：
                    <span class="color-red">*</span>
                </label>
                <input type="text" name="data[phone]" class="form-control" value="{{ $info->
                phone }}">
            @if ($errors->has('data.phone'))
                <span class="help-block">{{ $errors->first('data.phone') }}</span>
                @endif
            </div>
            <div class="form-group">
                <!-- 初始用户不能被禁用及删除 -->
                @if($info['id'] != 1)
                <label for="name">状态：</label>
                @if ($info['status'] == 1)
                <input type="radio" name="data[status]" checked="checked" class="input-radio" value="1">
                启用
                <input type="radio" name="data[status]" class="input-radio" value="0">
                禁用
            @else
                <input type="radio" name="data[status]" class="input-radio" value="1">
                启用
                <input type="radio" name="data[status]" checked="checked" class="input-radio" value="0">
                禁用
            @endif
            @endif
            </div>
        </div>
    </div>
    <div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>

<script>
    $(function(){
        var rids = [{!! $rids !!}];
        $(".check-mr").each(function(s){
            var thisVal = $(this).val();
            $.each(rids,function(i){
                if(rids[i] == thisVal){
                    $(".check-mr").eq(s).prop("checked",true);
                }
            });
        });
    })
</script>
@endsection