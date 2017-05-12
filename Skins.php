<?php
# These skins are always loaded on all projects
$wgRegistrationSkins = [
	'Vector'
];

# Skins available on request
if ( $fgUseCologneBlue ) {
	$wgRegistrationSkins[] = 'CologneBlue';
}

if ( $fgUseModern ) {
	$wgRegistrationSkins[] = 'Modern';
}

if ( $fgUseMonoBook ) {
	$wgRegistrationSkins[] = 'MonoBook';
}

# Load skins supporting Skin registration
wfLoadSkins( $wgRegistrationSkins );

# Set vector as the fallback skin if the site uses a different default skin
if ( $wgDefaultSkin !== 'vector' ) {
	$wgFallbackSkin = 'vector';
}
