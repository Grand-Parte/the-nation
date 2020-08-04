<?php
ct_add_custom_widget(
    array(
        'name' => 'ct_newsletter',
        'title' => esc_html__('Newsletter', 'consultio'),
        'icon' => 'eicon-envelope',
        'categories' => array(Case_Theme_Core::CT_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Color Settings', 'consultio'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'input_color',
                            'label' => esc_html__('Input Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'style' => 'style1',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ct-newsletter1.style1 .tnp-field-email .tnp-email' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'input_bg_color',
                            'label' => esc_html__('Input Background Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'style' => 'style1',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ct-newsletter1.style1 .tnp-field-email .tnp-email' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_color1',
                            'label' => esc_html__('Button Color 1', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'style' => ['style1', 'style3'],
                            ],
                        ),
                        array(
                            'name' => 'button_color2',
                            'label' => esc_html__('Button Color 2', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'style' => ['style1', 'style3'],
                            ],
                        ),
                        array(
                            'name' => 'color_gradient_type',
                            'label' => esc_html__('Gradient Type', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'horizontal' => 'Horizontal',
                                'vertical' => 'Vertical',
                            ],
                            'default' => 'horizontal',
                            'condition' => [
                                'style' => ['style1', 'style3'],
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);