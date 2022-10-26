<?php

namespace App\Dto\Generic;

use Symfony\Component\Validator\Constraints as Assert;

class NameInputDto
{
    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    public string $name;
}
