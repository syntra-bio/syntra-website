<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Syntra Variants — Strength / Size Selector
 * Meta box, cart hooks, availability helpers
 */

/* ─────────────────────────────────────────────────────────
   HELPERS
───────────────────────────────────────────────────────── */

/**
 * Return saved variants array for a product (indexed from 0).
 */
function syntra_get_variants( $product_id ) {
    $data = get_post_meta( (int) $product_id, 'syntra_variants', true );
    return is_array( $data ) ? array_values( $data ) : [];
}

/**
 * Aggregate stock across all variants.
 * Returns 'instock' | 'onbackorder' | 'outofstock', or null if no variants.
 */
function syntra_variant_aggregate_stock( $product_id ) {
    $variants = syntra_get_variants( $product_id );
    if ( empty( $variants ) ) return null;

    $has_in  = false;
    $has_bo  = false;
    foreach ( $variants as $v ) {
        $s = $v['stock'] ?? 'outofstock';
        if ( $s === 'instock' )     $has_in = true;
        if ( $s === 'onbackorder' ) $has_bo = true;
    }

    if ( $has_in ) return 'instock';
    if ( $has_bo ) return 'onbackorder';
    return 'outofstock';
}

/* ─────────────────────────────────────────────────────────
   META BOX — Registration
───────────────────────────────────────────────────────── */
add_action( 'add_meta_boxes', 'syntra_variants_register_box' );
function syntra_variants_register_box() {
    add_meta_box(
        'syntra_variants_box',
        'Syntra Variants (Strengths / Sizes)',
        'syntra_variants_box_render',
        'product',
        'normal',
        'high'
    );
}

