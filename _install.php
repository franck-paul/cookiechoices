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
if (!defined('DC_CONTEXT_ADMIN')) {
    return;
}

if (!dcCore::app()->newVersion(basename(__DIR__), dcCore::app()->plugins->moduleInfo(basename(__DIR__), 'version'))) {
    return;
}

dcCore::app()->blog->settings->cookiechoices->put('message', 'By using our services, you agree to our use of cookies.', 'string', 'Visitor message', true, true);
dcCore::app()->blog->settings->cookiechoices->put('close', 'Got it', 'string', 'Close message', true, true);
dcCore::app()->blog->settings->cookiechoices->put('learnmore', 'Learn more', 'string', 'Learn more message', true, true);
dcCore::app()->blog->settings->cookiechoices->put('url', 'https://www.cookiechoices.org/', 'string', 'Learn more URL', true, true);
dcCore::app()->blog->settings->cookiechoices->put('appearance', 2, 'integer', 'Message appearance', true, true);
dcCore::app()->blog->settings->cookiechoices->put('anywhere', false, 'boolean', 'Display message on every page', true, true);

return true;
