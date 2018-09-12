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

// dead but useful code, in order to have translations
__('cookiechoices') . __('Cookie Consent System');

$core->addBehavior('adminBlogPreferencesForm', ['cookiechoicesAdminBehaviours', 'adminBlogPreferencesForm']);
$core->addBehavior('adminBeforeBlogSettingsUpdate', ['cookiechoicesAdminBehaviours', 'adminBeforeBlogSettingsUpdate']);

class cookiechoicesAdminBehaviours
{

    public static function adminBlogPreferencesForm($core, $settings)
    {
        $settings->addNameSpace('cookiechoices');

        // Appearances of message
        $cookiechoices_appearance = [
            0 => __('A dialog box'),
            1 => __('A bar on top'),
            2 => __('A bar on bottom')
        ];

        echo
        '<div class="fieldset"><h4>' . __('Cookie Consent System') . '</h4>' .
        '<p><label class="classic">' .
        form::checkbox('cookiechoices_enabled', '1', html::escapeHTML($settings->cookiechoices->enabled)) .
        __('Enable Cookie Consent System') . '</label></p>' .
        '<div class="two-cols">' .
        '<div class="col">' .
        '<p><label class="required" title="' . __('Required field') . '"><abbr title="' . __('Required field') . '">*</abbr> ' .
        __('Your message for visitors here:') . " " .
        form::field('cookiechoices_message', 50, 255, html::escapeHTML($settings->cookiechoices->message), '', '', false, 'required placeholder="' . __('Message') . '"') .
        '</label></p>' .
        '<p class="form-note">' . __('Example:') . ' ' . __('Cookies help us deliver our services. By using our services, you agree to our use of cookies.') . '</p>' .
        '<p><label class="required" title="' . __('Required field') . '"><abbr title="' . __('Required field') . '">*</abbr> ' .
        __('Close message:') . " " .
        form::field('cookiechoices_close', 30, 255, html::escapeHTML($settings->cookiechoices->close), '', '', false, 'required placeholder="' . __('Message') . '"') .
        '</label></p>' .
        '<p class="form-note">' . __('Example:') . ' ' . __('Got it') . '</p>' .
        '</div>' .
        '<div class="col">' . '<h5>' . __('Learn more link') . '</h5>' .
        '<p><label>' .
        __('Learn more message:') . " " .
        form::field('cookiechoices_learnmore', 30, 255, html::escapeHTML($settings->cookiechoices->learnmore)) .
        '</label></p>' .
        '<p class="form-note">' . __('Example:') . ' ' . __('Learn more') . ' ' .
        __('(leave this field empty to not include this link)') . '</p>' .
        '<p><label>' .
        __('URL (learn more):') . " " .
        form::field('cookiechoices_url', 30, 255, html::escapeHTML($settings->cookiechoices->url)) .
        '</label></p>' .
        '<p class="form-note">' . __('Example:') . ' ' . __('https://www.cookiechoices.org/') . ' ' .
        __('(leave this field empty to not include this link)') . '</p>' .
            '</div>' .
            '</div>';

        echo
        '<p><label class="classic">' .
        form::checkbox('cookiechoices_anywhere', '1', html::escapeHTML($settings->cookiechoices->anywhere)) .
        __('Display message on every page') . '</label></p>';

        echo '<h5>' . __('Display message as:') . '</h5>';
        $i = 0;
        foreach ($cookiechoices_appearance as $k => $v) {
            echo '<p><label for="dashes_mode-' . $i . '" class="classic">' .
            form::radio(['cookiechoices_appearance', 'cookiechoices_appearance-' . $i],
                $k, $settings->cookiechoices->appearance == $k) . ' ' . $v . '</label></p>';
            $i++;
        }

        echo
            '</div>';
    }
    public static function adminBeforeBlogSettingsUpdate($settings)
    {
        $settings->addNameSpace('cookiechoices');
        $settings->cookiechoices->put('enabled', !empty($_POST['cookiechoices_enabled']), 'boolean');
        $settings->cookiechoices->put('message', empty($_POST['cookiechoices_message']) ? "" : $_POST['cookiechoices_message'], 'string');
        $settings->cookiechoices->put('close', empty($_POST['cookiechoices_close']) ? "" : $_POST['cookiechoices_close'], 'string');
        $settings->cookiechoices->put('learnmore', empty($_POST['cookiechoices_learnmore']) ? "" : $_POST['cookiechoices_learnmore'], 'string');
        $settings->cookiechoices->put('url', empty($_POST['cookiechoices_url']) ? "" : $_POST['cookiechoices_url'], 'string');
        $settings->cookiechoices->put('appearance', $_POST['cookiechoices_appearance'], 'integer');
        $settings->cookiechoices->put('anywhere', !empty($_POST['cookiechoices_anywhere']), 'boolean');
    }
}
