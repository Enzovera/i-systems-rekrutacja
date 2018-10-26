<?php

namespace ApiClient\Resource;

use ApiClient\iResponse;

class Producer extends Resource
{
    const URL = "/shop_api/v1/producers";

    public function createOne(
        string $name = "",
        string $site_url = "",
        string $logo_filename="",
        string $source_id = ""
    ) : bool
    {
        $producer = [
            "producer" => [
                'id' => null,
                'name' => $name,
                'site_url' => $site_url,
                'logo_filename' => $logo_filename,
                'ordering' => null,
                'source_id' => $source_id
            ]
        ];
        return $this->postResource($producer)->isSuccess();
    }

    public function getAll() : array
    {
        return $this->getResource()->getData()->producers;
    }

}
