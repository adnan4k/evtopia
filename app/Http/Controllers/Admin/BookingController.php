<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\GeneraleSetting;
use App\Models\Service;
use App\Models\User;
use App\Repositories\NotificationRepository;
use App\Services\NotificationServices;
use Illuminate\Http\Request;

class BookingController extends Controller
{
     public function index(Request $request)
     {
         $generaleSetting = GeneraleSetting::first();
         $search = $request->search;
         $status = $request->status;
         $orderStatus = OrderStatus::cases();


         $bookings = Booking::query()
             ->when($search, function ($query) use ($search) {
                 $query->where('id', 'like', '%' . $search . '%')
                     ->orWhere('booking_code', 'like', '%' . $search . '%')
                     ->orWhere('order_status', 'like', '%' . $search . '%')

                     ->orWhereHas('customer.user', function ($query) use ($search) {
                         $query->where('name', 'like', '%' . $search . '%');
                     });
             })
             ->when($status, function ($query) use ($status) {
                 $query->where('order_status', $status);
             })
             ->latest('id')
             ->paginate(10);
 
         return view('admin.booking.index', compact('bookings', 'search', 'status', 'orderStatus', 'generaleSetting'));
     }
 
     // Show form for creating a new booking
     public function create()
     {
         $services = Service::all();
         $customers = User::all();
         $providers = User::all();
 
         return view('bookings.create', compact('services', 'customers', 'providers'));
     }
 
     // Store a new booking
     public function store(Request $request)
     {
         $request->validate([
             'customer_id' => 'required|exists:users,id',
             'provider_id' => 'required|exists:users,id',
             'appointment_date' => 'required|date',
             'total_price' => 'required|numeric',
             'status' => 'required|in:pending,confirmed,completed,canceled',
             'booking_items' => 'required|array',
             'booking_items.*.service_id' => 'required|exists:services,id',
             'booking_items.*.quantity' => 'required|integer|min:1',
             'booking_items.*.unit_price' => 'required|numeric',
             'booking_items.*.tax_price' => 'required|numeric',
             'booking_items.*.total_price' => 'required|numeric',
         ]);
 
         $booking = Booking::create($request->only(['customer_id', 'provider_id', 'total_price', 'status', 'appointment_date', 'remark']));
 
         foreach ($request->booking_items as $item) {
             $booking->bookingItems()->create($item);
         }
 
         return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
     }
 
     // Show details for a specific booking
     public function show($id)
     {
        $order = Booking::find($id);
         $orderStatus = OrderStatus::cases();
        
         return view('admin.booking.show', compact('order', 'orderStatus'));
     }
 

     public function statusChange($id, Request $request)
     {

        $order = Booking::find($id);
        $request->validate(['status' => 'required']);
 
         $order->update(['order_status' => $request->status]);
 
         $title = 'Booking status updated';
         $message = 'Your booking status updated to '.$request->status;
         $deviceKeys = $order->customer->user->devices->pluck('key')->toArray();
 
        //  if ($request->status == OrderStatus::CANCELLED->value) {
        //      foreach ($order->bookingItems as $prodduct) {
        //          $prodduct->update(['quantity' => $prodduct->quantity + $prodduct->pivot->quantity]);
        //      }
        //  }
 
         try {
             NotificationServices::sendNotification($message, $deviceKeys, $title);
         } catch (\Throwable $th) {
         }
 
         $nofify = (object) [
             'title' => $title,
             'content' => $message,
             'user_id' => $order->customer->user_id,
             'type' => 'order',
         ];
 
         NotificationRepository::storeByRequest($nofify);
 
         return back()->with('success', __('Booking status updated successfully.'));
     }



     public function paymentStatusToggle($id)
     {

        $order = Booking::find($id);
         if ($order->payment_status == PaymentStatus::PAID->value) {
             return back()->with('error', __('When booking is paid, payment status cannot be changed.'));
         }
         $order->update(['payment_status' => PaymentStatus::PAID->value]);
 
         $title = 'Payment status updated';
         $message = __('Your payment status updated to paid. order code: ').$order->prefix.$order->booking_code;
         $deviceKeys = $order->customer->user->devices->pluck('key')->toArray();
 
         try {
             NotificationServices::sendNotification($message, $deviceKeys, $title);
         } catch (\Throwable $th) {
         }
 
         $nofify = (object) [
             'title' => $title,
             'content' => $message,
             'user_id' => $order->customer->user_id,
             'type' => 'order',
         ];
 
         NotificationRepository::storeByRequest($nofify);
 
         return back()->with('success', __('Payment status updated successfully'));
     }

     // Update the status of a booking
     public function updateStatus(Request $request, Booking $booking)
     {
         $request->validate(['status' => 'required|in:pending,confirmed,completed,canceled']);
 
         $booking->update(['status' => $request->status]);
 
         return redirect()->route('bookings.index')->with('success', 'Booking status updated.');
     }
 
     // Delete a booking
     public function destroy(Booking $booking)
     {
         $booking->delete();
 
         return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
     }
 }