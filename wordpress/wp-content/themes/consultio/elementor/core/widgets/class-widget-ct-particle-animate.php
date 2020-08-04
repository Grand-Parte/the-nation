<?php

class CT_CtParticleAnimate_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_particle_animate';
    protected $title = 'Particle Animate';
    protected $icon = 'eicon-barcode';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"content_section","label":"Source Settings","tab":"content","controls":[{"name":"content_list","label":"Images","type":"repeater","default":[],"controls":[{"name":"particle","label":"Particle","type":"media"},{"name":"particle_animate","label":"Animate","type":"select","options":{"shape-animate1":"Animate 1","shape-animate2":"Animate 2","shape-animate3":"Animate 3","shape-animate4":"Animate 4","shape-animate5":"Animate 5","shape-animate6":"Animate 6","shape-parallax":"Parallax","animate-none":"None"},"default":"shape-animate1"},{"name":"top_positioon","label":"Top Position","type":"slider","size_units":["%"],"default":{"size":0},"range":{"%":{"min":0,"max":100}}},{"name":"left_positioon","label":"Left Position","type":"slider","size_units":["%"],"default":{"size":0},"range":{"%":{"min":0,"max":100}}}]}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}