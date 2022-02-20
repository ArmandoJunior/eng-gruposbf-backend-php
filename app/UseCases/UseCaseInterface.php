<?php

namespace App\UseCases;

use App\Dtos\DtoInterface;

interface UseCaseInterface
{
    public function execute();

    public function setData(DtoInterface $data): self;
}
