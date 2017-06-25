<?php
# This is the LocalSettings.php file.
# This file determines the database name, loads the common settings, the $wgConf wiki-specific
# settings, skins, shared and wiki-specific extensions and the conditional CommonSettings
# This file is linked from $IP, either by symlink or by require_once( "$IP/config/LocalSettings.php" );

$configDir = __DIR__;

$wgConf = new SiteConfiguration();
$wgConf->suffixes = file( "$configDir/suffixes.list" );

# Generate the db name
if ( defined( 'MW_DB' ) ) {
	// Command-line mode and maintenance scripts (e.g. update.php)
	$wgDBname = MW_DB;

	foreach ( $wgConf->suffixes as $suffix ) {
		if ( substr( MW_DB, -strlen( $suffix ) ) === $suffix ) {
			$wikiname = substr( MW_DB, 0, -strlen( $suffix ) );
			break;
		}
	}

} else {
	// Web server
	$server = $_SERVER['SERVER_NAME'];

	$urlComponents = explode( '.', $server );

	if ( !$urlComponents ) {
		require_once( "$configDir/WikiNotFound404.php" );
	}

	// Reverse the array so the tld is the first item in the array
	// Content will look like:
	// $urlComponents = [
	// [0] => tld           (org)
	// [1] => domain        (example)
	// [2] => sub domain    (www)
	// [3...] => other sub domains
	// ]
	$urlComponents = array_reverse( $urlComponents );

	// If no sub domain has been given, set it to www as default
	if ( count( $urlComponents ) < 3 ) {
		$urlComponents[2] = 'www';
	}

	// Optional: Redirect different tld's to different wikis
	// Example: www.example.nl => nl.example.org
	if ( $urlComponents[0] !== 'org' && $urlComponents[0] !== 'example' ) {
		switch ( $urlComponents[0] ) {
			default:
				$urlComponents[2] = $urlComponents[0];
				$urlComponents[0] = 'org';
				break;
		}
	}

	// Determine wiki name by adding all segments after the domain together
	$wikiname = implode( '', array_slice( $urlComponents, 2 ) );

	// Optional: Override database name of your "main" wiki (otherwise 'wwwwiki')
	if ( $urlComponents[2] === 'www' ) {
		$wikiname = 'meta';
	}

	// Determine the database name suffix by checking the domain name
	// Remember to update suffixes.list when making edits to this configuration!
	switch( $urlComponents[1] ) {
		default:
			$suffix = 'wiki';
			break;
	}

	$wgDBname = $wikiname . $suffix;
}

# Import private settings
require_once( "$configDir/PrivateSettings.php" );

# Get the shared settings for all wikis
require_once( "$configDir/CommonSettings.php" );

# Load the settings from InitialiseSettings.php which contains the settings for all wikis
require_once( "$configDir/InitialiseSettings.php" );

$wgLocalDatabases = [];

# Load all databases
$fgDatabaseList = file( "$configDir/dblists/all.dblist" );

# Set the language and site name for each database/wiki
foreach ( $fgDatabaseList as $wiki ) {
	$wikiDB = explode( '|', $wiki, 3 );
	list( $dbName, $siteName, $siteLang ) = array_pad( $wikiDB, 3, '' );
	$wgLocalDatabases[] = trim( $dbName );
	$wgConf->settings['wgSitename'][$dbName] = trim( $siteName );
	$wgConf->settings['wgLanguageCode'][$dbName] = trim( $siteLang );
}

# Check if the obtained database name is in the list of databases
if ( !in_array ( $wgDBname, $wgLocalDatabases ) ) {
	require_once( "$configDir/WikiNotFound404.php" );
	// Optional: Redirect to a "No such wiki" page on the central wiki.
}

/**
 * Callback function used to determine the language code and suffix from a given wiki and Site configuration object.
 *
 * This is passed to siteParamsCallback of a SiteConfiguration instance (see below)
 *
 * @param SiteConfiguration $conf
 * @param string $wiki
 * @return array
 */
function efGetSiteParams( SiteConfiguration $conf, $wiki ) {
	global $configDir;

	$site = null;
	$lang = null;
	$tags = [];

	foreach ( $conf->suffixes as $suffix ) {
		if ( substr( $wiki, -strlen( $suffix ) ) === $suffix ) {
			$site = $suffix;
			break;
		}
	}

	// Get a list of all the tag dblists
	$tagDbLists = glob( "$configDir/dblists/tags/*" );
	foreach ( $tagDbLists as $dblistfile ) {
		$dblist = file( $dblistfile );

		if ( in_array( $wiki, $dblist ) ) {
			// Add the tag to the list of tags, which is equal to the name of the dblist, minus the
			// file extension
			$tags[] = basename( $dblistfile, '.dblist' );
		}
	}

	// Set the language code based on a value in the settings area because the regular approach
	// does not suffice, as sub domains are not limited to language codes
	// Go the extra mile by checking the tags that are available for this wiki if an entry in the
	// settings array does not exist, before picking the default language code
	if ( isset( $conf->settings['wgLanguageCode'][$wiki] ) ) {
		$lang = $conf->settings['wgLanguageCode'][$wiki];
	} else {
		foreach ( $tags as $tag ) {
			if ( isset( $conf->settings['wgLanguageCode'][$tag] ) ) {
				$lang = $conf->settings['wgLanguageCode'][$tag];
			}
		}

		// Could not find the language code anywhere, so fallback to the default
		if ( $lang === null ) {
			$lang = $conf->settings['wgLanguageCode']['default'];
		}
	}

	return [
		'suffix' => $site,
		'lang'   => $lang,
		'tags'   => $tags,
		'params' => [
			'lang' => $lang,
			'site' => $site,
			'wiki' => $wiki,
		],
	];
}

$wgConf->siteParamsCallback = 'efGetSiteParams';

# Set the wikis for $wgConf
$wgConf->wikis = $wgLocalDatabases;

# Extract the globals
$wgConf->extractAllGlobals( $wgDBname );

# Load the extensions
require_once( "$configDir/SharedExtensions.php" );
require_once( "$configDir/LocalExtensions.php" );

# Load the skins
require_once( "$configDir/Skins.php" );

# Load the Conditional Common Settings File
require_once( "$configDir/ConditionalCommonSettings.php" );
