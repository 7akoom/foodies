<?php

namespace App\Services\Client;

use App\Models\Client;
use Illuminate\Support\Facades\File;

class ProfileStoreService
{
    public function profileStore($data, $photoFile, $coverFile)
    {
        $client = auth()->guard('client')->user();

        $client->name = $data['name'];
        $client->email = $data['email'];
        $client->phone = $data['phone'];
        $client->address = $data['address'];

        if ($photoFile) {
            $this->handleFileUpload($client, $photoFile, 'photo');
        }

        if ($coverFile) {
            $this->handleFileUpload($client, $coverFile, 'cover_photo');
        }

        $notification = [
            'message' => 'Profile updated successfully',
            'alert-type' => 'success',
        ];

        return ['client' => $client, 'notification' => $notification];
    }

    protected function handleFileUpload(Client $client, $file, $type)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('upload/client_images'), $fileName);
        $oldPhoto = $client->$type;

        $client->$type = $fileName;

        if ($oldPhoto && $oldPhoto !== $fileName) {
            $this->deleteOldImage($oldPhoto);
        }

        $client->save();
    }

    protected function deleteOldImage($oldPhoto)
    {
        $path = public_path('upload/client_images/' . $oldPhoto);
        if (File::exists($path)) {
            File::delete($path);
        }
    }


}