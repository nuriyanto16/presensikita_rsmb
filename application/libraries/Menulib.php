<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menulib
{
    protected $obj;
    protected $flag;

    public function __construct()
    {
        $this->obj =& get_instance();
        $this->obj->load->helper('url');
        $this->obj->load->model('Mcommon', 'mcommon');
    }

    public function show_menu()
    {
        $dataMenu = $this->obj->mcommon->getMenuByRoleID($this->obj->session->userdata($this->obj->config->item('sess_prefix', 'ion_auth') . 'roleid'));

        $menu = array(
            'menus' => array(),
            'parent_menus' => array()
        );
        

        foreach ($dataMenu as $row) {
            $menu['menus'][$row['module_id']] = $row;
            //creates entry into parent_menus array. parent_menus array contains a list of all menus with children
            $menu['parent_menus'][$row['module_pid']][] = $row['module_id'];
        }
        $this->flag = false;
        
        $menu = $this->buildMenu(0, $menu);
        
        return $menu;
    }

    private function buildMenu($parent, $menu, $level = 0)
    {
        $html = "";
        
        if (isset($menu['parent_menus'][$parent])) {
          
            if ($parent === 0) {
                //$html .= "<h3>Menu Utama</h3>";
                $level = 0;
                $html .= "<ul class='nav' id='side-menu'>";
            } else {
                $level ++;
                $level_str = "second";
                switch ($level) {
                    case 2:
                        $level_str = "third";
                        break;
                    case 3:
                        $level_str = "fourth";
                        break;
                }
                $html .= sprintf('<ul class="nav nav-%s-level">', $level_str);
            }
            
            foreach ($menu['parent_menus'][$parent] as $menu_id) {
                   
                // class active child (not treeview)
                if (($this->obj->uri->uri_string() == $menu['menus'][$menu_id]['module_url'])
                    OR ($this->obj->uri->segment(1) == $menu['menus'][$menu_id]['mod_group'] 
                            && $this->obj->uri->segment(1) . "/" . $this->obj->uri->segment(2) == $menu['menus'][$menu_id]['module_url'])
                ) {
                    $clsActive = "class='active'";
                }

                $hideMenu = ""; $hideMenuEnd = "";
                if ($menu['menus'][$menu_id]['module_url'] == "#" || $menu['menus'][$menu_id]['module_url'] == "/"
                    || $menu['menus'][$menu_id]['module_url'] == "main/dashboard") {
                    $hideMenu = "<span class='hide-menu'>";
                    $hideMenuEnd = "</span>";
                }

                if (!isset($menu['parent_menus'][$menu_id])) {
                    $html .= "<li>
                                <a href='" . base_url($menu['menus'][$menu_id]['module_url']) . "' class='waves-effect'>
                                    <i class='" . $menu['menus'][$menu_id]['mod_icon_cls'] . "'></i> 
                                    " . $hideMenu . "
                                    " . $menu['menus'][$menu_id]['module_name'] . "
                                    " . $hideMenuEnd . "
                                </a>
                              </li>";
                }
                if (isset($menu['parent_menus'][$menu_id])) {
                    $html .= "<li>
                                <a class='waves-effect'>
                                    <i class='" . $menu['menus'][$menu_id]['mod_icon_cls'] . "'></i> 
                                    " . $hideMenu . "
                                    " . $menu['menus'][$menu_id]['module_name'] . "
                                    <span class='fa arrow'></span>
                                    " . $hideMenuEnd . "
                                </a>";
                    $html .= $this->buildMenu($menu_id, $menu, $level); //--== recursive
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        
        
        return $html;
    }
}

/* End of file MenuLib.php */
/* Location: ./application/libraries/MenuLib.php */
