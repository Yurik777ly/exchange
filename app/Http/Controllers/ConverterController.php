<?php

namespace App\Http\Controllers;

use App\Service\Converter;
use Illuminate\Http\Request;

class ConverterController extends Controller
{
    /**
     * @var Converter
     */
    protected $converter;

    /**
     * @param Converter $converter
     */
    public function __construct(Converter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('index', ['data' => $this->converter->getExchanges()]);
    }

    public function converter(Request $request)
    {
        return view('converter', ['data' => $this->converter->convert('USD', 'EUR')]);
    }
}
