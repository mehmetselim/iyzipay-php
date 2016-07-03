<?php

namespace Iyzipay\Tests\Model;

use Iyzipay\Model\BasicBkm;
use Iyzipay\Request\RetrieveBkmRequest;
use Iyzipay\Tests\IyzipayResourceTestCase;

class BasicBkmTest extends IyzipayResourceTestCase
{
    public function test_should_retrieve_connect_bkm_auth()
    {
        $this->expectHttpPost();

        $basicBkm = BasicBkm::retrieve(new RetrieveBkmRequest(), $this->options);

        $this->verifyResource($basicBkm);
    }
}