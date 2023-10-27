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
$this->registerModule(
    'cookiechoices',
    'Cookie Consent System',
    'Franck Paul',
    '4.1',
    [
        'requires'    => [['core', '2.28']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'settings'    => [
            'blog' => '#params.cookiechoices',
        ],

        'details'    => 'https://open-time.net/?q=cookiechoices',
        'support'    => 'https://github.com/franck-paul/cookiechoices',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/cookiechoices/master/dcstore.xml',
    ]
);
