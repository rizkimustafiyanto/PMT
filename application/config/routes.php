<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'login';
$route['404_override'] = 'error';

/*********** USER DEFINED ROUTES *******************/

// Login
$route['Login'] = 'login_controller/Login';
$route['logout'] = 'dashboard/logout';
$route['Dashboard'] = 'dashboard';

$route['RoleUser'] = 'dashboard/cekRole';
$route['Home'] = 'dashboard/Home';

// Master Role (Standart PSD)
// MemberRole
$route['MemberRole'] = 'master/member_role_controller/Get';
$route['InsertMemberRole'] = 'master/member_role_controller/Insert';
$route['UpdateMemberRole'] = 'master/member_role_controller/Update';
$route['DeleteMemberRole/(:any)'] = 'master/member_role_controller/Delete/$1';

// Role
$route['Role'] = 'master/role_controller/GetRole';
$route['InsertRole'] = 'master/role_controller/InsertRole';
$route['GetRoleById/(:num)'] = 'master/role_controller/GetRoleById/$1';
$route['UpdateRole'] = 'master/role_controller/UpdateRole';
$route['DeleteRole/(:num)'] = 'master/role_controller/DeleteRole/$1';

// Menu
$route['Menu'] = 'master/menu_controller/GetMenu';
$route['InsertMenu'] = 'master/menu_controller/InsertMenu';
$route['GetMenuById/(:num)'] = 'master/menu_controller/GetMenuById/$1';
$route['UpdateMenu'] = 'master/menu_controller/UpdateMenu';
$route['DeleteMenu/(:num)'] = 'master/menu_controller/DeleteMenu/$1';

// Sub Menu
$route['SubMenu'] = 'master/sub_menu_controller/GetSubMenu';
$route['InsertSubMenu'] = 'master/sub_menu_controller/InsertSubMenu';
$route['GetSubMenuById/(:num)'] = 'master/sub_menu_controller/GetSubMenuById/$1';
$route['GetSubMenuByMenuId'] = 'master/sub_menu_controller/GetSubMenuByMenuId';
$route['UpdateSubMenu'] = 'master/sub_menu_controller/UpdateSubMenu';
$route['DeleteSubMenu/(:num)'] = 'master/sub_menu_controller/DeleteSubMenu/$1';

// Menu Role
$route['MenuRole'] = 'master/menu_role_controller/GetMenuRole';
$route['InsertMenuRole'] = 'master/menu_role_controller/InsertMenuRole';
$route['GetMenuRoleById/(:num)'] = 'master/menu_role_controller/GetMenuRoleById/$1';
$route['UpdateMenuRole'] = 'master/menu_role_controller/UpdateMenuRole';
$route['DeleteMenuRole/(:num)'] = 'master/menu_role_controller/DeleteMenuRole/$1';

// variable
$route['Variable'] = 'master/variable_controller/GetVariable';
$route['InsertVariable'] = 'master/variable_controller/InsertVariable';
$route['GetVariableById/(:any)'] = 'master/variable_controller/GetVariableById/$1';
$route['UpdateVariable'] = 'master/variable_controller/UpdateVariable';
$route['DeleteVariable/(:any)'] = 'master/variable_controller/DeleteVariable/$1';

// MANAGEMENT MEMBER
$route['ManageMember'] = 'master/management_member_controller/index';
$route['InsertManage'] = 'master/management_member_controller/Insert';
$route['UpdateManage'] = 'master/management_member_controller/Update';
$route['DeleteManage/(:any)'] = 'master/management_member_controller/Delete/$1';


// --------------------- The transactions are below --------------------------------

// PROJEK
$route['Project'] = 'transaction/project/project_controller/GetProject';
$route['InsertProject'] = 'transaction/project/project_controller/InsertProject';
$route['DeleteProject'] = 'transaction/project/project_controller/DeleteProject';
$route['UpdateProject'] = 'transaction/project/project_controller/UpdateProject';
$route['InsertProjectMember'] = 'transaction/project/project_controller/InsertProjectMember';
$route['UpdateProjectMember'] = 'transaction/project/project_controller/UpdateProjectMember';
$route['DeleteProjectMember'] = 'transaction/project/project_controller/DeleteProjectMember';

// LIST
$route['Project/List/(:any)'] = 'transaction/list/list_controller/List/$1';
$route['UpdateList'] = 'transaction/list/list_controller/UpdateList';
$route['InsertList'] = 'transaction/list/list_controller/InsertList';
$route['DeleteList'] = 'transaction/list/list_controller/DeleteList';
$route['InsertListMember'] = 'transaction/list/list_controller/InsertListMember';
$route['UpdateListMember'] = 'transaction/list/list_controller/UpdateListMember';
$route['DeleteListMember'] = 'transaction/list/list_controller/DeleteListMember';

// TASK
$route['Project/List/Task/(:any)/(:any)'] = 'transaction/task/task_controller/Task/$1/$2';
$route['UpdateTask'] = 'transaction/task/task_controller/UpdateTask';
$route['InsertTask'] = 'transaction/task/task_controller/InsertTask';
$route['DeleteTask'] = 'transaction/task/task_controller/DeleteTask';

// KANBAN PROJECT
$route['Project/KanbanList/(:any)'] = 'transaction/list/kanban_list_controller/KanbanList/$1';

// ATTACHMENT
$route['InsertAttachment'] = 'transaction/tools/Attachment_controller/InsertAttachment';
$route['ViewAttachment/(:any)'] = 'transaction/tools/Attachment_controller/ViewAttachment/$1';
$route['DownloadAttachment/(:any)'] = 'transaction/tools/Attachment_controller/DownloadAttachment/$1';
$route['DeleteAttachment'] = 'transaction/tools/Attachment_controller/DeleteAttachment';

// LOGGING
$route['log_insert'] = 'transaction/tools/Log_controller/log_insert';

// COMMENT
$route['get_comments'] = 'transaction/tools/Comment_controller/get_comments';
$route['insert_comment'] = 'transaction/tools/Comment_controller/insert_comment';

//Profile Board
$route['Profile'] = 'profile/Profile_Controller';

//Calendar
$route['Calendar'] = 'calendar/calendar_controller';
$route['GetEvent'] = 'calendar/calendar_controller/GetEvent';
$route['UpdateEvent'] = 'calendar/calendar_controller/UpdateEvent';
$route['DeleteEvent'] = 'calendar/calendar_controller/DeleteEvent';
$route['GetEventColor'] = 'calendar/calendar_controller/GetEventColor';
$route['AddEvent'] = 'calendar/calendar_controller/AddEvent';

//Meesagaes
$route['Message'] = 'messages/Messages_controller';
$route['ColumnMessage'] = 'messages/Messages_controller/ColumnMessage';
$route['get_messages'] = 'messages/Messages_controller/get_messages';
$route['insert_message'] = 'messages/Messages_controller/insert_message';
$route['InsertNewMessages'] = 'messages/Messages_controller/InsertNewMessages';
$route['DeleteMessages'] = 'messages/Messages_controller/DeleteMessages';

// TOOLS
$route['MemberSelect'] = 'transaction/project/project_controller/SelectProjectMember';
$route['Pining'] = 'transaction/project/project_controller/PinorUnpinProject';
//BATAS

/* End of file routes.php */
/* Location: ./application/config/routes.php */
