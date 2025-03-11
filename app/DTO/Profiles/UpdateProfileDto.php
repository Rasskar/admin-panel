<?php

namespace App\DTO\Profiles;

class UpdateProfileDto
{
    /**
     * @param string $name
     * @param string $email
     * @param int $roleId
     * @param string|null $firstName
     * @param string|null $lastName
     */
    public function __construct(
        public string $name,
        public string $email,
        public int $roleId,
        public string|null $firstName,
        public string|null $lastName
    )
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'role_id' => $this->roleId
        ];
    }
}
