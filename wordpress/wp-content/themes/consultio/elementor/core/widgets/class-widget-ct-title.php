<?php

class CT_CtTitle_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_title';
    protected $title = 'Title';
    protected $icon = 'eicon-t-letter';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"title_section","label":"Content","tab":"content","controls":[{"name":"style","label":"Style","type":"select","options":{"style1":"Style 1","style2":"Style 2"},"default":"style1"},{"name":"title","label":"Title","type":"text","label_block":true},{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .ct-title1 h3":"color: {{VALUE}};"}},{"name":"line_color","label":"Line Color","type":"color","selectors":{"{{WRAPPER}} .ct-title1 h3 i":"background-color: {{VALUE}};"},"condition":{"style":"style1"}},{"name":"title_typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .ct-title1 h3"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}