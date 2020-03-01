<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\Id;
use App\Entity\Traits\Status;
use App\Entity\Traits\Timestampable;
use App\Entity\Traits\Type;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    use Id, Type, Status,
        Timestampable;
}
