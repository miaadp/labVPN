<?php

namespace labVPN;

use interfaces\accountInfo;
use interfaces\rateInfo;
use interfaces\service;
use interfaces\shortService;

class labVpn {
    const END_POINT = 'https://api.realix.pro/LabVPN/';
    private string $license;

    /**
     * @param string $license use 010101010101 to test apis
     */
    public function __construct (string $license = '010101010101') {
        $this->license = $license;
    }

    public function execute (string $method, array $inputs = []): mixed {
        $curl = curl_init();
        $inputs['method'] = $method;
        curl_setopt_array($curl, [
            CURLOPT_URL            => self::END_POINT . '?' . http_build_query($inputs),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'LabVPN-API-Token: ' . $this->license,
            ],
        ]);
        $response = curl_exec($curl);
        $response = json_decode($response);
        if (!isset($response->ok)) {
            return false;
        }
        if (!$response->ok) {
            return $response->description;
        }
        curl_close($curl);
        return $response->result;
    }

    /** @return accountInfo|false|string */
    public function getMe (): mixed {
        return $this->execute(__FUNCTION__);
    }

    /** @return rateInfo|false|string */
    public function getRate (): mixed {
        return $this->execute(__FUNCTION__);
    }

    /**
     * @param string $name  Name of the new service
     * @param int    $time  Duration of the new service (seconds), If you provide less than 60, It counts as day
     * @param int    $limit Connection limit of the new service
     *
     * @return service|false|string
     */
    public function createService (string $name, int $time, int $limit): mixed {
        if ($time < 60) {
            $time = $time * 3600 * 24;
        }
        return $this->execute(__FUNCTION__, [
            'name'  => $name,
            'time'  => $time,
            'limit' => $limit,
        ]);
    }

    /** @return service[]|false|string */
    public function getActiveServices (): mixed {
        return $this->execute(__FUNCTION__);
    }

    /**
     * @param string $client_id The clientID for execution
     *
     * @return service|false|string
     */
    public function getActiveService (string $client_id): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     * @param int    $time      Duration of the new service (seconds), If you provide less than 60, It counts as day
     *
     * @return shortService|false|string
     */
    public function renewService (string $client_id, int $time): mixed {
        if ($time < 60) {
            $time = $time * 3600 * 24;
        }
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
            'time'     => $time,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     * @param int    $limit     Connection limit of the new service
     *
     * @return shortService|false|string
     */
    public function changeCoLimit (string $client_id, int $limit): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
            'limit'    => $limit,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     * @param int    $limit     Connection limit of the new service
     *
     * @return shortService|false|string
     */
    public function changeConnectionLimit (string $client_id, int $limit): mixed {
        return $this->execute('changeCoLimit', [
            'clientID' => $client_id,
            'limit'    => $limit,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     *
     * @return service|false|string
     */
    public function revokeService (string $client_id): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     *
     * @return shortService|false|string
     */
    public function deactivateService (string $client_id): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     * @param string $name      New name for service
     *
     * @return shortService|false|string
     */
    public function changeName (string $client_id, string $name): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
            'name'     => $name,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     *
     * @return shortService|false|string
     */
    public function returnService (string $client_id): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     * @param string $note      New note for the service
     *
     * @return shortService|false|string
     */
    public function changeNote (string $client_id, string $note): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
            'note'     => $note,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     *
     * @return shortService|false|string
     */
    public function resetTraffic (string $client_id): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
        ]);
    }

    /** @return shortService[]|false|string */
    public function getSuspendedServices (): mixed {
        return $this->execute(__FUNCTION__);
    }

    /**
     * @param string $client_id The clientID for execution
     *
     * @return shortService|false|string
     */
    public function getSuspendedService (string $client_id): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     *
     * @return service|false|string
     */
    public function reliveService (string $client_id): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
        ]);
    }

    /**
     * @param string $client_id The clientID for execution
     *
     * @return service|false|string
     */
    public function activateService (string $client_id): mixed {
        return $this->execute(__FUNCTION__, [
            'clientID' => $client_id,
        ]);
    }
}