<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
use DB;

class PayController extends Controller
{
    // 
    public function getIndex(Request $res)
    {
    	$title = '支付配置';
        $list = Pay::where('status',1)->orderBy('id','asc')->get();
        return view('admin.pay.index',compact('list','title'));
    }
    // 修改支付配置
    public function getEdit($id)
    {
        $title = '修改支付配置';
        $info = Pay::findOrFail($id);
        $setting = json_decode($info->setting,true);
        return view('admin.pay.'.$info->code,compact('title','info','setting'));
    }
    public function postEdit(Request $req,$id)
    {
        $data = ['paystatus'=>$req->input('data.paystatus'),'setting'=>json_encode($req->input('set'))];
        // 添加，事务
        DB::beginTransaction();
        try {
            Pay::where('id',$id)->update($data);
            // 没出错，提交事务
            DB::commit();
            return redirect('xyshop/pay/index')->with('message', '修改支付配置成功！');
        } catch (Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','修改失败，请稍后再试！');
        }
    }

}
