<?php
/**
 * @brief cookiechoices, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
if (!defined('DC_RC_PATH')) {
    return;
}

dcCore::app()->addBehavior('publicFooterContent', ['cookiechoicesPublicBehaviours', 'publicFooterContent']);

class cookiechoicesPublicBehaviours
{
    public static function publicFooterContent($core)
    {
        if (dcCore::app()->blog->settings->cookiechoices->enabled && dcCore::app()->blog->settings->cookiechoices->message != '') {
            if (dcCore::app()->blog->settings->cookiechoices->anywhere || dcCore::app()->url->type == 'default') {
                $res = dcUtils::jsModuleLoad('cookiechoices/js/cookiechoices.js');
                $res .= '<script>' . "\n" .
                    'document.addEventListener(\'DOMContentLoaded\', function(event) {' . "\n";
                if (!dcCore::app()->blog->settings->cookiechoices->appearance) {
                    $res .= '    cookieChoices.showCookieConsentDialog(' . "\n";
                } else {
                    $res .= '    cookieChoices.showCookieConsentBar(' . "\n";
                }
                $res .= '   \'' . html::escapeJS(dcCore::app()->blog->settings->cookiechoices->message) . '\',' . "\n" .
                '   \'' . html::escapeJS(dcCore::app()->blog->settings->cookiechoices->close) . '\',' . "\n" .
                '   \'' . html::escapeJS(dcCore::app()->blog->settings->cookiechoices->learnmore) . '\',' . "\n" .
                '   \'' . html::escapeJS(dcCore::app()->blog->settings->cookiechoices->url) . '\',' . "\n" .
                    '   ' . (dcCore::app()->blog->settings->cookiechoices->appearance == 1 ? 'false' : 'true') . ');' . "\n" .
                    '});' . "\n" .
                    '</script>' . "\n";

                echo $res;
            }
        }
    }
}
