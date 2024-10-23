<?php

use App\Providers\MidtransServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    MidtransServiceProvider::class
];
