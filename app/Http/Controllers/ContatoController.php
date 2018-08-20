<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.contact');
    }
}