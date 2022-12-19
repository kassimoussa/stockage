<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Stock;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function index(Request $request)
    {
        $level = session('level');
        $dir = session('direction');
        $service = session('service');
        $sih = 'IT HelpDesk';
        $sites = Site::where('direction', $dir)->where('service', $service)->get();
        
        if ($service == $sih) {
            return view('sih.'.$level.'.stock.index', compact('sites'));
        } else {
            return view($level.'.stock.index', compact('sites'));
        }
    }

    public function stocksite($site)
    {
        $level = session('level');
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk';

        if ($service == $sih) {
            return view('sih.'.$level.'.stock.liste', compact('site'));
        } else {
            return view($level.'.stock.liste', compact('site'));
        }
    }

    
    public function rentree(Stock $stock)
    {
        $level = session('level');
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk';

        if ($service == $sih) {
            return view('sih.'.$level.'.stock.rentree', compact('stock'));
        } else {
            return view($level.'.stock.rentree', compact('stock'));
        }
    }

    public function sortie(Stock $stock)
    {
        $level = session('level');
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk';

        if ($service == $sih) {
            return view('sih.'.$level.'.stock.sortiee', compact('stock'));
        } else {
            return view($level.'.stock.sortiee', compact('stock'));
        }
    }

    public function allrentrees($site)
    {
        $level = session('level');
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk';

        if ($service == $sih) {
            return view('sih.'.$level.'.stock.all_rentree', compact('site'));
        } else {
            return view($level.'.stock.all_rentree', compact('site'));
        }
    }

    public function allsorties($site)
    {
        $level = session('level');
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk';

        if ($service == $sih) {
            return view('sih.'.$level.'.stock.all_sortiee', compact('site'));
        } else {
            return view($level.'.stock.all_sortiee', compact('site'));
        }
    }

}
