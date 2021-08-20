<?php

namespace App\View\Components;

use App\Models\Classified;
use App\Models\UserMembreship;
use Illuminate\View\Component;

class TreeComponent extends Component
{
    public $users = [];
    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct()
    {
        $currentUser =  UserMembreship::where('id', auth()->user()->id)->select('id', 'name', 'last_name', 'expiration_date')->get();

        $tmpUsers = UserMembreship::where('id_referrer_sponsor', auth()->user()->id)->select('id', 'id_referrer_sponsor AS pid', 'name', 'last_name', 'expiration_date')->get();

        $hijos=[];
        foreach ($tmpUsers as $item) {
            $tmUser =  UserMembreship::where('id_referrer_sponsor', $item->id)->select('id', 'id_referrer_sponsor AS pid', 'name', 'last_name', 'expiration_date')->get();
            if ($tmUser->isNotEmpty()) {
                $hijos = $tmUser;
            }
        }

        $nivel1 = $tmpUsers->merge($currentUser);
        $this->users = $nivel1->merge($hijos);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tree-component');
    }
}
