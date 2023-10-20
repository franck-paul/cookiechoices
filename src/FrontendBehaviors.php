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
declare(strict_types=1);

namespace Dotclear\Plugin\cookiechoices;

use Dotclear\App;
use Dotclear\Helper\Html\Html;

class FrontendBehaviors
{
    public static function publicFooterContent(): string
    {
        $settings = My::settings();
        if ($settings->enabled && $settings->message != '') {
            if ($settings->anywhere || App::url()->type == 'default') {
                $res = My::jsLoad('cookiechoices.js');
                $res .= '<script>' . "\n" .
                    'document.addEventListener(\'DOMContentLoaded\', function(event) {' . "\n";
                if (!$settings->appearance) {
                    $res .= '    cookieChoices.showCookieConsentDialog(' . "\n";
                } else {
                    $res .= '    cookieChoices.showCookieConsentBar(' . "\n";
                }
                $res .= '   \'' . Html::escapeJS($settings->message) . '\',' . "\n" .
                '   \'' . Html::escapeJS($settings->close) . '\',' . "\n" .
                '   \'' . Html::escapeJS($settings->learnmore) . '\',' . "\n" .
                '   \'' . Html::escapeJS($settings->url) . '\',' . "\n" .
                    '   ' . ($settings->appearance == 1 ? 'false' : 'true') . ');' . "\n" .
                    '});' . "\n" .
                    '</script>' . "\n";

                echo $res;
            }
        }

        return '';
    }
}
