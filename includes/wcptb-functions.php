<?php
if (!defined('WCPTB_KEY_DONATE'))
   { define('WCPTB_KEY_DONATE','2WY8NGAJH6FKG');
   }
if (!defined('WCPTB_PLUGIN_NAME'))
   { define('WCPTB_PLUGIN_NAME','Next Toolbox');
   }
if (!defined('WCPTB_PLUGIN_SLUG'))
   { define('WCPTB_PLUGIN_SLUG','next-wc-product-toolbox');
   }
if (!defined('WCPTB_VERSION'))
   { define('WCPTB_VERSION','1.3.1');
   }
if (!defined('WCPTB_TYPE'))
   { define('WCPTB_TYPE','Free');
   }
if (!defined('WCPTB_PLUGIN_PAGE'))
   { define('WCPTB_PLUGIN_PAGE','wcptb-acp');
   }
   
add_action('admin_enqueue_scripts', 'wcptb_Styles');
function wcptb_Styles()
{ $tmpStr = plugins_url('/',__FILE__);
  if (substr($tmpStr,-1) == "/")
     $tmpPos = strrpos($tmpStr,'/',-2);
  else   
     $tmpPos = strrpos($tmpStr,'/',-1);
  $tmpStr = substr($tmpStr,0,$tmpPos);
  $tmpPathCSS = $tmpStr . '/css/style.css';
  wp_enqueue_style('wcptb_Styles', $tmpPathCSS);
}

add_action('plugins_loaded', 'wcptb_checkVersion');
function wcptb_CheckVersion()
{ $tmpCurVersion = get_option('wcptbCurrentVersion');
  $tmpCurType = get_option('wcptbCurrentType');
  if((version_compare($tmpCurVersion, WCPTB_VERSION, '<')) or (WCPTB_TYPE !== $tmpCurType))
    { wcptb_PluginActivation();
    }
}

function wcptb_PluginActivation()
{ update_option('wcptbCurrentVersion', WCPTB_VERSION);
  update_option('wcptbCurrentType', WCPTB_TYPE);
  return WCPTB_VERSION;
}
register_activation_hook(__FILE__, 'wcptb_PluginActivation');

add_action('admin_menu','wcptb_Add_Menu');
function wcptb_Add_Menu()
{ add_menu_page(
      'WC Product Toolbox',
      WCPTB_PLUGIN_NAME,
      'manage_options',
      
      'wcptb-acp',
      'wcptb_acp_callback',
      plugins_url(WCPTB_PLUGIN_SLUG . '/images/icon.png')
  );
   
  
  add_submenu_page('wcptb-acp', __('Toolbox','next-wc-product-toolbox'), __('Toolbox','next-wc-product-toolbox'), 'manage_options', 'wcptb-acp&tab=wcptb_box', 'render_generic_settings_page');
  add_submenu_page('wcptb-acp', __('SEO','next-wc-product-toolbox'), __('SEO','next-wc-product-toolbox'), 'manage_options', 'wcptb-acp&tab=wcptb_seo', 'render_generic_settings_page');
  add_submenu_page('wcptb-acp', __('Misc','next-wc-product-toolbox'), __('Misc','next-wc-product-toolbox'), 'manage_options', 'wcptb-acp&tab=wcptb_misc', 'render_generic_settings_page');
  
	add_action('admin_init','register_wcptb_settings');  
}

add_action('init','wcptb_load_textdomain');
function wcptb_load_textdomain()
{ load_plugin_textdomain('next-wc-product-toolbox',false,WCPTB_PLUGIN_SLUG . '/languages/'); 
}

