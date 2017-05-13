<?php
# These extensions are available on request, but some are enabled by default
if ( $fgUseAbuseFilter ) {
	wfLoadExtension( 'AbuseFilter' );
	$wgAbuseFilterCentralDB = $wgSharedDB;
	$wgAbuseFilterIsCentral = $wgDBname === $wgSharedDB;
	## Adding rights
	### Everyone
	$wgGroupPermissions['*']['abusefilter-log-detail'] = true;
	$wgGroupPermissions['*']['abusefilter-view'] = true;
	$wgGroupPermissions['*']['abusefilter-log'] = true;
	### Sysop
	$wgGroupPermissions['sysop']['abusefilter-modify'] = true;
	$wgGroupPermissions['sysop']['abusefilter-log-private'] = true;
	$wgGroupPermissions['sysop']['abusefilter-private'] = true;
	$wgGroupPermissions['sysop']['abusefilter-revert'] = true;
	$wgGroupPermissions['sysop']['abusefilter-view-private'] = true;
	### Stewards
	$wgGroupPermissions['steward']['abusefilter-hidden-log'] = true;
	$wgGroupPermissions['steward']['abusefilter-hide-log'] = true;
	$wgGroupPermissions['steward']['abusefilter-log-private'] = true;
	$wgGroupPermissions['steward']['abusefilter-modify'] = true;
	$wgGroupPermissions['steward']['abusefilter-modify-restricted'] = true;
	$wgGroupPermissions['steward']['abusefilter-private'] = true;
	$wgGroupPermissions['steward']['abusefilter-revert'] = true;
	$wgGroupPermissions['steward']['abusefilter-view-private'] = true;
}

if ( $fgUseBabel ) {
	wfLoadExtension( 'Babel' );
	$wgConf->extractGlobal( 'wgBabelMainCategory', $wgDBname );
}

if ( $fgUseBetaFeatures ) {
	wfLoadExtension( 'BetaFeatures' );
}

if ( $fgUseDisambiguator ) {
	wfLoadExtension( 'Disambiguator' );
}

if ( $fgUseDPL3 ) {
	wfLoadExtension( 'DynamicPageList' );
	$wgConf->extractGlobal( 'wgDplSettings', $wgDBname );
}

if ( $fgUseEcho ) {
	wfLoadExtension( 'Echo' );

	$wgEchoSharedTrackingDB = $wgSharedDB;
	$wgEchoCrossWikiNotifications = true;
	$wgEchoUseCrossWikiBetaFeature = true;
	$wgFlowUseMemcache = false; // Until memcached has been setup
	$wgFlowSearchServers = $wgCirrusSearchServers;

	if ( $fgUseThanks ) {
		wfLoadExtension('Thanks' );
	}

	if ( $fgUseFlow ) {
		wfLoadExtension( 'Flow' );

		$wgFlowDefaultWikiDb = $wgSharedDB;

		if ( $fgEnableGroupContentModerator ) {
			$wgGroupPermissions['content-moderator']['flow-create-board'] = true;
		}
		$wgGroupPermissions['sysop']['flow-create-board'] = true;
		$wgGroupPermissions['steward']['flow-create-board'] = true;


		$wgGroupPermissions['steward']['flow-create-post'] = true;
	}
}

if ( $fgUseEditCount ) {
	wfLoadExtension( 'EditCount' );
}

if ( $fgUseGadgets ) {
	wfLoadExtension( 'Gadgets' );

	$wgGroupPermissions['sysop']['gadgets-edit'] = true;
	$wgGroupPermissions['sysop']['gadgets-definition-edit'] = true;
	$wgGroupPermissions['steward']['gadgets-edit'] = true;
	$wgGroupPermissions['steward']['gadgets-definition-edit'] = true;
}

if ( $fgUseGlobalUserPage ) {
	wfLoadExtension( 'GlobalUserPage' );
}

// ImageMap requires Uploads to be enabled
if ( $fgUseImageMap && $wgEnableUploads ) {
	wfLoadExtension( 'ImageMap' );
}

if ( $fgUseLabeledSectionTransclusion ) {
	wfLoadExtension( 'LabeledSectionTransclusion' );
}

if ( $fgUseNewUserMessage ) {
	wfLoadExtension( 'NewUserMessage' );
}

if ( $fgUseSandboxLink ) {
	wfLoadExtension( 'SandboxLink' );
}
