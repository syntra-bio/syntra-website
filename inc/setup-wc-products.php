<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SYNTRA — One-time WooCommerce Product Setup Tool
 * Admin page at: WP Admin → Products → Create Syntra Products
 * Run once, then this file can be removed.
 */

add_action( 'admin_menu', function() {
    add_submenu_page(
        'edit.php?post_type=product',
        'Create Syntra Products',
        'Create Syntra Products',
        'manage_options',
        'syntra-product-setup',
        'syntra_product_setup_page'
    );
});

function syntra_product_setup_page() {
    $results = [];
    if ( isset( $_POST['syntra_create_products'] ) && check_admin_referer( 'syntra_setup' ) ) {
        $results = syntra_create_all_products();
    }
    ?>
    <div class="wrap">
        <h1>Create Syntra Products</h1>
        <p>This tool creates all Syntra products in WooCommerce with correct slugs, prices, categories, and descriptions. It skips products that already exist.</p>
        <?php if ( $results ) : ?>
            <div class="notice notice-success"><p><?php echo implode( '<br>', array_map( 'esc_html', $results ) ); ?></p></div>
        <?php endif; ?>
        <form method="post">
            <?php wp_nonce_field( 'syntra_setup' ); ?>
            <input type="hidden" name="syntra_create_products" value="1">
            <?php submit_button( 'Create All Products', 'primary large' ); ?>
        </form>
    </div>
    <?php
}

