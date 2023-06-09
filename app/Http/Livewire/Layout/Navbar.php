<?php

namespace App\Http\Livewire\Layout;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $unreadNotificationsCount;
    public $notifications;

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->unreadNotificationsCount = $user->unreadNotifications->count();
            $this->notifications = $user->notifications()->whereNull('read_at')->latest()->limit(5)->get();
        }
    }
    public function render()
    {
        return view('livewire.layout.navbar');
    }

    public function markAllAsRead()
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications->markAsRead();
            $this->unreadNotificationsCount = 0;
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            $this->unreadNotificationsCount--;
            $this->notifications = Auth::user()->notifications()->whereNull('read_at')->latest()->limit(5)->get();
        }
    }
}