function register_wcptb_settings()
{ register_setting('wcptb-settings-group','wcptbCurrentVersion');
  register_setting('wcptb-settings-group','wcptbCurrentType');

  register_setting('wcptb-tags-group','optTagListTitle');
  register_setting('wcptb-tags-group','optTagListSort');
  register_setting('wcptb-tags-group','optTagListHideEmpty');
  register_setting('wcptb-tags-group','optTagListOrder');
  register_setting('wcptb-tags-group','optTagListCount');
 
  register_setting('wcptb-subcats-group','optCatListHideEmpty');
  register_setting('wcptb-subcats-group','optCatListOrder');
  register_setting('wcptb-subcats-group','optCatListCount');
  
  register_setting('wcptb-metas-group','optMetasHide');
  register_setting('wcptb-metas-group','optHideSKU');
  
  register_setting('wcptb-product-group','optHideTab_AddInfo');
  register_setting('wcptb-product-group','optHideTab_Review');
  register_setting('wcptb-product-group','optRelatedProducts');
  
  register_setting('wcptb-cart-group','optAddCartTextShop');
  register_setting('wcptb-cart-group','optAddCartTextProduct');
  register_setting('wcptb-cart-group','optNewAddCart');
  register_setting('wcptb-cart-group','optSoldOut');  
  register_setting('wcptb-cart-group','optFreeShippingAmount');
  register_setting('wcptb-cart-group','optFreeShippingButton'); 
    
  register_setting('wcptb-seo-group','optDescTitle');  
  register_setting('wcptb-seo-group','optDescShort');
  register_setting('wcptb-seo-group','optMetasShowCat');
  register_setting('wcptb-seo-group','optMetasShowTag');  
  register_setting('wcptb-seo-group','optMetasDescTabVal');
  register_setting('wcptb-seo-group','optMetasDescTitle');  
            
  register_setting('wcptb-seo-group','optTagHideEmpty');
  register_setting('wcptb-seo-group','optTagOrder');
  register_setting('wcptb-seo-group','optTagCount');
  register_setting('wcptb-seo-group','optSubcatHideEmpty');
  register_setting('wcptb-seo-group','optSubcatOrder');
  register_setting('wcptb-seo-group','optSubcatCount');
  
  register_setting('wcptb-misc-group','optDisableCopy');
}

function wcptb_acp_callback()
{ global $title;

  if (!current_user_can('administrator'))
     { wp_die(__('You do not have sufficient permissions to access this page.','next-wc-product-toolbox'));
	   }
	
  print '<div class="wrap">';
  print "<h1 class=\"stabilo\">$title</h1><hr>";

  $file = plugin_dir_path( __FILE__ ) . "wcptb-acp-page.php";
  if (file_exists($file))
      require $file;

  echo "<p><em><b>" . esc_html__('Add for free ','next-wc-product-toolbox') . " <a target=\"_blank\" href=\"https://nxt-web.com/wordpress-plugins/\" style=\"color:#FE5500;font-weight:bold;font-size:1.2em\">" . esc_html__('Next Product Labels & Badges for WooCommerce','next-wc-product-toolbox') .  "</a> " . esc_html__(' to automatically configure labels and badges on your WC image products!','next-wc-product-toolbox') . "</b></em></p>";
  echo "<p><em><b>" . esc_html__('You like this plugin?','next-wc-product-toolbox') . " <a target=\"_blank\" href=\"https://www.paypal.com/donate/?hosted_button_id=" . WCPTB_KEY_DONATE . "\" style=\"color:#FE5500;font-weight:bold;font-size:1.2em\">" . esc_html__('Offer me a coffee!','next-wc-product-toolbox') . "</a></b></em>";
  $CoffeePath = plugin_dir_url( dirname( __FILE__ ) )  . '/images/coffee-donate.gif';
  echo '&nbsp;<img src="' . $CoffeePath . '"></p>';
  print '</div>';
}

$opt_RelatedProducts = get_option('optRelatedProducts');
function wcptb_Change_RelatedProducts_text($translated_text, $text, $domain)
{ if ($text === 'Related products' && $domain === 'woocommerce')
     { $opt_RelatedProducts = get_option('optRelatedProducts');
       $translated_text = esc_attr($opt_RelatedProducts);
     }
  return $translated_text;
}
if ($opt_RelatedProducts!= "") 
   { add_filter('gettext', 'wcptb_Change_RelatedProducts_text', 10, 3);
     add_filter('ngettext', 'wcptb_Change_RelatedProducts_text', 10, 3);
   }

add_action("wp_footer", "wcptb_copy_protect");
function wcptb_copy_protect()
{ $opt_DisableCopy = get_option('optDisableCopy');
  if (!$opt_DisableCopy) return;

  ?><script type="text/javascript">
    jQuery(document).ready(function () {
        //Disable cut copy paste
        jQuery('body').bind('cut copy paste', function (e) {
            e.preventDefault();
        });
        //Disable mouse right click
        jQuery("body").on("contextmenu",function(e){
            return false;
        });
    });
    </script>
    <?php
}
   
