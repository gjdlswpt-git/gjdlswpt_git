<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="m_l f_l">
<?php if($MOD['page_irec']) { ?>
<div class="box_head"><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?typeid=4');?>" rel="nofollow">更多&raquo;</a></span><strong>精彩推荐</strong></div>
<div class="box_body"><?php echo tag("moduleid=$moduleid&condition=status=3 and level>0&areaid=$cityid&order=".$MOD['order']."&pagesize=".$MOD['page_irec']."&datetype=4&template=list-know");?></div>
<div class="b10"></div>
<?php } ?>
<?php if($MOD['page_isolve']) { ?>
<div class="box_head"><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?typeid=1');?>" rel="nofollow">更多&raquo;</a></span><strong>待解决的问题</strong></div>
<div class="box_body"><?php echo tag("moduleid=$moduleid&condition=status=3 and process=1&areaid=$cityid&order=".$MOD['order']."&pagesize=".$MOD['page_isolve']."&datetype=4&template=list-know");?></div>
<div class="b10"></div>
<?php } ?>
<?php if($MOD['page_iresolve']) { ?>
<div class="box_head"><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?typeid=0');?>" rel="nofollow">更多&raquo;</a></span><strong>已解决的问题</strong></div>
<div class="box_body"><?php echo tag("moduleid=$moduleid&condition=status=3 and process=3&order=updatetime desc&areaid=$cityid&pagesize=".$MOD['page_iresolve']."&datetype=4&template=list-know");?></div>
<div class="b10"></div>
<?php } ?>
<?php if($MOD['page_ivote']) { ?>
<div class="box_head"><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?typeid=2');?>" rel="nofollow">更多&raquo;</a></span><strong>投票中的问题</strong></div>
<div class="box_body"><?php echo tag("moduleid=$moduleid&condition=status=3 and process=2&order=updatetime desc&areaid=$cityid&pagesize=".$MOD['page_ivote']."&datetype=4&template=list-know");?></div>
<div class="b10"></div>
<?php } ?>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r f_l">
<div class="box_head"><div><strong>问题搜索</strong></div></div>
<div class="box_body">
<div class="know_sch">
<form action="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>" id="ask_form">
<input type="hidden" name="mid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="cid" value="<?php echo $catid;?>"/>
<input type="hidden" name="action" value="add"/>
<input type="hidden" name="kw" value="" id="ask_kw"/>
</form>
<form action="<?php echo $MOD['linkurl'];?>search.php" onsubmit="return know_sch_check();">
<input type="hidden" name="typeid" value="99" id="know_typeid"/>
<input type="text" name="kw" id="know_kw" value="请输入问题" class="know_sch_inp" onfocus="if(this.value=='请输入问题')this.value='';"/>
<div class="know_sch_btn">
<input type="submit" value="搜索答案" onclick="Dd('know_typeid').value=99;"/>&nbsp;
<input type="submit" value="我要回答" onclick="Dd('know_typeid').value=3;"/>&nbsp;
<input type="button" value="我要提问" onclick="if(know_sch_check()){Dd('ask_kw').value=Dd('know_kw').value;Dd('ask_form').submit();}"/>&nbsp;
</div>
</form>
<script type="text/javascript">
function know_sch_check() {
if(Dd('know_kw').value == '请输入问题' || Dd('know_kw').value.length < 1) {
alert('请输入问题');
Dd('know_kw').focus();
return false;
}
return true;
}
</script>
<div class="know_sch_item">
已解决问题数：<?php echo $db->count($table, 'status=3 and process=3', 1800);?>&nbsp;&nbsp;&nbsp;
待解决问题数：<?php echo $db->count($table, 'status=3 and process=1', 1800);?>
</div>
</div>
</div>
<div class="b10"></div>
<div class="box_head"><div><strong>问题分类</strong></div></div>
<div class="box_body">
<div class="know_catalog">
<?php $child = get_maincat(0, $moduleid, 1);?>
<?php if(is_array($child)) { foreach($child as $i => $c) { ?>
<p><a href="<?php echo $MOD['linkurl'];?><?php echo $c['linkurl'];?>"><strong class="px14"><?php echo set_style($c['catname'], $c['style']);?></strong></a> <span class="f_gray px10">(<?php echo $c['item'];?>)</span></p>
<?php if($c['child']) { ?>
<div>
<?php $sub = get_maincat($c['catid'], $moduleid, 1);?>
<?php if(is_array($sub)) { foreach($sub as $j => $s) { ?><a href="<?php echo $MOD['linkurl'];?><?php echo $s['linkurl'];?>"><?php echo set_style($s['catname'], $s['style']);?></a>&nbsp;|&nbsp;<?php } } ?>
</div>
<?php } ?>
<?php } } ?>
</div>
</div>
<?php if($MOD['page_iexpert']) { ?>
<div class="b10"></div>
<div class="box_head"><div><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('expert.php?page=1');?>">更多&raquo;</a></span><strong>知道专家</strong></div></div>
<div class="box_body">
<?php $tags=tag("table=know_expert&condition=1&pagesize=".$MOD['page_iexpert']."&order=addtime desc&template=null");?>
<?php if(is_array($tags)) { foreach($tags as $t) { ?>
<div class="know_expert">
<a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('expert.php?itemid='.$t['itemid']);?>" target="_blank"><img src="<?php echo useravatar($t['username'], 'large');?>" width="80" alt="<?php echo $t['alt'];?>"/></a><div><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('expert.php?itemid='.$t['itemid']);?>" target="_blank" title="<?php echo $t['alt'];?>" class="b"><strong><?php echo $t['title'];?></strong></a><br/><?php echo dsubstr($t['introduce'], 86, '..');?></div>
</div>
<?php } } ?>
</div>
<?php } ?>
</div>
</div>
<?php include template('footer');?>