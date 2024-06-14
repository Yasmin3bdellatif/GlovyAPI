<?php

use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;



#regionQR
Route::prefix('patients')->group(function () {
    Route::post('scan', [QRCodeController::class, 'scan']); // تسجيل طلب المسح
    Route::get('report/{id}', [QRCodeController::class, 'report']); // عرض تقرير المريض
});
#endregion
