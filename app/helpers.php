<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

function log_activity($action, $model = null, $model_id = null, $details = null)
{
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => $action,
        'model' => $model,
        'model_id' => $model_id,
        'details' => is_array($details) ? json_encode($details) : $details,
    ]);
}
