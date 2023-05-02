<?php

/**
 * @file
 * Model to represent the Producer table in the database
 * Contains both attributes and methods related to the Producer entity
 */

namespace app\models;

use app\core\Model;

class Producer extends RegisteredUser
{
    public function __construct(
        $id = null,
        $role = null,
        $name = null,
        $address = null,
        $lastLogin = null,
        $imageUrl = null,
        $email = null,
        $contactNo = null,
        $password = null,
        private ?string $nicNumber = null,
        private ?int $district = null,
    ) {
        parent::__construct($id, $role, $name, $address, $lastLogin, $imageUrl, $email, $contactNo, $password);
    }

    public function register(): bool
    {
        if (parent::register()) {
            $this->runQuery(
                "INSERT INTO producer (id, nic_number, district) VALUES (?,?,?)",
                [$this->getLastInsertedId(), $this->nicNumber, $this->district]
            );
            return true;
        }
        return false;
    }

    public function getAllNamesFromDB(): array
    {
        return $this->runQuery("SELECT id, name FROM registered_user WHERE id IN (SELECT id FROM producer)")
            ->fetchAll();
    }

    public function getAllProducersForManufacturer($manufacturerId): array
    {
        return $this->runQuery("SELECT 
            ru.image_url as 'image_url',
            p.id as 'producer_id',
            ru.name as 'producer_name',
            d.name as 'district',
            GROUP_CONCAT(DISTINCT cr.name SEPARATOR ',\n') as 'crop_names',
            co.status as 'is_connected'
            FROM producer p
            INNER JOIN registered_user ru ON p.id = ru.id
            INNER JOIN district d ON d.id = p.district
            INNER JOIN land l ON p.id = l.owner_id
            INNER JOIN cultivation c ON l.id = c.land_id
            INNER JOIN crop cr ON c.crop_id = cr.id
            LEFT JOIN connection_request co ON
                (co.sender_id = ? AND
                    co.receiver_id = p.id) OR 
                (co.sender_id = p.id AND
                    co.receiver_id = ?)
            GROUP BY ru.id
            ", [$manufacturerId, $manufacturerId])->fetchAll();
    }

    public function getConnectedProducersForManufacturer($manufacturerId): array
    {
        return $this->runQuery("SELECT
            ru.image_url as 'image_url',
            p.id as 'producer_id',
            ru.name as 'producer_name',
            GROUP_CONCAT(DISTINCT cr.name SEPARATOR ', ') as 'crop_names',
            ru.address as 'address',
            ru.contact_no as 'contact_no'
            FROM producer p
            INNER JOIN registered_user ru on p.id = ru.id
            INNER JOIN land l on p.id = l.owner_id
            INNER JOIN cultivation c on l.id = c.land_id
            INNER JOIN crop cr on c.crop_id = cr.id
            INNER JOIN connection_request co ON 
                (co.sender_id = ? AND
                    co.receiver_id = p.id) OR 
                (co.sender_id = p.id AND
                    co.receiver_id = ?)
            WHERE co.status = 'Accepted'
            GROUP BY ru.id
            ", [$manufacturerId, $manufacturerId])->fetchAll();
    }

    //Model function of Agri-Officer's Producer details.
    public function getAllProducersDetailsForAgriOfficers($agriOfficerDistrictID): array
    {
        $stmt = Model::select(
            table: "producer",
            columns: ["producer.nic_number", "registered_user.name", "registered_user.address",
                "registered_user.contact_no"],
            where: ["producer.district_id" => $agriOfficerDistrictID],
            joins: ["registered_user" => "producer.id"]
        );
        return [];
    }

    /**
     * @return string|null
     */
    public function getNicNumber(): ?string
    {
        return $this->nicNumber;
    }

    /**
     * @param string|null $nicNumber
     */
    public function setNicNumber(?string $nicNumber): void
    {
        $this->nicNumber = $nicNumber;
    }

    /**
     * @return int|null
     */
    public function getDistrict(): ?int
    {
        return $this->district;
    }

    /**
     * @param int|null $district
     */
    public function setDistrict(?int $district): void
    {
        $this->district = $district;
    }
}
