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

use dcCore;
use dcNamespace;
use Dotclear\Core\Process;
use Exception;

class Install extends Process
{
    public static function init(): bool
    {
        return self::status(My::checkContext(My::INSTALL));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        try {
            // Init
            $settings = My::settings();

            $settings->put('message', 'By using our services, you agree to our use of cookies.', dcNamespace::NS_STRING, 'Visitor message', false, true);
            $settings->put('close', 'Got it', dcNamespace::NS_STRING, 'Close message', false, true);
            $settings->put('learnmore', 'Learn more', dcNamespace::NS_STRING, 'Learn more message', false, true);
            $settings->put('url', 'https://www.cookiechoices.org/', dcNamespace::NS_STRING, 'Learn more URL', false, true);
            $settings->put('appearance', 2, dcNamespace::NS_INT, 'Message appearance', false, true);
            $settings->put('anywhere', false, dcNamespace::NS_BOOL, 'Display message on every page', false, true);
        } catch (Exception $e) {
            dcCore::app()->error->add($e->getMessage());
        }

        return true;
    }
}
