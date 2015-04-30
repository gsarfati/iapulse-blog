<?php

class WPZOOM_Admin_Settings_Fields {
    public $first = true;

    public function preheader($args) {
        extract($args);

        if (!$this->first) {
            $out.= "</div>";
        }
        $this->first = false;
        $stitle = 'wpz_' . substr(md5($name), 0, 8);
        $out.= "<div class=\"sub\" id=\"$stitle\">";

        $out.= '<div class="zoom-sub-header">';
        $out.= "<h4>$name</h4>";

        if (isset($desc)) {
            if (is_array($desc)) {
                foreach ($desc as $row) {
                    $out.= "<p>$row</p>";
                }
            } else {
                $out.= "<p>$desc</p>";
            }
        }

        $out.='</div>';

        return $out;
    }

    public function startsub($args) {
        extract($args);

        $out.= '<fieldset>';
        $out.= "<legend>$name</legend>";
        $out.= '<div class="sub_right">';
        $out.= '</div>';

        return $out;
    }

    public function endsub($args) {
        $out = '</fieldset>';

        return $out;
    }

    public function button($args) {
        extract($args);

        $out.= "<button class=\"button-secondary\" id=\"$id\">$name</button>";
        $out.= "<p>$desc</p>";

        return $out;
    }

    public function paragraph($args) {
        extract($args);

        $out.= "<div class=\"checkbox\"><label>$name</label>";
        $out.= "<p>$desc</p></div>";

        return $out;
    }

    public function checkbox($args) {
        extract($args);

        $out.= '<div class="checkbox">';
        $out.= '<input type="checkbox" class="checkbox" name="'.$id.'" id="'.$id.'" ';
        if ($value == "on") {
            $out.= ' checked="checked"';
        } elseif (!$value && $std == "on") {
            $out.= ' checked="checked"';
        }
        $out.= " />";
        $out.= "<label for=\"$id\">$name</label>";
        $out.= "<p>$desc</p>";
        $out.= "</div>";

        return $out;
    }

    public function select($args) {
        extract($args);

        $out.= "<label>$name</label>";
        $out.= "<select name=\"$id\" id=\"$id\">";

        foreach ($options as $option) {
            $out.= '<option' . selected($option, $value, false) . '>' . $option;
            $out.= '</option>';
        }

        $out.= "</select>";
        $out.= "<p>$desc</p>";

        return $out;
    }

    public function select_category($args) {
        extract($args);

        unset($catids,$catnames);
        $categoriesParents = ui::getCategories();
        if (count($categoriesParents) > 0) {
            foreach ( $categoriesParents as $key => $value ) {
                $catids[] = $key;
                $catnames[] = $value;
            }
        }
        $out.= "<label>$name</label>";
        $out.= "<select name=\"$id\">";

        $out.= "<option value=\"0\"";
        $out.= (option::get($id) == 0) ? ' selected="selected"' : '';
        $out.= '> - select a category -';
        $out.= "</option>";

        foreach ($catids as $key => $val) {
            $out.= "<option value=\"$val\"";
            $out.= (option::get($id) == $val) ? ' selected="selected"' : '';
            $out.= '>' . $catnames[$key];
            $out.= "</option>";
        }
        $out.= "</select>";
        $out.= "<p>$desc</p>";

        return $out;
    }

    public function select_category_multi($args) {
        extract($args);

         unset($catids,$catnames);
        $categoriesParents = ui::getCategories();
        if (count($categoriesParents) > 0) {
            foreach ( $categoriesParents as $key => $value ) {
                $catids[] = $key;
                $catnames[] = $value;
            }
        }
        $activeoptions = is_array(option::get($id)) ? option::get($id) : array();
        $out.= "<label>$name</label>";
        $out.= "<select id=\"s_$id\" multiple=\"true\" name=\"" . $id . "[]\" style=\"height: 150px\">";

        $out.= "<option value=\"0\"";
        $out.= (in_array(0, $activeoptions)) ? ' selected="selected"' : '';
        $out.= '> - select a category -';
        $out.= "</option>";

        if (count($catids) > 0) {
            foreach ($catids as $key => $val) {
                $out.= "<option value=\"$val\"";
                if (in_array($val, $activeoptions)) {
                    $out.= ' selected="selected"';
                }
                $out.= ">" . $catnames[$key];
                $out.= '</option>';
            }
        }
        $out.= "</select>";
        $out.= "<p>$desc</p>";

        return $out;
    }