/* ─────────────────────────────────────────────────────────
   META BOX — Render
───────────────────────────────────────────────────────── */
function syntra_variants_box_render( $post ) {
    wp_nonce_field( 'syntra_variants_save', 'syntra_variants_nonce' );
    $variants = syntra_get_variants( $post->ID );
    if ( empty( $variants ) ) $variants = [[]];
    ?>
    <style>
    #svt{width:100%;border-collapse:collapse;margin-bottom:4px}
    #svt th{padding:6px 8px;font-size:11px;text-align:left;background:#f0f4f8;color:#1F3552;border-bottom:2px solid #ddd;white-space:nowrap}
    #svt td{padding:5px 4px;vertical-align:middle;border-bottom:1px solid #f4f4f4}
    #svt input,#svt select{width:100%;padding:4px 6px;border:1px solid #ddd;border-radius:4px;font-size:12px;box-sizing:border-box}
    .svt-margin{font-family:monospace;font-size:12px;font-weight:700;color:#2FB7B3;min-width:42px;display:block;text-align:center}
    .svt-rm{background:#e53935;color:#fff;border:none;border-radius:3px;padding:3px 7px;cursor:pointer;font-size:11px}
    .svt-thumb{max-width:38px;max-height:38px;border-radius:3px;display:block;margin-bottom:2px}
    .svt-img-btn{font-size:10px!important;padding:2px 6px!important}
    #svt-add{margin-top:8px}
    </style>

    <table id="svt">
      <thead>
        <tr>
          <th style="width:65px">Label</th>
          <th style="width:48px">Unit</th>
          <th style="width:124px">SKU</th>
          <th style="width:74px">Cost AUD</th>
          <th style="width:74px">Price AUD</th>
          <th style="width:52px">Margin</th>
          <th style="width:118px">Stock</th>
          <th style="width:72px">Image</th>
          <th style="width:28px"></th>
        </tr>
      </thead>
      <tbody id="svt-body">
        <?php foreach ( $variants as $i => $v ) : syntra_variants_row( $i, $v ); endforeach; ?>
      </tbody>
    </table>

    <button type="button" class="button" id="svt-add">+ Add Variant</button>

    <p style="margin-top:10px;font-size:11px;color:#666;">
      <strong>Label</strong> = what the customer sees (e.g. <em>10mg</em>, <em>3ml</em>).
      Saving auto-syncs the WooCommerce product price &amp; SKU to the first variant.
    </p>

    <script>
    (function($){
        var idx = <?php echo count( $variants ); ?>;

        function calcMargin(row) {
            var cost  = parseFloat(row.find('[name$="[cost]"]').val())  || 0;
            var price = parseFloat(row.find('[name$="[price]"]').val()) || 0;
            var m     = price > 0 ? ((price - cost) / price * 100).toFixed(1) + '%' : '—';
            row.find('.svt-margin').text(m);
        }

        function bindRow(row) {
            row.find('[name$="[cost]"],[name$="[price]"]').on('input', function(){
                calcMargin($(this).closest('tr'));
            });
            row.find('.svt-rm').on('click', function(){ $(this).closest('tr').remove(); });
            row.find('.svt-img-btn').on('click', function(e){
                e.preventDefault();
                var tr    = $(this).closest('tr');
                var frame = wp.media({ title:'Select Variant Image', button:{text:'Use Image'}, multiple:false });
                frame.on('select', function(){
                    var att = frame.state().get('selection').first().toJSON();
                    var src = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
                    tr.find('.svt-img-id').val(att.id);
                    tr.find('.svt-thumb').attr('src', src).show();
                });
                frame.open();
            });
        }

        $('#svt-body tr').each(function(){ bindRow($(this)); });

        $('#svt-add').on('click', function(){
            var tpl = <?php echo json_encode( syntra_variants_row_tpl() ); ?>;
            tpl = tpl.replace(/\[__I__\]/g, idx);
            var row = $(tpl);
            $('#svt-body').append(row);
            bindRow(row);
            idx++;
        });
    })(jQuery);
    </script>
    <?php
}

function syntra_variants_row( $i, $v ) {
    $label  = esc_attr( $v['label']  ?? '' );
    $unit   = $v['unit']  ?? 'mg';
    $sku    = esc_attr( $v['sku']    ?? '' );
    $cost   = esc_attr( $v['cost']   ?? '' );
    $price  = esc_attr( $v['price']  ?? '' );
    $stock  = $v['stock'] ?? 'instock';
    $image  = absint( $v['image']    ?? 0 );
    $margin = '';
    if ( $price && $cost && (float) $price > 0 ) {
        $margin = round( ( (float) $price - (float) $cost ) / (float) $price * 100, 1 ) . '%';
    }
    $img_url = $image ? wp_get_attachment_image_url( $image, 'thumbnail' ) : '';
    $img_lg  = $image ? wp_get_attachment_image_url( $image, 'large' )     : '';

    echo '<tr>';
    echo '<td><input type="text" name="syntra_variants[' . $i . '][label]" value="' . $label . '" placeholder="10mg"></td>';
    echo '<td><select name="syntra_variants[' . $i . '][unit]">';
    echo '<option value="mg"' . ( $unit === 'mg' ? ' selected' : '' ) . '>mg</option>';
    echo '<option value="ml"' . ( $unit === 'ml' ? ' selected' : '' ) . '>ml</option>';
    echo '</select></td>';
    echo '<td><input type="text" name="syntra_variants[' . $i . '][sku]" value="' . $sku . '" placeholder="SYN-GLP-001"></td>';
    echo '<td><input type="number" name="syntra_variants[' . $i . '][cost]" value="' . $cost . '" placeholder="0.00" step="0.01" min="0"></td>';
    echo '<td><input type="number" name="syntra_variants[' . $i . '][price]" value="' . $price . '" placeholder="0.00" step="0.01" min="0"></td>';
    echo '<td><span class="svt-margin">' . esc_html( $margin ?: '—' ) . '</span></td>';

    echo '<td><select name="syntra_variants[' . $i . '][stock]">';
    foreach ( [ 'instock' => 'In Stock', 'onbackorder' => 'Backorder', 'outofstock' => 'Out of Stock' ] as $val => $lbl ) {
        echo '<option value="' . $val . '"' . ( $stock === $val ? ' selected' : '' ) . '>' . $lbl . '</option>';
    }
    echo '</select></td>';

    echo '<td>';
    echo '<input type="hidden" name="syntra_variants[' . $i . '][image]" class="svt-img-id" value="' . $image . '">';
    echo '<input type="hidden" name="syntra_variants[' . $i . '][image_lg]" class="svt-img-lg" value="' . esc_attr( $img_lg ) . '">';
    if ( $img_url ) {
        echo '<img src="' . esc_attr( $img_url ) . '" class="svt-thumb">';
    } else {
        echo '<img src="" class="svt-thumb" style="display:none">';
    }
    echo '<button type="button" class="button button-small svt-img-btn">Select</button>';
    echo '</td>';

    echo '<td><button type="button" class="svt-rm">✕</button></td>';
    echo '</tr>';
}

function syntra_variants_row_tpl() {
    ob_start();
    syntra_variants_row( '[__I__]', [] );
    return ob_get_clean();
}

/* ─────────────────────────────────────────────────────────
   SAVE VARIANTS
───────────────────────────────────────────────────────── */
add_action( 'save_post_product', 'syntra_variants_save_meta', 10, 2 );
function syntra_variants_save_meta( $post_id, $post ) {
    if ( ! isset( $_POST['syntra_variants_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['syntra_variants_nonce'], 'syntra_variants_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $raw      = isset( $_POST['syntra_variants'] ) ? (array) $_POST['syntra_variants'] : [];
    $variants = [];

    foreach ( $raw as $row ) {
        $label = sanitize_text_field( $row['label'] ?? '' );
        if ( $label === '' ) continue;

        $variants[] = [
            'label' => $label,
            'unit'  => in_array( $row['unit'] ?? '', [ 'mg', 'ml' ], true ) ? $row['unit'] : 'mg',
            'sku'   => sanitize_text_field( $row['sku']   ?? '' ),
            'cost'  => round( (float) ( $row['cost']  ?? 0 ), 2 ),
            'price' => round( (float) ( $row['price'] ?? 0 ), 2 ),
            'stock' => in_array( $row['stock'] ?? '', [ 'instock', 'onbackorder', 'outofstock' ], true ) ? $row['stock'] : 'instock',
            'image' => absint( $row['image'] ?? 0 ),
        ];
    }

    update_post_meta( $post_id, 'syntra_variants', $variants );

    // Sync WC product price & SKU to first variant
    if ( ! empty( $variants ) ) {
        $first = $variants[0];
        if ( $first['price'] > 0 ) {
            update_post_meta( $post_id, '_price',         (string) $first['price'] );
            update_post_meta( $post_id, '_regular_price', (string) $first['price'] );
        }
        if ( $first['sku'] ) {
            update_post_meta( $post_id, '_sku', $first['sku'] );
        }
    }
}

/* ─────────────────────────────────────────────────────────
   CART HOOKS
───────────────────────────────────────────────────────── */

// 1. Attach variant data to cart item
add_filter( 'woocommerce_add_cart_item_data', 'syntra_variant_add_cart_data', 10, 2 );
function syntra_variant_add_cart_data( $cart_item_data, $product_id ) {
    if ( ! isset( $_POST['syntra_variant_index'] ) ) return $cart_item_data;

    $index    = absint( $_POST['syntra_variant_index'] );
    $variants = syntra_get_variants( $product_id );

    if ( empty( $variants ) || ! array_key_exists( $index, $variants ) ) return $cart_item_data;

    $v = $variants[ $index ];
    $cart_item_data['syntra_variant'] = [
        'index' => $index,
        'label' => sanitize_text_field( $v['label'] ),
        'unit'  => sanitize_text_field( $v['unit'] ),
        'sku'   => sanitize_text_field( $v['sku'] ),
        'price' => (float) $v['price'],
        'stock' => $v['stock'],
    ];
    // Unique key so same product with different variant = separate cart lines
    $cart_item_data['syntra_variant_uid'] = $product_id . ':' . $index;

    return $cart_item_data;
}

// 2. Override price in cart
add_action( 'woocommerce_before_calculate_totals', 'syntra_variant_override_price', 20 );
function syntra_variant_override_price( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    foreach ( $cart->get_cart() as $item ) {
        if ( ! empty( $item['syntra_variant']['price'] ) ) {
            $item['data']->set_price( (float) $item['syntra_variant']['price'] );
        }
    }
}

// 3. Display variant label in cart + checkout
add_filter( 'woocommerce_get_item_data', 'syntra_variant_cart_label', 10, 2 );
function syntra_variant_cart_label( $data, $cart_item ) {
    if ( ! empty( $cart_item['syntra_variant'] ) ) {
        $v = $cart_item['syntra_variant'];
        $data[] = [
            'name'    => 'Strength',
            'value'   => esc_html( $v['label'] . $v['unit'] ),
            'display' => esc_html( $v['label'] . $v['unit'] ),
        ];
    }
    return $data;
}

// 4. Save variant to order line item
add_action( 'woocommerce_checkout_create_order_line_item', 'syntra_variant_order_meta', 10, 4 );
function syntra_variant_order_meta( $item, $cart_item_key, $values, $order ) {
    if ( ! empty( $values['syntra_variant'] ) ) {
        $v = $values['syntra_variant'];
        $item->add_meta_data( 'Strength',    esc_html( $v['label'] . $v['unit'] ), true );
        $item->add_meta_data( 'Variant SKU', esc_html( $v['sku'] ),                true );
    }
}

// 5. Validate variant is not out of stock before adding to cart
add_filter( 'woocommerce_add_to_cart_validation', 'syntra_variant_validate', 10, 3 );
function syntra_variant_validate( $passed, $product_id, $quantity ) {
    if ( ! isset( $_POST['syntra_variant_index'] ) ) return $passed;

    $index    = absint( $_POST['syntra_variant_index'] );
    $variants = syntra_get_variants( $product_id );

    if ( empty( $variants ) || ! array_key_exists( $index, $variants ) ) return $passed;

    if ( ( $variants[ $index ]['stock'] ?? 'instock' ) === 'outofstock' ) {
        wc_add_notice( 'This variant is currently out of stock.', 'error' );
        return false;
    }

    return $passed;
}

/* ─────────────────────────────────────────────────────────
   SHOP / ARCHIVE — Aggregate stock availability
───────────────────────────────────────────────────────── */
add_filter( 'woocommerce_get_availability', 'syntra_variant_availability', 10, 2 );
function syntra_variant_availability( $availability, $product ) {
    $agg = syntra_variant_aggregate_stock( $product->get_id() );
    if ( $agg === null ) return $availability;

    switch ( $agg ) {
        case 'instock':
            return [ 'availability' => 'In Stock',                  'class' => 'in-stock' ];
        case 'onbackorder':
            return [ 'availability' => 'Available on Backorder',    'class' => 'available-on-backorder' ];
        default:
            return [ 'availability' => 'Out of Stock',              'class' => 'out-of-stock' ];
    }
}
