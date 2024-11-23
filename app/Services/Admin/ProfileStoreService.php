<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\File;

class ProfileStoreService
{
    public function profileStore($data, $file)
    {
        $admin = auth()->guard('admin')->user();

        $admin->name = $data['name'];
        $admin->email = $data['email'];
        $admin->phone = $data['phone'];
        $admin->address = $data['address'];

        if ($file) {
            $this->handleFileUpload($admin, $file);
        }

        $notification = [
            'message' => 'Profile updated successfully',
            'alert-type' => 'success',
        ];

        return ['admin' => $admin, 'notification' => $notification];
    }

    protected function handleFileUpload(Admin $admin, $file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('upload/admin_images'), $fileName);
        $oldPhoto = $admin->photo;

        $admin->photo = $fileName;

        if ($oldPhoto && $oldPhoto !== $fileName) {
            $this->deleteOldImage($oldPhoto);
        }

        $admin->save();
    }

    protected function deleteOldImage($oldPhoto)
    {
        $path = public_path('upload/admin_images/' . $oldPhoto);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}