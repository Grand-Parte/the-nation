<?php

class CT_CtVideoPlayer_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_video_player';
    protected $title = 'Video Player';
    protected $icon = 'eicon-play';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"icon_section","label":"Video Player","tab":"content","controls":[{"name":"image","label":"Choose Image","type":"media"},{"name":"image_type","label":"Image Type","type":"select","options":{"img":"Image","bg":"Background"},"default":"img"},{"name":"image_height","label":"Image Height","type":"slider","description":"Enter number.","condition":{"image_type":"bg"},"range":{"px":{"min":0,"max":3000}},"control_type":"responsive","selectors":{"{{WRAPPER}} .ct-video-player .ct-video-image-bg":"height: {{SIZE}}{{UNIT}};"}},{"name":"video_link","label":"Link","type":"text"},{"name":"btn_video_style","label":"Button Video Style","type":"select","options":{"style1":"Style 1","style2":"Style 2","style3":"Style 3","style4":"Style 4 (Light)","style5":"Style 5 (Small)","style6":"Style 6 (Light)","style7":"Style 7 (Light)"},"default":"style1"},{"name":"ct_animate","label":"Case Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomIn":"zoomIn","wow zoomInDown":"zoomInDown","wow zoomInLeft":"zoomInLeft","wow zoomInRight":"zoomInRight","wow zoomInUp":"zoomInUp","wow zoomOut":"zoomOut","wow zoomOutDown":"zoomOutDown","wow zoomOutLeft":"zoomOutLeft","wow zoomOutRight":"zoomOutRight","wow zoomOutUp":"zoomOutUp"},"default":""}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}