<?php

namespace app\models;

use app\core\Model;

class RegisteredUser extends Model
{
    private int $id;
    private string $name;
    private string $address;
    private string $lastLogin;
    private string $imageUrl;
    private string $email;
    private string $contactNo;
    private ?string $password;

    public function register(): bool
    {
        if ($this->emailExists()) {
            return false;
        }

        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        unset($this->password);
        $result = $this->runQuery(
            "INSERT into registered_user (name, address, email, contact_no, hashed_password) VALUES (?,?,?,?,?)",
            [$this->name, $this->address, $this->email, $this->contactNo, $hash]
        );
        return $result == true;
    }

    private function emailExists(): bool
    {
        $result = $this->runQuery("SELECT id FROM registered_user WHERE email=?", [$this->email])->fetch();
        return $result == true;
    }

    public function loginByEmail($email, $password): ?RegisteredUser
    {
        $result = $this->runQuery("SELECT * FROM registered_user WHERE email=?", [$email])->fetch();
        if ($result) {
            $hash = $result["hashed_password"];
            if (password_verify($password, $hash)) {
                $this->fillData(['id' => $result["id"], 'name' => $result["name"], 'address' => $result["address"],
                    'email' => $result["email"], 'contactNo' => $result["contact_no"]]);
            } else {
                $this->id = -1;
            }
            return $this;
        }
        return null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getLastLogin(): string
    {
        return $this->lastLogin;
    }

    public function setLastLogin(string $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getContactNo(): string
    {
        return $this->contactNo;
    }

    public function setContactNo(string $contactNo): void
    {
        $this->contactNo = $contactNo;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
