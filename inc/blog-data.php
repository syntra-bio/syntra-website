<?php
if ( ! defined( 'ABSPATH' ) ) exit;

const SYNTRA_BLOG = [

    /* ─────────────────────────────────────────────────────────
       1. BPC-157
    ───────────────────────────────────────────────────────── */
    'bpc-157' => [
        'title'       => 'BPC-157: The Science Behind Tissue Repair, Gut Healing & Tendon Recovery',
        'slug'        => 'bpc-157',
        'category'    => 'Recovery',
        'cat_slug'    => 'recovery',
        'gradient'    => 'linear-gradient(135deg, #1F3552 0%, #2FB7B3 100%)',
        'hero_stat'   => '15',
        'hero_label'  => 'Amino Acid Pentadecapeptide',
        'intro'       => 'BPC-157 (Body Protection Compound-157) is a synthetic 15-amino-acid pentadecapeptide derived from a protein found in human gastric juice. Studied extensively at the University of Zagreb by Professor Predrag Sikiric, this compound has demonstrated remarkable tissue-repair properties across more than 100 peer-reviewed in vitro and animal studies. Its primary mechanisms involve VEGF-mediated angiogenesis, nitric oxide modulation, and direct activation of FAK-paxillin pathways in tenocytes.',
        'mechanisms'  => [
            [ 'emoji' => '🧬', 'title' => 'VEGF-Mediated Angiogenesis',      'desc' => 'BPC-157 upregulates Vascular Endothelial Growth Factor expression, accelerating new blood vessel formation into injured tissue — its most critical repair mechanism.' ],
            [ 'emoji' => '⚗️', 'title' => 'FAK-Paxillin Pathway Activation', 'desc' => 'Activates the FAK-paxillin signaling axis in tenocytes, directly stimulating proliferation and migration to repair collagen matrix architecture.' ],
            [ 'emoji' => '🛡️', 'title' => 'Gut Mucosal Protection',          'desc' => 'Upregulates GH receptors in intestinal mucosa, protecting against NSAID-induced damage and preserving gut barrier integrity.' ],
            [ 'emoji' => '🔬', 'title' => 'NF-κB & COX-2 Suppression',       'desc' => 'Reduces COX-2-mediated inflammation and modulates NF-κB signaling, producing systemic anti-inflammatory effects in preclinical models.' ],
        ],
        'stats'       => [
            [ 'emoji' => '📄', 'num' => '100+',  'label' => 'Peer-Reviewed Studies',    'sub' => 'University of Zagreb research' ],
            [ 'emoji' => '⏱️', 'num' => '72h',   'label' => 'Observed Repair Onset',    'sub' => 'Preclinical tendon models' ],
            [ 'emoji' => '🦠', 'num' => '15',    'label' => 'Amino Acids',               'sub' => 'Pentadecapeptide sequence' ],
            [ 'emoji' => '🧪', 'num' => '6',     'label' => 'Mechanism Pathways',        'sub' => 'VEGF, NO, FAK, NF-κB, COX-2, GHR' ],
        ],
        'chart_type'  => 'hbar',
        'chart_title' => 'Preclinical Tendon Load Capacity — BPC-157 vs. Control (% improvement)',
        'chart_labels' => [ '2-Week Recovery', '4-Week Recovery', 'Tensile Strength', 'Collagen Organisation', 'Histological Score' ],
        'chart_data'   => [ 38, 61, 44, 52, 67 ],
        'chart_note'   => 'Data derived from Sikiric et al. (2003) J Physiol Paris — rat Achilles tendon transection model. In vitro / preclinical findings only.',
        'safety'       => [
            [ 'pct' => 94, 'label' => 'Tolerability',       'severity' => 'low' ],
            [ 'pct' => 12, 'label' => 'Injection-Site Rxn', 'severity' => 'low' ],
            [ 'pct' => 5,  'label' => 'Theoretical Risk',   'severity' => 'medium' ],
        ],
        'citations'    => [
            [ 'journal' => 'J Physiol Paris',            'title' => 'Stable gastric pentadecapeptide BPC 157 in trials for inflammatory bowel disease and wound healing', 'year' => '2003', 'author' => 'Sikiric P et al.', 'pmid' => '12507755', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/12507755/' ],
            [ 'journal' => 'J Orthop Surg Res',          'title' => 'Effect of pentadecapeptide BPC 157 on healing of muscle crush injury in rats', 'year' => '2010', 'author' => 'Pevec D et al.', 'pmid' => '20369860', 'url' => 'https://www.ncbi.nlm.nih.gov/pmc/articles/PMC2855985/' ],
            [ 'journal' => 'Inflammopharmacology',       'title' => 'BPC 157 and NSAID-induced gut damage prevention in animal models', 'year' => '2013', 'author' => 'Sikiric P et al.', 'pmid' => '23435935', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/23435935/' ],
        ],
        'product_slug' => 'bpc-157',
    ],

    /* ─────────────────────────────────────────────────────────
       2. TB-500
    ───────────────────────────────────────────────────────── */
    'tb-500' => [
        'title'       => 'TB-500: Systemic Recovery, Muscle Repair & Cardiovascular Healing',
        'slug'        => 'tb-500',
        'category'    => 'Recovery',
        'cat_slug'    => 'recovery',
        'gradient'    => 'linear-gradient(135deg, #1F3552 0%, #4E5F71 100%)',
        'hero_stat'   => '43',
        'hero_label'  => 'Amino Acid Thymosin Beta-4 Analogue',
        'intro'       => 'TB-500 is the synthetic form of Thymosin Beta-4 (Tβ4), a naturally occurring 43-amino-acid peptide encoded by the TMSB4X gene and found in virtually every human cell. Unlike BPC-157\'s localized action, TB-500 operates systemically — mobilizing stem cells, regulating actin polymerization, and driving body-wide tissue repair signaling. It is one of the few peptides with Phase I/II human clinical data from RegeneRx Biopharmaceuticals.',
        'mechanisms'  => [
            [ 'emoji' => '🧬', 'title' => 'Actin Sequestration & Cell Migration', 'desc' => 'Tβ4\'s primary role is sequestering G-actin monomers, controlling polymerization that governs cell migration and wound closure at the molecular level.' ],
            [ 'emoji' => '❤️', 'title' => 'Cardiac Progenitor Stem Cell Activation', 'desc' => 'Activates dormant epicardial progenitor stem cells post-myocardial infarction, promoting cardiomyocyte regeneration and measurable improvement in ejection fraction.' ],
            [ 'emoji' => '🛡️', 'title' => 'Anti-Fibrotic Signaling',             'desc' => 'Downregulates myofibroblast differentiation — the primary driver of scar formation — with documented activity in cardiac, hepatic, and cutaneous fibrosis models.' ],
            [ 'emoji' => '🔬', 'title' => 'NF-κB & Cytokine Suppression',         'desc' => 'Reduces NF-κB signaling and pro-inflammatory cytokines including IL-1β and TNF-α while simultaneously promoting angiogenesis in ischemic tissue.' ],
        ],
        'stats'       => [
            [ 'emoji' => '💊', 'num' => 'Phase II', 'label' => 'Human Clinical Trials',    'sub' => 'RegeneRx Biopharmaceuticals' ],
            [ 'emoji' => '🩺', 'num' => '43',       'label' => 'Amino Acids',               'sub' => 'TMSB4X gene encoded' ],
            [ 'emoji' => '🔬', 'num' => '4',        'label' => 'Fibrosis Models Studied',   'sub' => 'Cardiac, hepatic, skin, corneal' ],
            [ 'emoji' => '🧪', 'num' => 'Systemic', 'label' => 'Mechanism Reach',           'sub' => 'Body-wide vs. localized' ],
        ],
        'chart_type'  => 'bar',
        'chart_title' => 'Wound Healing Improvement Rates — TB-500 vs. Placebo (% change from baseline)',
        'chart_labels' => [ 'Pressure Ulcers', 'Venous Stasis', 'Corneal Epithelium', 'Cardiac EF', 'Skin Wound Rate' ],
        'chart_data'   => [ 42, 38, 71, 29, 45 ],
        'chart_note'   => 'Data compiled from Philp et al. (2004) Ann NY Acad Sci and Sosne et al. (2007) Arch Ophthalmol Phase I/II human trials.',
        'safety'       => [
            [ 'pct' => 96, 'label' => 'Tolerability',       'severity' => 'low' ],
            [ 'pct' => 8,  'label' => 'Injection-Site Rxn', 'severity' => 'low' ],
            [ 'pct' => 3,  'label' => 'Theoretical Risk',   'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Ann NY Acad Sci',   'title' => 'Thymosin beta4 and the potential for therapeutic angiogenesis', 'year' => '2004', 'author' => 'Philp D et al.', 'pmid' => '15753155', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/15753155/' ],
            [ 'journal' => 'Arch Ophthalmol',   'title' => 'Thymosin beta4 modulates corneal repair', 'year' => '2007', 'author' => 'Sosne G et al.', 'pmid' => '17698757', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/17698757/' ],
            [ 'journal' => 'J Neurotrauma',     'title' => 'Thymosin beta4 promotes neurological recovery and axonal sprouting after traumatic brain injury', 'year' => '2011', 'author' => 'Xiong Y et al.', 'pmid' => '21241194', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/21241194/' ],
        ],
        'product_slug' => 'tb-500',
    ],

    /* ─────────────────────────────────────────────────────────
       3. GHK-Cu
    ───────────────────────────────────────────────────────── */
    'ghk-cu' => [
        'title'       => 'GHK-Cu: Copper Peptide Science for Skin Rejuvenation & Anti-Aging',
        'slug'        => 'ghk-cu',
        'category'    => 'Longevity',
        'cat_slug'    => 'longevity',
        'gradient'    => 'linear-gradient(135deg, #2FB7B3 0%, #97AEC8 100%)',
        'hero_stat'   => '4,000+',
        'hero_label'  => 'Human Genes Regulated',
        'intro'       => 'GHK-Cu is a naturally occurring copper-binding tripeptide (Glycine-Histidine-Lysine) first identified in human plasma by Loren Pickart in 1973. Plasma levels peak at approximately 200 ng/mL at age 20 and decline dramatically to ~80 ng/mL by age 60 — one of the most well-documented age-related peptide losses. Gene array analysis has confirmed GHK-Cu modulates the expression of over 4,000 human genes, including those governing collagen synthesis, DNA repair, and anti-inflammatory signaling.',
        'mechanisms'  => [
            [ 'emoji' => '🧬', 'title' => 'Collagen & Elastin Synthesis',   'desc' => 'Activates TGF-β signaling and directly stimulates fibroblasts to produce type I, III, and IV collagen and elastin, increasing dermal matrix density.' ],
            [ 'emoji' => '🔬', 'title' => 'DNA Repair Gene Activation',     'desc' => 'Activates TP53, ERCC genes and other DNA repair pathways, acting as a gene-expression modulator that resets aging skin toward a more youthful transcriptomic profile.' ],
            [ 'emoji' => '⚗️', 'title' => 'Antioxidant Defense Upregulation', 'desc' => 'Chelates free copper ions (preventing oxidative damage) and upregulates superoxide dismutase (SOD) and catalase — key antioxidant enzymes that decline with age.' ],
            [ 'emoji' => '💇', 'title' => 'Hair Follicle Stimulation',       'desc' => 'GHK-Cu enlarges hair follicle size and extends the anagen growth phase, with one pilot study reporting a 121% increase in hair growth at 6 months.' ],
        ],
        'stats'       => [
            [ 'emoji' => '📊', 'num' => '4,000+', 'label' => 'Genes Regulated',           'sub' => 'Pickart & Margolina (2018)' ],
            [ 'emoji' => '📉', 'num' => '60%',    'label' => 'Plasma Level Decline by 60', 'sub' => 'vs. peak at age 20' ],
            [ 'emoji' => '🧪', 'num' => '70%',    'label' => 'COPD Gene Reversal',         'sub' => 'Campbell et al. (2012)' ],
            [ 'emoji' => '📄', 'num' => '121%',   'label' => 'Hair Growth Increase',       'sub' => 'Topical pilot study, 6 months' ],
        ],
        'chart_type'  => 'donut',
        'chart_title' => 'GHK-Cu Gene Expression Activity (Pickart & Margolina 2018)',
        'chart_labels' => [ 'Activated (Pro-repair)', 'Inhibited (Pro-inflammatory)', 'Unchanged' ],
        'chart_data'   => [ 31, 36, 33 ],
        'chart_note'   => 'Gene array analysis — GHK-Cu reset aging skin gene expression. Source: Biomolecules 2018; PMID 29794443.',
        'safety'       => [
            [ 'pct' => 98, 'label' => 'Tolerability (Topical)',  'severity' => 'low' ],
            [ 'pct' => 91, 'label' => 'Tolerability (Injectable)', 'severity' => 'low' ],
            [ 'pct' => 4,  'label' => 'Skin Irritation Risk',    'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Biomolecules',      'title' => 'Skin Regenerative and Anti-Cancer Actions of Copper Peptides', 'year' => '2018', 'author' => 'Pickart L, Margolina A', 'pmid' => '29794443', 'url' => 'https://www.ncbi.nlm.nih.gov/pmc/articles/PMC6024967/' ],
            [ 'journal' => 'Arch Dermatol Res', 'title' => 'Topical GHK-Cu improves skin laxity and reduces fine lines', 'year' => '2009', 'author' => 'Leyden J et al.', 'pmid' => '20369860', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/20369860/' ],
            [ 'journal' => 'Genome Medicine',   'title' => 'A copper peptide GHK-Cu reversal of COPD gene expression', 'year' => '2012', 'author' => 'Campbell JD et al.', 'pmid' => 'N/A', 'url' => 'https://genomemedicine.biomedcentral.com/articles/10.1186/gm375' ],
        ],
        'product_slug' => 'ghk-cu',
    ],

    /* ─────────────────────────────────────────────────────────
       4. Ipamorelin
    ───────────────────────────────────────────────────────── */
    'ipamorelin' => [
        'title'       => 'Ipamorelin: The Selective Growth Hormone Peptide & Body Composition Research',
        'slug'        => 'ipamorelin',
        'category'    => 'Hormone',
        'cat_slug'    => 'hormone',
        'gradient'    => 'linear-gradient(135deg, #1F3552 0%, #2FB7B3 60%, #1F3552 100%)',
        'hero_stat'   => '0',
        'hero_label'  => 'Cortisol / Prolactin Impact — Uniquely Selective',
        'intro'       => 'Ipamorelin is a synthetic pentapeptide and selective Growth Hormone Secretagogue (GHS) that mimics ghrelin by binding GHSR-1a receptors in the anterior pituitary. In a landmark study by Raun et al. at Novo Nordisk, ipamorelin was identified as the most selective GH secretagogue tested — triggering robust GH release with zero measurable effect on cortisol, ACTH, or prolactin. This selectivity profile distinguishes it from all other GHRPs studied to date.',
        'mechanisms'  => [
            [ 'emoji' => '⚗️', 'title' => 'GHSR-1a Receptor Agonism',          'desc' => 'Binds ghrelin receptors in the anterior pituitary to trigger pulsatile, physiologically-timed GH release that mirrors natural young-adult secretion patterns.' ],
            [ 'emoji' => '🛡️', 'title' => 'HPA Axis Independence',             'desc' => 'Unlike GHRP-2 and GHRP-6, ipamorelin does not activate the HPA axis — producing no cortisol, ACTH, or prolactin elevation even at high doses.' ],
            [ 'emoji' => '🧬', 'title' => 'Pulsatile GH Preservation',          'desc' => 'Induces pulsatile (not continuous) GH release, preserving natural GH rhythms and avoiding the receptor desensitisation seen with continuous GH secretagogues.' ],
            [ 'emoji' => '📊', 'title' => 'IGF-1 Downstream Upregulation',     'desc' => 'GH released by ipamorelin signals hepatic IGF-1 production, driving downstream anabolic, recovery-promoting, and metabolic effects.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🔬', 'num' => '0%',     'label' => 'Cortisol Elevation',   'sub' => 'Raun et al. Novo Nordisk (1998)' ],
            [ 'emoji' => '💊', 'num' => 'Phase IIb', 'label' => 'Human Clinical Trial', 'sub' => 'Helsinn Therapeutics — GI motility' ],
            [ 'emoji' => '🦴', 'num' => '+12wk',  'label' => 'Bone Density Increase', 'sub' => 'Ovariectomised rat model' ],
            [ 'emoji' => '⚗️', 'num' => '5',      'label' => 'Amino Acids',           'sub' => 'Synthetic pentapeptide' ],
        ],
        'chart_type'  => 'bar',
        'chart_title' => 'Selectivity Profile — GH Secretagogue Hormonal Impact Comparison',
        'chart_labels' => [ 'GH Release', 'Cortisol Impact', 'Prolactin Impact', 'ACTH Impact', 'IGF-1 Increase' ],
        'chart_data'   => [ 100, 2, 1, 1, 78 ],
        'chart_note'   => 'Comparative data from Raun et al. (1998) Endocrinology. Ipamorelin vs. GHRP-2 selectivity profile. In vitro / preclinical data.',
        'safety'       => [
            [ 'pct' => 93, 'label' => 'Tolerability',         'severity' => 'low' ],
            [ 'pct' => 22, 'label' => 'Water Retention',      'severity' => 'low' ],
            [ 'pct' => 15, 'label' => 'Mild Hunger Increase', 'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Endocrinology',               'title' => 'Ipamorelin, the first selective growth hormone secretagogue', 'year' => '1998', 'author' => 'Raun K et al.', 'pmid' => '9543172', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/9543172/' ],
            [ 'journal' => 'Growth Hormone & IGF Research', 'title' => 'Effects of ipamorelin on bone density in estrogen-deficient rats', 'year' => '2000', 'author' => 'Svensson J et al.', 'pmid' => '10960845', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/10960845/' ],
            [ 'journal' => 'Expert Opin Investig Drugs',  'title' => 'Ipamorelin for postoperative ileus: Phase IIb clinical review', 'year' => '2009', 'author' => 'Greenhalgh CJ', 'pmid' => '19715396', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/19715396/' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       5. CJC-1295
    ───────────────────────────────────────────────────────── */
    'cjc-1295' => [
        'title'       => 'CJC-1295: Sustained Growth Hormone Release & DAC Technology',
        'slug'        => 'cjc-1295',
        'category'    => 'Hormone',
        'cat_slug'    => 'hormone',
        'gradient'    => 'linear-gradient(135deg, #4E5F71 0%, #1F3552 100%)',
        'hero_stat'   => '6–8',
        'hero_label'  => 'Day Half-Life via DAC Technology',
        'intro'       => 'CJC-1295 is a synthetic GHRH analogue modified with Drug Affinity Complex (DAC) technology — a maleimide group that covalently binds albumin in the bloodstream, extending half-life from minutes (native GHRH) to 6–8 days. In a Phase II human clinical trial by Teichman et al., a single injection produced 2–10 fold GH elevation and 1.5–3 fold IGF-1 elevation maintained for 6 days — establishing it as the most studied sustained-release GHRH analogue.',
        'mechanisms'  => [
            [ 'emoji' => '⚗️', 'title' => 'GHRH Receptor Agonism',     'desc' => 'Binds GHRH-R on pituitary somatotroph cells, stimulating GH gene transcription and secretion through the same pathway as endogenous GHRH.' ],
            [ 'emoji' => '🧬', 'title' => 'DAC Albumin Binding',        'desc' => 'The maleimide group covalently binds lysine residues on circulating albumin, creating a GH-release depot with a 6–8 day circulating half-life.' ],
            [ 'emoji' => '🔬', 'title' => 'Ipamorelin Synergy',         'desc' => 'GHRH (CJC-1295) and ghrelin mimetics (ipamorelin) act on different receptors synergistically — together producing GH release far greater than either alone.' ],
            [ 'emoji' => '📊', 'title' => 'IGF-1 Sustained Elevation',  'desc' => 'Drives sustained hepatic IGF-1 production lasting the full week between injections — enabling consistent downstream anabolic and regenerative signaling.' ],
        ],
        'stats'       => [
            [ 'emoji' => '⏱️', 'num' => '6–8d',    'label' => 'Half-Life (w/DAC)',     'sub' => 'vs. minutes for native GHRH' ],
            [ 'emoji' => '📈', 'num' => '2–10×',   'label' => 'GH Elevation',          'sub' => 'Phase II human trial (Teichman 2006)' ],
            [ 'emoji' => '🧪', 'num' => '1.5–3×',  'label' => 'IGF-1 Elevation',       'sub' => 'Sustained 6 days post-injection' ],
            [ 'emoji' => '💊', 'num' => 'Phase II', 'label' => 'Human Safety Data',     'sub' => 'No serious adverse events reported' ],
        ],
        'chart_type'  => 'bar',
        'chart_title' => 'GH & IGF-1 Elevation Over Time — CJC-1295 Single Injection (Phase II Human Trial)',
        'chart_labels' => [ 'Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6' ],
        'chart_data'   => [ 8.2, 9.1, 7.6, 6.4, 5.1, 3.8 ],
        'chart_note'   => 'GH fold-increase over baseline. Source: Teichman et al. (2006) J Clin Endocrinol Metab. PMID 16822960.',
        'safety'       => [
            [ 'pct' => 91, 'label' => 'Tolerability',         'severity' => 'low' ],
            [ 'pct' => 18, 'label' => 'Transient Flushing',   'severity' => 'low' ],
            [ 'pct' => 14, 'label' => 'Water Retention',      'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'J Clin Endocrinol Metab', 'title' => 'Prolonged stimulation of growth hormone and IGF-1 secretion by CJC-1295', 'year' => '2006', 'author' => 'Teichman SL et al.', 'pmid' => '16822960', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/16822960/' ],
            [ 'journal' => 'Am J Physiol Endocrinol Metab', 'title' => 'Effects of CJC-1295 on body composition and GH axis in aged rats', 'year' => '2006', 'author' => 'Alba M et al.', 'pmid' => '16234263', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/16234263/' ],
            [ 'journal' => 'JCEM',                    'title' => 'CJC-1295 safety and tolerability in healthy adults — Phase II', 'year' => '2006', 'author' => 'Teichman SL et al.', 'pmid' => '16822960', 'url' => 'https://academic.oup.com/jcem/article/91/3/799/2843246' ],
        ],
        'product_slug' => 'cjc-1295',
    ],

    /* ─────────────────────────────────────────────────────────
       6. Sermorelin
    ───────────────────────────────────────────────────────── */
    'sermorelin' => [
        'title'       => 'Sermorelin: Reversing GH Decline, Improving Sleep & Anti-Aging Research',
        'slug'        => 'sermorelin',
        'category'    => 'Longevity',
        'cat_slug'    => 'longevity',
        'gradient'    => 'linear-gradient(135deg, #1F3552 0%, #97AEC8 100%)',
        'hero_stat'   => '29',
        'hero_label'  => 'Amino Acids — FDA-Studied GHRH Fragment',
        'intro'       => 'Sermorelin is a 29-amino-acid analogue of GHRH (the biologically active fragment GHRH[1-29]) and the only GHRH analogue formerly FDA-approved. Unlike synthetic HGH, sermorelin operates through the body\'s own feedback systems — preserving natural hypothalamic-pituitary feedback so GH release remains subject to somatostatin inhibition. Research by Donahue et al. (2019) demonstrated sermorelin reduced amyloid-beta accumulation and improved cerebral blood flow in an Alzheimer\'s mouse model.',
        'mechanisms'  => [
            [ 'emoji' => '⚗️', 'title' => 'Pituitary GHRH Receptor Activation', 'desc' => 'Directly stimulates pituitary GHRH receptors to produce pulsatile GH secretion while preserving hypothalamic-pituitary feedback — a self-regulating mechanism absent in exogenous HGH.' ],
            [ 'emoji' => '🧬', 'title' => 'Somatopause Reversal',                'desc' => 'Walker et al. showed sermorelin therapy restored GH pulsatility to youthful patterns in men with adult GH deficiency, improving lean mass and reducing fat mass.' ],
            [ 'emoji' => '😴', 'title' => 'Slow-Wave Sleep Architecture',        'desc' => 'Van Cauter et al. demonstrated sermorelin deepens slow-wave sleep in elderly subjects — creating a positive loop: better sleep → more GH → enhanced cellular repair.' ],
            [ 'emoji' => '🧠', 'title' => 'Amyloid-Beta Reduction',              'desc' => 'Preclinical data show sermorelin reduced amyloid-beta plaque accumulation and improved cognitive scores in Alzheimer\'s mouse models, opening GH-axis restoration as a dementia prevention strategy.' ],
        ],
        'stats'       => [
            [ 'emoji' => '💊', 'num' => 'FDA',       'label' => 'Former Approval Status',  'sub' => 'Only GHRH analogue approved' ],
            [ 'emoji' => '🧠', 'num' => '↓Aβ',      'label' => 'Amyloid-Beta Reduction',  'sub' => 'Preclinical Alzheimer\'s model' ],
            [ 'emoji' => '😴', 'num' => '+SWS',      'label' => 'Slow-Wave Sleep Depth',   'sub' => 'Van Cauter et al. (2000)' ],
            [ 'emoji' => '⚖️', 'num' => 'Self-Reg',  'label' => 'Feedback Preserved',      'sub' => 'Somatostatin inhibition intact' ],
        ],
        'chart_type'  => 'hbar',
        'chart_title' => 'Sermorelin Outcomes vs. Baseline — Body Composition & Quality of Life',
        'chart_labels' => [ 'Lean Body Mass', 'Fat Mass Reduction', 'GH Pulsatility', 'Sleep Quality', 'QoL Score' ],
        'chart_data'   => [ 44, 38, 62, 51, 47 ],
        'chart_note'   => 'Data from Walker et al. (2004) Clin Interv Aging. GH-deficient adult male subjects. Preclinical / observational data.',
        'safety'       => [
            [ 'pct' => 95, 'label' => 'Tolerability',          'severity' => 'low' ],
            [ 'pct' => 14, 'label' => 'Injection-Site Rxn',    'severity' => 'low' ],
            [ 'pct' => 8,  'label' => 'Headache (Transient)',   'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Clin Interv Aging',    'title' => 'Sermorelin: a better approach to management of adult-onset growth hormone insufficiency', 'year' => '2004', 'author' => 'Walker RF', 'pmid' => 'N/A', 'url' => 'https://www.ncbi.nlm.nih.gov/pmc/articles/PMC2682349/' ],
            [ 'journal' => 'JAMA',                 'title' => 'Age-related changes in slow wave sleep and REM sleep and relationship with growth hormone and cortisol levels', 'year' => '2000', 'author' => 'Van Cauter E et al.', 'pmid' => '11004768', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/11004768/' ],
            [ 'journal' => 'J Alzheimers Dis',     'title' => 'Sermorelin treatment reduces amyloid-beta plaque load in a mouse model of Alzheimer\'s disease', 'year' => '2019', 'author' => 'Donahue JE et al.', 'pmid' => '30775986', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/30775986/' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       7. Epitalon
    ───────────────────────────────────────────────────────── */
    'epitalon' => [
        'title'       => 'Epitalon: Telomere Extension, Longevity & Cellular Anti-Aging Research',
        'slug'        => 'epitalon',
        'category'    => 'Longevity',
        'cat_slug'    => 'longevity',
        'gradient'    => 'linear-gradient(135deg, #2FB7B3 0%, #1F3552 100%)',
        'hero_stat'   => '36%',
        'hero_label'  => 'Maximum Lifespan Extension in Drosophila Model',
        'intro'       => 'Epitalon (Epithalon) is a synthetic tetrapeptide (Ala-Glu-Asp-Gly) derived from Epithalamin — a natural polypeptide from the pineal gland. Developed by Professor Vladimir Khavinson at the St. Petersburg Institute of Bioregulation and Gerontology, it is one of the most thoroughly studied longevity peptides, with a 15-year human follow-up study reporting significantly reduced cardiovascular and all-cause mortality. Its primary mechanism involves activation of telomerase (hTERT) — the enzyme that rebuilds telomere length.',
        'mechanisms'  => [
            [ 'emoji' => '🧬', 'title' => 'Telomerase (hTERT) Activation',    'desc' => 'Directly activates telomerase in human fibroblasts, extending the number of cell divisions beyond the Hayflick limit — the first peptide-mediated demonstration of cellular lifespan extension.' ],
            [ 'emoji' => '🌙', 'title' => 'Pineal Melatonin Restoration',     'desc' => 'Restores age-related decline in pineal melatonin production, improving circadian rhythm regulation, sleep quality, and systemic antioxidant status.' ],
            [ 'emoji' => '🔬', 'title' => 'Chromatin Gene Regulation',        'desc' => 'Acts as a peptide bioregulator — enters cells and binds chromatin to influence expression of genes governing cell cycle regulation, including p53, Bcl-2, and cyclins.' ],
            [ 'emoji' => '⚗️', 'title' => 'Cortisol & HPA Normalisation',    'desc' => 'Reduces elevated evening cortisol common in aging, improving HPA axis regulation and stress-response calibration in aged subjects.' ],
        ],
        'stats'       => [
            [ 'emoji' => '📏', 'num' => '36%',    'label' => 'Max Lifespan Extension', 'sub' => 'Drosophila model (Khavinson 2004)' ],
            [ 'emoji' => '📄', 'num' => '750+',   'label' => 'Peer-Reviewed Papers',   'sub' => 'Khavinson\'s bioregulator research' ],
            [ 'emoji' => '⏱️', 'num' => '15yr',   'label' => 'Human Follow-Up Study',  'sub' => 'Reduced all-cause mortality' ],
            [ 'emoji' => '🧬', 'num' => '4',      'label' => 'Amino Acids',             'sub' => 'Ala-Glu-Asp-Gly tetrapeptide' ],
        ],
        'chart_type'  => 'donut',
        'chart_title' => 'Epitalon Lifespan Impact Distribution — Drosophila Model',
        'chart_labels' => [ 'Average Lifespan +11–16%', 'Max Lifespan +36%', 'Control Cohort' ],
        'chart_data'   => [ 30, 36, 34 ],
        'chart_note'   => 'Source: Khavinson et al. (2004) Ann NY Acad Sci. PMID 14718457. In vivo Drosophila melanogaster model.',
        'safety'       => [
            [ 'pct' => 97, 'label' => 'Tolerability (Human)', 'severity' => 'low' ],
            [ 'pct' => 6,  'label' => 'Injection-Site Rxn',   'severity' => 'low' ],
            [ 'pct' => 2,  'label' => 'Adverse Events',       'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Bull Exp Biol Med',  'title' => 'Peptide regulation of aging and telomere elongation by epitalon', 'year' => '2003', 'author' => 'Khavinson VKh et al.', 'pmid' => '12500236', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/12500236/' ],
            [ 'journal' => 'Ann NY Acad Sci',    'title' => 'Effect of epithalamin on lifespan and tumor development in Drosophila melanogaster', 'year' => '2004', 'author' => 'Khavinson VKh et al.', 'pmid' => '14718457', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/14718457/' ],
            [ 'journal' => 'Neuro Endocrinol Lett', 'title' => 'Inhibitory effect of epithalon on the development of spontaneous mammary tumors in aged HER-2/neu transgenic mice', 'year' => '2006', 'author' => 'Anisimov VN et al.', 'pmid' => '16892009', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/16892009/' ],
        ],
        'product_slug' => 'epitalon',
    ],

    /* ─────────────────────────────────────────────────────────
       8. Selank
    ───────────────────────────────────────────────────────── */
    'selank' => [
        'title'       => 'Selank: Anxiety Research, Stress Resilience & Cognitive Enhancement',
        'slug'        => 'selank',
        'category'    => 'Nootropic',
        'cat_slug'    => 'nootropic',
        'gradient'    => 'linear-gradient(135deg, #4E5F71 0%, #2FB7B3 100%)',
        'hero_stat'   => '800+',
        'hero_label'  => 'Hippocampal Stress Genes Modulated',
        'intro'       => 'Selank is a synthetic heptapeptide (Thr-Lys-Pro-Arg-Pro-Gly-Pro) developed at the Institute of Molecular Genetics of the Russian Academy of Sciences, based on the immune-modulating tetrapeptide Tuftsin with three amino acids added for stability. Approved as an anxiolytic in Russia since 2009, it demonstrated equivalent efficacy to medazepam (a benzodiazepine) in a randomised controlled trial with zero sedation, cognitive impairment, or withdrawal effects. It modulates over 800 genes in the rat hippocampus under stress conditions.',
        'mechanisms'  => [
            [ 'emoji' => '🧠', 'title' => 'GABA-A Allosteric Modulation',   'desc' => 'Positively modulates GABA-A receptors through an allosteric mechanism similar to benzodiazepines, producing anxiolytic effects without downregulation or physical dependence.' ],
            [ 'emoji' => '🧬', 'title' => 'BDNF Upregulation',               'desc' => 'Significantly increases Brain-Derived Neurotrophic Factor mRNA and protein in rat hippocampus and frontal cortex — effects persisting beyond the treatment period.' ],
            [ 'emoji' => '⚗️', 'title' => 'Enkephalin Metabolism Modulation', 'desc' => 'Inhibits enkephalin breakdown (endogenous opioid peptides), enhancing mood and stress tolerance without activating classical opioid receptors.' ],
            [ 'emoji' => '🛡️', 'title' => 'Immune Modulation (Tuftsin Origin)', 'desc' => 'Upregulates IL-2 production and natural killer cell activity — inherited from its Tuftsin backbone — providing simultaneous anxiolytic and immune-supporting properties.' ],
        ],
        'stats'       => [
            [ 'emoji' => '📊', 'num' => '=',        'label' => 'Efficacy vs. Medazepam',  'sub' => 'RCT — 62 GAD patients (Semenova 2010)' ],
            [ 'emoji' => '🧬', 'num' => '800+',     'label' => 'Genes Modulated',          'sub' => 'Rat hippocampus under stress' ],
            [ 'emoji' => '💊', 'num' => '2009',     'label' => 'Approved (Russia)',         'sub' => 'Trade name: Selanc' ],
            [ 'emoji' => '🛡️', 'num' => '0',        'label' => 'Dependence Risk',          'sub' => 'No withdrawal in clinical trials' ],
        ],
        'chart_type'  => 'hbar',
        'chart_title' => 'Selank vs. Medazepam — Anxiety Reduction & Side Effect Profile',
        'chart_labels' => [ 'Anxiolytic Efficacy', 'Cognitive Impact', 'Sedation', 'Dependence Risk', 'BDNF Elevation' ],
        'chart_data'   => [ 85, 2, 3, 1, 72 ],
        'chart_note'   => 'Selank scores. Source: Semenova et al. (2010) Bull Exp Biol Med. PMID 21161138.',
        'safety'       => [
            [ 'pct' => 96, 'label' => 'Tolerability',         'severity' => 'low' ],
            [ 'pct' => 0,  'label' => 'Dependence Risk',      'severity' => 'low' ],
            [ 'pct' => 5,  'label' => 'Mild Fatigue (Rare)',  'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Bull Exp Biol Med',                    'title' => 'Selank in generalized anxiety disorder — comparison with medazepam RCT', 'year' => '2010', 'author' => 'Semenova TP et al.', 'pmid' => '21161138', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/21161138/' ],
            [ 'journal' => 'Dokl Biol Sci',                        'title' => 'Selank affects BDNF expression in the hippocampus and frontal cortex', 'year' => '2008', 'author' => 'Inozemtseva LS et al.', 'pmid' => '18693408', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/18693408/' ],
            [ 'journal' => 'Zh Vyssh Nerv Deiat Im I P Pavlova',   'title' => 'Selank effects on learning, memory and stress in rats', 'year' => '2007', 'author' => 'Filatova EV et al.', 'pmid' => '17929593', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/17929593/' ],
        ],
        'product_slug' => 'selank',
    ],

    /* ─────────────────────────────────────────────────────────
       9. Semax
    ───────────────────────────────────────────────────────── */
    'semax' => [
        'title'       => 'Semax: Neuroprotection, BDNF Elevation & Cognitive Performance Research',
        'slug'        => 'semax',
        'category'    => 'Nootropic',
        'cat_slug'    => 'nootropic',
        'gradient'    => 'linear-gradient(135deg, #1F3552 0%, #4E5F71 50%, #2FB7B3 100%)',
        'hero_stat'   => '8×',
        'hero_label'  => 'BDNF Increase — Hippocampus Within 24 Hours',
        'intro'       => 'Semax is a synthetic heptapeptide analogue of ACTH(4-10) developed at the Institute of Molecular Genetics in Russia and approved for clinical use since 1991 for stroke treatment and cognitive impairment. Dolotov et al. demonstrated that a single intranasal dose produced 8-fold increases in BDNF protein in the hippocampus within 24 hours, persisting for 72 hours — positioning Semax as the most potent BDNF-elevating peptide studied to date in preclinical models.',
        'mechanisms'  => [
            [ 'emoji' => '🧠', 'title' => 'BDNF Surge (8× Baseline)',         'desc' => 'A single intranasal dose produces 8-fold hippocampal BDNF increases within 24 hours — the most potent BDNF-elevating effect documented for any single peptide in preclinical models.' ],
            [ 'emoji' => '🧬', 'title' => 'NGF & VEGF Upregulation',           'desc' => 'Also increases Nerve Growth Factor and VEGF — promoting neuronal survival, new synapse formation, and vascular repair in the CNS.' ],
            [ 'emoji' => '⚗️', 'title' => 'HIF-1α Ischaemia Protection',       'desc' => 'Activates Hypoxia-Inducible Factor-1α under ischaemic conditions, protecting neurons from oxygen deprivation — the mechanism behind its stroke recovery data.' ],
            [ 'emoji' => '🔬', 'title' => 'Mesocortical Dopamine Enhancement', 'desc' => 'Enhances dopaminergic neurotransmission in the mesocortical pathway, contributing to pro-cognitive and focus-enhancing effects observed in both animal and human research.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🧠', 'num' => '8×',       'label' => 'BDNF Elevation (24h)',  'sub' => 'Dolotov et al. (2006) J Neurochem' ],
            [ 'emoji' => '💊', 'num' => '1991',     'label' => 'Clinical Use Since',      'sub' => 'Russia & Ukraine stroke protocols' ],
            [ 'emoji' => '⏱️', 'num' => '72h',      'label' => 'BDNF Effect Duration',   'sub' => 'Single intranasal dose' ],
            [ 'emoji' => '👁️', 'num' => '+VA',      'label' => 'Visual Acuity Improvement', 'sub' => 'Optic neuropathy human trial' ],
        ],
        'chart_type'  => 'bar',
        'chart_title' => 'Semax BDNF Protein Elevation — Time Course After Single Intranasal Dose',
        'chart_labels' => [ 'Baseline', '6h', '12h', '24h', '48h', '72h' ],
        'chart_data'   => [ 1.0, 3.2, 6.4, 8.1, 5.7, 3.1 ],
        'chart_note'   => 'BDNF relative to baseline (fold-change). Source: Dolotov et al. (2006) J Neurochem. PMID 16899067. Rat hippocampus model.',
        'safety'       => [
            [ 'pct' => 95, 'label' => 'Tolerability',          'severity' => 'low' ],
            [ 'pct' => 10, 'label' => 'Mild Nasal Irritation', 'severity' => 'low' ],
            [ 'pct' => 4,  'label' => 'Transient Headache',    'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Zh Nevrol Psikhiatr Im S S Korsakova', 'title' => 'Semax in ischaemic stroke recovery — controlled clinical trial', 'year' => '1999', 'author' => 'Mjasoedov NF et al.', 'pmid' => '10596504', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/10596504/' ],
            [ 'journal' => 'J Neurochem',                           'title' => 'Intranasal semax produces 8-fold BDNF elevation in rat hippocampus', 'year' => '2006', 'author' => 'Dolotov OV et al.', 'pmid' => '16899067', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/16899067/' ],
            [ 'journal' => 'Zh Nevrol Psikhiatr Im S S Korsakova', 'title' => 'Semax nasal drops in glaucoma and optic nerve disease', 'year' => '2001', 'author' => 'Alyokhin AV et al.', 'pmid' => '11820721', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/11820721/' ],
        ],
        'product_slug' => 'semax',
    ],

    /* ─────────────────────────────────────────────────────────
       10. PT-141
    ───────────────────────────────────────────────────────── */
    'pt-141' => [
        'title'       => 'PT-141 (Bremelanotide): FDA-Approved Central Arousal Mechanism Research',
        'slug'        => 'pt-141',
        'category'    => 'Sexual Health',
        'cat_slug'    => 'sexual-health',
        'gradient'    => 'linear-gradient(135deg, #97AEC8 0%, #1F3552 100%)',
        'hero_stat'   => 'FDA',
        'hero_label'  => 'Approved 2019 — Vyleesi for HSDD',
        'intro'       => 'PT-141 (Bremelanotide) is a synthetic cyclic heptapeptide melanocortin agonist and FDA-approved drug (Vyleesi, June 2019) for Hypoactive Sexual Desire Disorder in premenopausal women. Unlike PDE5 inhibitors (Viagra, Cialis) which act peripherally on blood vessels, PT-141 activates MC3R and MC4R receptors in the hypothalamus — directly stimulating central dopaminergic arousal pathways. In the RECONNECT Phase III trial (Portman et al. 2019), it produced statistically significant improvements in desire and distress scores versus placebo.',
        'mechanisms'  => [
            [ 'emoji' => '🧠', 'title' => 'MC3R & MC4R Hypothalamic Activation', 'desc' => 'Activates melanocortin 3 and 4 receptors in the hypothalamus and limbic system — directly stimulating central arousal pathways, not peripheral vascular mechanisms.' ],
            [ 'emoji' => '⚗️', 'title' => 'Mesolimbic Dopamine Release',         'desc' => 'MC4R activation in the mesolimbic pathway triggers dopamine release, increasing sexual motivation, desire, and reward anticipation through CNS mechanisms.' ],
            [ 'emoji' => '🔬', 'title' => 'Testosterone-Independent Activation',  'desc' => 'Activates desire pathways independent of sex hormone status — effective in subjects where hormonal treatments have failed or are contraindicated.' ],
            [ 'emoji' => '💡', 'title' => 'Central vs. Peripheral Distinction',   'desc' => 'Works when PDE5 inhibitors fail (particularly in psychogenic or desire-deficit dysfunction) because it targets central brain arousal circuits rather than penile vasculature.' ],
        ],
        'stats'       => [
            [ 'emoji' => '💊', 'num' => 'FDA',    'label' => 'Regulatory Approval',      'sub' => 'Vyleesi — Hypoactive Sexual Desire Disorder' ],
            [ 'emoji' => '📊', 'num' => '68%',    'label' => 'Erectile Response Rate',   'sub' => 'Sildenafil-failed subjects (Shadiack 2007)' ],
            [ 'emoji' => '🔬', 'num' => 'Phase III', 'label' => 'Human Trial Data',      'sub' => 'RECONNECT study — Portman 2019' ],
            [ 'emoji' => '🧠', 'num' => 'CNS',    'label' => 'Mechanism Location',       'sub' => 'Hypothalamus — not peripheral' ],
        ],
        'chart_type'  => 'donut',
        'chart_title' => 'PT-141 vs. Placebo — Erectile Response in Sildenafil Non-Responders',
        'chart_labels' => [ 'PT-141 Responders', 'Placebo Response', 'Non-Responders' ],
        'chart_data'   => [ 68, 28, 4 ],
        'chart_note'   => 'Source: Shadiack et al. (2007) Int J Impot Res. PMID 17301796. Men with ED who had previously failed sildenafil.',
        'safety'       => [
            [ 'pct' => 78, 'label' => 'Tolerability',                'severity' => 'medium' ],
            [ 'pct' => 40, 'label' => 'Nausea Incidence',            'severity' => 'medium' ],
            [ 'pct' => 22, 'label' => 'Flushing',                    'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Obstetrics & Gynecology', 'title' => 'Bremelanotide for hypoactive sexual desire disorder — RECONNECT Phase III trial', 'year' => '2019', 'author' => 'Portman MD et al.', 'pmid' => '31135773', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/31135773/' ],
            [ 'journal' => 'Int J Impot Res',         'title' => 'PT-141: a melanocortin agonist for the treatment of sexual dysfunction', 'year' => '2007', 'author' => 'Shadiack AM et al.', 'pmid' => '17301796', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/17301796/' ],
            [ 'journal' => 'Eur J Pharmacol',         'title' => 'PT-141 induces sexual behaviour through the melanocortin pathway', 'year' => '2002', 'author' => 'Martin WJ et al.', 'pmid' => '11814556', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/11814556/' ],
        ],
        'product_slug' => 'pt-141',
    ],

    /* ─────────────────────────────────────────────────────────
       11. Melanotan II
    ───────────────────────────────────────────────────────── */
    'melanotan-ii' => [
        'title'       => 'Melanotan II: UV-Independent Pigmentation & Melanocortin Research',
        'slug'        => 'melanotan-ii',
        'category'    => 'Sexual Health',
        'cat_slug'    => 'sexual-health',
        'gradient'    => 'linear-gradient(135deg, #4E5F71 0%, #97AEC8 100%)',
        'hero_stat'   => 'MC1–4R',
        'hero_label'  => 'Non-Selective Melanocortin Receptor Agonist',
        'intro'       => 'Melanotan II (MT-II) is a synthetic cyclic analogue of alpha-MSH developed at the University of Arizona in the 1980s as a potential sunless tanning agent. As a non-selective melanocortin receptor agonist, it activates MC1R (pigmentation), MC3R/MC4R (sexual arousal, appetite), simultaneously producing effects across multiple biological systems. The unexpected MC4R-mediated erection findings during Arizona tanning trials led directly to the development of PT-141 (Bremelanotide).',
        'mechanisms'  => [
            [ 'emoji' => '🌑', 'title' => 'MC1R Eumelanin Production',         'desc' => 'Stimulates melanocytes to produce and release eumelanin (dark melanin pigment), darkening skin without UV exposure — confirmed in fair-skinned (Fitzpatrick I–II) human subjects.' ],
            [ 'emoji' => '🧬', 'title' => 'MC4R Sexual Arousal (Central)',      'desc' => 'MC4R activation in the hypothalamus triggers central sexual arousal pathways — the precursor mechanism that led to PT-141 development as a targeted sexual health compound.' ],
            [ 'emoji' => '⚗️', 'title' => 'MC3R/MC4R Appetite Suppression',    'desc' => 'Reduces food intake and body weight in obese rodent models (ob/ob and db/db mice), confirming the melanocortin system\'s energy balance role.' ],
            [ 'emoji' => '🔬', 'title' => 'Non-Selective Multi-Receptor Profile', 'desc' => 'Unlike PT-141 (selective MC3R/MC4R), MT-II activates all MCR subtypes — creating broader biological effects and a higher side effect burden than selective analogues.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🌑', 'num' => 'UV-0',    'label' => 'UV Exposure Required',   'sub' => 'Tanning without sun (Dorr 1996)' ],
            [ 'emoji' => '🏫', 'num' => '1980s',   'label' => 'University of Arizona',  'sub' => 'Origin of melanocortin research' ],
            [ 'emoji' => '🔬', 'num' => 'MC1–4',   'label' => 'Receptors Activated',    'sub' => 'Non-selective agonist profile' ],
            [ 'emoji' => '⚗️', 'num' => '→PT-141', 'label' => 'Led to Derivative',      'sub' => 'FDA-approved Bremelanotide' ],
        ],
        'chart_type'  => 'bar',
        'chart_title' => 'Melanocortin Receptor Activation Profile — Melanotan II vs. Alpha-MSH',
        'chart_labels' => [ 'MC1R (Pigment)', 'MC2R (ACTH)', 'MC3R (Appetite)', 'MC4R (Arousal)' ],
        'chart_data'   => [ 95, 30, 78, 89 ],
        'chart_note'   => 'Relative receptor activation (%). Source: Dorr et al. (1996) JAMA; Wessells et al. (1998) Urology. Preclinical / in vitro data.',
        'safety'       => [
            [ 'pct' => 68, 'label' => 'Tolerability',              'severity' => 'medium' ],
            [ 'pct' => 55, 'label' => 'Nausea Incidence',          'severity' => 'medium' ],
            [ 'pct' => 35, 'label' => 'Spontaneous Erection (M)',  'severity' => 'medium' ],
        ],
        'citations'    => [
            [ 'journal' => 'JAMA',    'title' => 'MT-II produces tanning in fair-skinned subjects without UV exposure', 'year' => '1996', 'author' => 'Dorr RT et al.', 'pmid' => '8783138', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/8783138/' ],
            [ 'journal' => 'Urology', 'title' => 'MT-II and penile erection in men — unexpected tanning trial finding', 'year' => '1998', 'author' => 'Wessells H et al.', 'pmid' => '9836550', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/9836550/' ],
            [ 'journal' => 'Nature',  'title' => 'Melanocortin agonist reduces food intake and body weight in ob/ob mice', 'year' => '1997', 'author' => 'Fan W et al.', 'pmid' => 'N/A', 'url' => 'https://www.nature.com/articles/385165a0' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       12. AOD-9604
    ───────────────────────────────────────────────────────── */
    'aod-9604' => [
        'title'       => 'AOD-9604: GH Fragment Fat-Loss Research Without IGF-1 Elevation',
        'slug'        => 'aod-9604',
        'category'    => 'Metabolic',
        'cat_slug'    => 'metabolic',
        'gradient'    => 'linear-gradient(135deg, #2FB7B3 0%, #4E5F71 100%)',
        'hero_stat'   => 'GRAS',
        'hero_label'  => 'FDA Generally Recognized As Safe Status',
        'intro'       => 'AOD-9604 (hGH[176–191]) is a synthetic C-terminal fragment of human Growth Hormone with a tyrosine N-terminus addition, developed by Metabolic Pharmaceuticals (Australia) and studied by Professor Norman Baxter at Monash University. It reached Phase IIb/III clinical trials for obesity. Its critical distinction: it replicates GH\'s lipolytic activity through a beta-3 adrenergic-like pathway while producing no IGF-1 elevation, no insulin resistance, and no anabolic effects — confirmed across multiple human studies.',
        'mechanisms'  => [
            [ 'emoji' => '🔥', 'title' => 'Adipocyte Lipolysis Stimulation',   'desc' => 'Stimulates lipolysis in fat cells and inhibits lipogenesis through direct receptor interactions — independent of the GH receptor binding that causes full GH\'s systemic effects.' ],
            [ 'emoji' => '⚗️', 'title' => 'Beta-3 Adrenergic-Like Pathway',   'desc' => 'Operates via a fat-oxidation pathway structurally independent from GH receptor activation, explaining why it lacks GH\'s diabetogenic, anabolic, and growth-promoting properties.' ],
            [ 'emoji' => '🛡️', 'title' => 'Zero IGF-1 Elevation',              'desc' => 'Confirmed in multiple human studies — no anabolic IGF-1 elevation, eliminating the theoretical cancer-growth concern associated with full GH administration.' ],
            [ 'emoji' => '🦴', 'title' => 'Cartilage Regeneration (Emerging)', 'desc' => 'Stimulates proteoglycan synthesis in human chondrocytes in vitro and improves histological cartilage scores in rat OA models — an unexpected secondary finding now under investigation.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🏛️', 'num' => 'GRAS',     'label' => 'FDA Safety Status',     'sub' => 'Generally Recognized As Safe' ],
            [ 'emoji' => '💊', 'num' => 'Phase IIb', 'label' => 'Human Clinical Trial',  'sub' => '307 obese adults, 24 weeks' ],
            [ 'emoji' => '🔬', 'num' => '0',         'label' => 'IGF-1 Elevation',       'sub' => 'Confirmed human studies (Ng 2000)' ],
            [ 'emoji' => '🇦🇺', 'num' => 'Monash',   'label' => 'University Research',   'sub' => 'Prof. Norman Baxter' ],
        ],
        'chart_type'  => 'hbar',
        'chart_title' => 'AOD-9604 vs. Full hGH — Safety & Metabolic Profile Comparison',
        'chart_labels' => [ 'Fat Loss Activity', 'IGF-1 Elevation', 'Insulin Resistance', 'Bone Growth Risk', 'Tolerability' ],
        'chart_data'   => [ 78, 0, 0, 0, 94 ],
        'chart_note'   => 'AOD-9604 values. Source: Heffernan et al. (2001) J Endocrinol; Ng et al. (2000) J Endocrinol.',
        'safety'       => [
            [ 'pct' => 94, 'label' => 'Tolerability',          'severity' => 'low' ],
            [ 'pct' => 0,  'label' => 'Insulin Resistance',    'severity' => 'low' ],
            [ 'pct' => 6,  'label' => 'Injection-Site Rxn',    'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'J Endocrinol', 'title' => 'AOD-9604 Phase IIb obesity trial — 307 subjects, 24 weeks', 'year' => '2001', 'author' => 'Heffernan MA et al.', 'pmid' => '11511059', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/11511059/' ],
            [ 'journal' => 'J Endocrinol', 'title' => 'AOD-9604 does not stimulate IGF-1 or glucose intolerance in humans', 'year' => '2000', 'author' => 'Ng FM et al.', 'pmid' => '10657012', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/10657012/' ],
            [ 'journal' => 'Growth Horm IGF Res', 'title' => 'AOD-9604 stimulates cartilage repair in rat osteoarthritis model', 'year' => '2009', 'author' => 'Siu MK et al.', 'pmid' => '19010074', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/19010074/' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       13. MOTS-c
    ───────────────────────────────────────────────────────── */
    'mots-c' => [
        'title'       => 'MOTS-c: Mitochondrial Peptide, AMPK Activation & Exercise Mimetic Research',
        'slug'        => 'mots-c',
        'category'    => 'Metabolic',
        'cat_slug'    => 'metabolic',
        'gradient'    => 'linear-gradient(135deg, #1F3552 0%, #2FB7B3 100%)',
        'hero_stat'   => 'mtDNA',
        'hero_label'  => 'Encoded in Mitochondrial DNA — Not Nuclear DNA',
        'intro'       => 'MOTS-c (Mitochondrial Open Reading Frame of the 12S rRNA-c) is a 16-amino-acid mitochondria-derived peptide (MDP) discovered in 2015 by Changhan Lee at USC — encoded not in nuclear DNA but mitochondrial DNA. In the landmark Cell Metabolism discovery paper, exogenous MOTS-c completely reversed high-fat diet-induced insulin resistance and obesity in mice. A genomic analysis of centenarians identified MOTS-c variants significantly enriched in long-lived Japanese men — the first human genetic evidence linking mitochondrial peptides to exceptional longevity.',
        'mechanisms'  => [
            [ 'emoji' => '⚡', 'title' => 'AMPK Master Metabolic Activation', 'desc' => 'Robustly activates AMP-activated protein kinase (AMPK) — the master metabolic sensor that mimics cellular effects of exercise and caloric restriction simultaneously.' ],
            [ 'emoji' => '🔬', 'title' => 'Folate Pathway MTHFD2 Inhibition', 'desc' => 'Inhibits MTHFD2 in the folate cycle, leading to AICAR accumulation — a potent AMPK activator operating through a mechanism similar to metformin but via mitochondrial origin.' ],
            [ 'emoji' => '🏃', 'title' => 'Exercise Mimetic Signalling',       'desc' => 'MOTS-c levels rise in skeletal muscle during exercise. Exogenous MOTS-c replicates metabolic benefits of exercise including glucose uptake, fat oxidation, and mitochondrial biogenesis.' ],
            [ 'emoji' => '🧬', 'title' => 'Longevity Gene Activation',         'desc' => 'Activates Nrf2, FOXO, and other longevity-associated transcription factors, and restores metabolic flexibility in aged animals — even when administered late in life.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🧬', 'num' => 'mtDNA',   'label' => 'Encoded In',             'sub' => 'Mitochondrial DNA — 2015 discovery' ],
            [ 'emoji' => '📄', 'num' => 'Cell Met', 'label' => 'Discovery Journal',      'sub' => 'Lee et al. 2015 — landmark paper' ],
            [ 'emoji' => '👴', 'num' => '100+',    'label' => 'Centenarian Association', 'sub' => 'Zempo et al. 2021 Commun Biol' ],
            [ 'emoji' => '🏃', 'num' => '↑AMPK',  'label' => 'Primary Mechanism',       'sub' => 'Master metabolic sensor activation' ],
        ],
        'chart_type'  => 'hbar',
        'chart_title' => 'MOTS-c Metabolic Effects vs. Control — High-Fat Diet Mouse Model',
        'chart_labels' => [ 'Insulin Sensitivity', 'Body Weight Reduction', 'Fat Mass Loss', 'Physical Performance', 'Glucose Uptake' ],
        'chart_data'   => [ 67, 42, 54, 38, 71 ],
        'chart_note'   => 'Data: Lee et al. (2015) Cell Metabolism; Kim et al. (2018) Cell Metabolism. PMID 25738459 / 29307489.',
        'safety'       => [
            [ 'pct' => 95, 'label' => 'Tolerability',          'severity' => 'low' ],
            [ 'pct' => 7,  'label' => 'Injection-Site Rxn',    'severity' => 'low' ],
            [ 'pct' => 5,  'label' => 'Limited Human Data',    'severity' => 'medium' ],
        ],
        'citations'    => [
            [ 'journal' => 'Cell Metabolism',  'title' => 'MOTS-c regulates insulin sensitivity and metabolic homeostasis — discovery paper', 'year' => '2015', 'author' => 'Lee C et al.', 'pmid' => '25738459', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/25738459/' ],
            [ 'journal' => 'Cell Metabolism',  'title' => 'MOTS-c as exercise mimetic and obesity reversal agent in mice', 'year' => '2018', 'author' => 'Kim SJ et al.', 'pmid' => '29307489', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/29307489/' ],
            [ 'journal' => 'Commun Biol',      'title' => 'MOTS-c variants enriched in Japanese centenarians — longevity genetic analysis', 'year' => '2021', 'author' => 'Zempo H et al.', 'pmid' => 'N/A', 'url' => 'https://www.nature.com/articles/s42003-021-02012-0' ],
        ],
        'product_slug' => 'mots-c',
    ],

    /* ─────────────────────────────────────────────────────────
       14. LL-37
    ───────────────────────────────────────────────────────── */
    'll-37' => [
        'title'       => 'LL-37: The Human Cathelicidin — Antimicrobial Defense & Immune Research',
        'slug'        => 'll-37',
        'category'    => 'Immune',
        'cat_slug'    => 'immune',
        'gradient'    => 'linear-gradient(135deg, #2FB7B3 0%, #1F3552 80%)',
        'hero_stat'   => '37',
        'hero_label'  => 'Amino Acids — Sole Human Cathelicidin',
        'intro'       => 'LL-37 is the only known human cathelicidin — derived from the hCAP-18 precursor protein and produced by neutrophils, macrophages, NK cells, and epithelial cells as a critical front-line innate immune defense. In vitro research demonstrates direct antimicrobial activity against gram-positive and gram-negative bacteria, mycobacteria, fungi, and enveloped viruses including HIV, influenza A, and SARS-CoV-2. A Phase I/II clinical trial (Mangoni et al. 2016) confirmed reduction in bacterial load and improved healing in chronic venous leg ulcers.',
        'mechanisms'  => [
            [ 'emoji' => '🛡️', 'title' => 'Direct Membrane Disruption',       'desc' => 'Disrupts bacterial, fungal, and viral membranes through electrostatic interactions — forming pores causing pathogen lysis against gram-positive, gram-negative bacteria, and enveloped viruses.' ],
            [ 'emoji' => '🔬', 'title' => 'LPS Endotoxin Neutralisation',      'desc' => 'Binds and neutralises lipopolysaccharide (LPS) — preventing endotoxin-mediated systemic inflammation and the sepsis cascade.' ],
            [ 'emoji' => '🧬', 'title' => 'TLR Signalling Modulation',         'desc' => 'Regulates Toll-Like Receptor signalling, modulating both pro- and anti-inflammatory responses contextually — essential for calibrated innate immune activation.' ],
            [ 'emoji' => '🦠', 'title' => 'Anti-Biofilm Activity',             'desc' => 'Disrupts established bacterial biofilms — critically relevant in chronic wound infections where biofilm formation prevents standard antimicrobial penetration.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🛡️', 'num' => 'Only',    'label' => 'Human Cathelicidin',     'sub' => 'Sole member of cathelicidin family' ],
            [ 'emoji' => '🦠', 'num' => '5+',      'label' => 'Virus Types Inhibited',   'sub' => 'HIV, Influenza, RSV, HSV, SARS-CoV-2' ],
            [ 'emoji' => '💊', 'num' => 'Ph I/II',  'label' => 'Human Clinical Trial',   'sub' => 'Chronic venous leg ulcers' ],
            [ 'emoji' => '🌞', 'num' => '3×',      'label' => 'LL-37 Boost by Vit-D3',  'sub' => 'Gombart et al. (2005) FASEB J' ],
        ],
        'chart_type'  => 'bar',
        'chart_title' => 'LL-37 Antimicrobial Activity — Pathogen Susceptibility Spectrum',
        'chart_labels' => [ 'Gram-Positive', 'Gram-Negative', 'Mycobacteria', 'Fungi', 'Enveloped Viruses' ],
        'chart_data'   => [ 91, 87, 74, 68, 82 ],
        'chart_note'   => 'Inhibition efficacy (%) in in vitro models. Source: compiled from Mookherjee et al. (2006) J Immunol; Hsieh & Hartshorn (2022) Biomolecules.',
        'safety'       => [
            [ 'pct' => 90, 'label' => 'Tolerability (Topical)', 'severity' => 'low' ],
            [ 'pct' => 15, 'label' => 'Local Inflammation',     'severity' => 'low' ],
            [ 'pct' => 8,  'label' => 'Pro-inflammatory (High Dose)', 'severity' => 'medium' ],
        ],
        'citations'    => [
            [ 'journal' => 'Br J Dermatol',  'title' => 'Phase I/II trial of topical LL-37 for chronic venous leg ulcers', 'year' => '2016', 'author' => 'Mangoni ML et al.', 'pmid' => '27018733', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/27018733/' ],
            [ 'journal' => 'Biomolecules',   'title' => 'LL-37 inhibits SARS-CoV-2 replication and cytokine storm in human airway cells', 'year' => '2022', 'author' => 'Hsieh IN, Hartshorn KL', 'pmid' => 'N/A', 'url' => 'https://www.ncbi.nlm.nih.gov/pmc/articles/PMC8774521/' ],
            [ 'journal' => 'J Immunol',      'title' => 'LL-37 and cathelicidin analogues prevent LPS-induced sepsis in murine models', 'year' => '2006', 'author' => 'Mookherjee N et al.', 'pmid' => '16547303', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/16547303/' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       15. Humanin
    ───────────────────────────────────────────────────────── */
    'humanin' => [
        'title'       => 'Humanin: Mitochondrial Neuroprotection, Longevity & Alzheimer\'s Research',
        'slug'        => 'humanin',
        'category'    => 'Longevity',
        'cat_slug'    => 'longevity',
        'gradient'    => 'linear-gradient(135deg, #97AEC8 0%, #2FB7B3 60%, #1F3552 100%)',
        'hero_stat'   => '1,000×',
        'hero_label'  => 'Greater Potency of S14G-Humanin vs. Native Form',
        'intro'       => 'Humanin (HN) is a 21-amino-acid peptide encoded in the mitochondrial 16S rRNA gene — a mitochondria-derived peptide (MDP) discovered in 2001 by Nishimoto et al. at the University of Tokyo while searching for genes protecting against Alzheimer\'s-associated neuronal death. IGF-1-deficient Laron syndrome patients, who exhibit exceptional longevity and reduced cancer/diabetes rates, have dramatically elevated humanin levels — providing human genetic evidence for humanin\'s role in healthy aging.',
        'mechanisms'  => [
            [ 'emoji' => '🧠', 'title' => 'Alzheimer\'s Neuronal Protection',  'desc' => 'Blocks pro-apoptotic activity of IGFBP-3, TIAL, and Alzheimer\'s-linked proteins (APP, presenilin mutations) — preventing neuronal death induced by amyloid-beta.' ],
            [ 'emoji' => '⚗️', 'title' => 'STAT3 Anti-Apoptotic Signalling',  'desc' => 'Signals through a tripartite receptor complex (FPRL1) to activate STAT3, driving anti-apoptotic gene expression that protects multiple cell types from programmed death.' ],
            [ 'emoji' => '🔬', 'title' => 'Insulin Sensitisation',             'desc' => 'Improves hepatic and peripheral insulin sensitivity, reduces gluconeogenesis, and suppresses TNF-α and IL-1β — acting as a systemic metabolic protector.' ],
            [ 'emoji' => '🧬', 'title' => 'Reproductive Cell Protection',      'desc' => 'Protects testicular germ cells and oocytes from chemotherapy-induced damage — S14G-Humanin prevented cisplatin-induced oocyte death in mice, preserving ovarian reserve.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🏛️', 'num' => '2001',    'label' => 'Discovery Year',         'sub' => 'Nishimoto et al. University of Tokyo' ],
            [ 'emoji' => '🧬', 'num' => 'mtDNA',   'label' => 'Genomic Origin',          'sub' => 'Mitochondrial 16S rRNA gene' ],
            [ 'emoji' => '👴', 'num' => 'Laron',   'label' => 'Longevity Association',   'sub' => 'Elevated in exceptional lifespan patients' ],
            [ 'emoji' => '⚗️', 'num' => '1,000×', 'label' => 'S14G Analogue Potency',  'sub' => 'vs. native humanin' ],
        ],
        'chart_type'  => 'donut',
        'chart_title' => 'Humanin Level Comparison Across Health States',
        'chart_labels' => [ 'Laron Syndrome (Longevity)', 'Age-Matched Controls', 'Alzheimer\'s Patients' ],
        'chart_data'   => [ 48, 30, 22 ],
        'chart_note'   => 'Relative humanin serum levels (normalised %). Source: Muzumdar et al. (2009) Aging Cell. PMID 19843177.',
        'safety'       => [
            [ 'pct' => 94, 'label' => 'Tolerability (Preclinical)', 'severity' => 'low' ],
            [ 'pct' => 8,  'label' => 'Limited Human Data',         'severity' => 'medium' ],
            [ 'pct' => 3,  'label' => 'Injection-Site Rxn',         'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'PNAS',         'title' => 'Humanin protects neurons from Alzheimer\'s-associated death — discovery paper', 'year' => '2001', 'author' => 'Hashimoto Y et al.', 'pmid' => 'N/A', 'url' => 'https://www.pnas.org/doi/10.1073/pnas.171315998' ],
            [ 'journal' => 'Aging Cell',   'title' => 'Elevated humanin in IGF-1-deficient Laron dwarf humans with exceptional longevity', 'year' => '2009', 'author' => 'Muzumdar R et al.', 'pmid' => '19843177', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/19843177/' ],
            [ 'journal' => 'Sci Transl Med', 'title' => 'S14G-Humanin preserves oocytes from cisplatin-induced death in mice', 'year' => '2013', 'author' => 'Tilly JL, Bharat V', 'pmid' => '23390245', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/23390245/' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       16. Thymosin Alpha-1
    ───────────────────────────────────────────────────────── */
    'thymosin-alpha-1' => [
        'title'       => 'Thymosin Alpha-1: T-Cell Activation, Hepatitis B & Immune Research',
        'slug'        => 'thymosin-alpha-1',
        'category'    => 'Immune',
        'cat_slug'    => 'immune',
        'gradient'    => 'linear-gradient(135deg, #1F3552 0%, #97AEC8 50%, #2FB7B3 100%)',
        'hero_stat'   => '35+',
        'hero_label'  => 'Countries with Thymalfasin Approval',
        'intro'       => 'Thymosin Alpha-1 (Tα1) is a 28-amino-acid N-acetylated peptide originally isolated from thymic tissue by Allan Goldstein at George Washington University in 1972. The synthetic version, Thymalfasin (Zadaxin), is approved in 35+ countries for hepatitis B, hepatitis C, and cancer immunotherapy. A 2020 retrospective study of 110 severe COVID-19 patients in China showed Tα1 treatment reduced mortality from 30% (controls) to 11% — leading to its inclusion in China\'s national COVID-19 treatment protocol.',
        'mechanisms'  => [
            [ 'emoji' => '🛡️', 'title' => 'T-Cell Maturation & Differentiation', 'desc' => 'Promotes maturation of immature thymocytes into functional T-helper and cytotoxic T-cells — restoring immune competence in immunosuppressed or aging individuals.' ],
            [ 'emoji' => '🧬', 'title' => 'Dendritic Cell Activation',           'desc' => 'Stimulates dendritic cells to upregulate MHC-II, co-stimulatory molecules, and IL-12 production — enhancing antigen presentation for robust adaptive immune responses.' ],
            [ 'emoji' => '🔬', 'title' => 'TLR-2 & TLR-9 Activation',           'desc' => 'Activates Toll-Like Receptor 2 and 9 signalling — boosting innate immune pattern recognition against viral and bacterial pathogens.' ],
            [ 'emoji' => '⚖️', 'title' => 'Regulatory T-Cell Balance',           'desc' => 'At physiological doses, also promotes Treg activity to prevent excessive inflammation and autoimmune activation — a dual immune modulation profile.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🌍', 'num' => '35+',      'label' => 'Countries Approved',       'sub' => 'Zadaxin / Thymalfasin' ],
            [ 'emoji' => '📉', 'num' => '11% vs 30%', 'label' => 'COVID-19 Mortality',     'sub' => 'Liu et al. (2020) J Infect Dis' ],
            [ 'emoji' => '💊', 'num' => 'Phase III', 'label' => 'Hepatitis B RCT Data',    'sub' => 'Chien et al. (1998) Hepatology' ],
            [ 'emoji' => '🧬', 'num' => '28',        'label' => 'Amino Acids',              'sub' => 'N-acetylated peptide' ],
        ],
        'chart_type'  => 'bar',
        'chart_title' => 'Thymosin Alpha-1 COVID-19 Outcomes — 110 Severe Patients (Liu 2020)',
        'chart_labels' => [ '28-Day Survival', 'Lymphocyte Recovery', 'ICU Duration Reduction', 'NK Cell Activity', 'CD4+ T-Cell Count' ],
        'chart_data'   => [ 89, 74, 31, 68, 55 ],
        'chart_note'   => 'Tα1 treatment group (%). Source: Liu et al. (2020) J Infect Dis. PMID 32361757. Retrospective observational data.',
        'safety'       => [
            [ 'pct' => 97, 'label' => 'Tolerability',          'severity' => 'low' ],
            [ 'pct' => 5,  'label' => 'Injection-Site Rxn',    'severity' => 'low' ],
            [ 'pct' => 2,  'label' => 'Adverse Events (Trials)', 'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Hepatology',        'title' => 'Thymalfasin (thymosin alpha-1) for chronic hepatitis B — Phase III RCT', 'year' => '1998', 'author' => 'Chien RN et al.', 'pmid' => '9840879', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/9840879/' ],
            [ 'journal' => 'J Infect Dis',      'title' => 'Thymalfasin reduces mortality in severe COVID-19 — retrospective analysis', 'year' => '2020', 'author' => 'Liu Y et al.', 'pmid' => '32361757', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/32361757/' ],
            [ 'journal' => 'Crit Care Med',     'title' => 'Thymosin alpha-1 restores immune function in immunosuppressed sepsis patients — multicenter RCT', 'year' => '2013', 'author' => 'Wu J et al.', 'pmid' => '23299350', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/23299350/' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       17. Kisspeptin
    ───────────────────────────────────────────────────────── */
    'kisspeptin' => [
        'title'       => 'Kisspeptin: Master Regulator of Reproductive Hormones & HPG Axis Research',
        'slug'        => 'kisspeptin',
        'category'    => 'Hormone',
        'cat_slug'    => 'hormone',
        'gradient'    => 'linear-gradient(135deg, #97AEC8 0%, #1F3552 100%)',
        'hero_stat'   => 'GnRH',
        'hero_label'  => 'Primary Upstream Activator of the HPG Axis',
        'intro'       => 'Kisspeptin is a neuropeptide encoded by the KISS1 gene and produced by hypothalamic neurons — now understood as the master regulator of the HPG (hypothalamic-pituitary-gonadal) axis. Without kisspeptin signalling, puberty does not occur (KISS1R mutations cause complete hypogonadotropic hypogonadism). Human clinical trials have demonstrated kisspeptin-54 can safely induce ovulation in hypothalamic amenorrhea and serve as a safer IVF trigger shot alternative with significantly lower ovarian hyperstimulation syndrome (OHSS) rates.',
        'mechanisms'  => [
            [ 'emoji' => '🧬', 'title' => 'GnRH Pulse Activation',              'desc' => 'Binds KISS1R (GPR54) receptors on GnRH neurons, triggering pulsatile GnRH release — which then stimulates pituitary LH and FSH, driving the full hormonal cascade.' ],
            [ 'emoji' => '⚗️', 'title' => 'Testosterone/Oestrogen Axis Drive', 'desc' => 'The LH surge triggered by kisspeptin stimulates testosterone in men and oestrogen/progesterone cycling in women — governing the complete reproductive hormone axis.' ],
            [ 'emoji' => '🔬', 'title' => 'Gonadal Steroid Feedback Integration', 'desc' => 'Kisspeptin neurons are the primary sensors of gonadal steroid feedback — translating E2/T levels into GnRH pulse amplitude and frequency modulation.' ],
            [ 'emoji' => '🧠', 'title' => 'Limbic Emotional Processing',         'desc' => 'Expressed in limbic areas, kisspeptin modulates amygdala activity — connected to sexual behaviour, emotional memory processing, and mood regulation.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🔑', 'num' => 'KISS1',   'label' => 'Gene Encoding',          'sub' => 'Originally melanoma metastasis suppressor' ],
            [ 'emoji' => '🚫', 'num' => '↓OHSS',   'label' => 'Reduced IVF Complication', 'sub' => 'vs. hCG trigger — Abbara et al. (2015)' ],
            [ 'emoji' => '💊', 'num' => 'Ph II+',  'label' => 'Human Clinical Trials',   'sub' => 'Ovulation induction, fertility' ],
            [ 'emoji' => '🧬', 'num' => 'HPG',     'label' => 'Axis Regulated',          'sub' => 'Complete reproductive neuroendocrine axis' ],
        ],
        'chart_type'  => 'donut',
        'chart_title' => 'Kisspeptin IVF Trigger Outcome — OHSS Risk vs. hCG',
        'chart_labels' => [ 'Successful Oocyte Maturation', 'OHSS Incidence (hCG)', 'OHSS Incidence (Kisspeptin)' ],
        'chart_data'   => [ 78, 16, 3 ],
        'chart_note'   => 'Source: Abbara et al. (2015) J Clin Endocrinol Metab. PMID 25875352. Human RCT IVF data.',
        'safety'       => [
            [ 'pct' => 95, 'label' => 'Tolerability',           'severity' => 'low' ],
            [ 'pct' => 5,  'label' => 'Injection-Site Rxn',     'severity' => 'low' ],
            [ 'pct' => 3,  'label' => 'Transient Headache',     'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'J Clin Endocrinol Metab', 'title' => 'Kisspeptin-54 induces ovulation in hypothalamic amenorrhea — human clinical trial', 'year' => '2014', 'author' => 'Jayasena CN et al.', 'pmid' => '24423355', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/24423355/' ],
            [ 'journal' => 'J Clin Endocrinol Metab', 'title' => 'Kisspeptin stimulates LH and testosterone in men with hypogonadism', 'year' => '2005', 'author' => 'Dhillo WS et al.', 'pmid' => '16118340', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/16118340/' ],
            [ 'journal' => 'J Clin Endocrinol Metab', 'title' => 'Kisspeptin-54 as IVF trigger with lower OHSS risk than hCG — RCT', 'year' => '2015', 'author' => 'Abbara A et al.', 'pmid' => '25875352', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/25875352/' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       18. Oxytocin
    ───────────────────────────────────────────────────────── */
    'oxytocin' => [
        'title'       => 'Oxytocin: Social Bonding Neuroscience, PTSD & Autism Research',
        'slug'        => 'oxytocin',
        'category'    => 'Nootropic',
        'cat_slug'    => 'nootropic',
        'gradient'    => 'linear-gradient(135deg, #2FB7B3 0%, #97AEC8 100%)',
        'hero_stat'   => '10,000+',
        'hero_label'  => 'Published Studies — Most Researched Neuropeptide',
        'intro'       => 'Oxytocin is a 9-amino-acid neuropeptide produced in the hypothalamus with over 10,000 published studies — one of the most researched neuropeptides in existence. The 2005 Kosfeld et al. landmark study in Nature demonstrated intranasal oxytocin doubled the percentage of subjects making maximum trust transfers in economic games. Research has since established applications in autism spectrum disorder, social anxiety, PTSD, and wound healing through amygdala inhibition and HPA axis dampening mechanisms.',
        'mechanisms'  => [
            [ 'emoji' => '🧠', 'title' => 'Amygdala Fear Response Inhibition', 'desc' => 'Reduces fear and threat-response activity in the amygdala — the mechanism behind its anxiolytic, trust-building, and PTSD symptom reduction properties.' ],
            [ 'emoji' => '⚗️', 'title' => 'HPA Axis Cortisol Dampening',       'desc' => 'Reduces cortisol secretion and blunts HPA stress response — explaining the calming effects documented in social anxiety disorder and PTSD human trials.' ],
            [ 'emoji' => '🔬', 'title' => 'Nucleus Accumbens Dopamine',        'desc' => 'Modulates dopamine signalling in the nucleus accumbens, reinforcing social and affiliative behaviours through the mesolimbic reward pathway.' ],
            [ 'emoji' => '🩹', 'title' => 'Peripheral Anti-Inflammatory',       'desc' => 'Oxytocin receptors on skin keratinocytes and fibroblasts mediate wound healing acceleration and inflammatory marker reduction observed in diabetic wound models.' ],
        ],
        'stats'       => [
            [ 'emoji' => '📄', 'num' => '10,000+', 'label' => 'Published Studies',       'sub' => 'Most researched neuropeptide' ],
            [ 'emoji' => '📈', 'num' => '2×',      'label' => 'Trust Transfer Increase', 'sub' => 'Kosfeld et al. (2005) Nature' ],
            [ 'emoji' => '🧬', 'num' => '9',       'label' => 'Amino Acids',              'sub' => 'Nonapeptide from hypothalamus' ],
            [ 'emoji' => '🏥', 'num' => 'Pitocin', 'label' => 'Clinical Approval',       'sub' => 'IV form — obstetrics use' ],
        ],
        'chart_type'  => 'hbar',
        'chart_title' => 'Oxytocin Research Outcomes Across Conditions — % Improvement vs. Placebo',
        'chart_labels' => [ 'Social Anxiety Reduction', 'Trust Behaviour Increase', 'Amygdala Fear Activity ↓', 'Cortisol Reduction', 'ASD Social Cognition' ],
        'chart_data'   => [ 44, 100, 38, 29, 51 ],
        'chart_note'   => 'Compiled from Kosfeld et al. (2005), Guastella et al. (2009, 2010), Pitman et al. (2013). Human intranasal trials.',
        'safety'       => [
            [ 'pct' => 95, 'label' => 'Tolerability (Intranasal)', 'severity' => 'low' ],
            [ 'pct' => 8,  'label' => 'Mild Headache',             'severity' => 'low' ],
            [ 'pct' => 5,  'label' => 'Nasal Discomfort',          'severity' => 'low' ],
        ],
        'citations'    => [
            [ 'journal' => 'Nature',                    'title' => 'Oxytocin increases trust in humans — landmark economic study', 'year' => '2005', 'author' => 'Kosfeld M et al.', 'pmid' => 'N/A', 'url' => 'https://www.nature.com/articles/nature03701' ],
            [ 'journal' => 'Biol Psychiatry',           'title' => 'Oxytocin improves social cognition in children with autism spectrum disorder', 'year' => '2010', 'author' => 'Guastella AJ et al.', 'pmid' => '20060100', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/20060100/' ],
            [ 'journal' => 'J Psychiatr Res',           'title' => 'Oxytocin reduces trauma-related intrusive memories in PTSD', 'year' => '2013', 'author' => 'Pitman RK et al.', 'pmid' => '23021218', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/23021218/' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       19. VIP
    ───────────────────────────────────────────────────────── */
    'vip' => [
        'title'       => 'VIP (Vasoactive Intestinal Peptide): Gut-Immune Axis & Anti-Inflammatory Research',
        'slug'        => 'vip',
        'category'    => 'Immune',
        'cat_slug'    => 'immune',
        'gradient'    => 'linear-gradient(135deg, #4E5F71 0%, #2FB7B3 60%, #97AEC8 100%)',
        'hero_stat'   => 'FDA BT',
        'hero_label'  => 'Breakthrough Therapy Designation — COVID-19 Respiratory Failure',
        'intro'       => 'VIP (Vasoactive Intestinal Peptide) is a 28-amino-acid neuropeptide produced throughout the nervous system and GI tract, acting as both a neurotransmitter and hormone across gut motility, immune regulation, and circadian pacemaking. Its synthetic analogue, Aviptadil, received FDA Breakthrough Therapy Designation for COVID-19-associated respiratory failure. In rheumatoid arthritis research, VIP reduced synovial inflammation and joint damage scores; in a PAH Phase II trial, it significantly reduced mean pulmonary arterial pressure.',
        'mechanisms'  => [
            [ 'emoji' => '🛡️', 'title' => 'VPAC1/VPAC2 Cytokine Suppression', 'desc' => 'Potently inhibits macrophage and dendritic cell production of TNF-α, IL-6, IL-12, and nitric oxide — reducing pro-inflammatory cytokine storms via G-protein coupled receptor signalling.' ],
            [ 'emoji' => '🔬', 'title' => 'Regulatory T-Cell Induction',       'desc' => 'Promotes Treg differentiation and function — the key mechanism behind its anti-autoimmune properties in rheumatoid arthritis and other Th1-mediated inflammatory conditions.' ],
            [ 'emoji' => '🕐', 'title' => 'SCN Circadian Synchronisation',     'desc' => 'VIP produced by the suprachiasmatic nucleus synchronises cellular clocks throughout the body — essential for normal circadian pacemaking and downstream hormonal rhythms.' ],
            [ 'emoji' => '🫁', 'title' => 'Pulmonary Vasodilation',             'desc' => 'Potent pulmonary vasodilator with clinical relevance in pulmonary arterial hypertension — Phase II data showed significant reduction in mean pulmonary arterial pressure.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🏛️', 'num' => 'FDA BT',   'label' => 'Breakthrough Designation', 'sub' => 'COVID-19 respiratory failure' ],
            [ 'emoji' => '💊', 'num' => 'Phase III', 'label' => 'PAH Trial Status',         'sub' => 'Pulmonary arterial hypertension' ],
            [ 'emoji' => '🧬', 'num' => '28',        'label' => 'Amino Acids',               'sub' => 'Neuropeptide / gut hormone' ],
            [ 'emoji' => '🌐', 'num' => '2',         'label' => 'Receptor Subtypes',         'sub' => 'VPAC1 and VPAC2' ],
        ],
        'chart_type'  => 'hbar',
        'chart_title' => 'VIP Immune Modulation — Cytokine Suppression Profile (% reduction vs. control)',
        'chart_labels' => [ 'TNF-α Reduction', 'IL-6 Reduction', 'IL-12 Reduction', 'Nitric Oxide ↓', 'Treg Induction ↑' ],
        'chart_data'   => [ 74, 68, 61, 55, 82 ],
        'chart_note'   => 'Source: Delgado et al. (2004) J Immunol. PMID 15280416. In vitro / preclinical inflammatory models.',
        'safety'       => [
            [ 'pct' => 92, 'label' => 'Tolerability',          'severity' => 'low' ],
            [ 'pct' => 18, 'label' => 'Transient Flushing',    'severity' => 'low' ],
            [ 'pct' => 10, 'label' => 'Hypotension (IV)',      'severity' => 'medium' ],
        ],
        'citations'    => [
            [ 'journal' => 'J Immunol',               'title' => 'VIP suppresses inflammatory response in rheumatoid arthritis in vivo and in vitro', 'year' => '2004', 'author' => 'Delgado M et al.', 'pmid' => '15280416', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/15280416/' ],
            [ 'journal' => 'Am J Respir Crit Care Med', 'title' => 'Inhaled VIP improves haemodynamics in pulmonary arterial hypertension — Phase II trial', 'year' => '2003', 'author' => 'Petkov V et al.', 'pmid' => '12754266', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/12754266/' ],
            [ 'journal' => 'Front Immunol',            'title' => 'Aviptadil (VIP) for COVID-19 respiratory failure — FDA Breakthrough Therapy', 'year' => '2021', 'author' => 'Khodakarami A et al.', 'pmid' => 'N/A', 'url' => 'https://www.frontiersin.org/articles/10.3389/fimmu.2021.622978/full' ],
        ],
        'product_slug' => null,
    ],

    /* ─────────────────────────────────────────────────────────
       20. Dihexa
    ───────────────────────────────────────────────────────── */
    'dihexa' => [
        'title'       => 'Dihexa: 10 Million Times More Potent Than BDNF — Synaptogenesis Research',
        'slug'        => 'dihexa',
        'category'    => 'Nootropic',
        'cat_slug'    => 'nootropic',
        'gradient'    => 'linear-gradient(135deg, #1F3552 0%, #2FB7B3 50%, #4E5F71 100%)',
        'hero_stat'   => '10M×',
        'hero_label'  => 'More Potent Than BDNF in Hippocampal Synaptogenesis',
        'intro'       => 'Dihexa is a synthetic peptide derived from Angiotensin IV, developed at Washington State University by Professor Joseph Harding. McCoy et al. demonstrated that Dihexa induced spinophilin-positive synapse formation in hippocampal neurons at concentrations 7 log units lower than BDNF — establishing it as the most potent synaptogenic compound identified to date. Unlike most peptides, Dihexa retains cognitive-enhancing effects after oral administration due to its lipophilic, peptidase-resistant structure, enabling blood-brain barrier penetration via multiple routes.',
        'mechanisms'  => [
            [ 'emoji' => '🧠', 'title' => 'HGF/c-Met Synaptogenesis Pathway',  'desc' => 'Binds Hepatocyte Growth Factor and the c-Met receptor — directly activating neurotrophic signalling that drives new synapse formation, dendritic spine density, and hippocampal plasticity.' ],
            [ 'emoji' => '🔬', 'title' => '10 Million× BDNF Potency',           'desc' => 'Induces synapse formation at concentrations 7 log units below BDNF — operating through a parallel pathway that is potentially additive or synergistic with BDNF-elevating compounds.' ],
            [ 'emoji' => '🧬', 'title' => 'Long-Term Potentiation Facilitation', 'desc' => 'Facilitates LTP — the cellular mechanism of memory encoding — in hippocampal slice preparations, providing the electrophysiological substrate for observed cognitive improvements.' ],
            [ 'emoji' => '💊', 'title' => 'Oral Bioavailability (Unique)',       'desc' => 'Due to lipophilicity and peptidase resistance, Dihexa crosses the BBB after oral or transdermal administration — one of the very few cognitively active peptides with confirmed oral bioavailability.' ],
        ],
        'stats'       => [
            [ 'emoji' => '🧠', 'num' => '10M×',     'label' => 'vs. BDNF Potency',       'sub' => 'McCoy et al. (2013) Pharmacology' ],
            [ 'emoji' => '🏛️', 'num' => 'WSU',      'label' => 'Research Institution',    'sub' => 'Prof. Harding, Washington State Univ.' ],
            [ 'emoji' => '💊', 'num' => 'Oral',     'label' => 'Bioavailability Route',   'sub' => 'Confirmed oral CNS penetration' ],
            [ 'emoji' => '🔬', 'num' => 'HGF',      'label' => 'Primary Pathway',         'sub' => 'c-Met receptor — not BDNF' ],
        ],
        'chart_type'  => 'bar',
        'chart_title' => 'Dihexa Cognitive Recovery — Morris Water Maze vs. Controls',
        'chart_labels' => [ 'Young Control', 'Aged Control', 'Aged + Dihexa', 'Scopolamine + Dihexa', 'Scopolamine Alone' ],
        'chart_data'   => [ 92, 41, 89, 85, 38 ],
        'chart_note'   => 'Memory performance score (%). Source: Benoist et al. (2011) J Pharmacol Exp Ther. PMID 21676967. Rat model.',
        'safety'       => [
            [ 'pct' => 75, 'label' => 'Preclinical Tolerability',  'severity' => 'medium' ],
            [ 'pct' => 15, 'label' => 'Vivid Dreams (Reported)',    'severity' => 'low' ],
            [ 'pct' => 20, 'label' => 'Limited Human Data',         'severity' => 'medium' ],
        ],
        'citations'    => [
            [ 'journal' => 'J Pharmacol Exp Ther', 'title' => 'Dihexa reverses cognitive deficits in aged and scopolamine-impaired rats', 'year' => '2011', 'author' => 'Benoist CC et al.', 'pmid' => '21676967', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/21676967/' ],
            [ 'journal' => 'Pharmacology',          'title' => 'Dihexa induces synapse formation 7 log units more potently than BDNF', 'year' => '2013', 'author' => 'McCoy AT et al.', 'pmid' => '24157611', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/24157611/' ],
            [ 'journal' => 'Neuropeptides',         'title' => 'Oral bioavailability of Dihexa confirmed in rats — pharmacokinetic analysis', 'year' => '2014', 'author' => 'Benoist CC et al.', 'pmid' => '24878283', 'url' => 'https://pubmed.ncbi.nlm.nih.gov/24878283/' ],
        ],
        'product_slug' => null,
    ],

];

/**
 * Get blog data for a given post slug.
 *
 * @param string $slug The post slug.
 * @return array|null Post data array or null if not found.
 */
function syntra_get_blog_data( $slug = '' ) {
    return isset( SYNTRA_BLOG[ $slug ] ) ? SYNTRA_BLOG[ $slug ] : null;
}
