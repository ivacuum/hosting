<?php

Broadcast::channel('App.User.{id}', static fn ($user, $id) => (int) $user->id === (int) $id);

Broadcast::channel('chat.typing', static fn ($user) => ['auth' => $user->publicName()]);
