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

if (!defined('DC_CONTEXT_ADMIN')) { return; }

$this_version = $core->plugins->moduleInfo('cookiechoices','version');
$installed_version = $core->getVersion('cookiechoices');

if (version_compare($installed_version,$this_version,'>=')) {
	return;
}

$core->blog->settings->addNamespace('cookiechoices');
$core->blog->settings->cookiechoices->put('message','By using our services, you agree to our use of cookies.','string','Visitor message',true,true);
$core->blog->settings->cookiechoices->put('close','Got it','string','Close message',true,true);
$core->blog->settings->cookiechoices->put('learnmore','Learn more','string','Learn more message',true,true);
$core->blog->settings->cookiechoices->put('url','https://www.cookiechoices.org/','string','Learn more URL',true,true);
$core->blog->settings->cookiechoices->put('topbar',false,'boolean','Display message as a bar on top',true,true);

$core->setVersion('cookiechoices',$this_version);

return true;
