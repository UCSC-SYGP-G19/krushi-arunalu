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
    private ?int $id;
    private ?string $role;
    private ?string $name;
    private ?string $address;
    private ?string $lastLogin;
    private ?string $imageUrl;
    private ?string $email;
    private ?string $contactNo;
    private ?string $password;

    public function __construct(
        $id,
        $role,
        $name,
        $address,
        $lastLogin,
        $imageUrl,
        $email,
        $contactNo,
        $password
    ) {
        $this->id = $id;
        $this->role = $role;
        $this->name = $name;
        $this->address = $address;
        $this->lastLogin = $lastLogin;
        $this->imageUrl = $imageUrl;
        $this->email = $email;
        $this->contactNo = $contactNo;
        $this->password = $password;
    }

    public function register(): bool
    {
        if ($this->emailExists()) {
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

    public function loginByEmail($email, $password): ?RegisteredUser
    {
        $result = $this->runQuery("SELECT * FROM registered_user WHERE email=?", [$email])->fetch();
        if ($result) {
            $hash = $result["hashed_password"];
            if (password_verify($password, $hash)) {
                $this->fillData([
                    'id' => $result["id"],
                    'role' => $result["role"],
                    'name' => $result["name"],
                    'address' => $result["address"],
                    'lastLogin' => $result["last_login"],
                    'imageUrl' => $result["image_url"],
                    'email' => $result["email"],
                    'contactNo' => $result["contact_no"]]);
            } else {
                $this->id = -1;
            }
            return $this;
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
}
