<?php $uri= $_SERVER['REQUEST_URI'];
$uri = explode('/',$uri);

?>
<script type="text/javascript">
<!--
if (screen.width >= 699) {
document.location = "../<?php echo end($uri);?>";
}
//-->
</script>