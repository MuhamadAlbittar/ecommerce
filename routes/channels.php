<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;


Broadcast::channel('users.{id}', function ($user, $id) {

    if (!$user) {
        \Log::error('Auth failed: No user logged in');
        return false;
    }

    \Log::info('Authorizing channel users.' . $id . ' for user ' . $user->id);

    return (int) $user->id === (int) $id;
});

