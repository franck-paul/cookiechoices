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

if (!defined('DC_RC_PATH')) {return;}

$core->addBehavior('publicFooterContent', ['cookiechoicesPublicBehaviours', 'publicFooterContent']);

class cookiechoicesPublicBehaviours
{
    public static function publicFooterContent($core)
    {
        if ($core->blog->settings->cookiechoices->enabled && $core->blog->settings->cookiechoices->message != '') {
            if ($core->blog->settings->cookiechoices->anywhere || $core->url->type == 'default') {
                $res = dcUtils::jsLoad($core->blog->getPF('cookiechoices/js/cookiechoices.js'));
                $res .= '<script type="text/javascript">' . "\n" .
                    'document.addEventListener(\'DOMContentLoaded\', function(event) {' . "\n";
                if (!$core->blog->settings->cookiechoices->appearance) {
                    $res .= '    cookieChoices.showCookieConsentDialog(' . "\n";
                } else {
                    $res .= '    cookieChoices.showCookieConsentBar(' . "\n";
                }
                $res .= '   \'' . html::escapeJS($core->blog->settings->cookiechoices->message) . '\',' . "\n" .
                '   \'' . html::escapeJS($core->blog->settings->cookiechoices->close) . '\',' . "\n" .
                '   \'' . html::escapeJS($core->blog->settings->cookiechoices->learnmore) . '\',' . "\n" .
                '   \'' . html::escapeJS($core->blog->settings->cookiechoices->url) . '\',' . "\n" .
                    '   ' . ($core->blog->settings->cookiechoices->appearance == 1 ? 'false' : 'true') . ');' . "\n" .
                    '});' . "\n" .
                    '</script>' . "\n";

                echo $res;
            }
        }
    }
}