function wcptb_AddHeaderDesc()
{ global $post; 
 
  $opt_DescTitle = get_option('optDescTitle');
  $opt_DescShort = get_option('optDescShort');
  if (is_product() and (($opt_DescTitle == 1)or($opt_DescShort == 1)))
     { echo "<!SEO powered by Next Product Toolbox for WC plugin:>\n";
       $tmpShortDesc = $post->post_excerpt;

       echo "<meta name=\"description\" content=\"";
       if ($opt_DescTitle == 1) echo get_the_title();
       if (($tmpShortDesc != "") and ($opt_DescShort==1) and ($opt_DescTitle == 1)) echo ", ";
       if (($tmpShortDesc != "") and ($opt_DescShort==1))
          echo $post->post_excerpt . "\" />\n";
       else
          echo "\" />\n";
          
       echo "<meta property=\"og:description\" content=\"";
       if ($opt_DescTitle == 1) echo get_the_title();
       if (($tmpShortDesc != "") and ($opt_DescShort==1) and ($opt_DescTitle == 1)) echo ", ";
       if (($tmpShortDesc != "") and ($opt_DescShort==1))
          echo esc_attr($post->post_excerpt) . "\" />\n";
       else
          echo "\" />\n";     }
}
add_action('wp_head', 'wcptb_AddHeaderDesc');

function wcptb_subcats_cloud($atts)
{ $opt_SubcatHideEmpty = get_option('optSubcatHideEmpty');
  $opt_SubcatOrder = get_option('optSubcatOrder');
  $opt_SubcatCount = get_option('optSubcatCount');

  $atts = shortcode_atts(
        array(
          'sort' => 'alpha',
          'title' => 'Sub-categories',
          'cat' => '...',
          'orderby' => 'count',
          'order' => $opt_SubcatOrder,
          'number' => 10,
          'hide_empty' => 1, ($opt_SubcatHideEmpty==1),
          'count' =>  ($opt_SubcatCount==1)
        ), $atts, 'subcats_cloud' );

  $tmpSort = esc_html($atts['sort']);
  $tmpTitle = esc_html($atts['title']);
  $tmpCat = esc_html($atts['cat']);
  
  if ($tmpCat == "...")
     { $currentCat = get_queried_object();
       $currentCatID = $currentCat->term_id;
     }
  else
     $currentCatID = $tmpCat;

  $categories = get_term_children($currentCatID,'product_cat');
  if ($categories && !is_wp_error($category))
     { $NbSubcats = 0;
       $minCount=9999; $maxCount=0;
       foreach($categories as $category)
              { $term = get_term($category,'product_cat');
                if ($opt_SubcatHideEmpty == 1)
                   { if ($term->count != 0)
                        $A_Subcat[] = array('Name'=>$term->name,'Count'=>$term->count,'Link'=>get_term_link($term));
                   }
                else
                  $A_Subcat[] = array('Name'=>$term->name,'Count'=>$term->count,'Link'=>get_term_link($term));
                
                if ($term->count > $maxCount) $maxCount = $term->count; 
                if ($term->count < $minCount) $minCount = $term->count;
                $NbSubcats++;
              } 
     }
  
  $columns_1 = array_column($A_Subcat, 'Count');
  $columns_2 = array_column($A_Subcat, 'Name');
  if ($opt_SubcatOrder == "ASC")
     array_multisort($columns_1, SORT_DESC, $columns_2, SORT_ASC, $A_Subcat);
  else
     array_multisort($columns_1, SORT_DESC, $columns_2, SORT_DESC, $A_Subcat);
  
  $minSize = 10;
  $maxSize = 22;
  $NbInt = $maxCount - $minCount;
  $string = "<p>";
  for ($i=0; $i < $NbSubcats;$i++)
      { $tmpFntSize = (($A_Subcat[$i]['Count'] - 1)/$NbInt) * ($maxSize - $minSize) + $minSize + 2;
                
        if ($opt_SubcatCount == 1)
           { $string .= "<a class=\"tag-cloud-link tag-link-0\" style=\"font-size:" . $tmpFntSize . "px;\" href=\"" . $A_Subcat[$i]['Link'] . "\">". $A_Subcat[$i]['Name'] . "</a><span class=\"_tagcount\" style=\"font-size:" . $tmpFntSize . "px; color:#C0C0C0;\">[" . $A_Subcat[$i]['Count'] . "]</span>\n";
           }
        else
           { $string .= "<a class=\"tag-cloud-link tag-link-0\" style=\"font-size:" . $tmpFntSize . "px;\" href=\"" . $A_Subcat[$i]['Link'] . "\">". $A_Subcat[$i]['Name'] . "</a>\n";
           }
      }

  return $string;
} 
add_shortcode('subcats_cloud','wcptb_subcats_cloud');

