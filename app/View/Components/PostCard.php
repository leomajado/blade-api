<?php

namespace app\View\Components;

use Illuminate\View\Component;

class Postcard extends Component
{
    public ?int $id;
    public ?string $title;
    public ?string $body;
    public ?string $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?int $id = 0, ?string $title = null, ?string $body = null, ?string $color = 'primary')
    {
        $this->id = $id;
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
        return view('components.post-card');
    }
}
