<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function findById($id)
    {
        return User::find($id) ?? null;
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);
        return $user->fresh();
    }

    public function delete($id)
    {
        $isDeleted = User::findOrFail($id)->delete();
        if ($isDeleted) {
            return $id;
        }
        return false;
    }
}
