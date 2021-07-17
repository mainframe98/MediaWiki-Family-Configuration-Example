<?php
/**
 * This file displays a 404 page if the wiki is not found in the list of databases
 */

if ( $wgCommandLineMode ) {
	echo "$wgDBname is not a known database." . PHP_EOL;
} else {
	header( 'HTTP/1.0 404 Not Found' );

	echo '<html>
        <head>
            <style type="text/css">
                html, body {
                    font-family: sans-serif;
                }
                .div {
                	text-align: center;
                }
            </style>
            <title>Wiki Not Found</title>
        </head>
        <body>
            <div>
                <h1>Wiki Not Found</h1>
                <p>The wiki you wanted to visit does not exist. Please be sure you typed the URL correctly.</p>
            </div>
        </body>
    </html>';
}

exit;
