<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Manager;
use Authorization\IdentityInterface;
use App\MyHelpers\Functions;

/**
 * Manager policy
 */
class ManagerPolicy
{
    /**
     * Check if $user can add Manager
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Manager $manager
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Manager $manager)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can edit Manager
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Manager $manager
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Manager $manager)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can delete Manager
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Manager $manager
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Manager $manager)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can view Manager
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Manager $manager
     * @return bool
     */
    public function canView(IdentityInterface $user, Manager $manager)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }
}
