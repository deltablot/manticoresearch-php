<?php


namespace Manticoresearch\Connection\Strategy;


/**
 * Interface SelectorInterface
 * @package Manticoresearch\Connection\Strategy
 */
interface SelectorInterface
{
    /**
     * @param array $connections
     * @return mixed
     */
    public function getConnection(array $connections);
}