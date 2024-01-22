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
        if ($settings->enabled && $settings->message !== '' && ($settings->anywhere || App::url()->getType() == 'default')) {
            echo
            My::jsLoad('cookiechoices.js') .
            Html::jsJson('cookiechoices_settings', [
                'message'   => $settings->message,
                'close'     => $settings->close,
                'learnmore' => $settings->learnmore,
                'url'       => $settings->url,
                'dialog'    => $settings->appearance === 0,
                'bottom'    => $settings->appearance === 2,
            ]) .
            My::jsLoad('public.js');
        }

        return '';
    }
}
