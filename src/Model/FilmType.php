<?php

namespace App\Model;

enum FilmType: string
{
    case BW_PAN = 'bw_pan';
    case BW_ORTHO = 'bw_ortho';
    case BW_LITH = 'bw_lith';
    case C41 = 'c41';
    case E6 = 'e6';
}
