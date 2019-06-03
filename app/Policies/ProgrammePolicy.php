<?php
/**
 * Created by PhpStorm.
 * User: geoffroy
 * Date: 25/01/2019
 * Time: 17:04
 */

namespace App\Policies;

use App\User;
use App\Programme;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

//use TCG\Voyager\Contracts\User;


class ProgrammePolicy extends \TCG\Voyager\Policies\BasePolicy
{

    /**
     * Determine if the given model can be viewed by the user.
     *
     * @param \TCG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function browse(User $user, Programme $programme)
    {
        return true;
        if($user->id === 1){
            return true;
        }else{
            return true;

            return $user->lastname === $programme->lastname;
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
    public function read(User $user,  Programme $programme)
    {

        if($user->id === 1){
            return true;
        }else{
            //return true;
            return $user->id === $programme->author_id;
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
    public function edit(User $user, Programme $programme)
    {
        if($user->id === 1){
            return true;
        }else{
            return $user->id === $programme->author_id;
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
    public function delete(User $user,  Programme $programme)
    {
        if($user->id === 1){
            return true;
        }else{
            return $user->id === $programme->author_id;
        }
    }
}
