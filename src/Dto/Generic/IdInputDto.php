<?php

namespace App\Dto\Generic;

use Symfony\Component\Validator\Constraints as Assert;

class IdInputDto
{
    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Length(min: 26, max: 26)]
    public string $id;
}
