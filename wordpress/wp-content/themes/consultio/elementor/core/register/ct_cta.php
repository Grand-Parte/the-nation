<?php
// Register Call To Action Widget
ct_add_custom_widget(
    array(
        'name' => 'ct_cta',
        'title' => esc_html__('Call To Action', 'consultio' ),
        'icon' => 'eicon-call-to-action',
        'categories' => array( Case_Theme_Core::CT_CATEGORY_NAME ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'consultio' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'desc',
                            'label' => esc_html__('Description', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'btn_text',
                            'label' => esc_html__('Button Text', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'btn_link',
                            'label' => esc_html__('Button Link', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'default' => [
                                'url' => '#',
                            ],
                        ),
                        array(
                            'name' => 'btn_icon',
                            'label' => esc_html__('Button Icon', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'label_block' => true,
                            'fa4compatibility' => 'icon',
                        ),
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Button Style', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'consultio' ),
                                'btn-effect' => esc_html__('Default Effect', 'consultio' ),
                                'btn-primary' => esc_html__('Primary', 'consultio' ),
                                'btn-secondary' => esc_html__('Secondary', 'consultio' ),
                                'btn-secondary2' => esc_html__('Secondary Hover Two', 'consultio' ),
                                'btn-third' => esc_html__('Third One', 'consultio' ),
                                'btn-third2' => esc_html__('Third Two', 'consultio' ),
                                'btn-white' => esc_html__('White', 'consultio' ),
                                'btn-white2' => esc_html__('White 2', 'consultio' ),
                                'btn-round' => esc_html__('Round 1', 'consultio' ),
                                'btn-round2' => esc_html__('Round 2', 'consultio' ),
                                'text-white' => esc_html__('Text White', 'consultio' ),
                                'line-white' => esc_html__('Line White', 'consultio' ),
                                'btn-hover-outline' => esc_html__('Hover Outline', 'consultio' ),
                            ],
                        ),
                        array(
                            'name' => 'box_bg_color',
                            'label' => esc_html__('Box Background color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-cta1' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'ct_animate',
                            'label' => esc_html__('Case Animate', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => consultio_animate(),
                            'default' => '',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);