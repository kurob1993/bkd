<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Charts\opdNonPns;
use App\Models\MasterOpd;
use App\Models\Employee;
use App\Models\EmployeeStatus;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $opd = isset($request->opd) ? $request->opd : 1;
        $mopd = MasterOpd::all();

        $emp = Employee::select('gapok')->tkk()->get();
        $totalTkk = $emp->sum('gapok');

        $emp = Employee::select('gapok')->tks()->get();
        $totalTks = $emp->sum('gapok');

        $emp = Employee::select('gapok')->hkl()->get();
        $totalHkl = $emp->sum('gapok');

        $emp = Employee::select('gapok')->k2()->get();
        $totalK2 = $emp->sum('gapok');

        $opdNonPns = $this->KategoriNonPns($opd);
        $opdPendidikan = $this->KelasifikasiPendidikan($opd);
        $opdJenisKelamin = $this->KelasifikasiJenisKelamin($opd);
        $opdGaji = $this->KelasifikasiGaji();
        $opdGajiTkk = $this->KelasifikasiGajiTkk();
        $opdGajiTks = $this->KelasifikasiGajiTks();
        $opdGajiHkl = $this->KelasifikasiGajiHkl();
        $opdGajiK2 = $this->KelasifikasiGajiK2();
        return view('dashboard.index', compact(
            'mopd',
            'opd',
            'opdNonPns',
            'opdPendidikan',
            'opdJenisKelamin',
            'opdGaji',
            'opdGajiTkk',
            'opdGajiTks',
            'opdGajiHkl',
            'opdGajiK2',
            'totalTkk',
            'totalTks',
            'totalHkl',
            'totalK2'
        ));
    }

    public function KategoriNonPns($opd)
    {
        $opd = isset($opd) ? $opd : 1;

        $mopdChart = MasterOpd::where('id',$opd)->get();
        
        $mopdLabel = $mopdChart->map(function($item, $key){
            return $item->text;
        });

        $opdNonPns = new opdNonPns();
        $opdNonPns->labels($mopdLabel);
        foreach (EmployeeStatus::all() as $key => $value) {

            $empOfOpd = $mopdChart->map(function($item, $key) use($value) {
                return $item->employees->where('employee_status_id',$value->id)->count();
            });

            $opdNonPns->dataset($value->text, 'bar', $empOfOpd)->backgroundColor('rgba('.rand(0,255).', '.rand(0,255).', '.rand(0,255).', 0.3)')->fill(false);
        }

        return $opdNonPns;
    }

    public function KelasifikasiPendidikan($opd)
    {
        $opd = isset($opd) ? $opd : 1;

        $mopdChart = MasterOpd::where('id',$opd)->get();
        
        $mopdLabel = $mopdChart->map(function($item, $key){
            return $item->text;
        });

        $opdNonPns = new opdNonPns();
        $opdNonPns->labels($mopdLabel);
        foreach (Employee::select('pendidikan')->groupBy('pendidikan')->get() as $key => $value) {
            $empOfOpd = $mopdChart->map(function($item, $key) use($value) {
                return $item->employees->where('pendidikan',$value->pendidikan)->count();
            });
            $opdNonPns->dataset($value->pendidikan, 'bar', $empOfOpd)->backgroundColor('rgba('.rand(0,255).', '.rand(0,200).', '.rand(0,155).', 0.3)')->fill(false);
        }

        return $opdNonPns;
    }

    public function KelasifikasiJenisKelamin($opd)
    {
        $opd = isset($opd) ? $opd : 1;

        $mopdChart = MasterOpd::where('id',$opd)->get();
        
        $mopdLabel = $mopdChart->map(function($item, $key){
            return $item->text;
        });

        $opdNonPns = new opdNonPns();
        $opdNonPns->labels($mopdLabel);
        foreach (Employee::select('jenis_kelamin')->groupBy('jenis_kelamin')->get() as $key => $value) {
            $empOfOpd = $mopdChart->map(function($item, $key) use($value) {
                return $item->employees->where('jenis_kelamin',$value->jenis_kelamin)->count();
            });
            $opdNonPns->dataset($value->jenis_kelamin, 'bar', $empOfOpd)->backgroundColor('rgba('.rand(0,255).', '.rand(0,200).', '.rand(0,155).', 0.3)')->fill(false);
        }

        return $opdNonPns;
    }

    public function KelasifikasiGaji()
    {
        $mopdChart = MasterOpd::all();
        
        $mopdLabel = $mopdChart->map(function($item, $key){
            return Str::limit($item->text, 10);
        });
        $mopdColor = $mopdChart->map(function($item, $key){
            return 'rgba('.rand(0,255).', '.rand(0,200).', '.rand(0,155).', 0.3)';
        });

        $opdNonPns = new opdNonPns();
        $opdNonPns->labels($mopdLabel);

        $empOfOpd = $mopdChart->map(function($item, $key) {
            return $item->employees->sum('gapok');
        });

        $opdNonPns->dataset('', 'bar', $empOfOpd)->backgroundColor($mopdColor)->fill(false);
        $opdNonPns->displayLegend(false);
        return $opdNonPns;
    }

    public function KelasifikasiGajiTkk()
    {
        $emp = Employee::tkk()->get();
        $data = $emp->map(function($item, $key){
            return $item->gapok;
        });
        $label = $emp->map(function($item, $key){
            return $item->nama;
        });

        $opdNonPns = new opdNonPns();
        $opdNonPns->labels($label);
        $opdNonPns->dataset('', 'bar', $data)->backgroundColor('rgba(255,255,255,0.2)')->fill(false);
        $opdNonPns->displayLegend(false);
        $opdNonPns->displayAxes(false);
        $opdNonPns->options(['responsive' => true]);
        return $opdNonPns;
    }
    public function KelasifikasiGajiK2()
    {
        $emp = Employee::k2()->get();
        $data = $emp->map(function($item, $key){
            return $item->gapok;
        });
        $label = $emp->map(function($item, $key){
            return $item->nama;
        });

        $opdNonPns = new opdNonPns();
        $opdNonPns->labels($label);
        $opdNonPns->dataset('', 'bar', $data)->backgroundColor('rgba(255,255,255,0.2)')->fill(false);
        $opdNonPns->displayLegend(false);
        $opdNonPns->displayAxes(false);
        $opdNonPns->options(['responsive' => true]);
        return $opdNonPns;
    }
    public function KelasifikasiGajiTks()
    {
        $emp = Employee::tks()->get();
        $data = $emp->map(function($item, $key){
            return $item->gapok;
        });
        $label = $emp->map(function($item, $key){
            return $item->nama;
        });

        $opdNonPns = new opdNonPns();
        $opdNonPns->labels($label);
        $opdNonPns->dataset('', 'bar', $data)->backgroundColor('rgba(255,255,255,0.2)')->fill(false);
        $opdNonPns->displayLegend(false);
        $opdNonPns->displayAxes(false);
        $opdNonPns->options(['responsive' => true]);
        return $opdNonPns;
    }
    public function KelasifikasiGajiHkl()
    {
        $emp = Employee::hkl()->get();
        $data = $emp->map(function($item, $key){
            return $item->gapok;
        });
        $label = $emp->map(function($item, $key){
            return $item->nama;
        });

        $opdNonPns = new opdNonPns();
        $opdNonPns->labels($label);
        $opdNonPns->dataset('', 'bar', $data)->backgroundColor('rgba(255,255,255,0.2)')->fill(false);
        $opdNonPns->displayLegend(false);
        $opdNonPns->displayAxes(false);
        $opdNonPns->options(['responsive' => true]);
        return $opdNonPns;
    }

    public function test(Request $request)
    {
        // return $request->filled('remember');
        dd( Auth::user() );
    }
}
