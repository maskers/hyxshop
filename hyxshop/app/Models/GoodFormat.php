<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodFormat extends Model
{
    // 商品属性值 表，存sku的
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'good_formats';

    // 不可以批量赋值的字段，为空则表示都可以
    protected $guarded = [];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $hidden = [];
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = true;

    // 关联商品
    public function good()
    {
        return $this->belongsTo('\App\Models\Good','good_id','id');
    }
}
