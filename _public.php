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

$core->addBehavior('publicFooterContent',array('cookiechoicesPublicBehaviours','publicFooterContent'));

class cookiechoicesPublicBehaviours
{
	public static function publicFooterContent($core)
	{
		if ($core->blog->settings->cookiechoices->enabled && $core->blog->settings->cookiechoices->message != '') {

			$res .= '<script type="text/javascript" src="'.html::stripHostURL($core->blog->getQmarkURL().'pf=cookiechoices/js/cookiechoices.js').
					'"></script>'."\n";
			$res .= '<script type="text/javascript">'."\n".
				 	'document.addEventListener(\'DOMContentLoaded\', function(event) {'."\n";
			if ($core->blog->settings->cookiechoices->topbar) {
				$res .= '    cookieChoices.showCookieConsentBar('."\n";
			} else {
				$res .= '    cookieChoices.showCookieConsentDialog('."\n";
			}
			$res .= '		\''.html::escapeJS($core->blog->settings->cookiechoices->message).'\','."\n".
					'		\''.html::escapeJS($core->blog->settings->cookiechoices->close).'\','."\n".
					'		\''.html::escapeJS($core->blog->settings->cookiechoices->learnmore).'\','."\n".
					'		\''.html::escapeJS($core->blog->settings->cookiechoices->url).'\');'."\n".
					'});'."\n".
					'</script>'."\n";

			echo $res;
		}
	}
}
