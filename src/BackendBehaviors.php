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
use Dotclear\Helper\Html\Form\Checkbox;
use Dotclear\Helper\Html\Form\Div;
use Dotclear\Helper\Html\Form\Fieldset;
use Dotclear\Helper\Html\Form\Input;
use Dotclear\Helper\Html\Form\Label;
use Dotclear\Helper\Html\Form\Legend;
use Dotclear\Helper\Html\Form\Para;
use Dotclear\Helper\Html\Form\Radio;
use Dotclear\Helper\Html\Form\Text;
use Dotclear\Helper\Html\Html;

class BackendBehaviors
{
    public static function adminBlogPreferencesForm(): string
    {
        $settings = My::settings();

        // Appearances of message
        $cookiechoices_appearance = [
            0 => __('A dialog box'),
            1 => __('A bar on top'),
            2 => __('A bar on bottom'),
        ];

        $appearances = [];
        $i           = 0;
        foreach ($cookiechoices_appearance as $k => $v) {
            $appearances[] = (new Radio(['cookiechoices_appearance', 'cookiechoices_appearance-' . $i], $settings->appearance == $k))
                ->value($k)
                ->label((new Label($v, Label::INSIDE_TEXT_AFTER)));
            ++$i;
        }

        // Add fieldset for plugin options
        echo
        (new Fieldset('cookiechoices'))
        ->legend((new Legend(__('Cookie Consent System'))))
        ->fields([
            (new Para())->items([
                (new Checkbox('cookiechoices_enabled', $settings->enabled))
                    ->value(1)
                    ->label((new Label(__('Enable Cookie Consent System'), Label::INSIDE_TEXT_AFTER))),
            ]),
            (new Div())->class('two-cols')->items([
                (new Div())->class('col')->items([
                    (new Text('h5', __('Messages'))),
                    (new Para())->items([
                        (new Input('cookiechoices_message'))
                            ->size(50)
                            ->maxlength(255)
                            ->value(Html::escapeHTML($settings->message))
                            ->required(true)
                            ->placeholder(__('Message'))
                            ->label((new Label(
                                (new Text('abbr', '*'))->title(__('Required field'))->render() . __('Your message for visitors here:'),
                                Label::OUTSIDE_TEXT_BEFORE
                            ))->id('page_title_label')->class('required')->title(__('Required field'))),
                    ]),
                    (new Para())->class('form-note')->items([
                        (new Text(null, __('Example:') . ' ' . __('Cookies help us deliver our services. By using our services, you agree to our use of cookies.'))),
                    ]),
                    (new Para())->items([
                        (new Input('cookiechoices_close'))
                            ->size(30)
                            ->maxlength(255)
                            ->value(Html::escapeHTML($settings->close))
                            ->required(true)
                            ->placeholder(__('Message'))
                            ->label((new Label(
                                (new Text('abbr', '*'))->title(__('Required field'))->render() . __('Close message:'),
                                Label::OUTSIDE_TEXT_BEFORE
                            ))->id('page_title_label')->class('required')->title(__('Required field'))),
                    ]),
                    (new Para())->class('form-note')->items([
                        (new Text(null, __('Example:') . ' ' . __('Got it'))),
                    ]),
                ]),
                (new Div())->class('col')->items([
                    (new Text('h5', __('Learn more link'))),
                    (new Para())->items([
                        (new Input('cookiechoices_learnmore'))
                            ->size(30)
                            ->maxlength(255)
                            ->value(Html::escapeHTML($settings->learnmore))
                            ->required(true)
                            ->placeholder(__('Message'))
                            ->label((new Label(
                                (new Text('abbr', '*'))->title(__('Required field'))->render() . __('Learn more message:'),
                                Label::OUTSIDE_TEXT_BEFORE
                            ))->id('page_title_label')->class('required')->title(__('Required field'))),
                    ]),
                    (new Para())->class('form-note')->items([
                        (new Text(null, __('Example:') . ' ' . __('Learn more') . ' ' . __('(leave this field empty to not include this link)'))),
                    ]),
                    (new Para())->items([
                        (new Input('cookiechoices_url'))
                            ->size(30)
                            ->maxlength(255)
                            ->value(Html::escapeHTML($settings->url))
                            ->required(true)
                            ->placeholder(__('Message'))
                            ->label((new Label(
                                (new Text('abbr', '*'))->title(__('Required field'))->render() . __('URL (learn more):'),
                                Label::OUTSIDE_TEXT_BEFORE
                            ))->id('page_title_label')->class('required')->title(__('Required field'))),
                    ]),
                    (new Para())->class('form-note')->items([
                        (new Text(null, __('Example:') . ' ' . __('https://www.cookiechoices.org/') . ' ' . __('(leave this field empty to not include this link)'))),
                    ]),
                ]),
            ]),
            (new Para())->items([
                (new Checkbox('cookiechoices_anywhere', $settings->anywhere))
                    ->value(1)
                    ->label((new Label(__('Display message on every page'), Label::INSIDE_TEXT_AFTER))),
            ]),
            (new Text('h5', __('Display message as:'))),
            ...$appearances,
        ])
        ->render();

        return '';
    }

    public static function adminBeforeBlogSettingsUpdate(): string
    {
        $settings = My::settings();

        $settings->put('enabled', !empty($_POST['cookiechoices_enabled']), App::blogWorkspace()::NS_BOOL);
        $settings->put('message', empty($_POST['cookiechoices_message']) ? '' : $_POST['cookiechoices_message'], App::blogWorkspace()::NS_STRING);
        $settings->put('close', empty($_POST['cookiechoices_close']) ? '' : $_POST['cookiechoices_close'], App::blogWorkspace()::NS_STRING);
        $settings->put('learnmore', empty($_POST['cookiechoices_learnmore']) ? '' : $_POST['cookiechoices_learnmore'], App::blogWorkspace()::NS_STRING);
        $settings->put('url', empty($_POST['cookiechoices_url']) ? '' : $_POST['cookiechoices_url'], App::blogWorkspace()::NS_STRING);
        $settings->put('appearance', $_POST['cookiechoices_appearance'], App::blogWorkspace()::NS_INT);
        $settings->put('anywhere', !empty($_POST['cookiechoices_anywhere']), App::blogWorkspace()::NS_BOOL);

        return '';
    }
}
