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
			if ($core->blog->settings->cookiechoices->anywhere || $core->url->type == 'default') {
				$res = dcUtils::jsLoad($core->blog->getPF('cookiechoices/js/cookiechoices.js'));
				$res .= '<script type="text/javascript">'."\n".
					 	'document.addEventListener(\'DOMContentLoaded\', function(event) {'."\n";
				if (!$core->blog->settings->cookiechoices->appearance) {
					$res .= '    cookieChoices.showCookieConsentDialog('."\n";
				} else {
					$res .= '    cookieChoices.showCookieConsentBar('."\n";
				}
				$res .= '		\''.html::escapeJS($core->blog->settings->cookiechoices->message).'\','."\n".
						'		\''.html::escapeJS($core->blog->settings->cookiechoices->close).'\','."\n".
						'		\''.html::escapeJS($core->blog->settings->cookiechoices->learnmore).'\','."\n".
						'		\''.html::escapeJS($core->blog->settings->cookiechoices->url).'\','."\n".
						'		'.($core->blog->settings->cookiechoices->appearance == 1 ? 'false' : 'true').');'."\n".
						'});'."\n".
						'</script>'."\n";

				echo $res;
			}
		}
	}
}
