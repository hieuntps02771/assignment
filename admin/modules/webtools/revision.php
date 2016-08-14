<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 9/9/2010, 6:38
 */

if ( ! defined( 'NV_IS_FILE_WEBTOOLS' ) ) die( 'Stop!!!' );

$page_title = $lang_module['revision'];

function del_path_svn ( $subject )
{
    return str_replace( '/trunk/nukeviet3/', '', $subject );
}

function nv_mkdir_svn ( $dirname )
{
    $cp = "";
    $e = explode( "/", $dirname );
    foreach ( $e as $p )
    {
        if ( ! empty( $p ) and ! is_dir( NV_ROOTDIR . '/' . $cp . $p ) )
        {
            if ( ! @mkdir( NV_ROOTDIR . '/' . $cp . $p, 0777 ) )
            {
                $cp = '';
                break;
            }
        }
        $cp .= $p . '/';
    }
}

if ( $sys_info['allowed_set_time_limit'] )
{
    set_time_limit( 0 );
}

$vini = isset( $global_config['revision'] ) ? $global_config['revision'] : 0; // Phien ban truoc
if ( $vini < 893 )
{
    $contents = $lang_module['revision_nosuport'];
}
else
{
    $step = $nv_Request->get_int( 'step', 'get', 1 );
    $n = $nv_Request->get_int( 'n', 'get', 1 );
    $checkss = $nv_Request->get_string( 'checkss', 'get', '' );
    $nextstep = $step + 1;
    if ( $step == 1 )
    {
        require ( NV_ROOTDIR . '/includes/phpsvnclient/phpsvnclient.php' );
        $svn = new phpsvnclient();
        $svn->setRepository( "http://nuke-viet.googlecode.com/svn" );
        
        $vend = $svn->getVersion();
        if ( $vend > $vini )
        {
            $nv_Request->set_Session( 'getVersion', $vend );
            $nv_Request->set_Session( 'getfile', 0 );
            $logs = $svn->getRepositoryLogs( $vini, $vend );
            if ( ! empty( $logs ) )
            {
                $add_files = $del_files = $edit_files = array();
                foreach ( $logs as $key => $arr_log_i )
                {
                    if ( isset( $arr_log_i['del_files'] ) )
                    {
                        $array_remove_add = $array_remove_edit = array();
                        $arr_temp = $arr_log_i['del_files'];
                        foreach ( $arr_temp as $str )
                        {
                            $str = del_path_svn( trim( $str ) );
                            if ( in_array( $str, $add_files ) )
                            {
                                $array_remove_add[] = $str;
                            }
                            elseif ( in_array( $str, $edit_files ) )
                            {
                                $array_remove_edit[] = $str;
                            }
                            else
                            {
                                $del_files[] = $str;
                            }
                        }
                        $add_files = array_diff( $add_files, $array_remove_add );
                        $edit_files = array_diff( $edit_files, $array_remove_edit );
                    }
                    if ( isset( $arr_log_i['mod_files'] ) )
                    {
                        $arr_temp = $arr_log_i['mod_files'];
                        foreach ( $arr_temp as $str )
                        {
                            $str = del_path_svn( trim( $str ) );
                            if ( ! in_array( $str, $edit_files ) and ! in_array( $str, $add_files ) )
                            {
                                $edit_files[] = $str;
                            }
                        }
                    }
                    
                    if ( isset( $arr_log_i['add_files'] ) )
                    {
                        $array_remove_del = array();
                        $arr_temp = $arr_log_i['add_files'];
                        foreach ( $arr_temp as $str )
                        {
                            $str = del_path_svn( trim( $str ) );
                            if ( in_array( $str, $del_files ) )
                            {
                                $array_remove_del[] = $str;
                            }
                            $add_files[] = $str;
                        }
                        $del_files = array_diff( $del_files, $array_remove_del );
                    }
                }
                asort( $add_files );
                asort( $del_files );
                asort( $edit_files );
                
                $svn_data_files = array( 
                    'version' => $vend, 'add_files' => $add_files, 'del_files' => $del_files, 'edit_files' => $edit_files 
                );
                
                file_put_contents( NV_ROOTDIR . '/' . NV_DATADIR . '/svn_data_files_' . md5( $global_config['revision'] . $global_config['sitekey'] ) . '.log', serialize( $svn_data_files ), LOCK_EX );
                
                Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&step=' . $nextstep . '&checkss=' . md5( $nextstep . $global_config['sitekey'] . session_id() ) );
                exit();
            }
            else
            {
                $contents = $lang_module['revision_nochange'];
            }
        }
        elseif ( $vend == $vini )
        {
            $contents = $lang_module['revision_nochange'];
        }
        else
        {
            $contents = $lang_module['revision_error'];
        }
    }
    elseif ( $step == 2 and $checkss == md5( $step . $global_config['sitekey'] . session_id() ) )
    {
        if ( file_exists( NV_ROOTDIR . '/' . NV_DATADIR . '/svn_data_files_' . md5( $global_config['revision'] . $global_config['sitekey'] ) . '.log' ) )
        {
            $cache = file_get_contents( NV_ROOTDIR . '/' . NV_DATADIR . '/svn_data_files_' . md5( $global_config['revision'] . $global_config['sitekey'] ) . '.log' );
            $svn_data_files = unserialize( $cache );
            
            nv_deletefile( NV_ROOTDIR . '/install/update', true );
            
            @mkdir( NV_ROOTDIR . '/install/update', 0777 );
            @mkdir( NV_ROOTDIR . '/install/update/new', 0777 );
            @mkdir( NV_ROOTDIR . '/install/update/old', 0777 );
            
            @file_put_contents( NV_ROOTDIR . "/install/update/.htaccess", "deny from all", LOCK_EX );
            @file_put_contents( NV_ROOTDIR . "/install/update/index.html", "", LOCK_EX );
            @file_put_contents( NV_ROOTDIR . "/install/update/new/index.html", "", LOCK_EX );
            @file_put_contents( NV_ROOTDIR . "/install/update/old/index.html", "", LOCK_EX );
            
            $contents = '<div style="text-align:center;color:red;">' . $lang_module['revision_list_file'] . '</div>';
            $contents .= '<div style="overflow:auto;height:300px;width:100%">';
            if ( ! empty( $svn_data_files['add_files'] ) ) $contents .= '<br /><br /><b>' . $lang_module['revision_add_files'] . '</b><br />' . implode( "<br />", $svn_data_files['add_files'] );
            if ( ! empty( $svn_data_files['edit_files'] ) ) $contents .= '<br /><br /><b>' . $lang_module['revision_mod_files'] . '</b><br />' . implode( "<br />", $svn_data_files['edit_files'] );
            if ( ! empty( $svn_data_files['del_files'] ) ) $contents .= '<br /><br /><b>' . $lang_module['revision_del_files'] . '</b><br />' . implode( "<br />", $svn_data_files['del_files'] );
            $contents .= '</div><br /><br />';
            $contents .= $lang_module['revision_msg_download'];
            
            $contents .= '<br /><br /><center><input style="margin-top:10px;font-size:15px" type="button" name="download_file" value="' . $lang_module['revision_download_files'] . '"/></center>';
            $contents .= '<br /><br /><div id="message" style="display:none;text-align:center;color:red"><img src="' . NV_BASE_SITEURL . 'images/load_bar.gif" alt="" /></div>';
            $contents .= '<script type="text/javascript">
            	function nv_download_result(res)
				{
					var r_split = res.split("_");	
					if (r_split[0] != "OK") {
						$("#message").hide();	
						alert(r_split[1]);
        			}
					else if (r_split[1] == "DOWNLOADFILE") {
				 		nv_ajax("get", "' . NV_BASE_ADMINURL . 'index.php", "' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&step=' . $nextstep . '&checkss=' . md5( $nextstep . $global_config['sitekey'] . session_id() ) . '", "", "nv_download_result");
        			}
					else if (r_split[1] == "DOWNLOADCOMPLETE"){
						parent.location="' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=autoupdate";
        			} 
        			else{
        				alert("' . $lang_module['revision_download_error'] . '");
        			}       			
				}
            	nv_download_result
        		 $(function(){
        		 	$("input[name=download_file]").click(function(){
        		 		$("#message").show();
				 		$("#step1").html("");
				 		nv_ajax("get", "' . NV_BASE_ADMINURL . 'index.php", "' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&step=' . $nextstep . '&checkss=' . md5( $nextstep . $global_config['sitekey'] . session_id() ) . '", "", "nv_download_result");
					});
        		 });
			</script><br /><br />';
        }
        else
        {
            $contents = $lang_module['revision_error_cache_file'];
        }
    }
    //elseif ( $step == 3 and $checkss == md5( $step . $global_config['sitekey'] . session_id() ) )
    elseif ( $step == 3 )
    {
        $error_download = array();
        $cache = file_get_contents( NV_ROOTDIR . '/' . NV_DATADIR . '/svn_data_files_' . md5( $global_config['revision'] . $global_config['sitekey'] ) . '.log' );
        $svn_data_files = unserialize( $cache );
        $download_files = array_merge( $svn_data_files['edit_files'], $svn_data_files['add_files'] );
        
        $vend = $nv_Request->get_int( 'getVersion', 'session', 0 );
        $getfile = $nv_Request->get_int( 'getfile', 'session', 0 );
        
        require ( NV_ROOTDIR . '/includes/phpsvnclient/phpsvnclient.php' );
        $svn = new phpsvnclient();
        $svn->setRepository( "http://nuke-viet.googlecode.com/svn" );
        
        if ( $getfile < count( $download_files ) )
        {
            $file_name = $download_files[$getfile];
            $path = '/trunk/nukeviet3/' . $file_name;
            
            // download new file 
            $fileInfo = $svn->getDirectoryTree( $path, $vend, false );
            if ( $fileInfo["type"] == "directory" )
            {
                $dirname = str_replace( "/trunk/nukeviet3/", "install/update/new/", $path );
            }
            else
            {
                $contents_f = $svn->getFile( $path, $vend );
                if ( $contents_f === false )
                {
                    $error_download[] = "error getFile: " . $path . "--->" . $vend;
                    $dirname = "";
                }
                else
                {
                    $dirname = str_replace( "/trunk/nukeviet3/", "install/update/new/", dirname( $path ) );
                    $filename = basename( $path );
                }
            }
            
            if ( ! empty( $dirname ) and ! is_dir( NV_ROOTDIR . '/' . $dirname ) )
            {
                nv_mkdir_svn( $dirname );
            }
            if ( ! empty( $filename ) and ! empty( $dirname ) )
            {
                file_put_contents( NV_ROOTDIR . '/' . $dirname . "/" . $filename, $contents_f, LOCK_EX );
                // download old file
                if ( in_array( $file_name, $svn_data_files['edit_files'] ) )
                {
                    $contents_f = $svn->getFile( $path, $vini );
                    if ( $contents_f === false )
                    {
                        $error_download[] = "error getFile: " . $path . "--->" . $vini;
                        $dirname = "";
                    }
                    else
                    {
                        $dirname = str_replace( "/trunk/nukeviet3/", "install/update/old/", dirname( $path ) );
                        if ( ! empty( $dirname ) and ! is_dir( NV_ROOTDIR . '/' . $dirname ) )
                        {
                            nv_mkdir_svn( $dirname );
                        }
                        $filename = basename( $path );
                        file_put_contents( NV_ROOTDIR . '/' . $dirname . "/" . $filename, $contents_f, LOCK_EX );
                    }
                }
            }
            if ( empty( $error_download ) )
            {
                $nv_Request->set_Session( 'getfile', $getfile + 1 );
                die( "OK_DOWNLOADFILE" );
            }
            else
            {
                die( implode( "<br />", $error_download ) );
            }
        }
        else
        {
            $path = "/trunk/nukeviet3/update_revision.php";
            $contents_f = $svn->getFile( $path, $vend );
            $contents_f = str_replace( "?>", "\n", $contents_f );
            $contents_f .= "\$update_info = array( 
			    'revision' => array( 
			    	'from' => '" . $vini . "', 'to' => '" . $vend . "' 
				) 
			);\n";
            if ( ! empty( $svn_data_files['add_files'] ) ) $contents_f .= "\$add_files = array('" . implode( "',\n '", $svn_data_files['add_files'] ) . "');\n\n\n";
            if ( ! empty( $svn_data_files['edit_files'] ) ) $contents_f .= "\$edit_files = array('" . implode( "',\n '", $svn_data_files['edit_files'] ) . "');\n\n\n";
            if ( ! empty( $svn_data_files['del_files'] ) ) $contents_f .= "\$delete_files = array('" . implode( "',\n '", $svn_data_files['del_files'] ) . "');\n\n\n";
            $contents_f .= "\n?>";
            
            file_put_contents( NV_ROOTDIR . "/install/update/update.php", $contents_f, LOCK_EX );
            nv_deletefile( NV_ROOTDIR . '/' . NV_DATADIR . '/svn_data_files_' . md5( $global_config['revision'] . $global_config['sitekey'] ) . '.log' );
            
            die( "OK_DOWNLOADCOMPLETE" );
        }
    }
}
include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>