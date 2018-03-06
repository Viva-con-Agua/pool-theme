<?php
/**
 * The Template for displaying single Concerts.
 */

get_header();

	global $current_user;

	$utils = new P1_Utilities();

	$user_city = get_user_meta( $current_user->ID, 'city', true );
	$user_mem_status = get_user_meta( $current_user->ID, 'membership', true );
	$user_lang = get_user_meta( $current_user->ID, 'pool_lang', true );

	if( ! isset( $output ) ) {
		$output = '';
	}
	if( ! isset( $list_class ) ) {
		$list_class = '';
	}

	/* list & loop through posts (activities) */
	$output .=  '<div class="narrow"><div class="col12">';

if ( have_posts() ) while ( have_posts() ) : the_post();

		$output .= '<div class="activity single-activity">' .

			'<img class="activity-icon" alt="' . __( 'Concert', 'vca-theme' ) . '" src="' . get_bloginfo( 'template_url' ) . '/images/icons/icon-concert_32.png" />' .

			'<h4>' . get_the_title() . '</h4>' .

			'<h5>' . __( 'The Concert', 'vca-theme' ) . '</h5>' .

			'<table class="meta-table">' .
				'<tr>' .
					'<td><p class="label">' . __( 'Timeframe', 'vca-theme' ) . '</p>' .
					'<p class="metadata">';

		$start_act = intval( get_post_meta( get_the_ID(), 'start_act', true ) );
		$end_act = intval( get_post_meta( get_the_ID(), 'end_act', true ) );
		$start_app = intval( get_post_meta( get_the_ID(), 'start_app', true ) );
		$end_app = intval( get_post_meta( get_the_ID(), 'end_app', true ) );

		if ( 'en' === $user_lang ) {
			$start_act_string = strftime( '%A, %e/%m/%Y, %H:%M', $start_act );
			$end_act_string = strftime( '%A, %e/%m/%Y, %H:%M', $end_act );
			$start_app_string = strftime( '%A, %e/%m/%Y', $start_app );
			$end_app_string = strftime( '%A, %e/%m/%Y', $end_app );
		} else {
			$start_act_string = strftime( '%A, %e.%m.%Y, %H:%M', $start_act );
			$end_act_string = strftime( '%A, %e.%m.%Y, %H:%M', $end_act );
			$start_app_string = strftime( '%A, %e.%m.%Y', $start_app );
			$end_app_string = strftime( '%A, %e.%m.%Y', $end_app );
		}

		if ( strftime( '%e.%m.%Y', $start_act ) === strftime( '%e.%m.%Y', $end_act ) ) {
			$output .= $start_act_string .
				' ' . __( 'until', 'vca-theme' ) . ' ' .
				strftime( '%H:%M', $end_act );
		} else {
			$output .= $start_act_string .
				' ' . __( 'until', 'vca-theme' ) . ' ' .
				$end_act_string;
		}

		$output .= '</p></td></tr>' .
			'<tr>' .
				'<td><p class="label">' . __( 'Location', 'vca-theme' ) . '</p>' .
				'<p class="metadata">' . get_post_meta( get_the_ID(), 'location', true ) . '</p></td>' .
			'</tr>' .
			'<tr>' .
				'<td><p class="label">' . __( 'Application Deadline', 'vca-theme' ) . '</p>' .
				'<p class="metadata">' . $end_app_string . '</p></td>' .
			'</tr>' .
			'<tr>' .
				'<td><p class="label">' . _x( 'available Slots', 'i.e. max. participants', 'vca-theme' ) . '</p>' .
				'<p class="metadata">' . get_post_meta( get_the_ID(), 'total_slots', true ) . '</p></td>' .
			'</tr></table>';

		$subput = '';

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

			$subput .= '<tr>' .
				'<td><p class="label">' . __( 'VcA Activities', 'vca-theme' ) . '</p>' .
				'<p class="metadata">' . $tools . '</p></td>' .
			'</tr>';
		}

		$site = get_post_meta( get_the_ID(), 'website', true );

		if ( ! empty( $site ) ) {
			$subput .= '<tr>' .
				'<td><p class="label">' . __( 'Website', 'vca-theme' ) . '</p>' .
				'<p class="metadata">' . $utils->urls_to_links( $site ) . '</p></td>' .
			'</tr>';
		}

		$directions = get_post_meta( get_the_ID(), 'directions', true );

		if ( ! empty( $directions ) ) {
			$subput .= '<tr>' .
				'<td><p class="label">' . __( 'Directions', 'vca-theme' ) . '</p>' .
				'<p class="metadata">' . preg_replace( '#(<br */?>\s*){2,}#i', '<br><br>' , preg_replace( '/[\r|\n]/', '<br>' , $utils->urls_to_links( $directions ) ) ) . '</p></td>' .
			'</tr>';
		}

		$notes = get_post_meta( get_the_ID(), 'notes', true );

		if ( ! empty( $notes ) ) {
			$subput .= '<tr>' .
				'<td><p class="label">' . __( 'additional Notes', 'vca-theme' ) . '</p>' .
				'<p class="metadata">' . preg_replace( '#(<br */?>\s*){2,}#i', '<br><br>' , preg_replace( '/[\r|\n]/', '<br>' , $utils->urls_to_links( $notes ) ) ) . '</p></td>' .
			'</tr>';
		}

		if ( ! empty( $subput ) ) {
			$output .= '<h5>' . __( 'Further Info', 'vca-theme' ) . '</h5>' .
				'<table class="meta-table">' .$subput . '</table>';
			$subput = '';
		}

		/* Application / Interaction */

		if ( class_exists( 'VCA_ASM_Activity' ) ) {
			$the_activity = new VCA_ASM_Activity( get_the_ID() );
		}

		if ( $current_user->has_cap( 'vca_asm_view_network' ) ) {
			$show_contacts = true;
		} else {
			$show_contacts = false;
		}

		if ( isset( $_POST['todo'] ) && 'revoke_app' === $_POST['todo'] ) {$output .= '<h5>' . __( 'Application revoked', 'vca-theme' ) . '</h5>';

			$output .= '<p class="metadata metadata-message highlight">' .
				__( 'You have successfully revoked your application to this activity.', 'vca-theme' ) .
			'</p>';


		} elseif ( isset( $the_activity ) && $the_activity->has_applied( $current_user->ID ) ) {

			$output .= '<h5>' . __( 'Participate', 'vca-theme' ) . '</h5>';

			$output .= '<p class="metadata metadata-message">' .
				__( 'You have currently applied to this activity and will be notified soon.', 'vca-theme' ) .
			'</p>';

			$output .= '<form method="post" action="">' .
					'<input type="hidden" name="todo" id="todo" value="revoke_app" />' .
					'<input type="hidden" name="activity" id="activity" value="' . get_the_ID() . '" />' .
					'<div class="form-row">' .
						'<input type="submit" id="submit_form" name="submit_form" value="' . __( 'Revoke Application', 'vca-theme' ) . '" />' .
				'</div></form>';

		} elseif ( isset( $the_activity ) && $the_activity->is_participant( $current_user->ID ) && $the_activity->upcoming ) {

			$output .= '<h5>' . __( 'Participate', 'vca-theme' ) . '</h5>';

			$output .= '<p class="metadata metadata-message">' .
				__( 'You are currently registered as participant of this activity.', 'vca-theme' ) . '<br />' .
				__( 'Feel free to contact the SPOCs, should you have questions. Please do so in due time, should you not be able to participate.', 'vca-theme' ) .
			'</p>';
			$show_contacts = true;

		} elseif ( time() < $start_app ) {

			$output .= '<h5>' . __( 'Participate', 'vca-theme' ) . '</h5>' .
				'<p class="metadata metadata-message">' .
					sprintf(
						__( 'The application phase for this activity has not yet begun. It starts on %s.', 'vca-theme' ),
						$start_app_string
					) .
				'</p>';

		} elseif ( ( time() - 60*60*22 ) < $end_app ) {

			if ( ! is_user_logged_in() ) {

				$url = p1_current_country() === 'ch' ? 'https://pool.vivaconagua.ch' : 'https://pool.vivaconagua.org';

                $output .= '<h5>' . __( 'Participate', 'vca-theme' ) . '</h5>';
				$output .= '<p class="metadata metadata-message">' .
					sprintf(
						__( 'You must be <a title="Log In" href="%s">logged in</a> to be able to apply for an activity...', 'vca-theme' ),
						$url
					) .
				'</p>';

			} elseif ( isset( $the_activity ) && is_numeric( $the_activity->is_eligible( $current_user->ID ) ) ) {

                $output .= '<form method="post" action="">';

                if( ! empty( $tools_enc ) && in_array( '1', $tools_enc )) {

                    $cup_hunt = __("Check the <a href='' target='_blank'>information sheet</a> before applying! Here you will find all the information you need for a successful cup hunt. FAQ's, project information, overview of the use of funds, brief information on VcA and and and... Always up-to-date and interactive processed.<br/><br/>Don´t miss out!", 'vca-asm');

                    $output .= '<h5>' . __( 'All about the cup-hunt', 'vca-asm' ) . '</h5>';
                    $output .= '<p class="metadata">' . $cup_hunt . '</p>';

                    $output .= '<br/><span style="font-size: 14px; font-weight: bold;"><input type="checkbox" name="read_confirmation" required> ';
                    $output .= __( 'I have read it!', 'vca-asm' );
                    $output .= '</span><br/><br/>';
                }

                $output .= '<h5>' . __( 'Participate', 'vca-theme' ) . '</h5>';

                $output .= '<input type="hidden" name="unique_id" value="[' . md5( uniqid() ) . ']">' .
						'<input type="hidden" name="todo" id="todo" value="apply" />' .
						'<input type="hidden" name="activity" id="activity" value="' . get_the_ID() . '" />' .
						'<div class="form-row">' .
							'<textarea name="notes" id="notes" rows="5"></textarea>' .
							'<br class="no-js-toggle" /><span class="description no-js-toggle">' .
								_x( 'If you wish to send a message with your application, do so here.', 'Frontend: Application Process', 'vca-theme' ) .
							'</span>' .
						'</div><div class="form-row">' .
							'<input type="submit" id="submit_form" name="submit_form" value="' . __( 'Apply', 'vca-theme' ) . '" />' .
						'</div></form>';

			} else {

				$output .= '<p class="metadata metadata-message">' .
					__( 'You are not eligible for this activity. Either because a quota for your country and/or city does not exist or because this is limited by another factor. Sorry.', 'vca-theme' ) .
				'</p>';

			}

		} elseif ( isset( $the_activity ) && $the_activity->upcoming ) {

			$output .= '<h5>' . __( 'Participate', 'vca-theme' ) . '</h5>' .
				'<p class="metadata metadata-message">' .
					__( 'The application phase for this activity has already ended. Sorry.', 'vca-theme' ) .
				'</p>';

		} elseif ( isset( $the_activity ) ) {

			$output .= '<h5>' . __( 'Participants', 'vca-theme' ) . '</h5>' .
				'<p class="no-margin">' .
					sprintf(
						__( '%d people have participated in this activity.', 'vca-theme' ),
						$the_activity->participants_count
					);

			if ( $the_activity->is_participant( $current_user->ID ) ) {
				$output .= '<br />' . __( 'You were one of them.', 'vca-theme' );
			}

			$output .= '</p>';

		}

		/* End of Interactiveness */

		if (
			(
				isset( $show_contacts ) && true === $show_contacts
			) ||
			(
				$current_user->has_cap( 'vca_asm_manage_actions' ) ||
				$current_user->has_cap( 'vca_asm_manage_actions_nation' ) ||
				$current_user->has_cap( 'vca_asm_manage_actions_global' )
			)
		) {
			$output .= '<h5>' . __( 'SPOC(s)', 'vca-theme' ) . '</h5>';

			$contacts = get_post_meta( get_the_ID(), 'contact_name', true );
			$contact_emails = get_post_meta( get_the_ID(), 'contact_email', true );
			$contact_mobiles = get_post_meta( get_the_ID(), 'contact_mobile', true );
			$i = 0;

			if ( ! empty( $contacts ) && is_array( $contacts ) ) {
				$end = count( $contacts );
				foreach( $contacts as $contact_name ) {
					if( empty( $contact_name ) ) {
						if( $i === 0 ) {
							$output .= '<table class="meta-table">'.
									'<tr><td><p class="label">' .
											__( 'Contact Person(s)', 'vca-theme' ) .
										'</p><p class="metadata">' .
											__( 'Not set yet...', 'vca-theme' ) .
										'</p>' .
									'</td></tr>' .
								'</table>';
						} else {
							$output .= '</table>';
						}
						break;
					} elseif( $i === 0 ) {
						$output .= '<table class="meta-table">';
					}
					$output .= '<tr><td><p class="label">' .
							sprintf( __( 'Contact Person #%d', 'vca-theme' ), $i + 1 ) . '</p><p class="metadata">'  .
							$contact_name;

						if( ! empty( $contact_emails[$i] ) ) {
							$output .= ', <a title="' . __( 'Write to the contact', 'vca-theme' ) . '" href="mailto:' . $contact_emails[$i] . '">'. $contact_emails[$i] . '</a>';
						}
						if( ! empty( $contact_mobiles[$i] ) ) {
							$output .= ', ' . $contact_mobiles[$i];
						}
					$output .= '</p></td></tr>';

					if ( $end === $i + 1 ) {
						$output .= '</table>';
					}
					$i++;
				}
			} else {
				$output .= '<table class="meta-table">'.
						'<tr><td><p class="label">' .
								__( 'Contact Person(s)', 'vca-theme' ) .
							'</p><p class="metadata">' .
								__( 'Not set yet...', 'vca-theme' ) .
							'</p>' .
						'</td></tr>' .
					'</table>';
			}
		}

		$output .= '</div>';

	endwhile;

	$output .= '</div></div>';

	echo $output;

get_footer(); ?>