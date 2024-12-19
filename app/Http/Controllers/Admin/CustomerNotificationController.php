<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\DeviceKey;
use App\Repositories\UserRepository;
use App\Services\NotificationServices;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class CustomerNotificationController extends Controller
{
    public function index(Request $request)
    {
        $search1 = $request->input('search1'); // Search for general users
        $search2 = $request->input('search2'); // Search for service users

        // Query for general users
        $usersQuery = (new UserRepository)->query()
            ->role('customer')
            ->whereHas('customer', function ($query) {
                $query->where('notification_enabled', false);
            })
            ->with('customer.vehicle');

        if ($search1) {
            $usersQuery->where(function ($query) use ($search1) {
                $query->where('name', 'like', "%$search1%")
                      ->orWhere('email', 'like', "%$search1%")
                      ->orWhere('phone', 'like', "%$search1%");
            });
        }

        $users = $usersQuery->get();

        // Query for service users
        $serviceUsersQuery = (new UserRepository)->query()
            ->role('customer')
            ->whereHas('customer.vehicle', function ($query) {
                $startOfWeek = now()->startOfWeek()->toDateString();
                $endOfWeek = now()->endOfWeek()->toDateString();
                $query->whereBetween('service_date', [$startOfWeek, $endOfWeek]);
            })
            ->with('customer.vehicle');

        if ($search2) {
            $serviceUsersQuery->where(function ($query) use ($search2) {
                $query->where('name', 'like', "%$search2%")
                      ->orWhere('email', 'like', "%$search2%")
                      ->orWhere('phone', 'like', "%$search2%");
            });
        }

        $serviceUsers = $serviceUsersQuery->get();


        return view('admin.notification.index', compact('users', 'serviceUsers'));
    }



    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'message' => 'required',
            'user' => 'required|array',
        ]);

        $message = $request->message;
        $title = $request->title;
        $users = $request->user;

        $keys = DeviceKey::whereIn('user_id', $users)
        ->whereHas('user.customer', function ($query) {
            $query->where('notification_enabled', false);
        })
        ->pluck('key')
        ->toArray();
        $response = NotificationServices::sendNotification($message, $keys, $title);

        foreach ($users as $user_id) {
            $user = User::find($user_id);

            if ($user && $user->customer && $user->customer->vehicle) {
                $vehicleInfo = $user->customer->vehicle;
                if ($vehicleInfo->service_date) {
                    $vehicleInfo->service_date = \Carbon\Carbon::parse($vehicleInfo->service_date)->addYear()->toDateString();
                    $vehicleInfo->save();
                }
            }
            Notification::create([
                'title' => $request->title,
                'content' => $request->message,
                'user_id' => $user_id ?? null,
                'shop_id' => $request->shop_id ?? null,
                'url' => $request->url ?? null,
                'icon' => $request->icon ?? null,
                'type' => $request->type ?? null,
                'withdraw_id' => $request->withdraw_id ?? null,
            ]);
        }
        if (! $response['success']) {
            return back()->withError($response['message']);
        }

        return back()->withSuccess(__('Notification sent successfully'));
    }

    public function filter()
    {
        $deviceType = request()->device_type;

        $users = UserRepository::query()->role('customer')->whereHas('devices')
            ->when($deviceType && $deviceType != 'all', function ($query) use ($deviceType) {
                $query->whereHas('devices', function ($devices) use ($deviceType) {
                    return $devices->where('device_type', $deviceType);
                });
            })->get();

        return $this->json('user list', [
            'users' => UserResource::collection($users),
        ]);
    }
}
