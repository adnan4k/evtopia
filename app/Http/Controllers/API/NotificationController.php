<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebNotificationResource;
use App\Models\Notification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Fetch notifications for a user
    public function index(Request $request)
    {
        $userId = $request->user_id; // Assuming you're using authentication

        $notifications = Notification::query()
            ->where('user_id', $userId)
            ->orderBy('is_read', 'asc')
            ->where('is_read', false)
            ->latest('id')
            ->get();

        $total = Notification::query()
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'message' => 'Notifications fetched successfully',
            'data' => [
                'total' => $total >= 10 ? '9+' : $total,
                'notifications' => WebNotificationResource::collection($notifications),
            ],
        ], 200);
    }

    public function index_mobile(Request $request)
    {
        $userId = $request->user_id; // Assuming you're using authentication

        $notifications = Notification::query()
            ->where('user_id', $userId)
            ->orderBy('is_read', 'asc')
            // ->where('is_read', false)
            ->latest('id')
            ->get();

        $total = Notification::query()
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'message' => 'Notifications fetched successfully',
            'data' => [
                'total' => $total >= 10 ? '9+' : $total,
                'notifications' => WebNotificationResource::collection($notifications),
            ],
        ], 200);
    }

    public function totalNotification(Request $request)
    {
        $userId = $request->user_id;


        if($userId == null) {
            return response()->json([
                'message' => 'Notifications Counted successfully',
                'data' => [
                    'total' => 0,
                ]
            ], 200);
        }

        $total = Notification::query()
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'message' => 'Notifications Counted successfully',
            'data' => [
                'total' => $total,
            ],
        ], 200);
    }


    public function disable_notification(Request $request, $id)
    {
        $user = (new UserRepository)->query()->role('customer')->where('id', $id)->first();
        if(! $user) {
            return response()->json(['success' => false], 200);
        }
        $user->customer->update(['notification_enabled' => !$user->customer->notification_enabled]);
        return response()->json(['success' => $user->customer->notification_enabled], 200);    
    }
    // Mark a notification as read
    public function markAsRead(Request $request, $notificationId)
    {
        $notification = Notification::query()
            ->where('id', $notificationId)
            ->where('user_id', $request->user_id)
            ->firstOrFail();

        $notification->update(['is_read' => true]);

        return response()->json([
            'message' => 'Notification marked as read.',
            'data' => new WebNotificationResource($notification),
        ], 200);
    }

    // Show all notifications for a user (paginated)
    public function show(Request $request)
    {
        $userId = $request->user_id;

        $notifications = Notification::query()
            ->where('user_id', $userId)
            ->orderBy('is_read', 'asc')
            ->latest('id')
            ->paginate(10);

        return response()->json([
            'message' => 'Notifications fetched successfully.',
            'data' => WebNotificationResource::collection($notifications),
        ], 200);
    }

    // Mark all notifications as read
    public function markAllAsRead(Request $request)
    {
        $userId = $request->user_id;

        Notification::query()
            ->where('user_id', $userId)
            ->update(['is_read' => true]);

        return response()->json([
            'message' => __('All notifications marked as read!'),
        ], 200);
    }

    // Delete a notification
    public function destroy(Request $request, $notificationId)
    {
        $notification = Notification::query()
            ->where('id', $notificationId)
            ->where('user_id', $request->user_id)
            ->firstOrFail();

        $notification->delete();

        return response()->json([
            'message' => __('Notification deleted!'),
        ], 200);
    }
}
