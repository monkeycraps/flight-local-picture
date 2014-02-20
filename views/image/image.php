<?php 
use RedBean_Facade as R;
?>
<h1>2013年会 - 美地农庄 - <?php echo $path ?></h1>

<div id="blueimp-gallery-carousel" class="blueimp-gallery blueimp-gallery-carousel">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<style>
.thundmail1{
	width: 100px;
}
</style>

<?php 
$sql = 'select o.* from object o inner join directory d on o.directory_id = d.id and d.path = ?';
$list = R::getAll($sql, array($path));

?>
<div id="links">
    <?php foreach( $list as $one ){?>
	    <a href="<?php echo preg_replace( '/^\.\//', '/', $one['path'] ) ?>" title="">
            <?php if($one['path_small']){ ?>
               <img src="<?php echo preg_replace( '/^\.\//', '/', $one['path_small'] ) ?>" alt="" class='thundmail1'>
            <? }else{ ?>
	           <img src="<?php echo preg_replace( '/^\.\//', '/', $one['path_small'] ) ?>" alt="" class='thundmail1'>
            <?php }?>
	    </a>
	<?php }?>
</div>

<script>

document.getElementById('links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};

// blueimp.Gallery(
//     document.getElementById('links').getElementsByTagName('a'),
//     {
//         container: '#blueimp-gallery-carousel',
//         carousel: true
//     }
// );
</script>