function wcptb_tags_cloud()
{ $opt_TagHideEmpty = get_option('optTagHideEmpty');
  $opt_TagOrder = get_option('optTagOrder');
  $opt_TagCount = get_option('optTagCount');

  $tag_args = array(
    'taxonomy'               => 'product_tag',
    'orderby' => 'count',
    'order' => $opt_TagOrder,
    'number' => 10,
    'hide_empty' => ($opt_TagHideEmpty==1),
    'count' =>  ($opt_TagCount==1),
    );
  $tag_query = new WP_Term_Query($tag_args);
  if (!empty( $tag_query->terms))
     { $count = $tag_query->get_terms();
       $NbTags = count($count);
       $minSize = 10;
       $maxSize = 22;
       $i=0;
       foreach($tag_query->terms as $term)
              { $i++;
                if ($i==1) $maxCount = $term->count; 
                if ($i==$NbTags) $minCount = $term->count;
              }
       $NbInt = $maxCount - $minCount;
       $string = "";
       
       foreach($tag_query->terms as $term)
              { $tmpFntSize = (($term->count - 1)/$NbInt) * ($maxSize - $minSize) + $minSize + 2;
                
                if ($opt_TagCount==1)
                   { $string .= "<a class=\"tag-cloud-link tag-link-0\" style=\"font-size:" . $tmpFntSize . "px;\" href=\"" . get_tag_link($term->term_id) . "\">". $term->name . "</a><span class=\"_tagcount\" style=\"font-size:" . $tmpFntSize . "px; color:#C0C0C0;\">[" . $term->count . "]</span>\n";
                   }
                else
                   { $string .= "<a class=\"tag-cloud-link tag-link-0\" style=\"font-size:" . $tmpFntSize . "px;\" href=\"" . get_tag_link($term->term_id) . "\">". $term->name . "</a>\n";
                   }
              }
       return $string;
     }
}    
add_shortcode('tags_cloud','wcptb_tags_cloud');

