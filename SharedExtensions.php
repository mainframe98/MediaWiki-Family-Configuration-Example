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
	'Elastica', # CirrusSearch dependency
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
	'ParserFunctions',
	'PdfHandler',
	'Poem',
	'RefreshSpecial',
	'RenameUser',
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
$wgCirrusSearchServers = [ 'localhost' ]; //TODO: Verify me!
## Turn off leading wildcard matches, they are a very slow and inefficient query
$wgCirrusSearchAllowLeadingWildcard = false;

# GlobalBlocking
$wgApplyGlobalBlocks = $wgDBname !== 'metawiki'; // Don't apply a global block on meta, so it can be used to contest a global block
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
$wgMessageCommonsIsCommons = 'metawiki' === $wgDBname;

# Nuke
$wgGroupPermissions['steward']['nuke'] = true;

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
	//  database				title
	"DB: metawiki MediaWiki:Global-spam-blacklist",
];

# SiteMatrix
$wgSiteMatrixFile = "$IP/config/langlist";
$wgSiteMatrixPrivateSites = "$IP/config/dblists/private.dblist";
$wgSiteMatrixFishbowlSites = "$IP/config/dblists/restricted.dblist";
$wgSiteMatrixClosedSites = "$IP/config/dblists/closed.dblist";

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
