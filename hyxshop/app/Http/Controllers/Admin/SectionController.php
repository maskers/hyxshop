<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function getIndex(Request $res)
    {
    	$title = '部门列表';
        $list = Section::orderBy('id','desc')->paginate(15);
        // 保存一次性数据，url参数，供编辑完成后跳转用
        $res->flash();
        return view('admin.section.index',compact('list','title'));
    }

    // 添加部门
    public function getAdd()
    {
        $title = '添加部门';
        return view('admin.section.add',compact('title'));
    }

    public function postAdd(SectionRequest $request)
    {
        $data = $request->input('data');
        Section::create($data);
        return redirect('xyshop/section/index')->with('message', '添加部门成功！');
    }
    // 修改部门
    public function getEdit($id)
    {
        $title = '修改部门';
        // 拼接返回用的url参数
        $ref = '?page='.old('page');
        $info = Section::findOrFail($id);
        return view('admin.section.edit',compact('title','info','ref'));
    }
    public function postEdit(SectionRequest $request,$id)
    {
        Section::where('id',$id)->update($request->input('data'));
        return redirect('xyshop/section/index'.$request->input('ref'))->with('message', '修改部门成功！');
    }
    // 删除部门
    public function getDel($id)
    {
        // 查询下属用户
        if(is_null(Admin::where('section_id',$id)->first()))
        {
            // 开启事务
            DB::beginTransaction();
            try {
                // 同时删除关联的用户关系
                Section::destroy($id);
                // 没出错，提交事务
                DB::commit();
                return back()->with('message', '删除部门成功！');
            } catch (Exception $e) {
                // 出错回滚
                DB::rollBack();
                return back()->with('message','删除失败，请稍后再试！');
            }
        }
        else
        {
            return back()->with('message', '部门下有用户！');
        }
        
    }
}
