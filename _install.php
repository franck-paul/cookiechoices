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

if (!defined('DC_CONTEXT_ADMIN')) {return;}

$this_version      = $core->plugins->moduleInfo('cookiechoices', 'version');
$installed_version = $core->getVersion('cookiechoices');

if (version_compare($installed_version, $this_version, '>=')) {
    return;
}

$core->blog->settings->addNamespace('cookiechoices');
$core->blog->settings->cookiechoices->put('message', 'By using our services, you agree to our use of cookies.', 'string', 'Visitor message', true, true);
$core->blog->settings->cookiechoices->put('close', 'Got it', 'string', 'Close message', true, true);
$core->blog->settings->cookiechoices->put('learnmore', 'Learn more', 'string', 'Learn more message', true, true);
$core->blog->settings->cookiechoices->put('url', 'https://www.cookiechoices.org/', 'string', 'Learn more URL', true, true);
$core->blog->settings->cookiechoices->put('appearance', 2, 'integer', 'Message appearance', true, true);
$core->blog->settings->cookiechoices->put('anywhere', false, 'boolean', 'Display message on every page', true, true);

$core->setVersion('cookiechoices', $this_version);

return true;
