<?php

function pline( $msg ){
	if( is_array( $msg ) ){
		echo var_export( $msg, 1 );
		echo "<br/>";
		return ;
	}
	echo "{$msg}<br/>";
}
