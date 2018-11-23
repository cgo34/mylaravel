<?php
/**
 * Created by PhpStorm.
 * User: geoffroy
 * Date: 20/11/2018
 * Time: 12:22
 */

namespace App\Widgets;

use App\Dispositif;
use Arrilot\Widgets\AbstractWidget;


class DispositifDimmer extends AbstractWidget
{
    protected $config = [];

    public function run()
    {
        $count = Dispositif::count();
        $string = $count == 1 ? 'Dispositif' : 'Dispositifs';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => "Vous avez {$count} {$string} dans votre base de données. Cliquez sur le bouton pour voir tous vos dispositifs.",
            'button' => [
                'text' => 'Voir les dispositifs',
                'link' => route('voyager.dispositifs.index'),
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