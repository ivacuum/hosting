<?php

namespace App\Domain;

enum LivewireEvent
{
    case FocusOnAnswer;
    case LanguageChanged;
    case RefreshComments;
    case SayOutLoud;
    case ScrollChatDown;
}
