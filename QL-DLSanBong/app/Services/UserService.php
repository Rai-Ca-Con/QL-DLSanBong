<?php

namespace App\Services;

use App\Enums\ErrorCode;
use App\Exceptions\AppException;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

//    public function getAllUsers()
//    {
//        return $this->userRepository->getAll();
//    }

    public function createUser(array $data)
    {
        $user = $this->userRepository->create($data);
        return $user;
    }

    public function updateUser($userId, array $data)
    {
        $existingUser = $this->userRepository->findById($userId);
        if ($existingUser == null)
            throw new AppException(ErrorCode::USER_NON_EXISTED);

        if ($data['user_id'] != $existingUser->id)
            throw new AppException(ErrorCode::UNAUTHORIZED);

        // Update user information based on the DTO
        if (isset($data['name']) && !empty($data['name'])) {
            $existingUser->name = $data['name'];
        }

        if (isset($data['address']) && !empty($data['address'])) {
            $existingUser->address = $data['address'];
        }

        if (isset($data['phone_number']) && !empty($data['phone_number'])) {
            $existingUser->phone_number = $data['phone_number'];
        }

        // Save the updated user
        $userUpdate = $this->userRepository->update($existingUser->id, $data);
        return $userUpdate;
    }

    public function deleteUser($userId, $currentUser, $role, $accessToken)
    {
        $existingUser = $this->userRepository->findById($userId);
        if ($existingUser == null)
            throw new AppException(ErrorCode::USER_NON_EXISTED);

        if (!($currentUser == $existingUser->id || $role == 1)) {
            throw new AppException(ErrorCode::UNAUTHORIZED);
        }

        if ($role != 1) {
            JWTAuth::setToken($accessToken)->invalidate();
        }

        $this->userRepository->update($existingUser->id, ['refresh_token' => '']);
        return $this->userRepository->delete($userId);
    }
}
