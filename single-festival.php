<?php
/**
 * The Template for displaying single Festivals.
 */

get_header();
	
	global $current_user, $vca_asm_utilities;
	get_currentuserinfo();
	
	$user_region = get_user_meta( $current_user->ID, 'region', true );
	$user_mem_status = get_user_meta( $current_user->ID, 'membership', true );
	
	setlocale ( LC_ALL , 'de_DE' ); 
	
	if( ! isset( $output ) ) {
		$output = '';
	}
	if( ! isset( $list_class ) ) {
		$list_class = '';
	}
	
	/* list & loop through posts (activities) */
	$output .=  '<div class="narrow"><div class="col12"><ul class="' . $list_class . '">';
	
if ( have_posts() ) while ( have_posts() ) : the_post();
		
		$output .= '<li class="activity">' .
			'<h4>' . get_the_title() . '</h4>' .
			'<ul class="head-block"><li>' .
				__( 'Timeframe', 'vca-theme' ) . ': ' .
				strftime( '%A, %e.%m.%Y', intval( get_post_meta( get_the_ID(), 'start_date', true ) ) ) .
				' ' . __( 'until', 'vca-theme' ) . ' ' .
				strftime( '%A, %e.%m.%Y', intval( get_post_meta( get_the_ID(), 'end_date', true ) ) ) .
			'</li><li>' .
				__( 'Location', 'vca-theme' ) . ': ' .
				get_post_meta( get_the_ID(), 'location', true ) .
			'</li><li>' .
				__( 'Application Deadline', 'vca-theme' ) . ': ' .
				strftime( '%A, %e.%m.%Y', intval( get_post_meta( get_the_ID(), 'end_app', true ) ) ) .
			'</li></ul>' .
			
			'<h5>' . __( 'Further Info', 'vca-theme' ) . '</h5>' .
			'<ul><li>' .
				__( 'Website', 'vca-theme' ) . ': ';
		$website = get_post_meta( get_the_ID(), 'website', true );
		if( substr( $website, 0, 11 ) === 'http://www.' ) {
			$url = $website;
			$name = substr( $website, 11 );
		} elseif( substr( $website, 0, 7 ) === 'http://' ) {
			$url = $website;
			$name = substr( $website, 7 );
		} elseif( substr( $website, 0, 4 ) === 'www.' ) {
			$url = 'http://' . $website;
			$name = substr( $website, 4 );
		} else {
			$url = 'http://' . $website;
			$name = $website;					
		}
		$output .= '<a title="' .
			sprintf( __( 'Visit &quot;%s&quot;', 'vca-theme' ), $name ) .
			'" href="' . $url . '" target="_blank">' .
			$name . '</a>' .
			'</li><li>' .
				__( 'VcA Activities', 'vca-theme' ) . ': ';
		$tools_enc = get_post_meta( get_the_ID(), 'tools', true );
		$special_desc =  get_post_meta( get_the_ID(), 'special', true );
		if( ! empty( $tools_enc ) ) {
			$tools = array();
			if( in_array( '1', $tools_enc ) ) {
				$tools[] = _x( 'Cups', 'VcA Tools', 'vca-theme' );
			}
			if( in_array( '2', $tools_enc ) ) {
				$tools[] = _x( 'Guest List', 'VcA Tools', 'vca-theme' );
			}
			if( in_array( '3', $tools_enc ) ) {
				$tools[] = _x( 'Info Counter', 'VcA Tools', 'vca-theme' );
			}
			if( in_array( '4', $tools_enc ) ) {
				$tools[] = _x( 'Water Bottles', 'VcA Tools', 'vca-theme' );
			}
			if( in_array( '5', $tools_enc ) ) {
				if( isset( $special_desc ) && ! empty( $special_desc ) ) {
					$tools[] = $special_desc;
				} else {
					$tools[] = _x( 'Special', 'VcA Tools', 'vca-theme' );
				}
			}
			$tools = implode( ', ', $tools );
		} else {
			$tools = __( 'none', 'vca-theme' );
		}
		$output .= $tools . '</li><li>' .
				__( 'Directions', 'vca-theme' ) . ': ' .
				$vca_asm_utilities->urls_to_links( get_post_meta( get_the_ID(), 'directions', true ) ) .
			'</li></ul>';
		
		$output .= '<h5>' . __( 'Contact Person(s)', 'vca-theme' ) . '</h5>';
		$contacts = get_post_meta( get_the_ID(), 'contact_name', true );
		$contact_emails = get_post_meta( get_the_ID(), 'contact_email', true );
		$contact_mobiles = get_post_meta( get_the_ID(), 'contact_mobile', true );
		$i = 0;
		foreach( $contacts as $contact_name ) {
			if( empty( $contact_name ) ) {
				if( $i === 0 ) {
					$output .= '<p>' . __( 'Not set yet...', 'vca-theme' ) . '</p>';
				}
				continue;
			}
			$output .= '<ul><li>' .
				__( 'Name', 'vca-theme' ) . ': ' . $contact_name;
			if( ! empty( $contact_emails[$i] ) ) {
				$output .= '</li><li>' . __( 'E-Mail', 'vca-theme' ) . ': ' . $contact_emails[$i];
			}
			if( ! empty( $contact_mobiles[$i] ) ) {
				$output .= '</li><li>' . __( 'Mobile Number', 'vca-theme' ) . ': ' . $contact_mobiles[$i];
			}
			$output .= '</li></ul>';
			$i++;
		}
		
		//$slots_arr = get_post_meta( get_the_ID(), 'slots', true );
		//if( ! array_key_exists( 0, $slots_arr ) ) {
		//	if( ! array_key_exists( $user_region, $slots_arr ) || $user_mem_status != 2 ) {
		//		continue;
		//	}
		//}
		
		//if( isset( $show_app ) && $show_app === true ) {
		//	
		//	$output .= '<h5>' . __( 'Note', 'vca-theme' ) . '</h5>' .
		//		'<form method="post" action="">' .
		//		'<input type="hidden" name="unique_id" value="[' . md5( uniqid() ) . ']">' .
		//		'<input type="hidden" name="todo" id="todo" value="apply" />' .
		//		'<input type="hidden" name="activity" id="activity" value="' . get_the_ID() . '" />' .
		//		'<div class="form-row">' .
		//			'<div class="no-js-toggle">' .
		//				'<textarea name="notes" id="notes" rows="4"></textarea>' .
		//				'<br /><span class="description">' .
		//					_x( 'If you wish to send a message with your application, do so here.', 'Frontend: Application Process', 'vca-theme' ) .
		//				'</span>' .
		//			'</div>' .
		//			'<div class="js-toggle">' .
		//				'<textarea name="notes" id="notes" class="textarea-hint" rows="5">' .
		//					_x( 'If you wish to send a message with your application, do so here.', 'Frontend: Application Process', 'vca-theme' ) .
		//					"\n\n" .
		//					_x( "For insatance if you're applying with a friend, cannot reach on time, or the like.", 'Frontend: Application Process', 'vca-theme' ) .
		//				'</textarea>' .
		//			'</div>' .	
		//		'</div><div class="form-row">' .
		//			'<input type="submit" id="submit_form" name="submit_form" value="' . __( 'Apply', 'vca-theme' ) . '" />' .
		//		'</div></form>';
		//}
		//
		//if( isset( $show_rev_app ) && $show_rev_app === true ) {
		//	
		//	$output .= '<form method="post" action="">' .
		//		'<input type="hidden" name="todo" id="todo" value="revoke_app" />' .
		//		'<input type="hidden" name="activity" id="activity" value="' . get_the_ID() . '" />' .
		//		'<div class="form-row">' .
		//			'<input type="submit" id="submit_form" name="submit_form" value="' . __( 'Revoke Application', 'vca-theme' ) . '" />' .
		//		'</div></form>';
		//}
		
		$output .= '</li>';
		
	endwhile;
	
	$output .= '</ul></div></div>';
	
	echo $output;
	
get_footer(); ?>