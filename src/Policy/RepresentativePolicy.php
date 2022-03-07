<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Representative;
use Authorization\IdentityInterface;
use App\MyHelpers\Functions;

/**
 * Representative policy
 */
class RepresentativePolicy
{
    /**
     * Check if $user can add Representative
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Representative $representative
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Representative $representative)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can edit Representative
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Representative $representative
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Representative $representative)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can delete Representative
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Representative $representative
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Representative $representative)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can view Representative
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Representative $representative
     * @return bool
     */
    public function canView(IdentityInterface $user, Representative $representative)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }
}
