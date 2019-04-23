<?php
/**
 * Created by PhpStorm.
 * User: geoffroy
 * Date: 25/01/2019
 * Time: 17:04
 */

namespace App\Policies;

use App\User;
use App\Lot;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

//use TCG\Voyager\Contracts\User;


class LotPolicy extends \TCG\Voyager\Policies\BasePolicy
{

    /**
     * Determine if the given model can be viewed by the user.
     *
     * @param \TCG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function browse(User $user, Lot $lot)
    {
        if($user->id === 1){
            return true;
        }else{
            return true;
            return $user->id === $lot->author_id;
        }
    }

    /**
     * Determine if the given model can be viewed by the user.
     *
     * @param \TCG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function read(User $user,  Lot $lot)
    {
        if($user->id === 1){
            return true;
        }else{
            return true;
            return $user->id === $lot->author_id;
        }
    }

    /**
     * Determine if the given model can be edited by the user.
     *
     * @param \TCG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function edit(User $user, Lot $lot)
    {
        if($user->id === 1){
            return true;
        }else{
            return true;
            return $user->id === $lot->author_id;
        }
    }

    /**
     * Determine if the given model can be deleted by the user.
     *
     * @param \TCG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function delete(User $user,  Lot $lot)
    {
        if($user->id === 1){
            return true;
        }else{
            return true;
            return $user->id === $lot->author_id;
        }
    }
}