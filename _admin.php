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

// dead but useful code, in order to have translations
__('cookiechoices').__('Cookie Consent System');

$core->addBehavior('adminBlogPreferencesForm',array('cookiechoicesAdminBehaviours','adminBlogPreferencesForm'));
$core->addBehavior('adminBeforeBlogSettingsUpdate',array('cookiechoicesAdminBehaviours','adminBeforeBlogSettingsUpdate'));

class cookiechoicesAdminBehaviours
{
	public static function adminBlogPreferencesForm($core,$settings)
	{
		$settings->addNameSpace('cookiechoices');
		echo
		'<div class="fieldset"><h4>'.__('Cookie Consent System').'</h4>'.
		'<p><label class="classic">'.
		form::checkbox('cookiechoices_enabled','1',html::escapeHTML($settings->cookiechoices->enabled)).
		__('Enable Cookie Consent System').'</label></p>'.
		'<p><label>'.
		__('Your message for visitors here:')." ".
		form::field('cookiechoices_message',50,255,html::escapeHTML($settings->cookiechoices->message)).
		'</label></p>'.
		'<p class="form-note">'.__('Example:').' '.__('Cookies help us deliver our services. By using our services, you agree to our use of cookies.').'</p>'.
		'<p><label>'.
		__('Close message:')." ".
		form::field('cookiechoices_close',30,255,html::escapeHTML($settings->cookiechoices->close)).
		'</label></p>'.
		'<p class="form-note">'.__('Example:').' '.__('Got it').'</p>'.
		'<p><label>'.
		__('Learn more message:')." ".
		form::field('cookiechoices_learnmore',30,255,html::escapeHTML($settings->cookiechoices->learnmore)).
		'</label></p>'.
		'<p class="form-note">'.__('Example:').' '.__('Learn more').'</p>'.
		'<p><label>'.
		__('URL (learn more):')." ".
		form::field('cookiechoices_url',30,255,html::escapeHTML($settings->cookiechoices->url)).
		'</label></p>'.
		'<p class="form-note">'.__('Example:').' '.__('https://www.cookiechoices.org/').'</p>'.
		'<p><label class="classic">'.
		form::checkbox('cookiechoices_topbar','1',html::escapeHTML($settings->cookiechoices->topbar)).
		__('Display message as a bar on top').'</label></p>'.
		'</div>';
	}
	public static function adminBeforeBlogSettingsUpdate($settings)
	{
		$settings->addNameSpace('cookiechoices');
		$settings->cookiechoices->put('enabled',!empty($_POST['cookiechoices_enabled']),'boolean');
		$settings->cookiechoices->put('message',empty($_POST['cookiechoices_message'])?"":$_POST['cookiechoices_message'],'string');
		$settings->cookiechoices->put('close',empty($_POST['cookiechoices_close'])?"":$_POST['cookiechoices_close'],'string');
		$settings->cookiechoices->put('learnmore',empty($_POST['cookiechoices_learnmore'])?"":$_POST['cookiechoices_learnmore'],'string');
		$settings->cookiechoices->put('url',empty($_POST['cookiechoices_url'])?"":$_POST['cookiechoices_url'],'string');
		$settings->cookiechoices->put('topbar',!empty($_POST['cookiechoices_topbar']),'boolean');
	}
}
