<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Template;
use Authorization\IdentityInterface;
use App\MyHelpers\Functions;

/**
 * Template policy
 */
class TemplatePolicy
{
    /**
     * Check if $user can add Template
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Template $template
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Template $template)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can edit Template
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Template $template
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Template $template)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can delete Template
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Template $template
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Template $template)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }

    /**
     * Check if $user can view Template
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Template $template
     * @return bool
     */
    public function canView(IdentityInterface $user, Template $template)
    {
        return Functions::isAdmin($user) or Functions::isBiurowy($user);
    }
}
