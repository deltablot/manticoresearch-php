<?php


namespace Manticoresearch;


/**
 * Class Transport
 * @package Manticoresearch
 */
class Transport
{
    /**
     * @var Connection
     */
    protected $_connection;

    /**
     * Transport constructor.
     * @param Connection|null $connection
     */
    public function __construct(Connection $connection = null)
    {
        if ($connection) {
            $this->_connection = $connection;
        }
    }

    /**
     * @return Connection|null
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * @param Connection $connection
     * @return Transport
     */
    public function setConnection(Connection $connection): Transport
    {
        $this->_connection = $connection;
        return $this;
    }

    /**
     * @param $transport
     * @param Connection $connection
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public static function create($transport, Connection $connection, array $params = [])
    {
        $className = "Manticoresearch\\Transport\\$transport";
        if (class_exists($className)) {
            $transport = new $className($connection);
        }
        if ($transport instanceof self) {
            $transport->setConnection($connection);
        } else {
            throw new \Exception('Bad transport');
        }
        return $transport;
    }

    /**
     * @param string $uri
     * @param array $query
     * @return string
     */
    protected function setupURI(string $uri, $query = []): string
    {
        if (!empty($query)) {
            foreach ($query as $k => $v) {
                if (is_bool($query)) {
                    $query[$k] = $v ? 'true' : 'false';
                }
            }
            $uri = $uri . '?' . http_build_query($query);
        }
        return $uri;
    }
}