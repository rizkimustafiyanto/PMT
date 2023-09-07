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
$route['logout'] = 'member/logout';
$route['Dashboard'] = 'member';
$route['Dashboard/(:num)/(:num)'] = 'member/index/$1/$2';

$route['RoleUser'] = 'member/cekRole';
$route['Home'] = 'member/Home';

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


// --------------------- The transactions are below --------------------------------

// PROJEK WORKSPACE
$route['ProjectWrk'] = 'transaction/project_wrk/Project_wrk_controller/GetProjectWrk';
$route['InsertProjectWrk'] = 'transaction/project_wrk/Project_wrk_controller/InsertProjectWrk';
$route['DeleteProjectWrk'] = 'transaction/project_wrk/Project_wrk_controller/DeleteProjectWrk';
$route['UpdateProjectWrk'] = 'transaction/project_wrk/Project_wrk_controller/UpdateProjectWrk';

$route['InsertProjectWrkMember'] = 'transaction/project_wrk/Project_wrk_controller/InsertProjectWrkMember';
$route['UpdateProjectWrkMember'] = 'transaction/project_wrk/Project_wrk_controller/UpdateProjectWrkMember';
$route['DeleteProjectWrkMember/(:any)/(:any)'] = 'transaction/project_wrk/Project_wrk_controller/DeleteProjectWrkMember/$1/$2';

// ATTACHMENT
$route['InsertAttachment'] = 'transaction/tools/Attachment_controller/InsertAttachment';
$route['ViewAttachment/(:any)'] = 'transaction/tools/Attachment_controller/ViewAttachment/$1';
$route['DownloadAttachment/(:any)'] = 'transaction/tools/Attachment_controller/DownloadAttachment/$1';
$route['DeleteAttachment'] = 'transaction/tools/Attachment_controller/DeleteAttachment';

// PROJECT
$route['Project/(:any)'] = 'transaction/project/Project_controller/Project/$1';
$route['UpdateProject'] = 'transaction/project/Project_controller/UpdateProject';
$route['InsertProject'] = 'transaction/project/Project_controller/InsertProject';
$route['DeleteProject'] = 'transaction/project/Project_controller/DeleteProject';

// PROJECT DETAIL
$route['ProjectItem/(:any)/(:any)'] = 'transaction/project/Item_controller/ProjectItem/$1/$2';
$route['UpdateProjectItem'] = 'transaction/project/Item_controller/UpdateProjectItem';
$route['InsertProjectItem'] = 'transaction/project/Item_controller/InsertProjectItem';
$route['DeleteProjectItem'] = 'transaction/project/Item_controller/DeleteProjectItem';
$route['InsertProjectItemMember'] = 'transaction/project/Item_controller/InsertProjectItemMember';
$route['DeleteProjectItemMember'] = 'transaction/project/Item_controller/DeleteProjectItemMember';

// ITEM
$route['Item/(:any)/(:any)'] = 'transaction/project/Item_controller/Item/$1/$2';
$route['InsertItemMember'] = 'transaction/project/Item_controller/InsertItemMember';



// KANBAN PROJECT
$route['KanbanProject/(:any)'] = 'transaction/project/Kanban_project_controller/KanbanProject/$1';
$route['KanbanItem/(:any)/(:any)'] = 'transaction/project/Kanban_project_controller/KanbanItem/$1/$2';


//Board Project
$route['InsertBoardProject'] = 'transaction/Board_controller/InsertBoardProject';
$route['DeleteBoardProject/(:any)/(:any)'] = 'transaction/Board_controller/DeleteBoardProject/$1/$2';
$route['UpdateBoardProject'] = 'transaction/Board_controller/UpdateBoardProject';
$route['DetailBoardProject/(:any)/(:any)'] = 'transaction/Board_controller/DetailBoardProject/$1/$2';
$route['ChangeStatusProjectProjectBoard'] = 'transaction/Board_controller/ChangeStatusProjectProjectBoard';

//Project Board Items
$route['InsertBoardItemList'] = 'transaction/List_controller/InsertBoardItemList';
$route['DeleteBoardItemList/(:any)/(:any)/(:any)'] = 'transaction/List_controller/DeleteBoardItemList/$1/$2/$3';
$route['UpdateItemList'] = 'transaction/List_controller/UpdateItemList';
$route['DetailItemList/(:any)/(:any)/(:any)'] = 'transaction/List_controller/DetailItemList/$1/$2/$3';

