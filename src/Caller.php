<?php

namespace AlexQiu\HyperfLLM;

use AlexQiu\HyperfLLM\Exception\ResultErrorException;
use AlexQiu\Sdkit\BaseClient as KitBaseClient;
use Psr\Http\Message\ResponseInterface;

/**
 * Caller
 *
 * @author  alex
 * @package AlexQiu\HyperfLLM\Caller
 */
class Caller extends KitBaseClient
{

    /**
     * @param ResponseInterface $response
     *
     * @return \AlexQiu\Sdkit\Support\Collection|array|false|mixed|object|ResponseInterface|string|null
     * @throws \AlexQiu\Sdkit\Exceptions\InvalidConfigException
     */
    protected function unwrapResponse(ResponseInterface $response)
    {
        $res = parent::unwrapResponse($response);
        if (!isset($res['output'])) {
            throw new ResultErrorException("get llm response failed", 200);
        }
        return $res["output"];
    }
}