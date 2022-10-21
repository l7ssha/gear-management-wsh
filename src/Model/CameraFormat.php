<?php

namespace App\Model;

enum CameraFormat: string
{
    case APS_C = 'aps_c';
    case FULL_FRAME = 'full_frame';
    case HALF_FRAME = 'half_frame';
    case MEDIUM_FORMAT = 'medium_format';
    case LARGE_FORMAT = 'large_format';
}
