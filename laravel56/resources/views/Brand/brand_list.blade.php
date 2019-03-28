<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 品牌管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="{{URL::asset('css/general.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('css/main.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="{{URL::asset('Admin/Brand/brand_add')}}">添加品牌</a></span>
<span class="action-span1"><a href="{{URL::asset('Admin/Index/index')}}">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品品牌 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="javascript:search_brand()" name="searchForm">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <img src="{{URL::asset('images/icon_search.gif')}}" width="26" height="22" border="0" alt="SEARCH">
      <input type="text" name="brand_name" size="15" placeholder="请输入品牌名称查找" id="brand_name">
    <input type="button" value=" 搜索 " onclick="page()">
  </form>
</div>

<form method="post" action="" name="listForm">
<!-- start brand list -->
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th>品牌名称</th>
			<th>品牌LOGO</th>
			<th>品牌网址</th>
			<th>品牌描述</th>
			<th>排序</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
        <?php
            foreach ($data as $k=>$v)
            {
        ?>
            <tr>
                <td align="center"><b><?php echo $v->brand_name; ?></b></td>
                <td align="center"><img src="<?php echo $v->brand_logo?>" style="width: 50px;height: 50px;"></td>
                <td align="center"><a href="<?php echo $v->site_url?>"><?php echo $v->site_url?></a></td>
                <td align="center"><?php echo $v->brand_desc?></td>
                <td align="center"><?php echo $v->sort?></td>
                <td align="center">
                    <?php
                        if($v->is_show == 1)
                        {
                    ?>
                        <img src="{{URL::asset('images/yes.gif')}}" width="20" height="22">
                    <?php
                        }
                        else if($v->is_show == 0)
                        {
                    ?>
                        <img src="{{URL::asset('images/no.gif')}}" width="20" height="22">
                    <?php } ?>
                </td>
                <td align="center">
                    <a href='{{URL::asset("Admin/Brand/brand_upd?brand_id={$v->brand_id}")}}'>编辑</a> |
                    <input type="button" onclick="del({{$v->brand_id}})" value="删除" >
                </td>
            </tr>
        <?php } ?>
    <tr>
        <td></td>
		<td align="right" nowrap="true" colspan="6">
            <div id="turn-page">
        总计<span id="totalRecords"><?php echo $count?></span>个记录&nbsp;&nbsp;&nbsp;
        分为<span id="totalPages"><?php echo $page_num?></span>页&nbsp;&nbsp;&nbsp;
        当前第<span id="pageCurrent">1</span>页
        <span id="page-link">
            <a href="javascript:void(0)" onclick="page(1)">首页</a>
            <a href="javascript:void(0)" onclick="page({{$prev}})">上一页</a>
            <a href="javascript:void(0)" onclick="page({{$next}})">下一页</a>
            <a href="javascript:void(0)" onclick="page({{$page_num}})">尾页</a>
          <select id="gotoPage" onchange="page.gotoPage(this.value)">
                    <option value="1">1</option>
          </select>
        </span>
      </div>
      </td>
    </tr>
  </tbody></table>
<!-- end brand list -->
</div>
</form>
<div id="footer">
    版权所有 &copy; 2018-2019 八维教育 - 1607A - </div>
</div>
</body>
</html>
<script src="{{URL::asset('js/jquery.js')}}"></script>
<script>
    function page(page) {
        var brand_name = $('#brand_name').val();
        $.ajax({
            type:'get',
            url:'brand_list',
            data:{page:page,brand_name:brand_name},
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success:function (e) {
                $('body').html(e);
            }
        })
    }

    function del(brand_id) {
        var brand_name = $('#brand_name').val();
        $.ajax({
            type:'get',
            url:'brand_del',
            data:{brand_id:brand_id,brand_name:brand_name},
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success:function (msg) {
                $("body").html(msg);
            }
        })
    }
</script>
