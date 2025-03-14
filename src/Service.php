<?php

declare(strict_types=1);
/**
 * This file is part of msmm.
 */

namespace AlexQiu\HyperfLLM;

use AlexQiu\Sdkit\ServiceContainer;
use AlexQiu\HyperfLLM\Providers\CallerProvider;
use AlexQiu\HyperfLLM\Providers\HttpServiceClientProvider;
use AlexQiu\HyperfLLM\Services\Qwen;

/**
 * Service
 *
 * @property Qwen $qwen
 *
 * @author  alex
 * @package AlexQiu\HyperfLLM\Service
 */
class Service extends ServiceContainer
{
    protected $providers = [
        HttpServiceClientProvider::class,
        CallerProvider::class
    ];

    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);
    }
}
