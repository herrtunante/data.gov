<?php
$category = get_the_category();
if ($category[0]->cat_name != 'Uncategorized') {

    $slug = $wp_query->query_vars['category_name'];
}
?>
<footer class="content-info" role="contentinfo">

<div class="container">


  <div class="row">
  
    <!--
    <div class="col-lg-4">
      <?php dynamic_sidebar('sidebar-footer'); ?>
      <p>&copy; <?php echo date('Y') . ' '; bloginfo('name'); ?></p>
    </div>
    -->
    
    
    <div class="col-md-4 col-lg-4">
    
        <form role="search" method="get" style="display: block;" class="search-form form-inline" action="//catalog.data.gov/dataset">
          <div class="input-group">
            <label class="sr-only" for="search-footer"><?php _e('Search for:', 'roots'); ?></label>
            <input type="search" id="search-footer" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="q" class="search-field form-control" placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
              <span class="input-group-btn">
                <button type="submit" class="search-submit btn btn-default">
                     <i class="fa fa-search"></i>
                     <span class="sr-only"><?php _e('Search', 'roots'); ?></span>
                 </button>
            </span>
          </div>
        </form>    
    
        <div class="footer-logo">
            <a class="logo-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>        
        </div>
        
    </div>
    
    <?php if (has_nav_menu('primary_navigation')) : ?>
        <nav class="col-md-2 col-lg-2" role="navigation">        
            <?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav')); ?>
        </nav>    
    <?php endif; ?>    
    
    <?php if (has_nav_menu('footer_navigation')) :
      //add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
      ?>
        <nav class="col-md-2 col-lg-2" role="navigation">        
            <?php
                wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'nav'));
             ?>
        </nav>    
    <?php endif; ?>    
    

    <div class="col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 social-nav">

        <?php



            $menu_name = 'social_navigation';
            
            if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {

	            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );                
	            $menu_items = wp_get_nav_menu_items($menu->term_id);            
	            $menu_list = '<ul id="menu-' . $menu_name . '" class="nav">';
                
	            foreach ( (array) $menu_items as $key => $menu_item ) {
	                $title = $menu_item->title;
	                $url = $menu_item->url;
	                
	                switch (strtolower($title)) {
                        case 'twitter':
                            $class = 'fa fa-twitter';
                            break;
                        case 'github':
                            $class = 'fa fa-github';
                            break;
                        case 'stack exchange':
                            $class = 'fa fa-stack-exchange';
                            break;
                    }
	                
	                $menu_list .= '<li><a href="' . $url . '"><i class="' . $class . '"></i><span>' . $title . '</span></a></li>' . "\n";
	            }
	            
	            $menu_list .= '</ul>';
	            
            } else {
	            $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
            }

        ?>



        <?php if ($menu_list) : ?>
            <nav role="navigation">        
                <?php echo $menu_list; ?>
            </nav>    
        <?php endif; ?>

    </div>    
  </div>
</div>
</footer>
<!-- ----------------------------------------------------------------------------------- -->
<!-- Warning: The two script blocks below must remain inline. Moving them to an external -->
<!-- JavaScript include file can cause serious problems with cross-domain tracking.      -->
<!-- ----------------------------------------------------------------------------------- -->
<script type="text/javascript">
    //<![CDATA[
    var _tag=new WebTrends();
    _tag.dcsGetId();
    //]]>
</script>
<script type="text/javascript">
    //<![CDATA[
    _tag.dcsCustom=function(){
// Add custom parameters here.
//_tag.DCSext.param_name=param_value;
    }
    _tag.dcsCollect();
    //]]>
</script>
<noscript>
    <div><img alt="" id="DCSIMG" width="1" height="1" src="//statse.webtrendslive.com/dcscde6kv7bv0hc1auudkkpvh_6c5h/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=9.4.0&amp;dcssip=www.catalog.data.gov"/></div>
</noscript>
<!-- END OF SmartSource Data Collector TAG -->
<?php wp_footer(); ?>
