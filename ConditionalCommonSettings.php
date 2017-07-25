<?php
# Conditional Common settings contains larger code blocks toggled by a configuration setting in
# $wgConf.
# For user groups, please keep all rights sorted alphabetically

if ( $fgEnableGroupRollback ) {
	$wgGroupPermissions['rollback']['markbotedits'] = true;
	$wgGroupPermissions['rollback']['rollback'] = true;

	$wgRemoveGroups['bureaucrat'][] = 'rollback';
	$wgAddGroups['bureaucrat'][] = 'rollback';
}

if ( $fgEnableGroupContentModerator ) {
	$wgGroupPermissions['content-moderator']['autopatrol'] = true;
	$wgGroupPermissions['content-moderator']['delete'] = true;
	$wgGroupPermissions['content-moderator']['movefile'] = true;
	$wgGroupPermissions['content-moderator']['protect'] = true;
	$wgGroupPermissions['content-moderator']['patrol'] = true;
	$wgGroupPermissions['content-moderator']['patrolmarks'] = true;
	$wgGroupPermissions['content-moderator']['undelete'] = true;

	$wgRemoveGroups['bureaucrat'][] = 'content-moderator';
	$wgAddGroups['bureaucrat'][] = 'content-moderator';
}

if ( $fgEnableGroupAutopatrol ) {
	$wgGroupPermissions['autopatrol']['autopatrol'] = true;

	$wgRemoveGroups['bureaucrat'][] = 'autopatrol';
	$wgAddGroups['bureaucrat'][] = 'autopatrol';
}

if ( $fgEnableGroupPatroller ) {
	$wgGroupPermissions['patroller']['autopatrol'] = true;
	$wgGroupPermissions['patroller']['patrol'] = true;
	$wgGroupPermissions['patroller']['patrolmarks'] = true;

	$wgRemoveGroups['bureaucrat'][] = 'patroller';
	$wgAddGroups['bureaucrat'][] = 'patroller';
}

# Login Required Wikis require creating an account and logging in before editing
if ( $fgLoginRequiredWiki ) {
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['writeapi'] = false;

	# Restricted Wikis require having an account and being invited before editing
	if ( $fgRestrictedWiki ) {
		$wgGroupPermissions['user']['edit'] = false;
		$wgGroupPermissions['user']['writeapi'] = false;

		$wgGroupPermissions['invited']['edit'] = true;
		$wgGroupPermissions['invited']['writeapi'] = true;
		$wgGroupPermissions['bureaucrat']['edit'] = true;
		$wgGroupPermissions['bureaucrat']['writeapi'] = true;
		$wgGroupPermissions['steward']['edit'] = true;
		$wgGroupPermissions['steward']['writeapi'] = true;

		$wgRemoveGroups['bureaucrat'][] = 'invited';
		$wgAddGroups['bureaucrat'][] = 'invited';

		# Private Wikis are not readable by anyone but those invited, stewards and local bureaucrats
		if ( $fgPrivateWiki ) {
			$wgGroupPermissions['*']['read'] = false;
			$wgGroupPermissions['user']['read'] = false;
			$wgGroupPermissions['invited']['read'] = true;
			$wgGroupPermissions['bureaucrat']['read'] = true;
			$wgGroupPermissions['steward']['read'] = true;
		}
	}
}

# Closed wikis are read-only, but may be edited by stewards
if ( $fgClosedWiki ) {
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['createaccount'] = false;
	$wgGroupPermissions['*']['writeapi'] = false;
	$wgGroupPermissions['user']['edit'] = false;
	$wgGroupPermissions['user']['createaccount'] = false;
	$wgGroupPermissions['user']['writeapi'] = false;
	$wgGroupPermissions['sysop']['block'] = false;
	$wgGroupPermissions['sysop']['createaccount'] = false;
	$wgGroupPermissions['sysop']['delete'] = false;
	$wgGroupPermissions['sysop']['editsemiprotected'] = false;
	$wgGroupPermissions['sysop']['editprotected'] = false;
	$wgGroupPermissions['sysop']['import'] = false;
	$wgGroupPermissions['sysop']['patrol'] = false;
	$wgGroupPermissions['sysop']['protect'] = false;
	$wgGroupPermissions['sysop']['rollback'] = false;
	$wgGroupPermissions['sysop']['undelete'] = false;
	$wgGroupPermissions['sysop']['upload'] = false;
	$wgGroupPermissions['bot']['editsemiprotected'] = false;
	$wgGroupPermissions['bot']['writeapi'] = false;

	# Custom groups
	if ( $fgEnableGroupRollback ) {
		$wgGroupPermissions['rollback']['rollback'] = false;
	}

	if ( $fgEnableGroupContentModerator ) {
		$wgGroupPermissions['content-moderator']['delete'] = false;
		$wgGroupPermissions['content-moderator']['movefile'] = false;
		$wgGroupPermissions['content-moderator']['protect'] = false;
		$wgGroupPermissions['content-moderator']['undelete'] = false;
	}

	if ( $fgEnableGroupPatroller ) {
		$wgGroupPermissions['patroller']['patrol'] = false;
	}

	# Stewards may edit closed wikis
	$wgGroupPermissions['steward']['createaccount'] = true;
	$wgGroupPermissions['steward']['edit'] = true;
	$wgGroupPermissions['steward']['move'] = true;
	$wgGroupPermissions['steward']['move-subpages'] = true;
	$wgGroupPermissions['steward']['writeapi'] = true;
}
