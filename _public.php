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

use Dotclear\Helper\Html\Html;

class cookiechoicesPublicBehaviours
{
    public static function publicFooterContent()
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
                $res .= '   \'' . Html::escapeJS(dcCore::app()->blog->settings->cookiechoices->message) . '\',' . "\n" .
                '   \'' . Html::escapeJS(dcCore::app()->blog->settings->cookiechoices->close) . '\',' . "\n" .
                '   \'' . Html::escapeJS(dcCore::app()->blog->settings->cookiechoices->learnmore) . '\',' . "\n" .
                '   \'' . Html::escapeJS(dcCore::app()->blog->settings->cookiechoices->url) . '\',' . "\n" .
                    '   ' . (dcCore::app()->blog->settings->cookiechoices->appearance == 1 ? 'false' : 'true') . ');' . "\n" .
                    '});' . "\n" .
                    '</script>' . "\n";

                echo $res;
            }
        }
    }
}

dcCore::app()->addBehavior('publicFooterContent', [cookiechoicesPublicBehaviours::class, 'publicFooterContent']);
