<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bspagination {

    var $CI = null;

    function Bspagination() {
        $this->CI = & get_instance();
        clear_cache();
    }
    
    function config(){
        $bsp_init = array(
            'full_tag_open'    => '<ul class="pagination pagination-sm pull-right">',
            'full_tag_close'   => '</ul>',
            'first_link'       => FALSE,
            'last_link'        => FALSE,
            'first_tag_open'   => '<li>',
            'first_tag_close'  => '</li>',
            'prev_link'        => '&laquo',
            'prev_tag_open'    => '<li class="prev">',
            'prev_tag_close'   => '</li>',
            'next_link'        => '&raquo',
            'next_tag_open'    => '<li>',
            'next_tag_close'   => '</li>',
            'last_tag_open'    => '<li>',
            'last_tag_close'   => '</li>',
            'cur_tag_open'     => '<li class="active"><a href="#">',
            'cur_tag_close'    => '</a></li>',
            'num_tag_open'     => '<li>',
            'num_tag_close'    => '</li>'
        );
        return $bsp_init;
    }
}