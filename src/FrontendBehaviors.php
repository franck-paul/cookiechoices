<?php

/**
 * @brief cookiechoices, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul contact@open-time.net
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
        if ($settings->getBool('enabled')
            && $settings->getStr('message', false) !== ''
            && ($settings->getBool('anywhere') || App::url()->isType(['default', 'static']))
        ) {
            echo
            My::jsLoad('cookiechoices.js') .
            Html::jsJson('cookiechoices_settings', [
                'message'   => $settings->getStr('message'),
                'close'     => $settings->getStr('close'),
                'learnmore' => $settings->getStr('learnmore'),
                'url'       => $settings->getStr('url'),
                'dialog'    => $settings->getInt('appearance', false) === 0,
                'bottom'    => $settings->getInt('appearance', false) === 2,
            ]) .
            My::jsLoad('public.js');
        }

        return '';
    }
}
