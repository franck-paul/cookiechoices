<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
# This file is part of cookiechoices, a plugin for Dotclear 2.
#
# Copyright (c) Franck Paul and contributors
#
# Licensed under the GPL version 3.0 license.
# A copy of this license is available in LICENSE file or at
# http://www.gnu.org/licenses/gpl-3.0.html
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
	/* Name */			"cookiechoices",
	/* Description*/	"Cookie Consent System",
	/* Author */		"Franck Paul",
	/* Version */		'0.4',
	array(
		/* Permissions */	'permissions' =>	'contentadmin',
		/* Type */			'type' =>			'plugin'
	)
);
