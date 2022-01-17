<?php

namespace App\Http\Controllers;

use App\Models\ExcludedUsers;
use App\Models\SystemSetting;
use App\Models\User;

class UserController extends Controller
{
    public static function inactive_user_excluded()
    {
        if (ExcludedUsers::whereIn('global_id', User::where('employment_status_id', 5)
            ->pluck('global_id')->all())
            ->update(['status' => 2])) {
            return true;
        } else {
            return false;
        }
    }

    public static function remove_users_joined_n_days()
    {
        $hiredUser = SystemSetting::where('fields_name', 'auto_exclude_new_users_with_a_hire_date_within_the_last_n_days')
            ->first();

        if ($hiredUser) {
            $date = date('Y-m-d', strtotime($hiredUser->value . ' day', strtotime(date('Y-m-d'))));

            $userIds = User::where('creation_date', '<', $date)->pluck('fqml_global_id')->all();
            if (ExcludedUsers::whereIn('global_id', $userIds)->update(['status' => 2])) {
                return true;
            }
        }

        return false;

    }
}
