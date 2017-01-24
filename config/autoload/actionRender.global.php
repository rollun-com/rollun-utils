<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23.01.17
 * Time: 17:41
 */

use rollun\utils\ActionRender\Factory\AbstractMiddlewarePipeFactoryAbstract;
use rollun\utils\ActionRender\Factory\ActionRenderFactory;
use rollun\utils\ActionRender\Renderer\ResponseRendererFactory;

return [
    'dependencies' => [
        'abstract_factories' => [
            AbstractMiddlewarePipeFactoryAbstract::class,
            ActionRenderFactory::class,
            ResponseRendererFactory::class
        ],
        'invokables' => [

        ],
        'factories' => [
            \rollun\utills\ActionRender\Renderer\Html\HtmlRendererAction::class =>
                \rollun\utills\ActionRender\Renderer\Html\HtmlRendererFactory::class
        ],
    ],
    AbstractMiddlewarePipeFactoryAbstract::KEY_AMP => [
        'htmlReturner' => [
            'middlewares' => [
                \rollun\utills\ActionRender\Renderer\Html\HtmlParamResolver::class,
                \rollun\utills\ActionRender\Renderer\Html\HtmlRendererAction::class
            ]
        ]
    ],
    ResponseRendererFactory::KEY_RESPONSE_RENDERER => [
        'simpleHtmlJsonRenderer' => [
            ResponseRendererFactory::KEY_ACCEPT_TYPE_PATTERN => [
                //pattern => middleware-Service-Name
                '/application\/json/' => \rollun\utills\ActionRender\Renderer\Json\JsonRendererAction::class,
                '/text\/html/' => 'htmlReturner'
            ]
        ]
    ],
    ActionRenderFactory::KEY_ACTION_RENDER => [
        /*'home' => [
            // ActionRenderFactory::KEY_AR_MIDDLEWARE => 'ActionRenderMiddleware'
            ActionRenderFactory::KEY_AR_MIDDLEWARE => [
                ActionRenderFactory::KEY_ACTION => '',
                ActionRenderFactory::KEY_RENDER => 'simpleHtmlJsonRenderer'
            ]
        ],*/
    ]
];