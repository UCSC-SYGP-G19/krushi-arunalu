<?php

/**
 * @file
 * Model to represent the RegisteredUser table in the database
 * Contains both attributes and methods related to the RegisteredUser entity
 */

namespace app\models;

use app\core\Model;

class RegisteredUser extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?string $role = null,
        private ?string $name = null,
        private ?string $address = null,
        private ?string $lastLogin = null,
        private ?string $imageUrl = null,
        private ?string $email = null,
        private ?string $contactNo = null,
        private ?string $password = null,
        private ?bool $isEmailVerified = null,
        private ?string $tempHash = null,
    ) {
    }

    public function register(): bool
    {
        if ($this->emailExists() || $this->phoneExists()) {
            return false;
        }

        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        unset($this->password);

        $result = $this->runQuery(
            "INSERT into registered_user (role, name, address, last_login, image_url, email, contact_no, 
                             hashed_password)
            VALUES (?,?,?,?,?,?,?,?)",
            [$this->role, $this->name, $this->address, $this->lastLogin, $this->imageUrl, $this->email,
                $this->contactNo, $hash]
        );
        return $result == true;
    }

    private function emailExists(): bool
    {
        $result = $this->runQuery("SELECT id FROM registered_user WHERE email=?", [$this->email])->fetch();
        return $result == true;
    }

    private function phoneExists(): bool
    {
        $result = $this->runQuery("SELECT id FROM registered_user WHERE contact_no=?", [$this->contactNo])->fetch();
        return $result == true;
    }

    public function loginByEmailOrPhone($type, $emailOrPhone, $password): ?object
    {
        if ($type === 'email') {
            $result = $this->runQuery("SELECT * FROM registered_user WHERE email=?", [$emailOrPhone])->fetch();
        } elseif ($type === 'phone') {
            $result = $this->runQuery("SELECT * FROM registered_user WHERE contact_no=?", [$emailOrPhone])->fetch();
        } else {
            return null;
        }

        if ($result) {
            $hash = $result->hashed_password;
            if (password_verify($password, $hash)) {
                $this->updateLastLogin($result->id);
                $this->updateTempHash($result->id);

                $result->hashed_password = null;
                $result->temp_hash = $this->runQuery(
                    "SELECT temp_hash FROM registered_user WHERE id=?",
                    [$result->id]
                )->fetch()->temp_hash;
            } else {
                $result->id = -1;
            }

            return $result;
        }
        return null;
    }

    protected function updateLastLogin($userId): bool
    {
        return $this->update(
            table: "registered_user",
            data: ["last_login" => date("Y-m-d H:i:s")],
            where: ["id" => $userId]
        );
    }

    protected function updateTempHash($userId): bool
    {
        return $this->update(
            table: "registered_user",
            data: ["temp_hash" => hash("sha256", $userId . date("Y-m-d H:i:s"))],
            where: ["id" => $userId]
        );
    }

    public static function getUserIdByTempHash($tempHash): ?int
    {
        $result = Model::select(
            table: 'registered_user',
            columns: ['id'],
            where: ['temp_hash' => $tempHash],
            useSingleton: false
        )->fetch();
        if ($result) {
            return $result->id;
        }
        return null;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $role
     */
    public function setRole(?string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getLastLogin(): ?string
    {
        return $this->lastLogin;
    }

    /**
     * @param string|null $lastLogin
     */
    public function setLastLogin(?string $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     */
    public function setImageUrl(?string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getContactNo(): ?string
    {
        return $this->contactNo;
    }

    /**
     * @param string|null $contactNo
     */
    public function setContactNo(?string $contactNo): void
    {
        $this->contactNo = $contactNo;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return bool|null
     */
    public function getIsEmailVerified(): ?bool
    {
        return $this->isEmailVerified;
    }

    /**
     * @param bool|null $isEmailVerified
     */
    public function setIsEmailVerified(?bool $isEmailVerified): void
    {
        $this->isEmailVerified = $isEmailVerified;
    }

    /**
     * @return string|null
     */
    public function getTempHash(): ?string
    {
        return $this->tempHash;
    }

    /**
     * @param string|null $tempHash
     */
    public function setTempHash(?string $tempHash): void
    {
        $this->tempHash = $tempHash;
    }
}
