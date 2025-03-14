<?php

namespace AlexQiu\HyperfLLM\Services;

use AlexQiu\HyperfLLM\Caller;
use AlexQiu\HyperfLLM\Exception\ResultErrorException;
use Hyperf\Codec\Json;
use Psr\Http\Message\ResponseInterface;

/**
 * Oauth
 *
 * @author  alex
 * @package AlexQiu\HyperfLLM\Services\Oauth
 */
class Qwen extends Caller
{
    const BASE_URL = "https://dashscope.aliyuncs.com";

    /**
     * @param $code
     * @param $client_ip
     *
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function callLLM($params)
    {
        $request = [
            "input" => [
                "prompt" => Json::encode($params),
            ]
        ];
        $resp    = $this->fetch(
            sprintf("%s/api/v1/apps/%s/completion", self::BASE_URL, $this->app->config->get("app_id")),
            "POST",
            [
                "headers" => [
                    "Accept"        => "application/json",
                    "Content-Type"  => "application/json",
                    "Authorization" => "Basic " . $this->app->config->get("api_key")
                ],
                "json"    => $request,
            ]
        );

        if (!isset($resp['text'])) {
            throw new ResultErrorException("get llm output error");
        }
        $origin_text = trim($resp['text'], "```");
        $origin_text = str_replace("\n", "", $origin_text);
        $origin_text = str_replace("json", "", $origin_text);

        return Json::decode($origin_text);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return \AlexQiu\Sdkit\Support\Collection|array|false|mixed|object|ResponseInterface|string|null
     * @throws \AlexQiu\Sdkit\Exceptions\InvalidConfigException
     */
    protected function unwrapResponse(ResponseInterface $response)
    {
        $res = $this->castResponseToType(
            $response,
            $this->app->getContainer()->get("config")->get('http.response_type')
        );
        if (!isset($res['output'])) {
            throw new ResultErrorException("get llm response failed", 200);
        }
        return $res["output"];
    }
}
