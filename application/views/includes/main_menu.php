<?php
// data main menu
$main_menu = $this->db->get_where('gm_menu', ['record_status' => 'A']);
foreach ($main_menu->result() as $main) {
    // Query untuk mencari data sub menu
    $sub_menu = $this->db->get_where('gmasub_menu', [
        'menu_id' => $main->menu_id,
    ]);
    // periksa apakah ada sub menu
    if ($sub_menu->num_rows() > 0) {
        // main menu dengan sub menu
        echo "<li class='treeview'>" .
            anchor(
                $main->menu_url,
                '<i class="' .
                    $main->menu_icon .
                    '"></i>' .
                    $main->menu_name .
                    '<span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>'
            );
        // sub menu nya disini
        echo "<ul class='treeview-menu'>";
        foreach ($sub_menu->result() as $sub) {
            echo '<li>' .
                anchor(
                    $sub->sub_menu_url,
                    '<i class="' .
                        $sub->sub_menu_icon .
                        '"></i>' .
                        $sub->sub_menu_name
                ) .
                '</li>';
        }
        echo '</ul></li>';
    } else {
        // main menu tanpa sub menu
        echo '<li>' .
            anchor(
                $main->menu_url,
                '<i class="' . $main->menu_icon . '"></i>' . $main->menu_name
            ) .
            '</li>';
    }
}
