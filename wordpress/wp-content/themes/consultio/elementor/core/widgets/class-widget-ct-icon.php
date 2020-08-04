<?php

class CT_CtIcon_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_icon';
    protected $title = 'Icons';
    protected $icon = 'eicon-alert';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"section_icon","label":"Icons","tab":"content","controls":[{"name":"icons","label":"Icons","type":"repeater","controls":[{"name":"ct_icon","label":"Icon","type":"icons","fa4compatibility":"icon","default":{"value":"fas fa-star","library":"fa-solid"}},{"name":"icon_link","label":"Icon Link","type":"url","label_block":true}]},{"name":"style","label":"Style","type":"select","options":{"style1":"Style 1","style2":"Style 2","style3":"Style 3 (Box)"},"default":"style1"},{"name":"icon_color","label":"Icon Color","type":"color","selectors":{"{{WRAPPER}} .ct-icon1 a i":"color: {{VALUE}};"}},{"name":"icon_color_hover","label":"Icon Color","type":"color","selectors":{"{{WRAPPER}} .ct-icon1 a:hover i":"color: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}