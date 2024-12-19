<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\CustomerVehicle;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Returns the user profile.
     *
     * @return mixed
     */
    public function index()
    {
        $user = auth()->user();

        return $this->json('profile details', [
            'user' => UserResource::make($user),
        ]);
    }

    /**
     * Updates the user profile.
     *
     * @param  UserRequest  $request  The request object containing the updated user data.
     */
    public function update(Request $request)
    {
        // if (app()->environment() == 'local') {
        //     return $this->json('You can not update your profile in demo mode', [
        //         'user' => UserResource::make(auth()->user()),
        //     ]);
        // }
        $user = UserRepository::updateByRequest($request, auth()->user());
        $vehicleInfo = $user->customer->vehicle; // Get the related vehicle

        if($vehicleInfo) {
            $vehicleInfo->make = $request->make;
            $vehicleInfo->model = $request->model;
            $vehicleInfo->year = $request->year;
            $vehicleInfo->service_date = $request->service_date;
            $vehicleInfo->save();
        } else {
            CustomerVehicle::create([
                'customer_id' => $user->customer->id,
                'make' => $request->make??null,
                'model' => $request->model??null,
                'year' => $request->year??null,
                'service_date' => $request->service_date??null
            ]);
        }

        $user->refresh();

        return $this->json('Profile updated successfully', [
            'user' => UserResource::make($user),
        ]);
    }

    /**
     * Change the user's password.
     *
     * @param  ChangePasswordRequest  $request  The request object containing the new password.
     * @return string The success message.
     *
     * @throws Some_Exception_Class If the current password does not match.
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();

        if (app()->environment() == 'local') {
            return $this->json('You can not change your password in demo mode', [], 200);
        }

        if (! Hash::check($request->current_password, $user->password)) {
            return $this->json('Current password does not match', [], 422);
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return $this->json('Password changed successfully');
    }
}
