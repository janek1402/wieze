<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Tower;
use Authorization\IdentityInterface;
use App\MyHelpers\Functions;

/**
 * Tower policy
 */
class TowerPolicy
{
    /**
     * Check if $user can add Tower
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Tower $tower
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Tower $tower)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can edit Tower
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Tower $tower
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Tower $tower)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can delete Tower
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Tower $tower
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Tower $tower)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can view Tower
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Tower $tower
     * @return bool
     */
    public function canView(IdentityInterface $user, Tower $tower)
    {
        return true;
    }

    public function canGetImages(IdentityInterface $user, Tower $tower)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    public function canDeleteImages(IdentityInterface $user, Tower $tower)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }
}
