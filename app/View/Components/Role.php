<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Role extends Component
{
    public $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function render()
    {
        return function (array $data) {
            return $data['user'] && $data['user']->role === $this->role ? $data['slot'] : '';
        };
    }
}
