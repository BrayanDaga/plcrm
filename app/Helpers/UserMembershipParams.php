<?php


namespace App\Helpers;


class UserMembershipParams extends PagingParams
{
    public $OrderBy = 'updated_at';
    public $send = '';

    /**
     * @return string
     */
    public function getSend(): string
    {
        return $this->send;
    }

    /**
     * @param string $send
     */
    public function setSend(string $send): void
    {
        $this->send = $send;
    }

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