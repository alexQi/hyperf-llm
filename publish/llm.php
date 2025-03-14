<?php
/**
 * 配置文件
 *
 * @link     http://www.swoole.red
 * @contact  1712715552@qq.com
 */

use function Hyperf\Support\env;

return [
    'debug' => env('LLM_DEBUG', true),
    'http'  => [
        "debug"         => false,
        "response_type" => "array",
        "log_template"  => ">>>>>>>>\n{request}\n<<<<<<<<\n{response}\n--------\n{error}"
    ],
    'log'   => [
        'default'  => 'stdout', // 默认的日志驱动
        'driver'   => 'stdout',
        'channels' => [
            'stdout' => [
                'driver' => 'single',
                'stream' => 'php://stdout',
                'level'  => 'debug',
            ],
        ],
    ]
];
