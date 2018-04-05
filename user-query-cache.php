<?php

class User_Cache {
	function __construct() {
		add_filter( 'pre_user_query', [ $this, 'pre_user_query' ] );

		add_action( 'clean_user_cache', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'profile_update', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'user_register', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'add_user_to_blog', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'remove_user_from_blog', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'wpmu_new_user', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'granted_super_admin', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'revoke_super_admin', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'add_user_meta', [ $this, 'clean_user_cache' ], 999, 1 );

		add_action( 'remove_user_role', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'add_user_role', [ $this, 'clean_user_cache' ], 999, 1 );
		add_action( 'set_user_role', [ $this, 'clean_user_cache' ], 999, 1 );

		add_action( 'update_user_meta', [ $this, 'update_user_meta' ], 999, 2 );
		add_action( 'delete_user_meta', [ $this, 'update_user_meta' ], 999, 2 );

	}

	function pre_user_query( &$wp_user_query ) {
		global $wpdb;
		$query_fields = "$wpdb->users.ID";
		$sql          = "SELECT $query_fields $wp_user_query->query_from $wp_user_query->query_where $wp_user_query->query_orderby $wp_user_query->query_limit";
		$last_changed = wp_cache_get_last_changed( 'users' );
		if ( $wp_user_query->query_vars['has_published_posts'] && $wp_user_query->query_vars['blog_id'] ) {
			$last_changed .= wp_cache_get_last_changed( 'posts' );
		}

		$cache_key = md5( $wpdb->remove_placeholder_escape( $sql ) ) . $last_changed;

		$result = wp_cache_get( $cache_key, 'users' );

		if ( false === $result ) {
			$result = $wpdb->get_col( $sql );
			wp_cache_set( $cache_key, $result, 'users' );
		} elseif ( $number = count( $result ) ) {
			$include_sql                  = implode( ',', $result );
			$wp_user_query->query_from    = "FROM $wpdb->users";
			$wp_user_query->query_where   = "WHERE 1=1 AND $wpdb->users.ID IN ($include_sql)";
			$wp_user_query->query_orderby = "ORDER BY FIELD( $wpdb->users.ID, $include_sql )";
			$wp_user_query->query_limit   = "LIMIT $number";
		} else {
			$wp_user_query->query_from    = "FROM $wpdb->users";
			$wp_user_query->query_where   = 'WHERE 1=2';
			$wp_user_query->query_orderby = '';
			$wp_user_query->query_limit   = '';
		}

	}

	function update_user_meta( $meta_ids, $user_id ) {
		$this->clean_user_cache( $user_id );
	}

	function clean_user_cache( $user_id ) {
		$last_changed = microtime();
		wp_cache_set( 'last_changed', $last_changed, 'users' );
	}

}
new User_Cache;
