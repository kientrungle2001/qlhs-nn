<html>
<head>
<title>{prop title}</title>
<!--BEGIN META TAGS-->
<META NAME="keywords" CONTENT="{region keywords}">
<META NAME="description" CONTENT="{region description}">
<META NAME="rating" CONTENT="General">
<META NAME="ROBOTS" CONTENT="ALL">
<!--END META TAGS-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">
BASE_URL = '<?php echo BASE_URL ?>';
</script>
{children [id=head]}
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" background="{turl images/bckground.gif}">
<table cellspacing="0" cellpadding="0" border="0" height="66" width="100%" background="{turl images/topbarbkg.gif}">
  <tr valign="top"> 
    <td width="796" height="45">
	<div style="width:699px;height:91px;background:url({turl images/topbar.gif});">
	<div style="padding-top:22px;padding-left:15px;font-size:20px;">{prop sitename}</div>
	</div>
  </tr>
</table>
<table cellspacing="0" cellpadding="0" border="0" height="208" width="1162">
  <tr> 
    <td width="258" height="2" valign="top">
	{region menu}
    </td>
    <td width="885" height="2" valign="top"> 
      <div align="left">
		{children [id=right]}
		{region right}
		{pageappregion right}
        </div>
    <td width="19" height="2" valign="top" align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
      <style>BODY {
	SCROLLBAR-FACE-COLOR: #C40DC6; SCROLLBAR-HIGHLIGHT-COLOR: #FF6A02; SCROLLBAR-SHADOW-COLOR: #FF6A02; SCROLLBAR-3DLIGHT-COLOR: #41B7F2; SCROLLBAR-ARROW-COLOR: #FF6A02; SCROLLBAR-TRACK-COLOR: #41B7F2; SCROLLBAR-DARKSHADOW-COLOR: #000000
}
</style>
      </font> </td>
  </tr>
</table>
<?php if (count($data->jsInstances)) { ?>
		<script type="text/javascript">
			pzk_init(<?php echo json_encode($data->jsInstances) ?>);
		</script>
		<?php } ?>
</body>
</html>
