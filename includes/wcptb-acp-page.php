<?php
$tmpStr = plugin_dir_path( __DIR__ );
if (substr($tmpStr,-1) == "/")
   $tmpPos = strrpos($tmpStr,'/',-2);
else    
   $tmpPos = strrpos($tmpStr,'/',-1);

$wcptb_CurrentVersion = get_option('wcptbCurrentVersion');
$wcptb_CurrentType = get_option('wcptbCurrentType');

$opt_SoldOut = get_option('optSoldOut');
$opt_TagListHideEmpty = get_option('optTagListHideEmpty');
$opt_TagListOrder = get_option('optTagListOrder'); if ($opt_TagListOrder == "") $opt_TagListOrder = "ASC";
$opt_TagListCount = get_option('optTagListCount');
$opt_TagListSort = get_option('optTagListSort'); if ($opt_TagListSort == "") $opt_TagListSort = "alpha";
$opt_TagListTitle = get_option('optTagListTitle'); if ($opt_TagListTitle == "") $opt_TagListTitle = esc_html__('Tags','next-wc-product-toolbox');

$opt_CatListHideEmpty = get_option('optCatListHideEmpty');
$opt_CatListOrder = get_option('optCatListOrder'); if ($opt_CatListOrder == "") $opt_CatListOrder = "SORT_ASC";
$opt_CatListCount = get_option('optCatListCount');

$opt_MetasHide = get_option('optMetasHide');
$opt_HideSKU = get_option('optHideSKU');
$opt_HideTab_AddInfo = get_option('optHideTab_AddInfo');
$opt_HideTab_Review = get_option('optHideTab_Review');
$opt_RelatedProducts = get_option('optRelatedProducts');
$opt_AddCartTextShop = get_option('optAddCartTextShop');
$opt_AddCartTextProduct = get_option('optAddCartTextProduct');
$opt_NewAddCart = get_option('optNewAddCart');
$opt_FreeShippingAmount = get_option('optFreeShippingAmount');
$opt_FreeShippingButton = get_option('optFreeShippingButton'); if ($opt_FreeShippingButton == "") $opt_FreeShippingButton = esc_html__('Continue shopping!','next-wc-product-toolbox');

$opt_DescTitle = get_option('optDescTitle');
$opt_DescShort = get_option('optDescShort');

$opt_MetasShowCat = get_option('optMetasShowCat');
$opt_MetasShowTag = get_option('optMetasShowTag');

$opt_MetasShowCat = get_option('optMetasShowCat');
$opt_MetasShowTag = get_option('optMetasShowTag');
$opt_MetasShowCat = get_option('optMetasShowCat');

$opt_MetasDescTabVal = get_option('optMetasDescTabVal');
$opt_MetasDescTitle = get_option('optMetasDescTitle');  
   
$opt_TagHideEmpty = get_option('optTagHideEmpty');
$opt_TagOrder = get_option('optTagOrder'); if ($opt_TagOrder == "") $opt_TagOrder = "DESC";
$opt_TagCount = get_option('optTagCount');

$opt_SubcatHideEmpty = get_option('optSubcatHideEmpty');
$opt_SubcatOrder = get_option('optSubcatOrder'); if ($opt_SubcatOrder == "") $opt_SubcatOrder = "DESC";
$opt_SubcatCount = get_option('optSubcatCount');

$opt_DisableCopy = get_option('optDisableCopy');

function wcptb_LogFile($parMsg,$parNoticeType)
{ echo "<div class=\"notice notice-" . esc_attr($parNoticeType) . " is-dismissible\"><p>" . esc_attr($parMsg) . "</p></div>";
  
  $dir = plugin_dir_path( __DIR__ );
  $tmpPathLogFile = $dir . WCPTB_PLUGIN_SLUG . ".log";
  $handle = fopen($tmpPathLogFile,"a");
  if ($handle == false)
     { 
     }
  else
     { fwrite ($handle , date("D j M Y H:i:s", time()) . " - " . $parMsg . PHP_EOL); 
       fclose ($handle);
     }
}

echo '<div align="right">' . esc_attr($wcptb_CurrentType) . ' Version v.' . esc_attr($wcptb_CurrentVersion) . '</div>';

$tmpTab = sanitize_text_field($_GET['tab']);
$tab = (isset($tmpTab) and $tmpTab != "")?$tmpTab:'wcptb_box';
$tmpSection = sanitize_text_field($_GET['section']);
if($tab==='wcptb_box')
  { $section = (isset($tmpSection) and $tmpSection != "")?$tmpSection:'metas';
  }
