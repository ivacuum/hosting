<?php

Broadcast::channel('App.User.{id}', fn ($user, $id) => (int) $user->id === (int) $id);

Broadcast::channel('chat.typing', fn ($user) => ['auth' => $user->publicName()]);
