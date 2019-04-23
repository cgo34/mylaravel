<?php
/**
 * Created by PhpStorm.
 * User: geoffroy
 * Date: 20/11/2018
 * Time: 12:22
 */

namespace App\Widgets;

use App\Programme;
use App\User;
use Arrilot\Widgets\AbstractWidget;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;


class ProgrammeDimmer extends AbstractWidget
{
    protected $config = [];

    public function run()
    {


        if(Auth::user()->id === 1){
            $count = Programme::count();
            $string = $count == 1 ? 'Programme' : 'Programmes';
        }else{
            $count = Programme::where('author_id', Auth()->user()->id)->count();
            $string = $count == 1 ? 'Programme' : 'Programmes';
        }
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => "Vous avez {$count} {$string} dans votre base de données. Cliquez sur le bouton pour voir tous vos programmes.",
            'button' => [
                'text' => 'Voir les programmes',
                'link' => route('voyager.programmes.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.png'),
        ]));


    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return true;
    }
}