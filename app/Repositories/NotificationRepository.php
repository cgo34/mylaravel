<?php
/**
 * Created by PhpStorm.
 * User: geoffroy
 * Date: 27/03/2019
 * Time: 11:57
 */

namespace App\Repositories;

use Illuminate\Support\Facades\DB;


class NotificationRepository
{
    public function deleteContactDuplicate($user, $contact)
    {
        DB::table('notifications')
            ->whereNotifiableId($contact->user->id)
            ->whereNull('read_at')
            ->where('data->image_id', $contact->id)
            ->where('data->user', $user->id)
            ->delete();
    }

    public function deleteDenonceDuplicate($user, $denonce)
    {
        DB::table('notifications')
            ->whereNotifiableId($denonce->user->id)
            ->whereNull('read_at')
            ->where('data->image_id', $denonce->id)
            ->where('data->user', $user->id)
            ->delete();
    }
}