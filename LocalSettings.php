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

	// Define default suffix for that rare case
	$fgSuffix = 'wiki';

	// TODO: Run some edge case checks on this. The wiki name might contain a suffix value
	foreach ( $wgConf->suffixes as $suffix ) {
		if ( strpos( $wgDBname, $suffix ) > 0 ) {
			$fgSuffix = $suffix;
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
	if ( count( $urlComponents ) < 2 ) {
		$urlComponents[2] = 'www';
	}

	// Optional: Redirect different tld's to different wikis
	// Example: www.example.nl => nl.example.org
	switch( $urlComponents[0] ) {
		default:
			$urlComponents[2] = $urlComponents[0];
			$urlComponents[0] = 'org';
			break;
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
			$fgSuffix = 'wiki';
			break;
	}

	$wgDBname = $wikiname . $fgSuffix;
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
	$wgLocalDatabases[] = $dbName;
	$wgConf->settings['wgSitename'][$dbName] = $siteName;
	$wgConf->settings['wgLanguageCode'][$dbName] = $siteLang;
}

# Check if the obtained database name is in the list of databases
if ( in_array ($wgDBname, $wgLocalDatabases ) ) {
	require_once( "$configDir/WikiNotFound404.php" );
	// Optional: Redirect to a "No such wiki" page on the central wiki.
}

$wikiTagList = [];

# Get a list of all the tag dblists
$tagDbLists = glob( "$configDir/dblists/tags/*" );
foreach ( $tagDbLists as $dblistfile ) {
	$dblist = file( $dblistfile );

	if ( in_array( $wgDBname, $dblist ) ) {
		// Add the tag to the list of tags, which is equal to the name of the dblist, minus the
		// file extension
		$wikiTagList[] = basename( $dblistfile, '.dblist' );
	}
}

$fgLoginOnlyDatabaseList = file( "$configDir/dblists/loginonly.dblist" );

# Mark the wiki as login only if it is in the list of Login only databases
foreach ( $fgLoginOnlyDatabaseList as $database ) {
	$database = trim( $database );
	$wgConf->settings['fgLoginOnlyWiki'][$database] = true;
}

$fgRestrictedDatabaseList = file( "$configDir/dblists/restricted.dblist" );

# Mark the wiki as restricted if it is in the list of restricted databases
foreach ( $fgRestrictedDatabaseList as $database ) {
	$database = trim( $database );
	// The wiki is login only when restricted, so set this too
	$wgConf->settings['fgLoginOnlyWiki'][$database] = true;
	$wgConf->settings['fgRestrictedWiki'][$database] = true;
}

$fgPrivateDatabaseList = file( "$configDir/dblists/private.dblist" );

# Mark the wiki as private if it is in the list of private databases
foreach ( $fgPrivateDatabaseList as $database ) {
	$database = trim( $database );
	// The wiki is login only when private, so set this too
	$wgConf->settings['fgLoginOnlyWiki'][$database] = true;
	// The wiki is restricted when private, so set this too
	$wgConf->settings['fgRestrictedWiki'][$database] = true;
	$wgConf->settings['fgPrivateWiki'][$database] = true;
}

$fgClosedDatabaseList = file( "$configDir/dblists/closed.dblist" );

# Mark the wiki as closed if it is in the list of closed databases
foreach ( $fgClosedDatabaseList as $database ) {
	$database = trim( $database );
	$wgConf->settings['fgClosedWiki'][$database] = true;
}

/**
 * passed to siteParamsCallback of a SiteConfiguration instance (see below)
 *
 * @param SiteConfiguration $conf
 * @param $wiki
 * @return array
 */
function efGetSiteParams( SiteConfiguration $conf, $wiki ) {
	$site = null;
	$lang = null;
	foreach ( $conf->suffixes as $suffix ) {
		if ( substr( $wiki, -strlen( $suffix ) ) == $suffix ) {
			$site = $suffix;
			$lang = substr( $wiki, 0, -strlen( $suffix ) );
			break;
		}
	}
	return [
		'suffix' => $site,
		'lang' => $lang,
		'params' => [
			'lang' => $lang,
			'site' => $site,
			'wiki' => $wiki,
		],
		'tags' => [],
	];
}

$wgConf->siteParamsCallback = 'efGetSiteParams';

# Set the wikis for $wgConf
$wgConf->wikis = $wgLocalDatabases;

# Extract the globals
$wgConf->extractAllGlobals( $wgDBname, $fgSuffix, [], $wikiTagList );

# Load the extensions
require_once( "$configDir/SharedExtensions.php" );
require_once( "$configDir/LocalExtensions.php" );

# Load the skins
require_once( "$configDir/Skins.php" );

# Get the Conditional Common Settings File
require_once( "$configDir/ConditionalCommonSettings.php" );
