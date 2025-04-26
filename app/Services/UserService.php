<?php

namespace App\Services;

use App\PaginationEnum;
use App\Repositories\UserRepository;
use App\Traits\ResultTrait;
use App\Traits\ImageHandler;

class UserService
{
    use ResultTrait, ImageHandler;


    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll($request)
    {
        $perPage = PaginationEnum::DefaultCount->value;
        $name = $request->name ;
        $email = $request->email ;
        $query = $this->userRepository->latest();

        if ($name) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if ($email) {
            $query->where('email', 'LIKE', "%$email%");
        }

        $users = $query->paginate($perPage);
        $userCount = $query->count();

        return [
            'users' => $users->items(),
            'pagination' => $this->paginationResult($users),
            'user_count' => $userCount, 
        ];
    }

    public function create(array $data)
    {

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->storeImage($data['image'], 'user_images');
        }

        $user = $this->userRepository->create($data);
        $user->assignRole('Normal User');
        return $user;
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

    public function delete($id)
    {
        $user = $this->userRepository->find($id);

        $user->delete();
    }
}