function wcptb_show_subcat($atts)
{ $atts = shortcode_atts(
        array(
          'sort' => 'alpha',
          'title' => 'Sub-categories',
          'cat' => 'cat',
        ), $atts, 'show_subcat' );

  $tmpSort = esc_html($atts['sort']);
  $tmpTitle = esc_html($atts['title']);
  $tmpCat = esc_html($atts['cat']);

  $opt_CatListHideEmpty = get_option('optCatListHideEmpty');
  $opt_CatListOrder = get_option('optCatListOrder');
  $opt_CatListCount = get_option('optCatListCount');

  $currentCatID = $tmpCat;
  $categories = get_term_children($currentCatID,'product_cat');
  if ($categories && !is_wp_error($category))  
     { foreach($categories as $category)
              { $term = get_term( $category, 'product_cat' );
                if ($opt_CatListHideEmpty == 1)
                   { if ($term->count != 0)
                        $A_Subcat[] = array('Name'=>$term->name,'Slug'=>$term->slug,'Count'=>$term->count,'Link'=>get_term_link($term));
                   }
                else
                   $A_Subcat[] = array('Name'=>$term->name,'Slug'=>$term->slug,'Count'=>$term->count,'Link'=>get_term_link($term));
              }
            
       if ($tmpSort == "count")
          { $columns_1 = array_column($A_Subcat, 'Count');
            $columns_2 = array_column($A_Subcat, 'Name');
            array_multisort($columns_1, SORT_DESC, $columns_2, SORT_ASC, $A_Subcat);
          }
       else   
          { $columns_1 = array_column($A_Subcat, 'Name');
            if ($opt_CatListOrder == "ASC")
               array_multisort($columns_1, SORT_ASC, $A_Subcat);
            else
               array_multisort($columns_1, SORT_DESC, $A_Subcat);
          }  
     
       global $wp;
       $current_slug = add_query_arg( array(), $wp->request );
       $lastPos = strrpos($current_slug,'/');
       $current_slug = substr($current_slug,$lastPos+1);
    
       echo "<h3 class=\"widgettitle\">" . esc_attr($tmpTitle) . "</h3>";
       echo "<select class='AllLabs' id='AllLabs' name='AllLabs'>";
       echo "<option value=\"\">:: " . esc_attr($tmpTitle) . "</option>";
       $NbLabs = count($A_Subcat);
       for ($i=0; $i < $NbLabs;$i++)
           { if ($A_Subcat[$i]['Slug'] == $current_slug)
                $tmpSelected = 'selected ';
             else   
                $tmpSelected = '';
             echo "<option " . esc_attr($tmpSelected) . "class=\"level-0\" value=\"" . esc_attr($A_Subcat[$i]['Link']) . "\">" . esc_attr($A_Subcat[$i]['Name']);
             if ($opt_CatListCount == 1) echo " (" . esc_attr($A_Subcat[$i]['Count']) . ")";
             echo "</option>";
           }
       echo "</select><br>";
     }
?>
  <script type='text/javascript'>
        jQuery(function($){
            var select = '.AllLabs';

            function onProductLabChange()
                     { if ($(select).val() !== '')
                          { location.href = $(select).val();
                          }
                     }
            $(select).change(onProductLabChange);
            });
  </script>
<?php
}
add_shortcode('cats_list','wcptb_show_subcat');

function wcptb_single_product_summary()
{ $opt_MetasHide = get_option('optMetasHide');

  if ($opt_MetasHide == 1)
     remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40 );
}
add_action('woocommerce_single_product_summary','wcptb_single_product_summary',2);
  
function wcptb_remove_sku($enabled)
{ $opt_HideSKU = get_option('optHideSKU');

  if (!is_admin() && is_product())
     { if ($opt_HideSKU == 1)
          return false;
       else
          return $enabled;
     }
  return $enabled;
}
add_filter('wc_product_sku_enabled','wcptb_remove_sku');

function wcptb_display_single_product_tags_after_summary()
{ $opt_MetasShowCat = get_option('optMetasShowCat');
  $opt_MetasShowTag = get_option('optMetasShowTag');

  global $products;
  $product_id = $product->id;
  
  if(($opt_MetasShowTag ==1) or ($opt_MetasShowCat ==1))
    echo '<br><br>';
    
  if($opt_MetasShowTag ==1)  
    { $product_tags = get_the_term_list($product_id,'product_cat','',',','');
      $i=0;
      $A_Tag = explode(",", $product_tags);
      while ($A_Tag[$i] != "")
            { echo "<span class=\"tagbox\">" . esc_attr($A_Tag[$i]) . " </span>";
              $i++;
            }
    }
    
  if($opt_MetasShowCat ==1)  
    { $product_tags = get_the_term_list($product_id,'product_tag','',',','');
      $i=0;
      $A_Tag = explode(",", $product_tags);
      while ($A_Tag[$i] != "")
            { echo "<span class=\"tagbox\">" . esc_attr($A_Tag[$i]) . " </span>";
              $i++;
            }
    }        
};
add_action('woocommerce_single_product_summary','wcptb_display_single_product_tags_after_summary',100,0);

function wcptb_change_addtocart_shop()
{ global $product;
  
  $opt_AddCartTextShop = get_option('optAddCartTextShop');
  if ($opt_AddCartTextShop != "")
     { $link = $product->get_permalink();
       echo '<a href="' . esc_attr($link) . '" class="button wcptb_change_addtocart_shop">' . esc_attr($opt_AddCartTextShop) . '</a>';
     }
}
$opt_AddCartTextShop = get_option('optAddCartTextShop');
if ($opt_AddCartTextShop != "")
   add_filter('woocommerce_product_add_to_cart_text','wcptb_change_addtocart_shop');
