<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'business-architect' ); ?></label>
    <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search products', 'business-architect' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <input type="submit" value="<?php echo esc_attr_x( '...', 'submit button', 'business-architect' ); ?>" />
    <input type="hidden" name="post_type" value="product" />
</form>
