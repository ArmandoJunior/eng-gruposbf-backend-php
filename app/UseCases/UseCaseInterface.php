<?php

namespace App\UseCases;

use App\Dtos\DtoInterface;

interface UseCaseInterface
{
    public function execute(DtoInterface $dto);
}
