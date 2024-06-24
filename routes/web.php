<?php

use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;



#regionQR
Route::get('/scan-qr', [QRCodeController::class, 'scanQr']);
#endregion