else
   remove_filter('woocommerce_product_add_to_cart_text','wcptb_change_addtocart_shop');
   
function wcptb_change_addtocart_product()
{ $opt_AddCartTextProduct = get_option('optAddCartTextProduct');
  if ($opt_AddCartTextProduct != "")
     { return esc_attr($opt_AddCartTextProduct);
     }
}
$opt_AddCartTextProduct = get_option('optAddCartTextProduct');
if ($opt_AddCartTextProduct != "")
   add_filter('woocommerce_product_single_add_to_cart_text','wcptb_change_addtocart_product');
else
   remove_filter('woocommerce_product_single_add_to_cart_text','wcptb_change_addtocart_product');

function wcptb_GetTotalStock($product)
{ $total = 0;

  if ($product->is_type('variable')) 
     { if ($product->managing_stock())
          $total = $product->get_stock_quantity();
       else 
          { $total = "NotManaged";
            foreach ($product->get_children() as $child_id)
                    { $variation = wc_get_product($child_id);
                      if ($variation->managing_stock())  $total += $variation->get_stock_quantity();
                    }
           }
     }
  else
     { if ($product->managing_stock())
          $total = $product->get_stock_quantity();
       else
          $total = "NotManaged";
     }
  return $total;
}

function wcptb_new_addtocart_shop()
{ global $product;
  
  $opt_NewAddCart = get_option('optNewAddCart');
  if ($opt_NewAddCart != "")
     { $stock_quantity = wcptb_GetTotalStock($product);    
       if (($stock_quantity != "NotManaged") and ($stock_quantity > 0))
          { $link = $product->get_permalink();
            echo '<a href="' . esc_attr($link) . '" class="button wcptb_change_addtocart_shop">' . esc_attr($opt_NewAddCart) . ' (' . $stock_quantity . ')</a>';
          }
     }
}
add_action('woocommerce_after_shop_loop_item','wcptb_new_addtocart_shop',10);
   
function wcptb_product_tags_list($atts = array())
{ $opt_TagListHideEmpty = get_option('optTagListHideEmpty');
  $opt_TagListOrder = get_option('optTagListOrder'); if ($opt_TagListOrder == "") $opt_TagListOrder = "ASC";
  $opt_TagListCount = get_option('optTagListCount');
  $opt_TagListSort = get_option('optTagListSort');
  $opt_TagListTitle = get_option('optTagListTitle');

  extract(shortcode_atts(array(
          'sort' => esc_attr($opt_TagListSort),
          'title' => esc_attr($opt_TagListTitle)
         ), $atts));
         
  $tag_args = array(
    'taxonomy'               => 'product_tag',
    'orderby'                => 'name',
    'order'                  => $opt_TagListOrder,
    'hide_empty'             => ($opt_TagListHideEmpty==1),
    'count' => ($opt_TagListCount==1),
    );
  $tag_query = new WP_Term_Query($tag_args);
  
  if (!empty( $tag_query->terms))
     { foreach($tag_query->terms as $term)
              { $A_tags[] = array('Name'=>$term->name,'Slug'=>$term->slug,'Count'=>$term->count,'Link'=>get_term_link($term));
              }
       if ($sort == "count")
          { $columns_1 = array_column($A_tags, 'Count');
            $columns_2 = array_column($A_tags, 'Name');
            if ($opt_TagListOrder == "ASC")
               array_multisort($columns_1, SORT_ASC, $columns_2, SORT_ASC, $A_tags);
            else
               array_multisort($columns_1, SORT_DESC, $columns_2, SORT_ASC, $A_tags);
          }
       else   
          { $columns_1 = array_column($A_tags, 'Name');
            if ($opt_TagListOrder == "ASC")
               array_multisort($columns_1, SORT_ASC, $A_tags);
            else
               array_multisort($columns_1, SORT_DESC, $A_tags);
          }
     
       $NbTags = count($A_tags);
       global $wp;
       $current_slug = add_query_arg( array(), $wp->request );
       $lastPos = strrpos($current_slug,'/');
       $current_slug = substr($current_slug,$lastPos+1);
       
       echo "<h3 class=\"widgettitle\">" . esc_attr($title) . "</h3>";
       echo "<select class='AllTags' id='AllTags' name='AllTags'>";
       echo "<option value=\"\">:: " . esc_attr($opt_TagListTitle) . "</option>";
       for ($i=0; $i < $NbTags;$i++)
           { if ($A_tags[$i]['Slug'] == $current_slug)
                $tmpSelected = 'selected ';
             else   
                $tmpSelected = '';
                echo "<option " . esc_attr($tmpSelected) . "class=\"level-0\" value=\"" . esc_attr($A_tags[$i]['Link']) . "\">" . esc_attr($A_tags[$i]['Name']);
                if ($opt_TagListCount == 1)
                   echo " (" . esc_attr($A_tags[$i]['Count']) . ")</option>";
                else
                   echo "</option>";
           }
       echo "</select><br>";
     }
     
?>
  <script type='text/javascript'>
        jQuery(function($){
            var select = '.AllTags';

            function onProductTagChange()
                     { if ($(select).val() !== '')
                          { location.href = $(select).val();
                          }
                     }
            $(select).change(onProductTagChange);
            });
  </script>
<?php
}
add_shortcode('tags_list','wcptb_product_tags_list');

