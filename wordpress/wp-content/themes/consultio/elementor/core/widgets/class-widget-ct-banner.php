<?php

class CT_CtBanner_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_banner';
    protected $title = 'Banner';
    protected $icon = 'eicon-info-box';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/ctthemes\/csuti\/wp-content\/themes\/csuti\/elementor\/templates\/widgets\/ct_banner\/layout-image\/layout1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/ctthemes\/csuti\/wp-content\/themes\/csuti\/elementor\/templates\/widgets\/ct_banner\/layout-image\/layout2.jpg"}}}]},{"name":"content_section","label":"Banner Box","tab":"content","controls":[{"name":"image","label":"Banner Image","type":"media"},{"name":"thumbnail","label":"Image Size","type":"image-size","control_type":"group","default":"full"},{"name":"title","label":"Title","type":"text"},{"name":"desc","label":"Description","type":"textarea","rows":10,"show_label":false,"condition":{"layout":"2"}},{"name":"icon_image","label":"Icon Image","type":"media","condition":{"layout":"2"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}