<?php

/**
 * @file
 * Model to represent the RegisteredUser table in the database
 * Contains both attributes and methods related to the RegisteredUser entity
 */

namespace app\models;

use app\core\Model;

class Customer extends RegisteredUser
{
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?string $email = null,
        private ?string $address = null,
        private ?string $contactNo = null,
        private ?string $password = null,
        private ?string $lastLogin = null,
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
            "INSERT into registered_user (name, email, address, contact_no, hashed_password)
            VALUES (?,?,?,?,?)",
            [$this->name, $this->email, $this->address, $this->contactNo, $hash]
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
                $result->hashed_password = null;
            } else {
                $result->id = -1;
            }
            return $result;
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
}
