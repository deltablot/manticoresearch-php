<?php


namespace Manticoresearch\Connection\Strategy;


/**
 * Class RoundRobin
 * @package Manticoresearch\Connection\Strategy
 */
class RoundRobin implements SelectorInterface
{
    /**
     * @var int
     */
    private $current = 0;

    /**
     * @param array $connections
     * @return mixed
     */
    public function getConnection(array $connections)
    {

        $alives = array_filter($connections, function ($connection) {
            return $connection->isAlive() ?? false;
        });
        $connection = $alives[$this->current % count($connections)];
        $this->current += 1;
        return $connection;
    }
}