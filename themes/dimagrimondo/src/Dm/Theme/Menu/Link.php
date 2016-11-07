<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 03/11/2016
 * Time: 21:24
 */

namespace Dm\Theme\Menu;


use Mekit\Drupal7\HookInterface;

class Link implements HookInterface
{
    /**
     * @param array $vars
     * @return string
     */
    public static function execute($vars)
    {
        return self::themeMenuLink($vars);
    }


    /**
     * @param $vars
     * @return string
     */
    private static function themeMenuLink($vars)
    {
        $answer = '';
        if ($vars['element']['#original_link']['menu_name'] == 'user-menu'
            && $vars['element']['#original_link']['link_path'] = 'user'
                && $vars['element']['#title'] == t('My account')
        ) {
            if (user_is_logged_in()) {
                $answer = self::getProfileDropdown($vars);
            } else {
                $answer = '';
            }
        }

        //fall back to default bootstrap style
        if (!$answer) {
            $answer = bootstrap_menu_link($vars);
        }

        return $answer;
    }

    private static function getProfileDropdown($vars)
    {
        /** @var \stdClass $user */
        global $user;

        /* Global user is missing custom fields so we need to load it explicitely */
        /** @var \stdClass $currUser */
        $currentUser = user_load($user->uid);

        $userName = $user->name;
        if (isset($currentUser->name_field[LANGUAGE_NONE][0]['value'])) {
            $userName = $currentUser->name_field[LANGUAGE_NONE][0]['value'];
        }

        /* The menu item link element */
        $element = $vars['element'];


        //dpm($currentUser, "PROFILE-user");
        //dpm($element, "PROFILE-DD");

        $sub_menu = '';
        if ($element['#below']) {
            unset($element['#below']['#theme_wrappers']);
            $sub_menu = '<ul class="dropdown-menu profile-menu">' . drupal_render($element['#below']) . '</ul>';
        }

        $element['#title'] = $userName;
        $element['#attributes']['class'][] = 'dropdown';
        $element['#attributes']['class'][] = 'profile';
        $element['#localized_options']['html'] = TRUE;
        $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
        $element['#localized_options']['attributes']['data-target'] = '#';
        $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';

        $avatarImage = '';
        if (isset($currentUser->field_single_image_private[LANGUAGE_NONE][0]['uri'])) {
            $fileUri = $currentUser->field_single_image_private[LANGUAGE_NONE][0]['uri'];
            $avatarImage = theme('image_style',
                [
                    'style_name' => 'profile_menu_avatar',
                    'path' => $fileUri,
                    'alt' => $userName,
                    'title' => $userName,
                    'attributes' => [
                        'class' => ['circular']
                    ],
                ]
            );
        }


        $liContent = [
            'toggler' => [
                '#prefix' => '<a href="#" class="dropdown-toggle" data-toggle="dropdown">',
                '#suffix' => '</a>',
                'user-avatar' => [
                    '#markup' => $avatarImage,/*'<i class="fa fa-user" aria-hidden="true"></i>',*/
                ],
                'user-name' => [
                    '#prefix' => '<span class="name">',
                    '#suffix' => '</span>',
                    '#markup' => $userName,
                ],
                'chevron' => [
                    '#markup' => '&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i>'
                ]
            ],
            'dropdown' => [
                '#markup' => $sub_menu,
            ],
            /*
            'dropdown' => [
                '#prefix' => '<ul class="dropdown-menu">',
                '#suffix' => '</ul>',

                'li-profile' => [
                    '#prefix' => '<li><div class="navbar-login"><div class="row">',
                    '#suffix' => '</div></div></li>',
                    'profile-avatar' => [
                        '#prefix' => '<div class="col-lg-4">',
                        '#suffix' => '</div>',
                        '#markup' => $avatarImage,
                    ],
                    'profile-info' => [
                        '#prefix' => '<div class="col-lg-8">',
                        '#suffix' => '</div>',
                        'user-name' => [
                            '#prefix' => '<p class="text-left">',
                            '#suffix' => '</p>',
                            '#markup' => $element["#title"]
                        ],
                        'user-mail' => [
                            '#prefix' => '<p class="text-left">',
                            '#suffix' => '</p>',
                            '#markup' => $currentUser->mail,
                        ],
                        'profile-link' => [
                            '#prefix' => '<p class="text-left">',
                            '#suffix' => '</p>',
                            '#markup' => l(t('user profile'), $element['#href'], ['attributes' => ['class' => ['btn', 'btn-primary', 'btn-block', 'btn-sm']]]),
                        ],
                    ],
                ],
                'li-divider' => [
                    '#prefix' => '<li class="divider">',
                    '#suffix' => '</li>',
                ],

                'li-submenu' => [
                    '#prefix' => '<li class="profile-menu">',
                    '#suffix' => '</li>',
                    '#markup' => $sub_menu,
                ],
                'li-exit' => [
                    '#prefix' => '<li>',
                    '#suffix' => '</li>',
                ],
            ],*/
        ];

        $liMarkup = drupal_render($liContent);
        //$output = l($title, $element['#href'], $element['#localized_options']);
        return '<li' . drupal_attributes($element['#attributes']) . '>' . $liMarkup . "</li>\n";
    }

}

/*

<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user"></span> 
            <strong>Nombre</strong>
            <span class="glyphicon glyphicon-chevron-down"></span>
        </a>
        <ul class="dropdown-menu">

            <li>
                <div class="navbar-login">
                    <div class="row">
                        <div class="col-lg-4">
                            <p class="text-center">
                                <span class="glyphicon glyphicon-user icon-size"></span>
                            </p>
                        </div>
                        <div class="col-lg-8">
                            <p class="text-left"><strong>Nombre Apellido</strong></p>
                            <p class="text-left small">correoElectronico@email.com</p>
                            <p class="text-left">
                                <a href="#" class="btn btn-primary btn-block btn-sm">Actualizar Datos</a>
                            </p>
                        </div>
                    </div>
                </div>
            </li>

            <li class="divider"></li>
            <li>
                <div class="navbar-login navbar-login-session">
                    <div class="row">
                        <div class="col-lg-12">
                            <p>
                                <a href="#" class="btn btn-danger btn-block">Cerrar Sesion</a>
                            </p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>
</ul>


*/