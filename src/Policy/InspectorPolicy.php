<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Inspector;
use Authorization\IdentityInterface;
use App\MyHelpers\Functions;

/**
 * Inspector policy
 */
class InspectorPolicy
{
    /**
     * Check if $user can add Inspector
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Inspector $inspector
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Inspector $inspector)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can edit Inspector
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Inspector $inspector
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Inspector $inspector)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can delete Inspector
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Inspector $inspector
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Inspector $inspector)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can view Inspector
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Inspector $inspector
     * @return bool
     */
    public function canView(IdentityInterface $user, Inspector $inspector)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }
}
