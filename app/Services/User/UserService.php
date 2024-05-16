<?php

declare(strict_types=1);

namespace App\Services\User;


use App\Handlers\ResourceHandler;
use Illuminate\Http\Client\ConnectionException;

class UserService extends ResourceHandler
{
    /**
     * @throws ConnectionException
     */
    public function getListOfUsers(): array
    {
        return $this->list();
    }

    public function deleteUser(int $userId): array
    {
        return $this->delete($userId);
    }

    public function storeUser(array $attributes): array
    {
        return $this->store($attributes);
    }

    public function getUser(int $id): array
    {
        return $this->find($id);
    }

    public function updateUser(array $attributes, int $id): array
    {
        return $this->update($attributes, $id);
    }

    public function getFullPath(int|string|null $resourceId = null): string
    {
        $baseUrl = $this->config->get('crud.users.base_url');

        if( $resourceId == null ){
            return $baseUrl . '/users';
        }

        return $baseUrl . '/users/'. $resourceId;
    }
}