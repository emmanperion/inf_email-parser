<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('email:parse')
    ->hourly();