function syntra_create_all_products() {
    $log = [];

    $products = [
        [
            'slug'     => 'ghk-cu',
            'name'     => 'GHK-Cu (Copper Peptide)',
            'sku'      => 'GHKCU-100MG',
            'price'    => '79.99',
            'cats'     => [ 'Skin & Anti-Aging' ],
            'desc'     => 'GHK-Cu is a naturally occurring copper-binding tripeptide that modulates over 4,000 human genes, stimulates collagen and elastin synthesis, and exerts powerful antioxidant and wound-healing effects.',
        ],
        [
            'slug'     => 'bpc-157',
            'name'     => 'BPC-157',
            'sku'      => 'BPC157-10MG',
            'price'    => '89.99',
            'cats'     => [ 'Recovery & Repair' ],
            'desc'     => 'BPC-157 is a 15-amino-acid peptide derived from human gastric juice, extensively researched for its ability to accelerate healing of tendons, ligaments, gut lining, and muscle tissue via VEGF upregulation and the FAK-paxillin pathway.',
        ],
        [
            'slug'     => 'tb-500',
            'name'     => 'TB-500 (Thymosin Beta-4)',
            'sku'      => 'TB500-10MG',
            'price'    => '109.99',
            'cats'     => [ 'Recovery & Repair' ],
            'desc'     => 'TB-500 is the synthetic form of Thymosin Beta-4, a naturally occurring 43-amino-acid peptide that promotes systemic wound healing, muscle recovery, and cardiac repair through actin sequestration and stem cell mobilisation.',
        ],
        [
            'slug'     => 'bpc-157-tb500-stack',
            'name'     => 'BPC-157 + TB-500 Stack',
            'sku'      => 'BPC157-TB500-10MG',
            'price'    => '109.99',
            'cats'     => [ 'Recovery & Repair' ],
            'desc'     => 'The most popular recovery stack — BPC-157 targets localised tissue repair via VEGF and the FAK-paxillin pathway, while TB-500 provides systemic healing through actin sequestration and stem cell mobilisation.',
        ],
        [
            'slug'     => 'cjc-1295-no-dac',
            'name'     => 'CJC-1295 (No DAC)',
            'sku'      => 'CJC1295NODAC-10MG',
            'price'    => '109.99',
            'cats'     => [ 'Hormone Optimisation' ],
            'desc'     => 'CJC-1295 without DAC (Mod GRF 1-29) is the bioidentical GHRH(1-29) fragment that produces pulsatile, physiologically natural GH release.',
        ],
        [
            'slug'     => 'cjc-1295-dac',
            'name'     => 'CJC-1295 (with DAC)',
            'sku'      => 'CJC1295DAC-5MG',
            'price'    => '89.99',
            'cats'     => [ 'Hormone Optimisation' ],
            'desc'     => 'CJC-1295 with DAC uses Drug Affinity Complex technology to bind circulating albumin, extending its half-life to 6-8 days and producing sustained, dose-dependent GH and IGF-1 elevation.',
        ],
        [
            'slug'     => 'cjc-1295-ipamorelin-stack',
            'name'     => 'CJC-1295 + Ipamorelin Stack',
            'sku'      => 'CJC1295-IPA-10MG',
            'price'    => '119.99',
            'cats'     => [ 'Hormone Optimisation' ],
            'desc'     => 'The gold-standard GH optimisation stack — CJC-1295 No DAC stimulates GHRH receptors while Ipamorelin triggers a selective ghrelin-receptor pulse, producing synergistic GH release far greater than either alone.',
        ],
        [
            'slug'     => 'ipamorelin',
            'name'     => 'Ipamorelin',
            'sku'      => 'IPA-10MG',
            'price'    => '109.99',
            'cats'     => [ 'Hormone Optimisation' ],
            'desc'     => 'Ipamorelin is a highly selective growth hormone secretagogue that stimulates pulsatile GH release via GHSR-1a with no effect on cortisol or prolactin.',
        ],
        [
            'slug'     => 'sermorelin',
            'name'     => 'Sermorelin',
            'sku'      => 'SERM-10MG',
            'price'    => '139.99',
            'cats'     => [ 'Hormone Optimisation' ],
            'desc'     => 'Sermorelin is GHRH[1-29], the biologically active fragment of endogenous growth hormone-releasing hormone. It restores pulsatile GH secretion through the body\'s natural feedback systems.',
        ],
        [
            'slug'     => 'igf-lr3',
            'name'     => 'IGF-LR3',
            'sku'      => 'IGFLR3-10MG',
            'price'    => '269.99',
            'cats'     => [ 'Hormone Optimisation' ],
            'desc'     => 'IGF-LR3 is a synthetic analogue of IGF-1 with a substitution that reduces IGF-binding protein affinity, extending its half-life to 20-30 hours and amplifying anabolic signalling.',
        ],
        [
            'slug'     => 'melanotan-ii',
            'name'     => 'Melanotan II',
            'sku'      => 'MT2-10MG',
            'price'    => '54.99',
            'cats'     => [ 'Sexual Health' ],
            'desc'     => 'Melanotan II is a non-selective cyclic alpha-MSH analogue that activates MC1R to increase eumelanin production and MC4R to stimulate arousal pathways.',
        ],
        [
            'slug'     => 'pt-141',
            'name'     => 'PT-141 (Bremelanotide)',
            'sku'      => 'PT141-10MG',
            'price'    => '69.99',
            'cats'     => [ 'Sexual Health' ],
            'desc'     => 'PT-141 is a cyclic melanocortin peptide and FDA-approved treatment (Vyleesi) for Hypoactive Sexual Desire Disorder, activating MC3R and MC4R receptors in the hypothalamus.',
        ],
        [
            'slug'     => 'semax',
            'name'     => 'Semax',
            'sku'      => 'SEMAX-10MG',
            'price'    => '119.99',
            'cats'     => [ 'Cognitive & Neurological' ],
            'desc'     => 'Semax is a synthetic ACTH(4-10) heptapeptide analogue that produces 8-12x BDNF elevation in the hippocampus within 24 hours, approved in Russia for stroke and cognitive impairment.',
        ],
        [
            'slug'     => 'selank',
            'name'     => 'Selank',
            'sku'      => 'SELANK-10MG',
            'price'    => '79.99',
            'cats'     => [ 'Cognitive & Neurological' ],
            'desc'     => 'Selank is a synthetic heptapeptide anxiolytic approved in Russia, derived from Tuftsin. It demonstrated equivalent efficacy to benzodiazepines in a controlled GAD trial without sedation or dependence.',
        ],
        [
            'slug'     => 'dsip',
            'name'     => 'DSIP (Delta Sleep-Inducing Peptide)',
            'sku'      => 'DSIP-15MG',
            'price'    => '109.99',
            'cats'     => [ 'Cognitive & Neurological' ],
            'desc'     => 'DSIP is a naturally occurring nonapeptide that modulates slow-wave (delta) sleep architecture, reduces cortisol and ACTH production, and has shown anti-stress and analgesic properties.',
        ],
        [
            'slug'     => 'ss-31',
            'name'     => 'SS-31 (Elamipretide)',
            'sku'      => 'SS31-10MG',
            'price'    => '144.99',
            'cats'     => [ 'Longevity' ],
            'desc'     => 'SS-31 is a mitochondria-targeting tetrapeptide that selectively concentrates in the inner mitochondrial membrane, binding cardiolipin to restore electron transport chain efficiency and reduce ROS production.',
        ],
        [
            'slug'     => '5-amino-1mq',
            'name'     => '5-Amino-1MQ',
            'sku'      => '5A1MQ-60CAPS',
            'price'    => '109.99',
            'cats'     => [ 'Metabolic Health' ],
            'desc'     => '5-Amino-1MQ is an NNMT inhibitor that blocks the enzyme responsible for consuming NAD+ precursors in adipose tissue, increasing cellular NAD+ levels and activating SIRT1.',
        ],
        [
            'slug'     => 'klow',
            'name'     => 'KLOW 80mg',
            'sku'      => 'KLOW-80MG',
            'price'    => '89.99',
            'cats'     => [ 'Recovery & Repair' ],
            'desc'     => 'KLOW is a precision quad-peptide recovery complex combining GHK-Cu (50mg), KPV (10mg), BPC-157 (10mg), and TB-500 (10mg) targeting the full spectrum of tissue recovery and anti-inflammatory pathways simultaneously.',
        ],
        [
            'slug'     => 'retatrutide',
            'name'     => 'Retatrutide',
            'sku'      => 'RETAT-10MG',
            'price'    => '289.99',
            'cats'     => [ 'Weight Management & GLP-1' ],
            'desc'     => 'Retatrutide is a triple incretin receptor agonist (GIP/GLP-1/Glucagon) that produced up to 24.2% body weight reduction in Phase II human trials at 48 weeks — the highest result ever recorded.',
        ],
        [
            'slug'     => 'semaglutide',
            'name'     => 'Semaglutide',
            'sku'      => 'SEMA-10MG',
            'price'    => '249.99',
            'cats'     => [ 'Weight Management & GLP-1' ],
            'desc'     => 'Semaglutide is a GLP-1 receptor agonist (Ozempic/Wegovy) with Phase III trials demonstrating up to 14.9% body weight loss at 68 weeks and 20% cardiovascular event reduction.',
        ],
        [
            'slug'     => 'tirzepatide',
            'name'     => 'Tirzepatide',
            'sku'      => 'TIRZ-10MG',
            'price'    => '269.99',
            'cats'     => [ 'Weight Management & GLP-1' ],
            'desc'     => 'Tirzepatide (Mounjaro/Zepbound) is a dual GIP/GLP-1 receptor agonist that produced 22.5% body weight reduction in the SURMOUNT-1 Phase III trial — the most effective approved weight-loss drug.',
        ],
        [
            'slug'     => 'nad-plus',
            'name'     => 'NAD+',
            'sku'      => 'NAD-500MG',
            'price'    => '79.99',
            'cats'     => [ 'Longevity' ],
            'desc'     => 'NAD+ is a coenzyme essential to all living cells, driving over 500 enzymatic reactions including mitochondrial ATP production, DNA repair, and sirtuin-mediated longevity signalling.',
        ],
        [
            'slug'     => 'epithalon',
            'name'     => 'Epithalon (Epitalon)',
            'sku'      => 'EPITH-10MG',
            'price'    => '54.99',
            'cats'     => [ 'Longevity' ],
            'desc'     => 'Epithalon is a tetrapeptide pineal bioregulator that activates telomerase, restores melatonin production, and demonstrated 33% mortality reduction and lifespan extension in a 15-year human follow-up study.',
        ],
        [
            'slug'     => 'mots-c',
            'name'     => 'MOTS-c',
            'sku'      => 'MOTSC-10MG',
            'price'    => '139.99',
            'cats'     => [ 'Longevity' ],
            'desc'     => 'MOTS-c is a mitochondrial DNA-encoded peptide that activates AMPK to mimic the metabolic benefits of exercise and reversed high-fat diet-induced insulin resistance in animal models.',
        ],
        [
            'slug'     => 'humanin',
            'name'     => 'Humanin',
            'sku'      => 'HUMAN-10MG',
            'price'    => '154.99',
            'cats'     => [ 'Longevity' ],
            'desc'     => 'Humanin is a mitochondrial 12S rRNA-encoded peptide originally discovered as a neuroprotective agent against Alzheimer\'s disease. Elevated humanin levels are associated with human longevity and insulin sensitivity.',
        ],
        [
            'slug'     => 'thymosin-alpha-1',
            'name'     => 'Thymosin Alpha-1',
            'sku'      => 'TA1-10MG',
            'price'    => '119.99',
            'cats'     => [ 'Immune Support' ],
            'desc'     => 'Thymosin Alpha-1 (Zadaxin) is a 28-amino-acid thymic peptide approved in over 35 countries for hepatitis B and cancer immunotherapy adjunct use, demonstrating 38% mortality reduction in severe COVID-19.',
        ],
        [
            'slug'     => 'll-37',
            'name'     => 'LL-37',
            'sku'      => 'LL37-10MG',
            'price'    => '164.99',
            'cats'     => [ 'Immune Support' ],
            'desc'     => 'LL-37 is the only known human cathelicidin — a host-defence antimicrobial peptide that disrupts bacterial, fungal, and viral membranes and demonstrated direct virucidal activity against SARS-CoV-2 in vitro.',
        ],
        [
            'slug'     => 'kisspeptin-10',
            'name'     => 'Kisspeptin-10',
            'sku'      => 'KISS10-10MG',
            'price'    => '109.99',
            'cats'     => [ 'Hormone Optimisation' ],
            'desc'     => 'Kisspeptin-10 is the master upstream regulator of the hypothalamic-pituitary-gonadal axis, driving GnRH-mediated LH surges and validated as a safer IVF trigger alternative with lower OHSS risk.',
        ],
        [
            'slug'     => 'oxytocin',
            'name'     => 'Oxytocin',
            'sku'      => 'OXY-SPRAY-3ML',
            'price'    => '54.99',
            'cats'     => [ 'Cognitive & Neurological' ],
            'desc'     => 'Oxytocin is the hypothalamic neuropeptide governing social bonding, trust, and stress resilience. Intranasal administration demonstrated 34% social anxiety reduction in controlled trials.',
        ],
        [
            'slug'     => 'vip',
            'name'     => 'VIP (Vasoactive Intestinal Peptide)',
            'sku'      => 'VIP-10MG',
            'price'    => '174.99',
            'cats'     => [ 'Immune Support' ],
            'desc'     => 'VIP is a 28-amino-acid neuropeptide and potent anti-inflammatory agent that suppresses cytokine storms, induces regulatory T-cells, and modulates the gut-immune axis — with FDA Breakthrough Therapy Designation for COVID-19.',
        ],
        [
            'slug'     => 'dihexa',
            'name'     => 'Dihexa',
            'sku'      => 'DIHEX-60CAPS',
            'price'    => '139.99',
            'cats'     => [ 'Cognitive & Neurological' ],
            'desc'     => 'Dihexa is a synthetic Angiotensin IV-derived peptide that potentiates HGF/c-Met signalling to drive hippocampal synaptogenesis at concentrations reported to be 10 million times more potent than BDNF.',
        ],
        [
            'slug'     => 'aod-9604',
            'name'     => 'AOD-9604',
            'sku'      => 'AOD9604-10MG',
            'price'    => '89.99',
            'cats'     => [ 'Metabolic Health' ],
            'desc'     => 'AOD-9604 is the C-terminal fragment of human growth hormone that replicates GH\'s lipolytic activity without anabolic or IGF-1-elevating effects. It holds FDA GRAS status.',
        ],
        [
            'slug'     => 'bac-water',
            'name'     => 'BAC Water (Bacteriostatic Water)',
            'sku'      => 'BACWATER-10ML',
            'price'    => '9.99',
            'cats'     => [ 'Accessories' ],
            'desc'     => 'Pharmaceutical-grade bacteriostatic water (sterile water with 0.9% benzyl alcohol) for the reconstitution of lyophilised peptide vials. Maintains sterility for 28 days after opening.',
        ],
    ];

    // Ensure categories exist
    $all_cats = [];
    foreach ( $products as $p ) {
        foreach ( $p['cats'] as $cat ) {
            $all_cats[] = $cat;
        }
    }
    foreach ( array_unique( $all_cats ) as $cat_name ) {
        if ( ! term_exists( $cat_name, 'product_cat' ) ) {
            wp_insert_term( $cat_name, 'product_cat' );
            $log[] = "Created category: {$cat_name}";
        }
    }

    foreach ( $products as $p ) {
        // Check if product with this slug already exists
        $existing = get_page_by_path( $p['slug'], OBJECT, 'product' );
        if ( $existing ) {
            $log[] = "SKIPPED (already exists): {$p['name']}";
            continue;
        }

        // Resolve category term IDs
        $cat_ids = [];
        foreach ( $p['cats'] as $cat_name ) {
            $term = get_term_by( 'name', $cat_name, 'product_cat' );
            if ( $term ) $cat_ids[] = $term->term_id;
        }

        // Create the WooCommerce product
        $product = new WC_Product_Simple();
        $product->set_name( $p['name'] );
        $product->set_slug( $p['slug'] );
        $product->set_sku( $p['sku'] );
        $product->set_regular_price( $p['price'] );
        $product->set_short_description( $p['desc'] );
        $product->set_status( 'publish' );
        $product->set_catalog_visibility( 'visible' );
        $product->set_category_ids( $cat_ids );
        $product->set_manage_stock( false );
        $product->set_stock_status( 'instock' );
        $id = $product->save();

        if ( $id ) {
            // Force the slug to exactly match our key
            wp_update_post( [ 'ID' => $id, 'post_name' => $p['slug'] ] );
            $log[] = "CREATED: {$p['name']} (ID: {$id}, slug: {$p['slug']})";
        } else {
            $log[] = "FAILED: {$p['name']}";
        }
    }

    return $log;
}
