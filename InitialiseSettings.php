<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

# All wiki settings. Remember to save any default settings here, and not in CommonSettings.php
$wgConf->settings = [
	// General settings
	'wgLanguageCode' => [
		'default' => 'en'
	],
	'wgCapitalLinks' => [
		'default' => true,
	],
	'wgEnableEmail' => [
		'default' => true
	],
	'wgEnableScaryTranscluding' => [
		'default' => false
	],
	'wgEnableUploads' => [
		'default' => true
	],
	'wgEnableUserEmail' => [
		'default' => true
	],
	'wgLocaltimezone' => [
		'default' => 'UTC'
	],
	'wgLogo' => [
		'default' => "$wgScriptPath/images/" . $wgDBname . '_logo.png'
	],
	'fgLoginRequiredWiki' => [
		'default' => false,
		'loginonly' => true,
		'restricted' => true,
		'private' => true
	],
	'fgRestrictedWiki' => [
		'default' => false,
		'restricted' => true,
		'private' => true
	],
	'fgPrivateWiki' => [
		'default' => false,
		'private' => true
	],
	'fgClosedWiki' => [
		'default' => false,
		'closed' => true
	],
	'wgRightsIcon' => [
		'default' => "$wgResourceBasePath/resources/assets/licenses/cc-by-sa.png"
	],
	'wgRightsPage' => [
		'default' => 'Project:Copyright'
	],
	'wgRightsText' => [
		'default' => 'Creative Commons Naamsvermelding-Gelijk delen'
	],
	'wgRightsUrl' => [
		'default' => 'https://creativecommons.org/licenses/by-sa/4.0/'
	],
	'wgServer' => [
		'default' => "//$wikiname.example.org"
	],
	'wgMetaNamespace' => [
		'default' => null // Set to null to be generated automatically from $wgSitename
	],
	// InstantCommons allows wiki to use images from https://commons.wikimedia.org
	'wgUseInstantCommons' => [
		'default' => false
	],
	'wgUseSiteJs' => [
		'default' => false // Disabled for security reasons, request
	],
	// Don't add rel="nofollow" for these domains, as these sites are not external
	'wgNoFollowDomainExceptions' => [
		'default' => [
			'https://www.example.org'
		]
	],
	// This only needs to be set for wikis where $fgPrivateWiki = true
	// Remember to add a + before the name of the wiki, as the array must be merged!
	'wgWhitelistRead' => [
		'default' => [
			'Special:RunJobs',
			'Main Page',
			'MediaWiki:Common.css', // Custom CSS on the whitelisted pages should be visible
			'MediaWiki:Common.js', // Custom JavaScript on the whitelisted pages should work
			'Special:OAuth' // Required for OAuth functionality
		]
	],
	// Extensions
	'fgUseAbuseFilter' => [
		'default' => false,
	],
	'fgUseBabel' => [
		'default' => false,
	],
	'wgBabelMainCategory' => [
		'default' => [
			'0' => 'User %code%-0',
			'1' => 'User %code%-1',
			'2' => 'User %code%-2',
			'3' => 'User %code%-3',
			'4' => 'User %code%-4',
			'5' => 'User %code%-5',
			'N' => 'User %code%-N'
		]
	],
	'wgBabelCategoryNames' => [
		'default' => 'User %code%'
	],
	'fgUseBetaFeatures' => [
		'default' => false
	],
	'fgUseDisambiguator' => [
		'default' => true
	],
	'fgUseDPL3' => [
		'default' => false
	],
	'wgDplSettings' => [
		'default' => [
			'functionalRichness' => 1
		]
	],
	'fgUseEcho' => [
		'default' => false,
		'echo' => true,
		'flow' => true, // Flow depends on echo
		'thanks' => true // So does thanks
	],
	'fgUseFlow' => [
		'default' => false,
		'flow' => true,
	],
	 'fgUseThanks' => [
		'default' => false
	 ],
	 'fgUseEditcount' => [
		'default' => true
	 ],
	 'fgUseGadgets' => [
		'default' => false
	 ],
	 'fgUseGlobalUserPage' => [
		'default' => true
	 ],
	 'fgUseImageMap' => [
		'default' => true
	 ],
	'fgUseLabeledSectionTransclusion' => [
		'default' => false
	 ],
	'fgUseNewUserMessage' => [
		'default' => false
	],
	'fgUseSandboxLink' => [
		'default' => false
	],
	// Skins
	'wgDefaultSkin' => [
		'default' => 'Vector'
	],
	'fgUseCologneBlue' => [
		'default' => true
	],
	'fgUseModern' => [
		'default' => true
	],
	'fgUseMonoBook' => [
		'default' => true
	],
	// Groups
	'fgEnableGroupAutopatrol' => [
		'default' => true
	],
	'fgEnableGroupPatroller' => [
		'default' => false
	],
	'fgEnableGroupContentModerator' => [
		'default' => true
	],
	'fgEnableGroupRollback' => [
		'default' => true
	],
];
