<?php

use App\Models\AdminLog;

function log_admin_action($action, $model = null, $model_id = null, $details = null)
{
    AdminLog::create([
        'admin_id' => auth()->id(),
        'action'   => $action,
        'model'    => $model,
        'model_id' => $model_id,
        'details'  => is_array($details) ? json_encode($details) : $details
    ]);
}
