<?php

/**
* @Author Xman (admin@user.vn)
* @Website http://user.vn
* @Description Get rows from catid
*/
if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$catid = 36; # cat id
$num = 7; # amount rows to get
$striptext = 100; #cutout long text
$imgwidth = 52; #image width
$imgheight = 60; #image height


global $global_config, $db, $lang_global, $site_mods, $module_file;

list ( $catalias ) = $db->sql_fetchrow ( $db->sql_query ( "SELECT alias FROM `" . NV_PREFIXLANG . "_news_cat` WHERE catid=" . $catid . "" ) );
$content = '<table style="width:100%;border-bottom:1px #ccc dotted"">';
list ( $id, $title, $alias, $publtime, $hometext, $homeimgalt, $homeimgfile, $hitstotal ) = $db->sql_fetchrow ( $db->sql_query ( "SELECT id, title, alias, publtime, hometext, homeimgalt, homeimgfile, hitstotal FROM `" . NV_PREFIXLANG . "_news_" . $catid . "` WHERE homeimgfile!='' AND `status`= 1 AND `publtime` < " . NV_CURRENTTIME . " AND (`exptime`=0 OR `exptime`>" . NV_CURRENTTIME . ") ORDER BY `hitstotal` DESC LIMIT 1" ) );
$link = NV_BASE_SITEURL . "?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=news&amp;" . NV_OP_VARIABLE . "=" . $catalias . "/" . $alias . "-" . $id;
$publtime = date ( 'd.m.Y h:i', $publtime );
$hometext = strip_tags ( $hometext );
$hometext = nv_clean60 ( $hometext, $striptext );
$homeimgfile = explode ( '|', $homeimgfile );
$imglink = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/news/' . $homeimgfile [0];

$content .= '<tr><td style="text-align: justify;vertical-align:top;width:97%"><p style="margin:2px;font-weight:bold"><a title="' . $title . '" href="' . $link . '">' . $title . '</a></p>';
$content .= '<p style="margin-bottom:3px;font-size:0.9em">Đăng lúc: ' . $publtime . '  -  Đã xem: ' . $hitstotal . '</p><a title="' . $title . '" href="' . $link . '"><img src="' . $imglink . '" alt="' . $homeimgalt . '" style="border:1px #ccc solid; padding:1px;margin-right: 5px; float: left;width:50px;height:50px">' . $hometext . '</a><br /></td></tr>';
$content .= '</table>';
$content .= '<table style="text-align: justify;width:99%">';

$i = 1;
$sql = "SELECT id, title, alias, hometext, homeimgalt, homeimgfile FROM `" . NV_PREFIXLANG . "_news_" . $catid . "` WHERE id!=" . $id . " AND `status`= 1 AND `publtime` < " . NV_CURRENTTIME . " AND (`exptime`=0 OR `exptime`>" . NV_CURRENTTIME . ") ORDER BY `publtime` DESC LIMIT " . ($num - 1) . "";
$result = $db->sql_query ( $sql );
while ( list ( $id, $title, $alias, $hometext, $homeimgalt, $homeimgfile ) = $db->sql_fetchrow ( $result ) ) {
   $link = NV_BASE_SITEURL . "?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=news&amp;" . NV_OP_VARIABLE . "=" . $catalias . "/" . $alias . "-" . $id;
   $hometext = strip_tags ( $hometext );
   $hometext = nv_clean60 ( $hometext, $striptext );
   if (! empty ( $homeimgfile )) {
      $homeimgfile = explode ( '|', $homeimgfile );
      $imglink = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/news/' . $homeimgfile [0];
      $image = '<img src="' . $imglink . '" alt="' . $homeimgalt . '" style="border:1px #ccc solid; padding:1px;margin-right: 5px;margin-top: 1px;float: left;width:50px;height:50px">';
   } else {
      $image = '';
   }
   if ($i%2 == 1) {
      $content .= '<tr>';
   }
   $content .= '<td style="vertical-align:top;width:138px;border-bottom:1px #ccc dotted"><a title="' . $title . '" href="' . $link . '">' . $image . '' . $title . '</a></td>';
   if ($i%2 == 0) {
      $content .= "</tr>";
   }
   $i ++;
}
$content .= '</table>';
?>
