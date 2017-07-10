<?php defined('IN_DESTOON') or exit('Access Denied');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo DT_CHARSET;?>"/>
<title><?php if($seo_title) { ?><?php echo $seo_title;?><?php } else { ?><?php if($head_title) { ?><?php echo $head_title;?><?php echo $DT['seo_delimiter'];?><?php } ?>
<?php echo $DT['sitename'];?><?php } ?>
</title>
<meta http-equiv="x-ua-compatible" content="IE=7"/>
<link rel="stylesheet" type="text/css" href="<?php echo DT_SKIN;?>style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo DT_SKIN;?>know.css"/>
<script type="text/javascript" src="<?php echo DT_STATIC;?>lang/<?php echo DT_LANG;?>/lang.js"></script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/config.js"></script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/jquery.js"></script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/common.js"></script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/page.js"></script>
<script type="text/javascript">
if(parent.location == window.location) Go('<?php echo $linkurl;?>');
</script>
</head>
<body>
<div id="destoon_answer">
<?php if($action == 'vote_show') { ?>
<div class="m">
<div class="answer_box">
<div class="left_head">投票结果</div>
<div style="padding:15px;">
<table cellpadding="6" cellspacing="1" width="100%" align="center" bgcolor="#DDDDDD">
<tr bgcolor="#F1F1F1" align="center">
<td>回答者</td>
<td>票数</td>
<td width="200">&nbsp;</td>
<td>比例</td>
</tr>
<?php if(is_array($votes)) { foreach($votes as $v) { ?>
<tr bgcolor="#FFFFFF" align="center">
<td>
<?php if($v['hidden']) { ?>
匿名
<?php } else { ?>
<?php if($v['username']) { ?>
<a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?username='.$v['username']);?>" class="b" target="_blank" rel="nofollow"><?php echo $v['username'];?></a>
<?php } else { ?>
<span title="<?php echo hide_ip($v['ip']);?>"><?php echo ip2area($v['ip']);?>访客</span>
<?php } ?>
<?php } ?>
</td>
<td class="px11"><?php echo $v['vote'];?></td>
<td align="left"><div class="vote_b"><div class="vote_s" style="width:<?php echo $v['precent'];?>;"> </div></div></td>
<td class="px11"><?php echo $v['precent'];?></td>
</tr>
<?php } } ?>
</table>
</div>
<center><input type="button" value="返 回" onclick="Go('answer.php?itemid=<?php echo $itemid;?>');" class="answer_btn"/></center>
<br/>
</div>
</div>
<?php } else { ?>
<div class="m">
<div class="answer_box">
<iframe src="" name="send" id="send" style="display:none;"></iframe>
<?php if($could_admin && $item['process']==1) { ?>
<div class="left_head">处理提问</div>
<div class="question_op">
<div><span class="px14">如果已获得满意的回答，请及时采纳，感谢回答者。若还没有满意的回答，可以尝试以下操作： </span></div>
<?php if($items>1) { ?>
<div><a href="answer.php?itemid=<?php echo $itemid;?>&action=vote" onclick="return confirm('确定要举行投票吗？');" class="f_b px13" target="_top">举行投票</a><span class="f_gray"> - 不知道哪个回答最好，让网友投票来选出最佳答案;</span></div>
<?php } ?>
<div><a href="javascript:" onclick="Ds('add_content');H();" class="f_b px13">补充问题</a><span class="f_gray"> - 补充提问细节，以得到更准确的答案;</span></div>
<div id="add_content" style="display:none;background:#F1F1F1;padding:15px;">
<form method="post" action="answer.php" target="_top">
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="action" value="addition"/>
<textarea name="content" id="content" style="width:90%;height:80px;margin:0 0 10px 0;"><?php echo $item['addition'];?></textarea><br/>
<input type="submit" value=" 确 认 " class="answer_btn"/>
<input type="button" value=" 取 消 " class="answer_btn" onclick="Dh('add_content');H();"/>
</form>
</div>
<?php if($item['raise'] < $MOD['maxraise']) { ?>
<div><a href="javascript:" onclick="Ds('add_credit');H();" class="px13 f_b">提高悬赏</a><span class="f_gray"> - 提高悬赏，以提高问题的关注度;</span></div>
<div id="add_credit" style="display:none;background:#F1F1F1;padding:15px;">
<form method="post" action="answer.php" target="_top">
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="action" value="raise"/>
提问期内，可以追加悬赏 <strong class="f_red"><?php echo $MOD['maxraise'];?></strong> 次(已追加<strong><?php echo $item['raise'];?></strong>次)。悬赏一次，可延长问题的有效期 <strong class="f_blue"><?php echo $MOD['raisedays'];?></strong> 天。<br/> 
当您一次悬赏的<?php echo $DT['credit_name'];?>高于 <strong>20</strong> 分时，该问题将等同于新提出的问题，在所属分类的问题列表中显示为最新。 <br/>
追加悬赏
<select name="credit">
<?php if(is_array($CREDITS)) { foreach($CREDITS as $v) { ?>
<?php if($v>0) { ?><option value="<?php echo $v;?>"><?php echo $v;?></option><?php } ?>
<?php } } ?>
</select>
分  当前<?php echo $DT['credit_name'];?> <strong class="f_blue"><?php echo $_credit;?></strong><br/>
<div style="padding:5px 0 5px 0;">
<input type="submit" value=" 确 认 " class="answer_btn"/>
<input type="button" value=" 取 消 " class="answer_btn" onclick="Dh('add_credit');H();"/>
</form>
</div>
</div>
<?php } ?>
<div><a href="answer.php?itemid=<?php echo $itemid;?>&action=close" onclick="return confirm('确定要关闭这个问题吗？');" class="f_b px13" target="_top">关闭问题</a><span class="f_gray"> - 没有满意的回答 ，可以直接结束提问，关闭问题;</span></div>
</div>
<?php } ?>
</div>
</div>
<div id="destoon_answers">
<?php if($answers) { ?>
<?php if(is_array($answers)) { foreach($answers as $k => $v) { ?>
<?php if($k==count($answers)-1) { ?><a name="last"></a><?php } ?>
<div class="m">
<div class="know_show">
<table>
<tr>
<td valign="top" class="know_show_l">
<ul>
<?php if($v['hidden']) { ?>
<li id="u_<?php echo $v['itemid'];?>"><strong>匿名</strong></li>
<li><img src="<?php echo useravatar('', 'large');?>" alt=""/></li>
<?php } else { ?>
<li id="u_<?php echo $v['itemid'];?>">
<?php if($v['username']) { ?>
<a href="<?php echo $MOD['linkurl'];?><?php if($v['expert']) { ?><?php echo rewrite('expert.php?username='.$v['username']);?><?php } else { ?><?php echo rewrite('search.php?username='.$v['username']);?><?php } ?>
" target="_blank" class="b"><strong><?php echo $v['username'];?></strong></a>
<?php } else { ?>
<strong title="<?php echo hide_ip($item['ip']);?>"><?php echo ip2area($item['ip']);?>访客</strong>
<?php } ?>
</li>
<li><img src="<?php echo useravatar($v['username'], 'large');?>" alt=""/></li>
<?php if($v['username'] && $DT['im_web']) { ?><li><?php echo im_web($v['username'], 1);?></li><?php } ?>
<?php } ?>
<?php if($v['expert']) { ?><li class="f_red">知道专家</li><?php } ?>
<li></li>
</ul>
</td>
<td valign="top">
<div class="know_info">
<span class="f_r g_gray">
<?php if($could_admin && $item['process'] == 1) { ?>
<span onclick="choose_answer(<?php echo $v['itemid'];?>);" class="c_p f_dblue">采纳为答案</span>&nbsp;
<?php } ?>
<?php if($item['process'] == 2) { ?>
<?php if($could_admin) { ?>
<span onclick="if(confirm('确定要移除此投票选项吗？')) Dd('send').src='answer.php?itemid=<?php echo $itemid;?>&aid=<?php echo $v['itemid'];?>&action=vote_del';" class="c_p f_dblue"/>移除选项</span>&nbsp;
<?php } ?>
<?php if(!$could_vote || $could_admin) { ?>
<span onclick="Go('answer.php?itemid=<?php echo $itemid;?>&action=vote_show');" class="c_p f_dblue"/>投票结果</span>&nbsp;
<?php } ?>
<?php if($could_vote) { ?>
<span onclick="Dd('send').src='answer.php?itemid=<?php echo $itemid;?>&aid=<?php echo $v['itemid'];?>&action=vote_add';" class="c_p f_dblue"/>投一票</span>&nbsp;
<?php } ?>
<?php } ?>
</span>
<span class="px11"><?php echo timetodate($v['addtime'], 5);?></span>
</div>
<div class="content" id="a_<?php echo $v['itemid'];?>"><?php echo $v['content'];?></div>
</td>
</tr>
</table>
</div>
</div>
<?php } } ?>
<?php if($pages) { ?><div class="pages"><?php echo $pages;?></div><?php } ?>
<?php } ?>
</div>
<div class="m">
<div id="choose_form" style="display:none;">
<div class="answer_box">
<div class="left_head">采纳答案</div>
<div class="answer_body" id="choose_a"></div>
<div class="answer_foot" id="choose_u"></div>
<form method="post" action="answer.php" target="_top" onsubmit="return choose_check();">
<input type="hidden" name="aid" id="aid" value="0"/>
<input type="hidden" name="action" value="choose"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<table width="100%" cellpadding="8" cellspacing="0">
<tr>
<td align="right" valign="top" class="px14"><br/>感谢语或评论：</td>
<td><textarea rows="6" cols="70" name="thx" id="thx_content" class="f_gray" onfocus="if(this.value=='说声谢谢，感谢回答者的无私帮助'){this.value='';this.className='';}">说声谢谢，感谢回答者的无私帮助</textarea>
</td>
</tr>
<tr>
<td align="right"  class="px14">额外奖励：</td>
<td>
<select name="credit" id="choose_credit">
<option value="0">0</option>
<?php if(is_array($CREDITS)) { foreach($CREDITS as $v) { ?>
<?php if($v>0) { ?><option value="<?php echo $v;?>"><?php echo $v;?></option><?php } ?>
<?php } } ?>
</select>
<span class="f_gray">如果您对这一回答非常满意,您可以选择给回答者额外的奖励</span>
</td>
</tr>
<tr>
<td> </td>
<td>
<input type="submit" value=" 确 认 " class="answer_btn"/>
<input type="button" value=" 取 消 " class="answer_btn" onclick="choose_cancel();"/>
</td>
</tr>
</table>
</form>
</div>
</div>
</div>
<script type="text/javascript">
function choose_check() {
return true;
}
function choose_answer(id) {
Dd('choose_a').innerHTML = Dd('a_'+id).innerHTML;
Dd('choose_u').innerHTML = Dd('u_'+id).innerHTML;
Dd('aid').value = id;
Ds('choose_form');
H();
Dd('choose_credit').focus();
}
function choose_cancel() {
Dd('choose_a').innerHTML = '';
Dd('choose_u').innerHTML = '';
Dd('aid').value = 0;
Dh('choose_form');
H();
}
</script>
<?php if($could_answer) { ?>
<div class="m">
<div class="answer_box">
<div class="left_head">我来回答</div>
<form method="post" action="answer.php" target="send" id="dform" onsubmit="return check();">
<input type="hidden" name="items" value="<?php echo $items;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<div class="px14">
<table width="100%" cellpadding="8" cellspacing="1">
<tr>
<td align="right" valign="top"><br/>我来回答：</td>
<td><textarea name="content" id="content" style="display:none;"></textarea>
<script type="text/javascript">var ModuleID = <?php echo $moduleid;?>;var DTAdmin = 0;var EDPath = "<?php echo $MODULE['2']['linkurl'];?>fckeditor/";var EDW = "98%";var FCKID = "content";</script><script type="text/javascript" src="<?php echo $MODULE['2']['linkurl'];?>fckeditor/fckeditor.js"></script>
<br/><span id="dcontent" class="f_red px12"></span>
</td>
</tr>
<tr>
<td align="right">参考资料：</td>
<td><input type="text" name="url" size="60" id="url"/></td>
</tr>
<?php if($_userid) { ?>
<tr>
<td align="right">匿名设定：</td>
<td class="px12"><input type="checkbox" name="hidden" value="1" id="hidden"/> 如果不需要显示您的信息，您可以对回答设定匿名</td>
</tr>
<?php } ?>
<?php if($need_question) { ?>
<tr onmouseout="H();">
<td align="right"><span class="f_red">*</span> 验证问题：</td>
<td class="px12"><?php include template('question', 'chip');?> <span id="danswer" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($need_captcha) { ?>
<tr>
<td align="right"><span class="f_red">*</span> 验证码：</td>
<td class="px12"><?php include template('captcha', 'chip');?> <span id="dcaptcha" class="f_red"></span></td>
</tr>
<?php } ?>
<tr>
<td> </td>
<td class="px12">
<input type="submit" name="submit" value=" 提交回答 " class="answer_btn"/>&nbsp;&nbsp;
<a href="<?php echo $MOD['linkurl'];?>faq.php#credit" target="_blank" class="b"><?php echo $DT['credit_name'];?>规则</a>
</td>
</tr>
<?php if(!$_userid) { ?>
<tr>
<td> </td>
<td class="px14 f_gray">
登录后回答可以获得<?php echo $DT['credit_name'];?>奖励，并可以查看和管理所有的回答。<a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>" target="_top" class="b">登录</a> | <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_register'];?>" target="_top" class="b">注册</a><br/>
</td>
</tr>
<?php } ?>
</table>
</div>
</form>
</div>
</div>
</div>
<?php echo load('clear.js');?>
<script type="text/javascript">
function check() {
var l;
var f;
f = 'content';
l = FCKLen();
if(l < 5) {
Dmsg('内容应最少5字，当前已输入'+l+'字', f);
return false;
}
<?php if($need_captcha) { ?>
f = 'captcha';
l = Dd(f).value;
if(!is_captcha(l)) {
Dmsg('请填写正确的验证码', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
<?php if($need_question) { ?>
f = 'answer';
l = Dd(f).value.length;
if(l < 1) {
Dmsg('请填写验证问题', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
}
try{parent.Dd('answer_btn').style.display = '';}catch(e){}
</script>
<?php } ?>
<?php } ?>
<script type="text/javascript">
function H() {
try{parent.Dd('destoon_answer').style.height = Dd('destoon_answer').scrollHeight+'px';}
catch(e){}
}
function ImgZoom(i, m) {
var m = m ? m : 550; var w = i.width;
if(w < m) return;
var h = i.height;
i.title = L['click_open'];
i.height = parseInt(h*m/w);
i.width = m;
i.onclick = function (e) {window.open(EXPath+'view.php?img='+i.src);}
}
function Z() {
try {
var content_id = 'destoon_answers';
var img_max_width = <?php echo $MOD['max_width'];?>;
var Imgs = Dd(content_id).getElementsByTagName("img");
for(var i=0;i<Imgs.length;i++) {ImgZoom(Imgs[i], img_max_width);}
var Links = Dd(content_id).getElementsByTagName("a");
for(var i=0;i<Links.length;i++){if(Links[i].target != '_blank') {if(document.domain && Links[i].href.indexOf(document.domain) == -1) Links[i].target = '_blank';}}
} catch(e) {}
}
window.onload = function() {
<?php if($could_answer) { ?>
var sBasePath = "<?php echo $MODULE['2']['linkurl'];?>fckeditor/";var oFCKeditor = new FCKeditor("content");oFCKeditor.Width = "98%";oFCKeditor.Height = "200px";oFCKeditor.BasePath = sBasePath;oFCKeditor.ToolbarSet = "Basic";oFCKeditor.ReplaceTextarea();
<?php } ?>
Z();
H();
}
</script>
<?php if($could_answer) { ?><?php echo load('fckeditor.js');?><?php } ?>
</body>
</html>