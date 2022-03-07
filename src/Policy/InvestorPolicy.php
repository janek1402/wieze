<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Investor;
use Authorization\IdentityInterface;
use App\MyHelpers\Functions;

/**
 * Investor policy
 */
class InvestorPolicy
{
    /**
     * Check if $user can add Investor
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Investor $investor
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Investor $investor)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can edit Investor
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Investor $investor
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Investor $investor)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can delete Investor
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Investor $investor
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Investor $investor)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can view Investor
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Investor $investor
     * @return bool
     */
    public function canView(IdentityInterface $user, Investor $investor)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }
}
