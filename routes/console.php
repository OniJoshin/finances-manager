<?php

use Illuminate\Console\Scheduling\Schedule;

app(Schedule::class)->command('income:generate-recurring')->daily();
app(Schedule::class)->command('expense:generate-recurring')->daily();
