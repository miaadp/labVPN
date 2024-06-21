<?php

namespace interfaces;

/**
 * @property string $TRX
 * @property string $TON
 */
interface wallets {}

/**
 * @property int $active
 * @property int $suspended
 */
interface stats {}

/**
 * @property int $balance
 * @property int $userID
 * @property string $brand
 * @property int $level
 * @property wallets $wallets
 * @property stats $stats
 */
interface accountInfo {}

/**
 * @property int $limit
 * @property int $price
 */
interface price {}

/**
 * @property int $min
 * @property int $max
 */
interface limit {}

/**
 * @property limit $create
 * @property limit $renew
 * @property limit $relive
 * @property limit $suspension
 */
interface limits {}

/**
 * @property price[] $prices
 * @property limits $limits
 */
interface rateInfo {}

/**
 * @property int $download
 * @property int $upload
 */
interface traffic {}

/**
 * @property string $direct
 * @property string $sub
 * @property string $qrcode
 */
interface connectDetail {}

/**
 * @property int $count
 * @property int $forgive
 * @property int $latest
 */
interface warnings {}

/**
 * @property string $clientID
 * @property int $number
 * @property int $expire
 * @property string $name
 * @property string $note
 * @property int $coLimit
 * @property traffic $traffic
 * @property int $price
 * @property connectDetail $connect
 * @property warnings $warnings
 */
interface service {}

/**
 * @property string $clientID
 * @property int $number
 * @property int $expire
 * @property string $name
 * @property string $note
 * @property int $coLimit
 * @property traffic $traffic
 * @property int $price
 * @property warnings $warnings
 */
interface shortService {}