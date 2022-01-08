<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Supplier;

use Webmozart\Assert\Assert;

class Address
{
    private const COUNTRY_RUSSIA = 'Россия';
    private const CITY_MOSCOW = 'Москва';

    private string $country;
    private string $city;
    private string $street;
    private string $building;
    private string $notice = '';

    private function __construct(
        string $country,
        string $city,
        string $street,
        string $building,
        string $notice = ''
    ) {
        Assert::oneOf($country, [self::COUNTRY_RUSSIA]);
        Assert::oneOf($city, [self::CITY_MOSCOW]);
        Assert::allNotEmpty([$street, $building]);

        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->building = $building;
        $this->notice = $notice;
    }

    public static function Moscow(string $street, string $building, string $notice = ''): self
    {
        return new self(
            self::COUNTRY_RUSSIA,
            self::CITY_MOSCOW,
            $street,
            $building,
            $notice
        );
    }

    public function getFullAddress(): string
    {
        return "$this->country, $this->city, $this->street, $this->building";
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getBuilding(): string
    {
        return $this->building;
    }

    /**
     * @return string
     */
    public function getNotice(): string
    {
        return $this->notice;
    }
}
