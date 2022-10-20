<?php

namespace App\Model;

enum LensType: string
{
    case FISH_EYE = 'fish_eye';
    case ULTRA_WIDE_ANGLE = 'ultra_wide_angle';
    case WIDE_ANGLE = 'wide_angle';
    case NORMAL = 'normal';
    case TELE = 'tele';
    case ZOOM = 'zoom';
}
