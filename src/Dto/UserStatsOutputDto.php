<?php

namespace App\Dto;

class UserStatsOutputDto
{
    public function __construct(
        public int $cameraCount,
        public int $lensCount
    ) {
    }
}
