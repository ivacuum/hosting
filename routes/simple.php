<?php

Route::get('cv', 'Home@cv');
Route::get('parser/fl/{login}/{passwd}', 'ParserFl@index');
