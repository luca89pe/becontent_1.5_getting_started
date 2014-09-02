<?php
$files = glob(  "contents/events/entities". '/*.php' );
foreach ( $files as $file )
	require_once( $file );