    public function select_page($args) {
        extract($args);

        $pages = get_pages();

        $out.= "<label>$name</label>";
        $out.= "<select name=\"$id\">";

        $out.= '<option value="0"';
        $out.= (option::get($id) == 0) ? ' selected="selected"' : '';
        $out.= '> - select a page -';
        $out.= "</option>";

        foreach ($pages as $page) {
            $out.= "<option value=\"{$page->ID}\"";
            $out.= (option::get($id) == $page->ID) ? ' selected="selected"' : '';
            $out.= '>' . get_the_title($page->ID);
            $out.= "</option>";
        }

        $out.= "</select>";
        $out.= "<p>$desc</p>";

        return $out;
    }

    public function select_tag_multi($args) {
        extract($args);

        unset($catids,$catnames);
        $categoriesParents = get_categories('taxonomy=post_tag');;

        $catids = array();
        $catnames = array();

        if (count($categoriesParents) > 0) {
            foreach ( $categoriesParents as $cat ) {
                $catids[] = $cat->term_id;
                $catnames[] = $cat->category_nicename;
            }
        }
        $activeoptions = is_array(option::get($id)) ? option::get($id) : array();
        $out.= "<label>$name</label>";
        $out.= "<select id=\"s_$id\" multiple=\"true\" name=\"" . $id . "[]\" style=\"height: 150px\">";

        $out.= "<option value=\"0\"";
        $out.= (in_array(0, $activeoptions)) ? ' selected="selected"' : '';
        $out.= '> - select a tag -';
        $out.= "</option>";

        if (count($catids) > 0) {
            foreach ($catids as $key => $val) {
                $out.= "<option value=\"$val\"";
                if (in_array($val, $activeoptions)) {
                    $out.= ' selected="selected"';
                }
                $out.= ">" . $catnames[$key];
                $out.= '</option>';
            }
        }
        $out.= "</select>";
        $out.= "<p>$desc</p>";

        return $out;
    }

    public function select_layout($args) {
        extract($args);

        $out.= "<label class=\"layout_label\">$name</label>";

        foreach ($options as $key => $val) {
            $out.= "<input id=\"$id--$key\" type=\"radio\" class=\"RadioClass\" name=\"$id\" value=\"$key\"";
            if (option::get($id) == $key) {
                $out .= ' checked';
            }
            $out.= ' />';
            $out.= "<label for=\"$id--$key\" class=\"RadioLabelClass";
            if (option::get($id) == $key) {
                $out .= ' RadioSelected';
            }
            $out.= "\">";
            $out.= "<img src=\"".WPZOOM::$wpzoomPath."/assets/images/layout-$key.png\" alt=\"\" title=\"$val\" class=\"layout-select\" /></label>";
        }
        $out.= "<p class=\"layout_desc\">$desc</p>";

        return $out;
    }

    public function text($args) {
        extract($args);

        $out.= "<label for=\"$id\">$name</label>";
        $out.= "<input name=\"$id\" id=\"$id\" type=\"$type\" value=\"" . esc_attr($value) . '" />';
        $out.= "<p>$desc</p>";

        return $out;
    }

    public function textarea($args) {
        extract($args);

        $value = apply_filters('wpzoom_field_' . $id, $value);

        $out.= "<label>$name</label>";
        $out.= "<textarea id=\"$id\" name=\"$id\" type=\"$type\" colls=\"\" rows=\"\">$value</textarea>";
        $out.= "<p>$desc</p>";

        return $out;
    }

    public function separator() {
        return '<div class="sep">&nbsp;</div>';
    }

    public function cleaner() {
        return '<div class="cleaner">&nbsp;</div>';
    }
}
