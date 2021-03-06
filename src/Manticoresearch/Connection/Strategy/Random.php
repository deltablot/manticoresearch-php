<?php

namespace Manticoresearch\Connection\Strategy;

/**
 * Class Random
 * @package Manticoresearch\Connection\Strategy
 */
class Random implements SelectorInterface
{
    /**
     * @param array $connections
     * @return mixed
     */
    public function getConnection(array $connections)
    {
        shuffle($connections);
        foreach ($connections as $connection) {
            if ($connection->isAlive()) {
                return $connection;
            }
        }

    }
}