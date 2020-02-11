<?php


namespace App\Repositories;


interface TeamRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll() : array;
}
