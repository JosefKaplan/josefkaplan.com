<?php

class minalite_Customize_Pro_Control extends WP_Customize_Control {
    public $type = 'minalite_pro';
    function render_content(){
        if ( ! empty( $this->label ) ) : ?>
            <span class="customize-control-title minalite-pro-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif;
        if ( ! empty( $this->description ) ) : ?>
            <div class="description customize-control-description minalite-pro-description"><?php echo $this->description ; ?></div>
        <?php endif; ?>
        <?php

    }
}

?>