<?php

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.typing', function ($user) {
    return ['auth' => $user->publicName()];
});
