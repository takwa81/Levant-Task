<?php

namespace App\Services;

use App\PaginationEnum;
use App\Repositories\UserRepository;
use App\Traits\ResultTrait;
use App\Traits\ImageHandler;

class UserService
{
    use ResultTrait , ImageHandler;


    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        $perPage = PaginationEnum::DefaultCount->value;

        $users = $this->userRepository->makeModel()
            ->latest()
            ->paginate($perPage);

        return [
            'users' => $users->items(),
            'pagination' => $this->paginationResult($users),
        ];
    }

    public function create(array $data)
    {

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->storeImage($data['image'], 'user_images');
        }

        return $this->userRepository->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->userRepository->find($id);

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->updateImage(
                $data['image'],
                $user->image,
                'user_images'
            );
        }
        $user->update($data);

        return $user;
    }
}
