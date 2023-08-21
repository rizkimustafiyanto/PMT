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
$route['GetSubMenuById/(:num)'] =
    'master/sub_menu_controller/GetSubMenuById/$1';
$route['GetSubMenuByMenuId'] = 'master/sub_menu_controller/GetSubMenuByMenuId';
$route['UpdateSubMenu'] = 'master/sub_menu_controller/UpdateSubMenu';
$route['DeleteSubMenu/(:num)'] = 'master/sub_menu_controller/DeleteSubMenu/$1';

// Menu Role
$route['MenuRole'] = 'master/menu_role_controller/GetMenuRole';
$route['InsertMenuRole'] = 'master/menu_role_controller/InsertMenuRole';
$route['GetMenuRoleById/(:num)'] =
    'master/menu_role_controller/GetMenuRoleById/$1';
$route['UpdateMenuRole'] = 'master/menu_role_controller/UpdateMenuRole';
$route['DeleteMenuRole/(:num)'] =
    'master/menu_role_controller/DeleteMenuRole/$1';

// Variable
$route['Variable'] = 'master/variable_controller/GetVariable';
$route['InsertVariable'] = 'master/variable_controller/InsertVariable';
$route['GetVariableById/(:any)'] =
    'master/variable_controller/GetVariableById/$1';
$route['UpdateVariable'] = 'master/variable_controller/UpdateVariable';
$route['DeleteVariable/(:any)'] =
    'master/variable_controller/DeleteVariable/$1';

// MemberList
$route['MemberList'] = 'master/member_controller/GetMember';
$route['InsertMember'] = 'master/member_controller/InsertMember';
$route['UpdateMember'] = 'master/member_controller/UpdateMember';
$route['DeleteMember/(:any)'] = 'master/member_controller/DeleteMember/$1';
$route['Detailmember/(:any)'] = 'master/member_controller/Detailmember/$1';
// $route['EmployeeDetail'] = 'master/employee_controller/Info';
// $route['InsertEmployee'] = 'master/employee_controller/InsertEmployee';
// $route['DeleteEmploye/(:any)'] = 'master/employee_controller/Delete/$1';
// $route['EmployeeInfo/(:any)'] = 'master/employee_controller/GetDetail/$1';
// $route['UpdateEmployee'] = 'master/employee_controller/Update';
// $route['PasswordReset'] = 'master/employee_controller/PasswordReset';

// Voucher
$route['VoucherList'] = 'master/voucher_controller/GetVoucher';
$route['InsertVoucher'] = 'master/voucher_controller/InsertVoucher';
$route['UpdateVoucher'] = 'master/voucher_controller/UpdateVoucher';
$route['DeleteVoucher/(:any)'] = 'master/voucher_controller/DeleteVoucher/$1';

// Member Voucher

$route['MemberVoucherList'] =
    'transaction/member_voucher_controller/GetMemberVoucher';
$route['InsertMemberVoucher'] =
    'transaction/member_voucher_controller/InsertMemberVoucher';
$route['UpdateMemberVoucher'] =
    'transaction/member_voucher_controller/UpdateMemberVoucher';
$route['DeleteMemberVoucher/(:any)'] =
    'transaction/member_voucher_controller/DeleteMemberVoucher/$1';

//Point transaction
$route['PointTransactionList'] =
    'transaction/point_transaction_controller/GetPointTransaction';
$route['InsertPointTransaction'] =
    'transaction/point_transaction_controller/InsertPointTransaction';
$route['UpdatePointTransaction'] =
    'transaction/point_transaction_controller/UpdatePointTransaction';
$route['DeletePointTransaction/(:any)'] =
    'transaction/point_transaction_controller/DeletePointTransaction/$1';
$route['GetMemberVoucherByMember'] =
    'transaction/point_transaction_controller/GetMemberVoucherByMember';
$route['GetPoinVoucherByVoucher'] =
    'transaction/point_transaction_controller/GetPoinVoucherByVoucher';
$route['GetMemberVoucherBySender'] =
    'transaction/point_transaction_controller/GetMemberVoucherBySender';
$route['GetMemberForTransaction'] =
    'transaction/point_transaction_controller/GetMemberForTransaction';

//Point Saldo
$route['PointSaldoList'] = 'transaction/point_saldo_controller/GetPointSaldo';
$route['InsertPointSaldo'] =
    'transaction/point_saldo_controller/InsertPointSaldo';
$route['UpdatePointSaldo'] =
    'transaction/point_saldo_controller/UpdatePointSaldo';
$route['DeletePointSaldo/(:any)'] =
    'transaction/point_saldo_controller/DeletePointSaldo/$1';
//BATAS

/* End of file routes.php */
/* Location: ./application/config/routes.php */
