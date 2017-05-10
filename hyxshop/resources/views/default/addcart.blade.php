@extends('default.layout')


@section('title')
    <title>添加购物车成功-HYXSHOP</title>
@endsection


@section('content')
	<div class="container mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">添加购物车完成</span></h3>
		
		<a href="{{ url('/') }}" class="btn btn-success">继续购物</a> <a href="{{ url('/shop/cart') }}" class="btn btn-default">提交订单</a>

	</div>
@endsection