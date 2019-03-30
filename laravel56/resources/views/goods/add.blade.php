<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <title></title>
    <link href="{{URL::asset('css/general.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('css/main.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{URL::asset('js/utils.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/selectzone.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/colorselector.js')}}"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="goods.php?act=list">商品列表</a></span>
    <span class="action-span1"><a href="index.php?act=main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 编辑商品信息 </span>
    <div style="clear:both"></div>
</h1>
<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
            <span class="tab-back" id="detail-tab">详细描述</span>
            <span class="tab-back" id="mix-tab">其他信息</span>
            <span class="tab-back" id="properties-tab">商品属性</span>
            <span class="tab-back" id="gallery-tab">商品相册</span>
        </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
        <form action="add" method="post" name="theForm" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152">

            <!-- 通用信息 -->
            <table width="90%" id="general-table" align="center" style="display: table;">
                <tbody>
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="诺基亚N85" size="30"><span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品货号： </td>
                    <td><input type="text" name="goods_num" value="ECS000032" size="20"><span id="goods_sn_notice"></span><br>
                        <span class="notice-span" style="display:block" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="type_id" id="">
                            <option value="0">请选择....</option>
                            <?php foreach($type as $key=>$val) { ?>
                            <option value="<?php echo $val->type_id?>"><?php echo $val->type_name?>
                            <?php foreach($val->children as $k=>$v) {?>
                            <option value="<?php echo $v->type_id?>"><?php echo '--'.$v->type_name?></option>
                            <?php } ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <select name="brand_id">
                            <option value="0">请选择...</option>
                            <?php foreach($brand as $key=>$val) { ?>
                            <option value="<?php echo $val->brand_id?>"><?php echo $val->brand_name?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">选择供货商：</td>
                    <td>
                        <select name="provider_id" id="suppliers_id">
                            <option value="0">不指定供货商属于本店商品</option>
                            <?php foreach($provider as $key=>$val) { ?>
                            <option value="<?php echo $val->provider_id?>"><?php echo $val->provider_name?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td><input type="text" name="shop_price"  size="20" class="shop_price">
                        <input type="button" value="按市场价计算" id="market_price">
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">会员价格：</td>
                    <td><input type="text" name="user_price" value="3010.00" size="20"></td>
                </tr>

                <tr>
                    <td class="label">市场售价：</td>
                    <td><input type="text" name="market_price"  size="20" class="marketPrice">
                        <input type="button" value="取整数" id="marketPrice">
                    </td>
                </tr>

                <tr>
                    <td class="label"><label for="is_promote"><input type="checkbox" name="is_promote" value="1" id="is_promote"  class="is_promote"> 促销价：</label></td>
                    <td id="promote_3"><input type="text" id="promote_1" name="promote_price" value="2750.00" size="20"></td>
                </tr>
                <tr id="promote_4">
                    <td class="label" id="promote_5">促销日期：</td>
                    <td id="promote_6">
                        <input name="promote_start_date" type="date">
                        <input name="promote_end_date" type="date">
                    </td>
                </tr>
                <tr>
                    <td class="label">上传商品图片：</td>
                    <td>
                        <input type="file" name="goods_img" size="35">
                        <a href="goods.php?act=show_image&amp;img_url=images/200905/goods_img/32_G_1242110760868.jpg" target="_blank"><img src="{{URL::asset('images/yes.gif')}}" border="0"></a>
                        <br><input type="text" size="40" value="商品图片外部URL" style="color:#aaa;" onfocus="if (this.value == '商品图片外部URL'){this.value='http://';this.style.color='#000';}" name="goods_img_url">
                    </td>
                </tr>
                <tr id="auto_thumb_1">
                    <td class="label"> 上传商品缩略图：</td>
                    <td id="auto_thumb_3">
                        <input type="file" name="goods_thumb" size="35" disabled="">
                        <a href="goods.php?act=show_image&amp;img_url=images/200905/thumb_img/32_thumb_G_1242110760196.jpg" target="_blank"><img src="{{URL::asset('images/yes.gif')}}" border="0"></a>
                        <br><input type="text" size="40" value="商品缩略图外部URL" style="color:#aaa;" onfocus="if (this.value == '商品缩略图外部URL'){this.value='http://';this.style.color='#000';}" name="goods_thumb_url" disabled="">
                        <br><label for="auto_thumb"><input type="checkbox" id="auto_thumb" name="auto_thumb" checked="true" value="1" onclick="handleAutoThumb(this.checked)">自动生成商品缩略图</label>            </td>
                </tr>
                </tbody></table>
            <div class="button-div">
                <input type="hidden" name="goods_id" value="32">
                <input type="submit" value=" 确定 " >
                <input type="reset" value=" 重置 " >
            </div>
            <input type="hidden" name="act" value="update">
        </form>
    </div>
</div>
<div id="footer">
    版权所有 &copy; 2006-2013
</div>
</body>
</html>
<script type="text/javascript" src="{{URL::asset('js/jquery-1.10.2.js')}}"></script>
<script type="text/javascript">
    $("#market_price").click(function()
    {
        var shop_price=$(".shop_price").val();
        //按市场价格计算打八折
        var market_price=(shop_price)*0.8;
        //替换原来的价格
        $(".shop_price").val(market_price);
    })
    $("#marketPrice").click(function()
    {
        var marketPrice=$(".marketPrice").val();
        var uu=Math.floor(marketPrice);
        $(".marketPrice").val(uu);

    })

</script>