//Project Card List
$route['InsertCard'] = 'transaction/Card_controller/InsertCard';
$route['DeleteCard/(:any)/(:any)'] = 'transaction/Card_controller/DeleteCard/$1/$2';
$route['UpdateCard'] = 'transaction/Card_controller/UpdateCard';
$route['DetailCard/(:any)/(:any)'] = 'transaction/Card_controller/DetailCard/$1/$2';
$route['MoveCardList/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'transaction/Card_controller/MoveCardList/$1/$2/$3/$4/$5';
$route['ChangeStatusProjectProjectBoardCard'] = 'transaction/Card_controller/ChangeStatusProjectProjectBoardCard';

//Project Card Member
$route['InsertCardMember'] = 'transaction/Card_member_controller/InsertCardMember';
$route['DeleteCardMember/(:any)/(:any)/(:any)'] = 'transaction/Card_member_controller/DeleteCardMember/$1/$2/$3';
// $route['UpdateCard'] = 'transaction/Card_member_controller/UpdateCard';
// $route['DetailCard/(:any)/(:any)/(:any)/(:any)'] ='transaction/Card_member_controller/DetailCard/$1/$2/$3/$4';

//Project Card Comment
$route['InsertCardComment'] = 'transaction/Card_comment_controller/InsertCardComment';
$route['UpdateCardComment'] = 'transaction/Card_comment_controller/UpdateCardComment';
$route['DeleteCardComment/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'transaction/Card_comment_controller/DeleteCardComment/$1/$2/$3/$4/$5';

//Project Card Attachment
$route['InsertCardAttachment'] = 'transaction/Card_attachment_controller/InsertCardAttachment';
$route['DeleteCardAttachment/(:any)/(:any)/(:any)'] = 'transaction/Card_attachment_controller/DeleteCardAttachment/$1/$2/$3';

//Project Card Checklist
$route['InsertCardChecklist'] = 'transaction/Card_checklist_controller/InsertCardChecklist';
$route['DeleteCardChecklist/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'transaction/Card_checklist_controller/DeleteCardChecklist/$1/$2/$3/$4/$5';
$route['UpdateCardChecklist'] = 'transaction/Card_checklist_controller/UpdateCardChecklist';
$route['DetailChecklistItem/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'transaction/Card_checklist_controller/DetailChecklistItem/$1/$2/$3/$4/$5';
$route['UpdateCardChecklistPercentage'] = 'transaction/Card_checklist_controller/UpdateCardChecklistPercentage';

//Project Card Checklist Item
$route['InsertChecklistItem'] = 'transaction/Checklist_item_controller/InsertChecklistItem';
$route['DeleteChecklistItem/(:any)/(:any)/(:any)'] = 'transaction/Checklist_item_controller/DeleteChecklistItem/$1/$2/$3';
$route['UpdateChecklistItem'] = 'transaction/Checklist_item_controller/UpdateChecklistItem';
$route['UpdateChecklistItemChecked'] = 'transaction/Checklist_item_controller/UpdateChecklistItemChecked';
// $route['UpdateBoardProject'] =
// 'transaction/Board_controller/UpdateBoardProject';

//Upload
$route['Upload/(:any)'] = 'transaction/Card_attachment_controller/Upload/$1';
//Download
$route['Download/(:any)/(:any)/(:any)/(:any)'] = 'transaction/Card_attachment_controller/Download/$1/$2/$3/$4';


//position
$route['UpdatePositionListBoard'] = 'transaction/Board_controller/UpdatePositionListBoard';

//Project Card Log
$route['InsertCardLog'] = 'transaction/Card_log_controller/InsertCardLog';
$route['UpdateCardLog'] = 'transaction/Card_log_controller/UpdateCardLog';
$route['DeleteCardLog/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'transaction/Card_log_controller/DeleteCardLog/$1/$2/$3/$4/$5';

// PMT Board
$route['PmtBoard'] = 'transaction/Pmt_board_controller';

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


//BATAS

/* End of file routes.php */
/* Location: ./application/config/routes.php */
