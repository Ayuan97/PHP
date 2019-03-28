<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SHOP 管理中心 - 类型管理 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{URL::asset('css/general.css')}}" rel="stylesheet" type="text/css" />.
    <link href="{{URL::asset('css/main.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
</head>
<body>

<h1>
    <span class="action-span"><a href="{{URL('Admin/Goods/goods_type_add')}}">新建商品类型</a></span>
    <span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品类型 </span>
    <div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
    <!-- start goods type list -->
    <div class="list-div" id="listDiv">

        <table width="100%" cellpadding="3" cellspacing="1" id="listTable">
            <tbody>
            <tr>
                <th>商品类型名称</th>
                <th>属性分组</th>
                <th>属性数</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            @foreach($data as $val)
            <tr data-id="{{$val->cat_id}}">
                <td class="first-cell"><span onclick="javascript:listTable.edit(this, 'edit_type_name', 1)">{{$val->cat_name}}</span></td>
                <td></td>
                <td align="right">12</td>
                <td align="center"><span class="status" val="{{$val->status}}"><img src="{{URL::asset('images/yes.gif')}}"></span></td>
                <td align="center">
                    <a href="attribute.php?act=list&amp;goods_type=1" title="属性列表" value="{{$val->cat_id}}">属性列表</a> |
                    <a href="{{URL('Admin/Goods/goods_type_edit')}}?cat_id={{$val->cat_id}}" title="编辑">编辑</a> |
                    <a href="javascript:void(0);"  class="delete" title="移除">移除</a>
                </td>
            </tr>
            @endforeach
            <tr>
                <td align="right" nowrap="true" colspan="6" style="background-color: rgb(255, 255, 255);">
                    <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
                    <div id="turn-page">
                        总计  <span id="totalRecords">{{$limit}}</span>
                        个记录分为 <span id="totalPages">1</span>
                        页当前第 <span id="pageCurrent">{{$page}}</span>
                        页，每页 <input type="text" size="3" id="pageSize" value="10" onkeypress="return listTable.changePageSize(event)">
                        <span id="page-link">
          <a href="{{URL('Admin/Goods/goods_type_list')}}?page=1">第一页</a>
          <a href="{{URL('Admin/Goods/goods_type_list')}}?page=<?= max($page-1,1)?>">上一页</a>
          <a href="{{URL('Admin/Goods/goods_type_list')}}?page=<?= min($page+1,$sum)?>">下一页</a>
          <a href="{{URL('Admin/Goods/goods_type_list')}}?page= <?= $sum?>">最末页</a>
          <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
            <option value="1">1</option>          </select>
        </span>
                    </div>
                </td>
            </tr>
            </tbody></table>

    </div>
    <!-- end goods type list -->
</form>

<div id="footer">
    版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>
<script>
    $('#pageSize').blur(function () {
        var limit = $('#pageSize').val()
        $.ajax({
            type:'post',
            url:'Admin/Goods/goods_type_list',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            data:{limit:limit},
            success:function (e) {
                    console.log(e);
            }
        })
    })
    $('.status').click(function () {
        var status = $(this).attr('val');
        var cat_id = $(this).parents('tr').data('id');
        $.ajax({
            type:'post',
            url:"{{URL('Admin/Goods/goods_type_edit_status')}}",
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            data:{status:status,cat_id:cat_id},
            success:function (e) {
               console.log(e);
            }
        })
    })
    $('.delete').click(function () {
        var obj = $(this);
        var cat_id = obj.parents('tr').data('id');
        if(confirm('删除商品类型将会清除该类型下的所有属性。\n您确定要删除选定的商品类型吗？')==true){
            $.ajax({
                type:'post',
                url:"{{URL('Admin/Goods/goods_type_delete')}}",
                headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                data:{cat_id:cat_id},
                dataType:'json',
                success:function (e) {
                    if(e.code == 200)
                    {
                        alert(e.message);
                        tr = obj.parents('td').parents('tr').remove();
                    }else{
                        alert(e.message);
                    }

                }
            })
        }else{
            return false;
        }

    })
</script>