<?php
# These extensions are available on request, but some are enabled by default
if ( $fgUseAbuseFilter ) {
	wfLoadExtension( 'AbuseFilter' );
	$wgAbuseFilterCentralDB = $wgSharedDB;
	$wgAbuseFilterIsCentral = $wgDBname === 'metawiki';
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

	if ( $fgUseThanks ) {
		wfLoadExtension('Thanks' );
	}

	if ( $fgUseFlow ) {
		wfLoadExtension( 'Flow' );
	}
}

if ( $fgUseEditCount ) {
	wfLoadExtension( 'EditCount' );
}

if ( $fgUseGadgets ) {
	wfLoadExtension( 'Gadgets' );
}

if ( $fgUseGlobalUserPage ) {
	wfLoadExtension( 'GlobalUserPage' );
}

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
