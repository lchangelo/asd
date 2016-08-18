<script>
<!--
//跳页的方法
function getPageInput(path,url) {
    var input=$("#pageIn").val();
    var maxpage=$("#getMaxpage").val();
    input=parseInt(input);
    maxpage=parseInt(maxpage);
    if(isNaN(input)||input==0||input>maxpage){
        $("#pageIn").val('');
        alert("请输入正确页码");
    }
    else{
        location.href=path+'pageNo='+input+url;
    }
}
-->
</script>
<?php if($page['sum']): ?>
<div style="text-align:center;">
<div style="float:left; font-size:18px;">&nbsp;&nbsp; 第 <?= $page['pageNo'] ?><b>/</b><?= $page['maxpage'] ?> 页 | 共 <?= $page['sum'] ?> 条 </div>
<a>
<input type="text" name="pageInput"  size="5" id="pageIn" onkeyup="value=value.replace(/[^\d]/g,'')" 
onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
<input type="button" onclick="getPageInput('<?= $url['path'] ?>','<?= $url['url'] ?>')" value="GO!" />&nbsp;&nbsp;
<input type="hidden" id="getMaxpage" value="<?= $page['maxpage']?>" />
</a>
<a <?php if($page['pageNo']>1)echo 'href='.$url['path'].'pageNo=1'.$url['url'];?> >
<img src="images/home.gif" />&nbsp;&nbsp;
</a> 
<a <?php if($page['prepg']>=1)echo 'href='.$url['path'].'pageNo='.$page['prepg'].$url['url'];?> > 
<img src="images/pre.gif" width="61" height="20" />&nbsp;&nbsp;
</a>
<a <?php if($page['nextpg']<=$page['maxpage'])echo 'href='.$url['path'].'pageNo='.$page['nextpg'].$url['url'];?> >
<img src="images/next.gif" />&nbsp;&nbsp;
</a>
<a <?php if($page['pageNo']<$page['maxpage'])echo 'href='.$url['path'].'pageNo='.$page['maxpage'].$url['url'];?> >
<img src="images/end.gif" />&nbsp;&nbsp;
</a>
</div>
<?php endif;?>