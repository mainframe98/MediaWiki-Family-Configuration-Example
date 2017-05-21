<?php
# These extensions are always loaded on all projects
$wgRegistrationExtensions = [
	'AntiSpoof',
	'cldr',
	'CategoryTree',
	'CheckUser',
	'CirrusSearch',
	'Cite',
	'CiteThisPage',
	'Elastica', // CirrusSearch dependency
	'GlobalBlocking',
	'GlobalCssJs',
	'GlobalPreferences',
	'GlobalUserrights',
	'InputBox',
	'Interwiki',
	'LocalisationUpdate',
	'Maintenance',
	'Math',
	'MessageCommons',
	'Nuke',
	'OAuth',
	'ParserFunctions',
	'PdfHandler',
	'Poem',
	'RefreshSpecial',
	'Renameuser',
	'SiteMatrix',
	'SyntaxHighlight_GeSHi', // On Linux, set chmod a+x/path/to/extensions/SyntaxHighlight_GeSHi/pygments/pygmentize to allow the library to execute
	'SpamBlacklist',
	'Tabber',
	'TitleBlacklist',
	'UserMerge'
];

wfLoadExtensions( $wgRegistrationExtensions );
require_once "$IP/extensions/Scribunto/Scribunto.php";

# Configuration
$wgScribuntoDefaultEngine = 'luastandalone';

# AntiSpoof
$wgSharedTables[] = 'spoofuser';

# CirrusSearch
$wgSearchType = 'CirrusSearch';
$wgCirrusSearchServers = [ 'localhost' ];
## Turn off leading wildcard matches, they are a very slow and inefficient query
$wgCirrusSearchAllowLeadingWildcard = false;

# GlobalBlocking
$wgApplyGlobalBlocks = $wgDBname !== $wgSharedDB; // Don't apply a global block on the central wiki, so it can be used to contest a global block
$wgGlobalBlockingDatabase = $wgSharedDB;

# GlobalCssJs
$wgResourceLoaderSources['metawiki'] = [
	'apiScript' => '//meta.example.org/w/api.php',
	'loadScript' => '//meta.example.org/w/load.php',
];
$wgGlobalCssJsConfig = [
	'wiki' => 'metawiki', // database name
	'source' => 'metawiki', // ResourceLoader source name
];
# GlobalPreferences
$wgGlobalPreferencesDB = $wgSharedDB;

# GlobalUserrights
$wgSharedTables[] = 'global_user_groups';
$wgGroupPermissions['staff']['userrights-global'] = false; // Needs to be unset, as it is assigned automatically
$wgGroupPermissions['steward']['userrights-global'] = true;

# InterWiki
$wgInterwikiCentralDB = $wgSharedDB;
$wgGroupPermissions['sysop']['interwiki'] = true;
$wgGroupPermissions['steward']['interwiki'] = true;

# Maintenance
$wgGroupPermissions['steward']['maintenance'] = true;

# MessageCommons
$wgMessageCommonsLang = 'en';
$wgMessageCommonsDatabase = $wgSharedDB;
$wgMessageCommonsIsCommons = $wgDBname === $wgSharedDB;

# Nuke
$wgGroupPermissions['steward']['nuke'] = true;

# OAuth
$wgMWOAuthCentralWiki = $wgSharedDB;
$wgMWOAuthSecureTokenTransfer = true; // If the wikis do not use https, set this to false
$wgGroupPermissions['autoconfirmed']['mwoauthproposeconsumer'] = true;
$wgGroupPermissions['autoconfirmed']['mwoauthupdateownconsumer'] = true;
$wgGroupPermissions['steward']['mwoauthmanageconsumer'] = true;
$wgGroupPermissions['steward']['mwoauthsuppress'] = true;
$wgGroupPermissions['steward']['mwoauthviewsuppressed'] = true;
$wgGroupPermissions['steward']['mwoauthviewprivate'] = true;

# PdfHandler
$wgPdfProcessor = '/usr/bin/gs';
$wgPdfPostProcessor = $wgImageMagickConvertCommand;
$wgPdfInfo = '/usr/bin/pdfinfo';
$wgPdftoText = '/usr/bin/pdftotext';

# RenameUser
$wgGroupPermissions['bureaucrat']['renameuser'] = false;

# SpamBlacklist
$wgSpamBlacklistFiles = [
	"[[m:Spam blacklist]]", // Wikimedia's list
    // Spam black list from the central wiki
	//   database				title
	"DB: $wgSharedDB MediaWiki:Global-spam-blacklist",
];

# SiteMatrix
$wgSiteMatrixFile = "$configDir/langlist";
$wgSiteMatrixPrivateSites = "$configDir/dblists/private.dblist";
$wgSiteMatrixFishbowlSites = "$configDir/dblists/restricted.dblist";
$wgSiteMatrixClosedSites = "$configDir/dblists/closed.dblist";
$wgSiteMatrixSites = [
	'wiki' => [
		'name' => 'Example',
		'host' => 'www.example.org',
		'prefix' => 'w',
	]
];

# TitleBlackList
$wgTitleBlackListSources = [
	[
		'type' => 'url',
	    'src' => 'https://meta.example.org/w/index.php?title=MediaWiki:Global-title-blacklist'
	]
];

# UserMerge
$wgGroupPermissions['steward']['usermerge'] = true;
$wgUserMergeProtectedGroups = [ 'steward' ];
