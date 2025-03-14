<?php

namespace AlexQiu\HyperfLLM\Providers;

use AlexQiu\HyperfLLM\Services\Qwen;
use AlexQiu\Sdkit\ServiceContainer;

/**
 * Client
 *
 * @author  alex
 * @package AlexQiu\HyperfLLM\Client
 */
class CallerProvider
{
    /**
     * @param ServiceContainer $service
     *
     * @return void
     */
    public function register(ServiceContainer $service): void
    {
        $service->getContainer()->set("qwen", function () use ($service) {
            return new Qwen($service);
        });
    }
}