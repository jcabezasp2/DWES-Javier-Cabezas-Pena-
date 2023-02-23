<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function create()
    {
        $project = new Project;
        $title = _('Crear proyecto');
        $textButton= _('Crear proyecto');
        $route = route('projects.store');

        return view('projects.form', compact('project', 'title', 'textButton', 'route'));
    }
}
