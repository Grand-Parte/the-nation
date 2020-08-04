<?php

class CT_CtAboutUs_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_about_us';
    protected $title = 'About Us';
    protected $icon = 'eicon-site-logo';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"content_section","label":"Banner Box","tab":"content","controls":[{"name":"image","label":"Image","type":"media"},{"name":"sub_title","label":"Sub Title","type":"text"},{"name":"title","label":"Title","type":"text"},{"name":"desc","label":"Description","type":"textarea","rows":10,"show_label":false},{"name":"bg","type":"background","control_type":"group","types":["classic","gradient"],"selector":"{{WRAPPER}} .ct-about-us .ct-about-holder"},{"name":"icon_box","label":"Icon Box","type":"repeater","controls":[{"name":"ib_icon","label":"Icon","type":"icons","fa4compatibility":"icon","default":{"value":"fas fa-star","library":"fa-solid"}},{"name":"ib_title","label":"Title","type":"text"},{"name":"ib_content","label":"Content","type":"textarea"}],"title_field":"{{{ ib_title }}}"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}