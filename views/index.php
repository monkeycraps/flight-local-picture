
<h1>2013年会 - 美地农庄</h1>
<?php 
use RedBean_Facade as R;
$sql = 'select path from directory group by path';
$list = R::getAll($sql);
?>
<ul>
	<?php foreach( $list as $one ){ ?>
		<li><a href='/image/<?= $one['path'] ?>' ><?= $one['path'] ?></a></li>
	<?php }?>  
</ul>


<h1>局域网图片管理</h1>

<p>在局域网搭建图片管理，拟定 01-23 周四下午4点分享此网站开发</p>

<h2>使用框架</h2>

<ul>
<li>nginx + php + sqlite + imageMagick</li>
<li>flight: php framework</li>
<li>redBean: php easy rom</li>
<li>jqurey: js framework</li>
<li>bootstrap: css + js framework</li>
<li>blueimp-gallery: image gallery</li>
<li>bower: js + css package manager</li>
<li>composer: php package manager</li>
</ul>


<h2>设计</h2>

<ul>
<li>nginx 前端转发</li>
<li>php 执行脚本</li>
<li>readBean 管理sqlite</li>
<li>sqlite 管理缓存</li>
<li>imageMagick 缩放图片</li>
</ul>


<h2>使用</h2>

<ul>
<li>composer 安装管理 php 包，flight， redbean</li>
<li>bower 安装管理 bootstrap, jqurey, blueimp-gallery</li>
<li>/update/@path 更新指定文件夹的图片资料到 sqlite</li>
<li>/image/@path 打开指定path 的图片列表</li>
<li>imageMagick 转换所有图片为 1560 大小尺寸</li>
</ul>
