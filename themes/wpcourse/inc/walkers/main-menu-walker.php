<?php

class Wpc_Main_Menu_Walker extends Walker_Nav_Menu {

    private $tabs_labels = '';
    private $tabs_content = '';
    private $in_mega_menu = false;
    private $current_tab = 1;

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default class.
		$classes = array( 'dropdown-menu' );
		$class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $lebelledby = ($depth == 0) ? ' aria-lebelledby="dropdown_'.$this->dropdown_id.'"' : '';
        if ($this->in_mega_menu) {
            if ($depth == 1) {
                $is_active = $this->current_tab == 1 ? 'active' : '';
                $this->tabs_content .= '<div id="cat_'.$this->mega_id.'_'.$this->current_tab.'" class="tabcontent '.$is_active.'">';
                $this->tabs_content .= '<div class="row">';
            }
        } else {
            $output .= "{$n}{$indent}<ul$class_names $lebelledby>{$n}";
        }
		
    }
    
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent  = str_repeat( $t, $depth );
		if ($this->in_mega_menu) {
            if ($depth == 1) {
                $this->tabs_content .= '</div></div>';
            }
        } else {
            $output .= "$indent</ul>{$n}";
        }
    }
    
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        if ($item->mega_menu == '1') {
            $this->in_mega_menu = true;
            $classes[] = 'menu-large hidden-md-down hidden-sm-down hidden-xs-down';
            $this->mega_id = $item->ID;
        }
        $classes[] = 'menu-item-' . $item->ID;
        if ($depth == 0) {
            $classes[] = 'nav-item';
            if ($args->walker->has_children) {
                $classes[] = 'dropdown has-submenu';
            }
        }
        
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        if ($this->in_mega_menu && $depth > 0) {

        } else {
            $output .= $indent . '<li' . $id . $class_names . '>';
        }
		

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener';
		} else {
			$atts['rel'] = $item->xfn;
		}
		$atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';
        if (!isset($atts['class'])) {
            $atts['class'] = '';
        }
        if ($depth == 0) {
            $atts['class'] .= ' nav-link';
            if (!empty($item->color)) {
                $atts['class'] .= ' color-'.$item->color.'-hover';
            }
            if ($args->walker->has_children) {
                $atts['class'] .= ' dropdown-toggle';
                $atts['data-toggle'] = 'dropdown';
                $atts['aria-haspopup'] = 'true';
                $atts['aria-expanded'] = 'false';
                $atts['id'] = 'dropdown_' . $item->ID;
                $this->dropdown_id = $item->ID;
            }
        }
        if ($depth > 0) {
            $atts['class'] .= 'dropdown-item';
        }

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before;
        $item_output .= '<a' . $attributes . '>';
        if ($depth == 0) {
            if (!empty($item->icon)) {
                $item_output .= '<i class="fa '.$item->icon.'"></i> ';
            }
        }
        $item_output .= $args->link_before . $title . $args->link_after;
        if ($depth > 0 && $args->walker->has_children) {
            $item_output .= ' <span class="hidden-md-down hidden-sm-down hidden-xs-down"><i class="fa fa-angle-right"></i></span>';
        }
		$item_output .= '</a>';
		$item_output .= $args->after;
        if ($this->in_mega_menu && $depth > 0) {
            if ($depth == 1) {
                $is_active = $this->current_tab == 1 ? 'active' : '';
                $this->tabs_labels .= '<button class="tablinks '.$is_active.'" onclick="openCategory(event, \'cat_'.$this->mega_id.'_'.$this->current_tab.'\')">'.$title.'</button>';
            } elseif ($depth == 2) {
                $object_categories = get_the_category($item->object_id);
                if (is_array($object_categories)) {
                    $object_category = $object_categories[0]->name;
                } else {
                    $object_category = '';
                }
                $this->tabs_content .= '<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="blog-box">
                    <div class="post-media">
                        <a href="'.esc_url($item->url).'" title="">
                            <img src="'.esc_url(get_the_post_thumbnail_url($item->object_id, 'horizontal')).'" alt="" class="img-fluid">
                            <div class="hovereffect">
                            </div><!-- end hover -->
                            <span class="menucat">'.$object_category.'</span>
                        </a>
                    </div><!-- end media -->
                    <div class="blog-meta">
                        <h4><a href="'.esc_url($item->url).'" title="">'.$title.'</a></h4>
                    </div><!-- end meta -->
                </div><!-- end blog-box -->
            </div>';
            }
        } else {
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
		
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
        }
        if ($this->in_mega_menu) {
            if ($depth == 0) {
                $output .= '<ul aria-lebelledby="dropdown_'.$this->dropdown_id.'" class="dropdown-menu megamenu"><li><div class="mega-menu-content clearfix">';
                $output .= '<div class="tab">' . $this->tabs_labels . '</div>';
                $output .= '<div class="tab-details clearfix">' . $this->tabs_content . '</div>';
                $output .= '</div></li></ul>';
                $output .= "</li>{$n}";
                $this->in_mega_menu = false;
                $this->tabs_content = '';
                $this->tabs_labels = '';
                $this->current_tab = 1;
            } elseif ($depth == 1) {
                $this->current_tab++;
            }
        } else {
            $output .= "</li>{$n}";
        }
		
	}

}
