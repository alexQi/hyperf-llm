<?php

declare(strict_types=1);

namespace AlexQiu\HyperfLLM;

use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

/**
 * 唯品会客户端工厂类。
 */
class Factory
{
    /**
     * Create the Service instance.
     *
     * @param ContainerInterface $container
     *
     * @return Service
     */
    public function __invoke(ContainerInterface $container): Service
    {
        /** @var ConfigInterface $config */
        $config = $container->get(ConfigInterface::class);

        // 获取唯品会相关配置
        $config = $config->get('llm', []);

        return new Service($config);
    }
}