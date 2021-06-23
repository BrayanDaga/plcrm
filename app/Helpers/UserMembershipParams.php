<?php


namespace App\Helpers;


class UserMembershipParams extends PagingParams
{
    public $OrderBy = 'id';

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->OrderBy;
    }

    /**
     * @param string $OrderBy
     */
    public function setOrderBy(string $OrderBy): void
    {
        $this->OrderBy = $OrderBy;
    }

}