<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}
## This file contains all the settings shared among all wikis.
## Ideally, you'd set this once and forget about it. As such,
## you set settings that wikis would like to override not here,
## but in InitialiseSettings.php instead.

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "/w";
$wgArticlePath = "/wiki/$1";

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

$wgEmergencyContact = "info@example.org";
$wgPasswordSender = "reset-password@example.org";

## UPO means: this is also a user preference option

$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

# Shared Database related settings
$wgSharedDB = 'metawiki';

# Shared Bot passwords database
$wgBotPasswordsDatabase = $wgSharedDB;

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgUploadDirectory = "{$wgScriptPath}/$wgDBname/images";
$wgUploadPath = $wgUploadDirectory;
$wgAllowCopyUploads = true;
$wgCopyUploadsFromSpecialUpload = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = true;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "C.UTF-8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publicly accessible from the web.
$wgCacheDirectory = "$IP/cache";

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# User css/jss
$wgAllowUserCss = true;
$wgAllowUserJs = true;

# Allow PageLanguage change
$wgPageLanguageUseDB = true;

# Enable MiserMode to reduce server load
$wgMiserMode = true;

# Remove user_properties from the shared tables as Extension:GlobalPreferences takes care of this
unset( $wgSharedTables['user_properties'] );

# User rights - Remember to place rights for extensions that aren't loaded by default in their
# block in Extensions.php!
# This will prevent those right showing up for wikis where they don't exist.
## Adding
### Sysop
$wgGroupPermissions['sysop']['editcontentmodel'] = true;
$wgGroupPermissions['sysop']['pagelang'] = true;
$wgGroupPermissions['sysop']['patrolmarks'] = true;

## Remove some of the built-in rights
### User
$wgGroupPermissions['user']['movefile'] = false;
### Bureaucrat
$wgGroupPermissions['bureaucrat']['userrights'] = false;

## Rearange them
### Bureaucrat
$wgGroupPermissions['bureaucrat']['unblockself'] = true;

## Global group permissions
### Stewards
$wgGroupPermissions['steward']['apihighlimits'] = true;
$wgGroupPermissions['steward']['autopatrol'] = true;
$wgGroupPermissions['steward']['autoconfirmed'] = true;
$wgGroupPermissions['steward']['bigdelete'] = true;
$wgGroupPermissions['steward']['block'] = true;
$wgGroupPermissions['steward']['blockemail'] = true;
$wgGroupPermissions['steward']['browsearchive'] = true;
$wgGroupPermissions['steward']['checkuser'] = true;
$wgGroupPermissions['steward']['checkuser-log'] = true;
$wgGroupPermissions['steward']['delete'] = true;
$wgGroupPermissions['steward']['deletedtext'] = true;
$wgGroupPermissions['steward']['deletedhistory'] = true;
$wgGroupPermissions['steward']['deletedtext'] = true;
$wgGroupPermissions['steward']['deletelogentry'] = true;
$wgGroupPermissions['steward']['deleterevision'] = true;
$wgGroupPermissions['steward']['disableaccount'] = true;
$wgGroupPermissions['steward']['editcontentmodel'] = true;
$wgGroupPermissions['steward']['editinterface'] = true;
$wgGroupPermissions['steward']['editprotected'] = true;
$wgGroupPermissions['steward']['editusercss'] = true;
$wgGroupPermissions['steward']['edituserjs'] = true;
$wgGroupPermissions['steward']['extensions'] = true;
$wgGroupPermissions['steward']['extensions-all'] = true;
$wgGroupPermissions['steward']['gadgets-edit'] = true;
$wgGroupPermissions['steward']['gadgets-definition-edit'] = true;
$wgGroupPermissions['steward']['global-block'] = true;
$wgGroupPermissions['steward']['global-unblock'] = true;
$wgGroupPermissions['steward']['hideuser'] = true;
$wgGroupPermissions['steward']['import'] = true;
$wgGroupPermissions['steward']['importupload'] = true;
$wgGroupPermissions['steward']['ipblock-exempt'] = true;
$wgGroupPermissions['steward']['lookupuser'] = true;
$wgGroupPermissions['steward']['maintenance'] = true;
$wgGroupPermissions['steward']['managechangetags'] = true;
$wgGroupPermissions['steward']['markbotedits'] = true;
$wgGroupPermissions['steward']['mergehistory'] = true;
$wgGroupPermissions['steward']['movefile'] = true;
$wgGroupPermissions['steward']['move-categorypages'] = true;
$wgGroupPermissions['steward']['move-rootuserpages'] = true;
$wgGroupPermissions['steward']['noratelimit'] = true;
$wgGroupPermissions['steward']['override-antispoof'] = true;
$wgGroupPermissions['steward']['override-export-depth'] = true;
$wgGroupPermissions['steward']['pagelang'] = true;
$wgGroupPermissions['steward']['patrol'] = true;
$wgGroupPermissions['steward']['patrolmarks'] = true;
$wgGroupPermissions['steward']['protect'] = true;
$wgGroupPermissions['steward']['proxyunbannable'] = true;
$wgGroupPermissions['steward']['refreshspecial'] = true;
$wgGroupPermissions['steward']['renameuser'] = true;
$wgGroupPermissions['steward']['rollback'] = true;
$wgGroupPermissions['steward']['spamblacklistlog'] = true;
$wgGroupPermissions['steward']['suppressionlog'] = true;
$wgGroupPermissions['steward']['suppressrevision'] = true;
$wgGroupPermissions['steward']['tboverride'] = true;
$wgGroupPermissions['steward']['tboverride-account'] = true;
$wgGroupPermissions['steward']['titleblacklistlog'] = true;
$wgGroupPermissions['steward']['usermerge'] = true;
$wgGroupPermissions['steward']['userrights'] = true;
$wgGroupPermissions['steward']['userrights-interwiki'] = true;
$wgGroupPermissions['steward']['unblockself'] = true;
$wgGroupPermissions['steward']['undelete'] = true;
$wgGroupPermissions['steward']['unwatchedpages'] = true;
$wgGroupPermissions['steward']['upload'] = true;
$wgGroupPermissions['steward']['upload_by_url'] = true;
### Bot-global
$wgGroupPermissions['bot-global'] = $wgGroupPermissions['bot'];

# Allow any user to remove their own rights
$wgGroupsRemoveFromSelf['user'] = true;

# Allow bureaucrats to set local rights
$wgAddGroups['bureaucrat'] = [ 'sysop', 'bot', 'bureaucrat' ];
$wgRemoveGroups['bureaucrat'] = [ 'sysop', 'bot' ];
