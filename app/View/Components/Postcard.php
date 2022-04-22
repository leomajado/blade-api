<?php

namespace App\View\Components;

use __PHP_Incomplete_Class;
use Illuminate\View\Component;

class Postcard extends Component
{
    public ?string $title;
    public ?string $body;
    public ?string $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $title = null, ?string $body = null, ?string $color = 'primary')
    {
        $this->title = $title;
        $this->body = $body;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.postcard');
    }
}
