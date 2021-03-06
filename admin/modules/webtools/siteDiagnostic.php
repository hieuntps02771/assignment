<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 23/12/2010, 11:54
 */

if ( ! defined( 'NV_IS_FILE_WEBTOOLS' ) ) die( 'Stop!!!' );

$xtpl = new XTemplate( "siteDiagnostic.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'LANG', $lang_module );

if ( $nv_Request->isset_request( 'i', 'get' ) )
{
    $i = $nv_Request->get_string( 'i', 'get' );

    if ( $i == "process" or $i == "refresh" )
    {
        $thead = array( //
            $lang_module['diagnosticDate'], //
            $lang_module['diagnosticGPR'], //
            $lang_module['diagnosticATR'], //
            $lang_module['diagnosticGBL'], //
            $lang_module['diagnosticYBL'], //
            $lang_module['diagnosticABL'], //
            $lang_module['diagnosticGID'], //
            $lang_module['diagnosticYID'] //
            );
        foreach ( $thead as $r )
        {
            $xtpl->assign( 'THEAD', $r );
            $xtpl->parse( 'scontent.thead' );
        }

        if ( ! isset( $Diagnostic ) or ! is_object( $Diagnostic ) )
        {
            if ( ! class_exists( 'UrlGetContents' ) )
            {
                include ( NV_ROOTDIR . "/includes/class/Diagnostic.class.php" );
            }

            $Diagnostic = new Diagnostic();
        }

        $info = ( $i == "process" ) ? $Diagnostic->process() : $Diagnostic->process( 300 );

        $refresh = 0;
        $imgs = array();
        $a = 1;
        foreach ( $info['item'] as $inf )
        {
            $refresh = strtotime( $inf['date'] );
            $class_PageRank = ( isset( $imgs['PageRank'] ) and $imgs['PageRank'] > $inf['PageRank'] ) ? "down" : ( ( isset( $imgs['PageRank'] ) and $imgs['PageRank'] < $inf['PageRank'] ) ? "up" : "pix" );
            $class_AlexaRank = ( isset( $imgs['AlexaRank'] ) and $imgs['AlexaRank'] < $inf['AlexaRank'] ) ? "down" : ( ( isset( $imgs['AlexaRank'] ) and $imgs['AlexaRank'] > $inf['AlexaRank'] ) ? "up" : "pix" );
            $class_GoogleBackLink = ( isset( $imgs['GoogleBackLink'] ) and $imgs['GoogleBackLink'] > $inf['GoogleBackLink'] ) ? "down" : ( ( isset( $imgs['GoogleBackLink'] ) and $imgs['GoogleBackLink'] < $inf['GoogleBackLink'] ) ? "up" : "pix" );
            $class_YahooBackLink = ( isset( $imgs['YahooBackLink'] ) and $imgs['YahooBackLink'] > $inf['YahooBackLink'] ) ? "down" : ( ( isset( $imgs['YahooBackLink'] ) and $imgs['YahooBackLink'] < $inf['YahooBackLink'] ) ? "up" : "pix" );
            $class_AlexaBackLink = ( isset( $imgs['AlexaBackLink'] ) and $imgs['AlexaBackLink'] > $inf['AlexaBackLink'] ) ? "down" : ( ( isset( $imgs['AlexaBackLink'] ) and $imgs['AlexaBackLink'] < $inf['AlexaBackLink'] ) ? "up" : "pix" );
            $class_GoogleIndexed = ( isset( $imgs['GoogleIndexed'] ) and $imgs['GoogleIndexed'] > $inf['GoogleIndexed'] ) ? "down" : ( ( isset( $imgs['GoogleIndexed'] ) and $imgs['GoogleIndexed'] < $inf['GoogleIndexed'] ) ? "up" : "pix" );
            $class_YahooIndexed = ( isset( $imgs['YahooIndexed'] ) and $imgs['YahooIndexed'] > $inf['YahooIndexed'] ) ? "down" : ( ( isset( $imgs['YahooIndexed'] ) and $imgs['YahooIndexed'] < $inf['YahooIndexed'] ) ? "up" : "pix" );

            $imgs['PageRank'] = $inf['PageRank'];
            $imgs['AlexaRank'] = $inf['AlexaRank'];
            $imgs['GoogleBackLink'] = $inf['GoogleBackLink'];
            $imgs['YahooBackLink'] = $inf['YahooBackLink'];
            $imgs['AlexaBackLink'] = $inf['AlexaBackLink'];
            $imgs['GoogleIndexed'] = $inf['GoogleIndexed'];
            $imgs['YahooIndexed'] = $inf['YahooIndexed'];

            $row = array( //
                'date' => array( 'class' => '', 'style' => "text-align:left", 'content' => nv_date( "l, d-m-Y H:i:s", $refresh ) ), //
                'PageRank' => array( 'class' => " class=\"" . $class_PageRank . "\"", 'style' => "text-align:right", 'content' => "<img alt=\"" . $inf['PageRank'] . "\" src=\"" . NV_BASE_SITEURL . "images/rank/" . $inf['PageRank'] . ".gif\" width=\"42\" height=\"7\" /> " . number_format( $inf['PageRank'] ) ), //
                'AlexaRank' => array( 'class' => " class=\"" . $class_AlexaRank . "\"", 'style' => "text-align:right", 'content' => number_format( $inf['AlexaRank'] ) ), //
                'GoogleBackLink' => array( 'class' => " class=\"" . $class_GoogleBackLink . "\"", 'style' => "text-align:right", 'content' => number_format( $inf['GoogleBackLink'] ) ), //
                'YahooBackLink' => array( 'class' => " class=\"" . $class_YahooBackLink . "\"", 'style' => "text-align:right", 'content' => number_format( $inf['YahooBackLink'] ) ), //
                'AlexaBackLink' => array( 'class' => " class=\"" . $class_AlexaBackLink . "\"", 'style' => "text-align:right", 'content' => number_format( $inf['AlexaBackLink'] ) ), //
                'GoogleIndexed' => array( 'class' => " class=\"" . $class_GoogleIndexed . "\"", 'style' => "text-align:right", 'content' => number_format( $inf['GoogleIndexed'] ) ), //
                'YahooIndexed' => array( 'class' => " class=\"" . $class_YahooIndexed . "\"", 'style' => "text-align:right", 'content' => number_format( $inf['YahooIndexed'] ) ) //
                );
            foreach ( $row as $td )
            {
                $xtpl->assign( 'TD', $td );
                $xtpl->parse( 'scontent.loop.td' );
            }
            $xtpl->assign( 'CLASS', ( $a % 2 ) ? " class=\"second\"" : "" );
            $xtpl->parse( 'scontent.loop' );
            $a++;
        }

        $today = mktime( 0, 0, 0, date( "m", NV_CURRENTTIME ), date( "d", NV_CURRENTTIME ), date( "Y", NV_CURRENTTIME ) );
        if ( $refresh < $today )
        {
            $xtpl->parse( 'scontent.ref' );
        }

        $xtpl->parse( 'scontent' );
        echo $xtpl->text( 'scontent' );
    }

    die();
}

$page_title = $lang_module['siteDiagnostic'];
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>