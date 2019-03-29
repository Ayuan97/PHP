<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 属性管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="_token" content="{{csrf_token()}}">
<link href="{{URL::asset('css/general.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('css/main.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="{{URL('Admin/Attribute/attribute_add')}}">添加属性</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品属性 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="" name="searchForm">
    <img src="{{URL::asset('images/icon_search.gif')}}" width="26" height="22" border="0" alt="SEARCH">
    按商品类型显示：<select name="goods_type" onchange="searchAttr(this.value)"><option value="0">所有商品类型</option><option value="1" selected="true">书</option><option value="2">音乐</option><option value="3">电影</option><option value="4">手机</option><option value="5">笔记本电脑</option><option value="6">数码相机</option><option value="7">数码摄像机</option><option value="8">化妆品</option><option value="9">精品手机</option><option value="10">我的商品</option></select>
  </form>
</div>
<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
<form method="post" action="attribute.php?act=batch" name="listForm">
<div class="list-div" id="listDiv">
<center>
  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th><input type="checkbox">编号 </th>
			<th>属性名称</th>
			<th>商品类型</th>
			<th>属性值的录入方式</th>
			<th>可选值列表</th>
			<th>排序</th>
			<th>操作</th>
		</tr>
        @foreach($data as $key=>$val)
        <tr>
          <td><input type="checkbox">{{$val->attr_id}}</td>
          <td>{{$val->attr_name}}</td>
          <td>{{$val->goods_type}}</td>
          <td>{{$val->attr_input_type}}</td>
          <td>{{$val->attr_values}}</td>
          <td>{{$val->sort_order}}</td>
          <td>
            <a href="attribute_edit?id={{$val->attr_id}}">编辑</a>
            <a href=" {{url('Admin/Attribute/arrtibute_del',['id'=>$val->attr_id])}} ">删除</a>
          </td>
        </tr>
        @endforeach

      </tbody>
  </table>
    <a href="javascript:void (0)" onclick="page(1)">首页</a>
    <a href="javascript:void (0)" onclick="page({{$prev}})">上一页</a>
    <a href="javascript:void (0)" onclick="page({{$next}})">下一页</a>
    <a href="javascript:void (0)" onclick="page({{$sum}})">尾页</a>
</center>
</div>

</form>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
<script type="text/javascript" src="{{URL::asset('/js/jquery.js')}}"></script>
<script type="text/javascript">
    function page(page) {
        $.ajax({
            type:'get',
            url:'attribute_list',
            data:{page:page},
            headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content  ')},
            success:function (msg) {

                $('html').html(msg);

            }
        });
    }
</script>
</html>