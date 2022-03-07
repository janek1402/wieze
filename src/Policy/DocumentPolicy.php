<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Document;
use Authorization\IdentityInterface;
use App\MyHelpers\Functions;

/**
 * Documents policy
 */
class DocumentPolicy
{
    public function canDelete(IdentityInterface $user, Document $document)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }
}
