<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $title, $action, $formId, $method, $button;

    public function __construct($id, $title, $action = '#', $formId = 'form', $method = null, $button = 'Simpan')
    {
        $this->id = $id;
        $this->title = $title;
        $this->action = $action;
        $this->formId = $formId;
        $this->method = $method;
        $this->button = $button;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-form');
    }
}