?>
<!-- Admin page content should all be inside .wrap -->
<div class="wrap">
<!-- Print the page title -->
<nav class="nav-tab-wrapper">
     <a href="?page=wcptb-acp&tab=wcptb_box" class="nav-tab <?php if($tab==='wcptb_box'):?>nav-tab-active<?php endif; ?>"><?php esc_html_e('Toolbox','next-wc-product-toolbox'); ?></a>
     <a href="?page=wcptb-acp&tab=wcptb_seo" class="nav-tab <?php if($tab==='wcptb_seo'):?>nav-tab-active<?php endif; ?>"><?php esc_html_e('SEO','next-wc-product-toolbox'); ?></a>
     <a href="?page=wcptb-acp&tab=wcptb_misc" class="nav-tab <?php if($tab==='wcptb_misc'):?>nav-tab-active<?php endif; ?>"><?php esc_html_e('Misc','next-wc-product-toolbox'); ?></a>
</nav>

    <div class="tab-content">
    <?php switch($tab)
          { case 'wcptb_misc': ?> 
  
    <form method="post" action="options.php">
    <?php settings_fields('wcptb-misc-group'); ?>
    <?php do_settings_sections('wcptb-misc-group'); ?>

    <h2 class="title"><?php esc_html_e('Content protection','next-wc-product-toolbox'); ?></h2>
       
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Copy protection','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optDisableCopy" value=1 <?php echo($opt_DisableCopy==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Disable right click and copy content','next-wc-product-toolbox'); ?>
        </td></tr>
    </table>    
    <?php submit_button(esc_html__('Save','next-wc-product-toolbox')); ?>
</form>


        <?php break;   
               
               
 
    
    
    
    
    
    
    case 'wcptb_seo': ?> 
    <form method="post" action="options.php">
    <?php settings_fields('wcptb-seo-group'); ?>
    <?php do_settings_sections('wcptb-seo-group'); ?>
    
    <h2 class="title"><?php esc_html_e('Product meta description','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Improve your SEO by informing visitors with a relevant product title and/or short meta description of what each product is about.','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Add meta title, description','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optDescTitle" value=1 <?php echo($opt_DescTitle==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Use title','next-wc-product-toolbox'); ?><br>
            <input type="checkbox" name="optDescShort" value=1 <?php echo($opt_DescShort==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Use short description','next-wc-product-toolbox'); ?>
        </td></tr>
    </table>
        
    <h2 class="title"><?php esc_html_e('Product meta links','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Improve your SEO by adding internal category and/or tag links between your products.','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Add meta links','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optMetasShowCat" value=1 <?php echo($opt_MetasShowCat==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Add category links','next-wc-product-toolbox'); ?><br>
            <input type="checkbox" name="optMetasShowTag" value=1" <?php echo($opt_MetasShowTag==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Add tag links','next-wc-product-toolbox'); ?>
        </td></tr>
    </table>

    <h2 class="title"><?php esc_html_e('Product description tab','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Improve your SEO by replacing automatically Description heading by your product title and/or description tab by your own text.','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Description heading','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optMetasDescTitle" value=1 <?php echo($opt_MetasDescTitle==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Rename description heading by product title','next-wc-product-toolbox'); ?>
        </td></tr>


        <tr valign="top">
        <th scope="row"><?php esc_html_e('Description tab','next-wc-product-toolbox'); ?></th>
        <td><input type="text" name="optMetasDescTabVal" value="<?php echo esc_attr($opt_MetasDescTabVal) ?>" class="xxx" /> <em><font color="#808080"><?php esc_html_e('(Left empty if not used)','next-wc-product-toolbox'); ?></font></em>
        <br><font color="#808080"><em><?php esc_html_e('Rename \'Description tab\' text with your own text.','next-wc-product-toolbox'); ?></em></font>
        </td></tr>
    </table>
        
    <h2 class="title"><?php esc_html_e('Tags cloud','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Improve your SEO by adding a tag cloud of WC product tags.','next-wc-product-toolbox'); ?></em></font><br>
    <font color="#808080"><em><?php esc_html_e('Insert [tags_cloud] short code into a text widget as well as post or page content.','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Empty tags','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optTagHideEmpty" value=1 <?php echo($opt_TagHideEmpty==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Hide tags with NO product','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Order','next-wc-product-toolbox'); ?></th>
        <td><input type="radio" name="optTagOrder" value="ASC" <?php echo($opt_TagOrder=="ASC"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Ascending','next-wc-product-toolbox'); ?><br>
            <input type="radio" name="optTagOrder" value="DESC" <?php echo($opt_TagOrder=="DESC"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Descending','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Count','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optTagCount" value=1 <?php echo($opt_TagCount==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Display number of products','next-wc-product-toolbox'); ?>
        </td></tr>    
   
    </table>    <h2 class="title"><?php esc_html_e('Categories cloud','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Improve your SEO by adding a categories cloud of WC product categories.','next-wc-product-toolbox'); ?></em></font><br>
    <font color="#808080"><em><?php esc_html_e('Insert [subcats_cloud] short code into a text widget as well as post or page content.','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Empty categories','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optSubcatHideEmpty" value=1 <?php echo($opt_SubcatHideEmpty==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Hide categories with NO product','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Order','next-wc-product-toolbox'); ?></th>
        <td><input type="radio" name="optSubcatOrder" value="ASC" <?php echo($opt_SubcatOrder=="ASC"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Ascending','next-wc-product-toolbox'); ?><br>
            <input type="radio" name="optSubcatOrder" value="DESC" <?php echo($opt_SubcatOrder=="DESC"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Descending','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Count','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optSubcatCount" value=1 <?php echo($opt_SubcatCount==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Display number of products','next-wc-product-toolbox'); ?>
        </td></tr>    
    </table>
    <?php submit_button(esc_html__('Save','next-wc-product-toolbox')); ?>
    </form>
    <?php break;
    
    
    
    
    
    
        
    case 'wcptb_box': ?> 
    
    
    <?php
    switch ($section)
           { case 'metas':?>
                   <h1 class="screen-reader-text">Toolbox</h1>
		               <ul class="subsubsub"><li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=metas" class="current"><?php esc_html_e('Metas','next-wc-product-toolbox'); ?></a> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=tags" class=""><?php esc_html_e('Tags','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=subcats" class=""><?php esc_html_e('Categories','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=product" class=""><?php esc_html_e('Products','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=cart" class=""><?php esc_html_e('Cart','next-wc-product-toolbox'); ?></a> </li>
		               </ul><br class="clear">
    <form method="post" action="options.php">
    <?php settings_fields('wcptb-metas-group'); ?>
    <?php do_settings_sections('wcptb-metas-group'); ?>
    <h2 class="title"><?php esc_html_e('Product metas','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Improve your layout by hiding product metas.','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Hide metas','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optMetasHide" value=1 <?php echo($opt_MetasHide==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Hide SKU, Categories and Tags','next-wc-product-toolbox'); ?>
            <br><input type="checkbox" name="optHideSKU" value=1 <?php echo($opt_HideSKU==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Hide only SKU','next-wc-product-toolbox'); ?>
        </td></tr>
    </table>   
    <?php submit_button(esc_html__('Save','next-wc-product-toolbox')); ?>
    </form>

                   <?php break;
                  
                  
                  
             case 'tags':?>
                   <h1 class="screen-reader-text">Toolbox</h1>
		               <ul class="subsubsub"><li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=metas" class=""><?php esc_html_e('Metas','next-wc-product-toolbox'); ?></a> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=tags" class="current"><?php esc_html_e('Tags','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=subcats" class=""><?php esc_html_e('Categories','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=product" class=""><?php esc_html_e('Products','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=cart" class=""><?php esc_html_e('Cart','next-wc-product-toolbox'); ?></a> </li>
  	               </ul><br class="clear">             
    <form method="post" action="options.php">
    <?php settings_fields('wcptb-tags-group'); ?>
    <?php do_settings_sections('wcptb-tags-group'); ?>
    <h2 class="title"><?php esc_html_e('Tags scrolling list','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Improve your navigation by adding a tags scrolling list of all your product tags.','next-wc-product-toolbox'); ?></em></font><br>
    <font color="#808080"><em><?php esc_html_e('Insert [tags_list] short code into a text widget as well as post or page content.','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
    
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Title','next-wc-product-toolbox'); ?></th>
        <td><input type="text" name="optTagListTitle" value="<?php echo esc_attr($opt_TagListTitle) ?>" class="xxx" />
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Sort','next-wc-product-toolbox'); ?></th>
        <td><input type="radio" name="optTagListSort" value="alpha" <?php echo($opt_TagListSort=="alpha"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Alpha','next-wc-product-toolbox'); ?><br>
            <input type="radio" name="optTagListSort" value="count" <?php echo($opt_TagListSort=="count"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('By number','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Empty tags','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optTagListHideEmpty" value=1 <?php echo($opt_TagListHideEmpty==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Hide tags with NO product','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Order','next-wc-product-toolbox'); ?></th>
        <td><input type="radio" name="optTagListOrder" value="ASC" <?php echo($opt_TagListOrder=="ASC"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Ascending','next-wc-product-toolbox'); ?><br>
            <input type="radio" name="optTagListOrder" value="DESC" <?php echo($opt_TagListOrder=="DESC"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Descending','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Count','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optTagListCount" value=1 <?php echo($opt_TagListCount==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Display number of products','next-wc-product-toolbox'); ?>
        </td></tr>    
    </table>
    <?php submit_button(esc_html__('Save','next-wc-product-toolbox')); ?>
    </form>
                  <?php break;
                  
                  
                  
             case 'subcats':?>
                   <h1 class="screen-reader-text">Toolbox</h1>
		               <ul class="subsubsub"><li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=metas" class=""><?php esc_html_e('Metas','next-wc-product-toolbox'); ?></a> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=tags" class=""><?php esc_html_e('Tags','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=subcats" class="current"><?php esc_html_e('Categories','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=product" class=""><?php esc_html_e('Products','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=cart" class=""><?php esc_html_e('Cart','next-wc-product-toolbox'); ?></a> </li>
  	               </ul><br class="clear">             
    <form method="post" action="options.php">
    <?php settings_fields('wcptb-subcats-group'); ?>
    <?php do_settings_sections('wcptb-subcats-group'); ?>
    
    <h2 class="title"><?php esc_html_e('Sub categories scrolling list','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Improve your navigation by adding a sub-categories scrolling lists of your product categories.','next-wc-product-toolbox'); ?></em></font><br>
    <font color="#808080"><em><?php esc_html_e('1. Insert: [cats_list cat=(catId) title=(your category title) sort=(alpha/count)] as a usual shortcode into a text widget as well as post or page content.','next-wc-product-toolbox'); ?></em></font><br>
    <font color="#808080"><em><?php esc_html_e('2. In templates, pages or functions shortcode: echo do_shortcode(\'[cats_list cat=(catId) title=(your category title) sort=(alpha/count)]\');','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Empty sub-categories','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optCatListHideEmpty" value=1 <?php echo($opt_CatListHideEmpty==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Hide sub-categories with NO product','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Order','next-wc-product-toolbox'); ?></th>
        <td><input type="radio" name="optCatListOrder" value="ASC" <?php echo($opt_CatListOrder=="ASC"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Ascending','next-wc-product-toolbox'); ?><br>
            <input type="radio" name="optCatListOrder" value="DESC" <?php echo($opt_CatListOrder=="DESC"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Descending','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Count','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optCatListCount" value=1 <?php echo($opt_CatListCount==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Display number of products per sub-category','next-wc-product-toolbox'); ?>
        </td></tr>    
    </table>
    <?php submit_button(esc_html__('Save','next-wc-product-toolbox')); ?>
    </form>
                  <?php break;
                  
      
             case 'product':?>
                   <h1 class="screen-reader-text">Toolbox</h1>
		               <ul class="subsubsub"><li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=metas" class=""><?php esc_html_e('Metas','next-wc-product-toolbox'); ?></a> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=tags" class=""><?php esc_html_e('Tags','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=subcats" class=""><?php esc_html_e('Categories','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=product" class="current"><?php esc_html_e('Products','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=cart" class=""><?php esc_html_e('Cart','next-wc-product-toolbox'); ?></a> </li>
		               </ul><br class="clear">
    <form method="post" action="options.php">
    <?php settings_fields('wcptb-product-group'); ?>
    <?php do_settings_sections('wcptb-product-group'); ?>
    <h2 class="title"><?php esc_html_e('Product layout','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Improve your layout by configuring product tabs (See also SEO tab).','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Hide tabs','next-wc-product-toolbox'); ?></th>
        <td><input type="checkbox" name="optHideTab_AddInfo" value=1 <?php echo($opt_HideTab_AddInfo==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Hide Additional Information tab','next-wc-product-toolbox'); ?><br>
            <input type="checkbox" name="optHideTab_Review" value=1 <?php echo($opt_HideTab_Review==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Hide Reviews tab','next-wc-product-toolbox'); ?>
        </td></tr>

        <tr valign="top">
        <th scope="row"><?php esc_html_e('Related products','next-wc-product-toolbox'); ?></th>
        <td><input type="text" name="optRelatedProducts" value="<?php echo esc_attr($opt_RelatedProducts) ?>" size="30" class="xxx" /> <em><font color="#808080"><?php esc_html_e('(Left empty if not used)','next-wc-product-toolbox'); ?></font></em>
        <br><font color="#808080"><em><?php esc_html_e('Replace \'Related products\' text with your own text.','next-wc-product-toolbox'); ?></em></font>
        </td></tr>
    </table>   
    <?php submit_button(esc_html__('Save','next-wc-product-toolbox')); ?>
    </form>

                   <?php break;
                   
                         
      
                  
                  
             case 'cart':?>
                   <h1 class="screen-reader-text">Toolbox</h1>
		               <ul class="subsubsub"><li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=metas" class=""><?php esc_html_e('Metas','next-wc-product-toolbox'); ?></a> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=tags" class=""><?php esc_html_e('Tags','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=subcats" class=""><?php esc_html_e('Categories','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=product" class=""><?php esc_html_e('Products','next-wc-product-toolbox'); ?></a> </li> | </li>
		                                     <li><a href="/wp-admin/admin.php?page=wcptb-acp&amp;tab=wcptb_box&amp;section=cart" class="current"><?php esc_html_e('Cart','next-wc-product-toolbox'); ?></a> </li>
		               </ul><br class="clear">             
    <form method="post" action="options.php">
    <?php settings_fields('wcptb-cart-group'); ?>
    <?php do_settings_sections('wcptb-cart-group'); ?>
    <h2 class="title"><?php esc_html_e('Add to cart button','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Configure "Add to cart" options','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Shop page','next-wc-product-toolbox'); ?></th>
        <td><input type="text" name="optAddCartTextShop" value="<?php echo esc_attr($opt_AddCartTextShop) ?>" class="xxx" /> <?php esc_html_e('Change "Add to cart" text button','next-wc-product-toolbox'); ?>
            <br><input type="text" name="optNewAddCart" value="<?php echo esc_attr($opt_NewAddCart) ?>" class="xxx" /> <?php esc_html_e('Add a bigger "Buy" button','next-wc-product-toolbox'); ?>
        </td></tr>
 
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Product page','next-wc-product-toolbox'); ?></th>
        <td><input type="text" name="optAddCartTextProduct" value="<?php echo esc_attr($opt_AddCartTextProduct) ?>" class="xxx" /> <?php esc_html_e('Change "Add to cart" text button','next-wc-product-toolbox'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Sold out!','next-wc-product-toolbox'); ?></th>
        <td><input type="text" name="optSoldOut" value="<?php echo esc_attr($opt_SoldOut) ?>" class="xxx" /> <em><font color="#808080"><?php esc_html_e('(Left empty if not used)','next-wc-product-toolbox'); ?></font></em>
        <br><font color="#808080"><em><?php esc_html_e('Replace \'Sold out!\' text when out of stock with your own text.','next-wc-product-toolbox'); ?></em></font>
        </td></tr>
    </table>  
    
    <?php $tmpCur = get_woocommerce_currency_symbol(); ?>
    <h2 class="title"><?php esc_html_e('Free shipping','next-wc-product-toolbox'); ?></h2>
    <font color="#808080"><em><?php esc_html_e('Display remaining amount to free shipping','next-wc-product-toolbox'); ?></em></font>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Free shipping amount','next-wc-product-toolbox'); ?></th>
        <td><input type="number" min="0" name="optFreeShippingAmount" value="<?php echo esc_attr($opt_FreeShippingAmount) ?>" class="xxx" /> <?php echo esc_attr($tmpCur); ?>  <em><font color="#808080"><?php esc_html_e('(Left empty if not used)','next-wc-product-toolbox'); ?></font></em>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Free shipping text button','next-wc-product-toolbox'); ?></th>
        <td><input type="text" name="optFreeShippingButton" value="<?php echo esc_attr($opt_FreeShippingButton) ?>" class="xxx" />
        </td></tr>
    </table>    
    <?php submit_button(esc_html__('Save','next-wc-product-toolbox')); ?>
    </form>

                  <?php break;

             default:?>
             <?php break;
           } ?>


    <?php break;
      default:
    } ?>
    </div>
  </div>
  