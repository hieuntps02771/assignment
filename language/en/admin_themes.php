<?php

/**
* @Project NUKEVIET 3.0
* @Author VINADES.,JSC (contact@vinades.vn)
* @Copyright (C) 2010 VINADES.,JSC. All rights reserved
* @Language English
* @Createdate Jan 21, 2011, 02:18:37 AM
*/

 if (! defined('NV_ADMIN') or ! defined('NV_MAINFILE')){
 die('Stop!!!');
}

$lang_translator['author'] ="VINADES.,JSC (contact@vinades.vn)";
$lang_translator['createdate'] ="04/03/2010, 15:22";
$lang_translator['copyright'] ="@Copyright (C) 2010 VINADES.,JSC. All rights reserved";
$lang_translator['info'] ="";
$lang_translator['langtype'] ="lang_module";

$lang_module['blocks'] = "Setup block";
$lang_module['change_func_name'] = "Change the name of the function &ldquo;%1\$s&rdquo; in module &ldquo;%2\$s&rdquo;";
$lang_module['bl_list_title'] = "Blocks in &ldquo;%1\$s&rdquo; is of function &ldquo;%2\$s&rdquo;";
$lang_module['add_block_title'] = "Add block &ldquo;%1\$s&rdquo; of function &ldquo;%2\$s&rdquo; in module &ldquo;%3\$s&rdquo;";
$lang_module['edit_block_title'] = "Edit block &ldquo;%1\$s&rdquo; at &ldquo;%2\$s&rdquo; of function &ldquo;%3\$s&rdquo; of module &ldquo;%4\$s&rdquo;";
$lang_module['block_add'] = "Add block";
$lang_module['block_edit'] = "Edit block";
$lang_module['block_title'] = "Block name";
$lang_module['block_link'] = "URL of block";
$lang_module['block_file_path'] = "Get contents from file";
$lang_module['block_global_apply'] = "Apply to all";
$lang_module['block_type_global'] = "Global";
$lang_module['block_select_type'] = "Select format";
$lang_module['block_tpl'] = "Template";
$lang_module['block_pos'] = "Position";
$lang_module['block_groupbl'] = "In group";
$lang_module['block_leavegroup'] = "Split from the group and create a new group";
$lang_module['block_group_notice'] = "Note: <br /> If you change a block of a group then you will change all other blocks in that group. <br/> If not want to change the other blocks of group but wanted to split the block into a new group, please check out the group split button and create new group.";
$lang_module['block_group_block'] = "Group";
$lang_module['block_no_more_func'] = "If not to choose functions from the group  then only one function is selected";
$lang_module['block_no_func'] = "Please select at least one function";
$lang_module['block_limit_func'] = "If confirmed not choosed then only one function is selected for a blocks";
$lang_module['block_func'] = "Zone";
$lang_module['block_nums'] = "Number of group block";
$lang_module['block_count'] = "block";
$lang_module['block_func_list'] = "Functions";
$lang_module['blocks_by_funcs'] = "Management blocks to follow the function";
$lang_module['block_yes'] = "Yes";
$lang_module['block_active'] = "Active";
$lang_module['block_group'] = "Who can view";
$lang_module['block_module'] = "Display in module";
$lang_module['block_all'] = "All modules";
$lang_module['block_confirm'] = "Accept";
$lang_module['block_default'] = "Default";
$lang_module['block_exp_time'] = "Expired time";
$lang_module['block_sort'] = "Sort";
$lang_module['block_change_pos_warning'] = "If you change the position of this block will change the positions all of the other blocks in the same group";
$lang_module['block_change_pos_warning2'] = "Do you want to change position?";
$lang_module['block_error_nogroup'] = "Please select at least 1 group";
$lang_module['block_error_noblock'] = "Please select at least 1 block";
$lang_module['block_delete_confirm'] = "Are you sure you want to delete all the selected block. If this will not be deleted to recover?";
$lang_module['block_delete_per_confirm'] = "Are you sure you want to remove this block?";
$lang_module['block_add_success'] = "Add successful";
$lang_module['block_update_success'] = "Update successful";
$lang_module['block_checkall'] = "Check all";
$lang_module['block_uncheckall'] = "Uncheck all";
$lang_module['block_delete_success'] = "Delete successful";
$lang_module['block_error_nomodule'] = "Please select at least 1 module";
$lang_module['block_error_title'] = "Block title is empty or exists!";
$lang_module['error_empty_title'] = "You do not declare block name";
$lang_module['error_invalid_url'] = "you have entered URL that does not correct";
$lang_module['error_empty_content'] = "Block didn't conect file, Block content is empty";
$lang_module['block_type'] = "Block type";
$lang_module['block_file'] = "File";
$lang_module['block_html'] = "HTML";
$lang_module['block_typehtml'] = "HTML type";
$lang_module['functions'] = "Function";
$lang_module['edit_block'] = "Edit block";
$lang_module['block_function'] = "Select function";
$lang_module['add_block_module'] = "Apply for modules";
$lang_module['add_block_all_module'] = "all modules";
$lang_module['add_block_select_module'] = "Select module";
$lang_module['block_layout'] = "Select layout";
$lang_module['block_select'] = "Select block";
$lang_module['block_check'] = "Check";
$lang_module['block_select_module'] = "Select module";
$lang_module['block_select_function'] = "Select function";
$lang_module['block_error_fileconfig_title'] = "Interface configuration file error";
$lang_module['block_error_fileconfig_content'] = "Interface configuration file is incorrect or does not exist. Check in your theme directory";
$lang_module['autoinstall'] = "Automatic setup";
$lang_module['autoinstall_theme_install'] = "Installing themes";
$lang_module['autoinstall_method_none'] = "Please select:";
$lang_module['autoinstall_method_install'] = "Installing themes on the system";
$lang_module['autoinstall_method_packet'] = "Module packeted";
$lang_module['autoinstall_method_packet_module'] = "Packing the module theme";
$lang_module['autoinstall_continue'] = "Next";
$lang_module['autoinstall_back'] = "Back";
$lang_module['autoinstall_error_nomethod'] = "Empty setup type!";
$lang_module['autoinstall_theme_select_file'] = "Please select packages for installation:";
$lang_module['autoinstall_theme_error_nofile'] = "Error: Please select the file to install";
$lang_module['autoinstall_theme_error_filetype'] = "Error: File must be installed zip or gz format file";
$lang_module['autoinstall_theme_error_createfile'] = "Error: Unable to save cache file list. Check your tmp directory or chmod";
$lang_module['autoinstall_theme_uploadedfile'] = "The system uploaded file:";
$lang_module['autoinstall_theme_uploadedfilesize'] = "File size";
$lang_module['autoinstall_theme_uploaded_filenum'] = "Total number of files + folders:";
$lang_module['autoinstall_theme_error_warning_fileexist'] = "The list is on the system:";
$lang_module['autoinstall_theme_checkfile_notice'] = "To continue the installation , click on CHECK the system will check automatically for compatibility";
$lang_module['autoinstall_theme_checkfile'] = "CHECK !";
$lang_module['autoinstall_theme_installdone'] = "Install ...";
$lang_module['autoinstall_theme_error_invalidfile'] = "Error: Invalid zip file";
$lang_module['autoinstall_theme_error_invalidfile_back'] = "Back";
$lang_module['autoinstall_package_processing'] = "please wait to complete...";
$lang_module['autoinstall_theme_error_uploadfile'] = "Error: Unable to upload files. Please check directory permission or chmod directory";
$lang_module['autoinstall_theme_unzip_abort'] = "The installation can not continue automatically by the host does not support.";
$lang_module['autoinstall_theme_permission_folder'] = "The installation can not continue automatically, because the system can not create folders.";
$lang_module['autoinstall_theme_unzip_success'] = "The installation process successfully. The system will automatically switch you to a page layout settings for the interface.";
$lang_module['autoinstall_theme_error_movefile'] = "The installation can not continue automatically because the host does not support moving files after unpacking";
$lang_module['autoinstall_theme_cantunzip'] = "Error can not unpack. Please check the chmod of directory.";
$lang_module['autoinstall_theme_unzip_filelist'] = "Extract files list";
$lang_module['autoinstall_theme_unzip_setuppage'] = "Go to the management page theme.";
$lang_module['autoinstall_package_select'] = "Select module to package";
$lang_module['autoinstall_package_noselect'] = "No module selected";
$lang_module['autoinstall_package_module_select'] = "Select the module to package";
$lang_module['autoinstall_package_noselect_module'] = "Please select a module to package themes";
$lang_module['autoinstall_method_theme_none'] = "Please select the theme";
$lang_module['autoinstall_method__module_none'] = "Select module";
$lang_module['autoinstall_package_noselect_module_theme'] = "Required to choose the theme and module name to package";
$lang_module['setup_layout'] = "Set layout";
$lang_module['setup_module'] = "Module";
$lang_module['setup_select_layout'] = "Choose layout";
$lang_module['setup_updated_layout'] = "Set layout to succeed!";
$lang_module['setup_error_layout'] = "Could not execute command set layout";
$lang_module['setup_save_layout'] = "Save all changes";
$lang_module['theme_manager'] = "Management interface";
$lang_module['theme_recent'] = "List interface is ready";
$lang_module['theme_created_by'] = "designed by";
$lang_module['theme_created_website'] = "visit author's website";
$lang_module['theme_created_folder'] = "Files + directory in:";
$lang_module['theme_created_position'] = "The position in the design theme:";
$lang_module['theme_created_activate'] = "Activate uses";
$lang_module['theme_created_activate_layout'] = "Error: You need to set the layout for this interface the firt to active";
$lang_module['theme_created_delete'] = "Deleted from the system";
$lang_module['theme_created_current_use'] = "Interface using";
$lang_module['theme_created_delete_theme'] = "Do you want to delete the all theme package";
$lang_module['theme_created_delete_theme_success'] = "Successfully deleted the theme go out the system !";
$lang_module['theme_created_delete_theme_unsuccess'] = "There are errors in the process of deleting files !";
$lang_module['theme_created_delete_current_theme'] = "You can not delete the current theme when the systme is using it!";
$lang_module['theme_created_delete_module_theme'] = "You can not delete themes because this theme are using for module:% s, you need to reconfigure modules.";
$lang_module['block_front_delete_error'] = "Error: Unable to delete the block, check your permission";
$lang_module['block_front_outgroup_success'] = "Block was successfully removed from the group and add to group";
$lang_module['block_front_outgroup_cancel'] = "Currently there is only one block in this group should therefore not removed from group";
$lang_module['block_front_outgroup_error_update'] = "There are errors in the process of updating data";
$lang_module['xcopyblock'] = "Block copying";
$lang_module['xcopyblock_to'] = "target theme";
$lang_module['xcopyblock_from'] = "from theme";
$lang_module['xcopyblock_position'] = "Select position";
$lang_module['xcopyblock_process'] = "Copy";
$lang_module['xcopyblock_no_position'] = "Please select at least on position to copy";
$lang_module['xcopyblock_notice'] = "This process will drop all exist blocks in target theme, please wait until all process successful";
$lang_module['xcopyblock_success'] = "All process has been done !";
$lang_module['block_weight'] = "Set the position of block";
$lang_module['block_weight_confirm'] = "Do you want to set up the position of block? The settings in the function will be the settings.";
$lang_module['autoinstall_theme_error_warning_overwrite'] = "Info: Package interfaces you install the file already exists, you have to make sure the installation to overwrite this file";
$lang_module['autoinstall_theme_overwrite'] = "Overwrite";

?>