function wcptb_change_get_availability_text($opt_SoldOut,$product)
{ $opt_SoldOut = get_option('optSoldOut');
  $stock_quantity = wcptb_GetTotalStock($product);  
    
  if ($stock_quantity !== "NotManaged")
     { if ($stock_quantity <= 0)
          { if ($opt_SoldOut == "")
               return __('Out of stock','woocommerce'); 
            else
               return $opt_SoldOut;
          }
       else
          { return __('In stock','woocommerce');
          }
     }
}
add_filter('woocommerce_get_availability_text','wcptb_change_get_availability_text',999,2);

function wcptb_hide_sale()
{ return false;
}
add_filter('woocommerce_sale_flash', 'wcptb_hide_sale');

$opt_HideTab_AddInfo = get_option('optHideTab_AddInfo');
function wcptb_woo_remove_product_tab_AddInfo($tabs)
{	unset($tabs['additional_information']);
	return $tabs;
}
if ($opt_HideTab_AddInfo) add_filter('woocommerce_product_tabs','wcptb_woo_remove_product_tab_AddInfo',98);

$opt_HideTab_Review = get_option('optHideTab_Review');
function wcptb_woo_remove_product_tabs_Review($tabs)
{	unset($tabs['reviews']);
	return $tabs;
}
if ($opt_HideTab_Review) add_filter('woocommerce_product_tabs','wcptb_woo_remove_product_tabs_Review',98);

$opt_MetasDescTitle = get_option('optMetasDescTitle'); 
function wcptb_description_heading( $heading )
{ global $product;
  
  return '' . $product->get_name() . '';
}
if ($opt_MetasDescTitle) add_filter('woocommerce_product_description_heading','wcptb_description_heading');

$opt_MetasDescTabVal = get_option('optMetasDescTabVal');
function wcptb_rename_description_tab($title)
{	$opt_MetasDescTabVal = get_option('optMetasDescTabVal');
  
  $title = esc_html__($opt_MetasDescTabVal);
	return $title;
}
if ($opt_MetasDescTabVal <> "") add_filter('woocommerce_product_description_tab_title','wcptb_rename_description_tab');

$opt_FreeShippingAmount = get_option('optFreeShippingAmount');
function wcptb_free_shipping_cart_notice()
{ $min_amount = get_option('optFreeShippingAmount');

  $current = WC()->cart->subtotal;
  if ($current < $min_amount)
     { $tmpRemain = wc_price($min_amount - $current);
       $added_text = "<b>" . sprintf(esc_html__('Get free shipping if you order %s more!','next-wc-product-toolbox'),$tmpRemain) . "</b>";
       
       $return_to = wc_get_page_permalink('shop');
       $opt_FreeShippingButton = get_option('optFreeShippingButton');
       $notice = sprintf('<a href="%s" class="button wc-forward">%s</a> %s', esc_url($return_to),esc_attr($opt_FreeShippingButton),$added_text);
       wc_print_notice($notice, 'notice');
     }
}
if ($opt_FreeShippingAmount <> "") add_action('woocommerce_before_cart','wcptb_free_shipping_cart_notice');
?>
