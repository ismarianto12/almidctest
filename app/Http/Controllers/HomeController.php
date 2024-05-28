<?php

namespace App\Http\Controllers;

use App\Models\tmp_surat;
use App\Models\Tmsurat_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $view;
    protected $request;
    protected $route;

    public function __construct(Request $request)
    {
        // $this->middleware('auth');
        $this->request = $request;
        $this->view = '.home';
        $this->route = 'home';
    }


    public function index()
    {
        $tahun = $this->request->contract;
        $title = 'Welcome Page';

        $fsiswa = \DB::table('siswa')
            ->select(\DB::raw('count(id) as totalsiswa'))
            ->first();
        $tsisiwa = $fsiswa->totalsiswa;

        $ftendik = \DB::table('karyawan')
            ->select(\DB::raw('count(id) as tkaryawan'))
            ->where('status', 1)
            ->first();
        $ttendik = $ftendik->tkaryawan;

        $fkependidikan = \DB::table('siswa')
            ->select(\DB::raw('count(id) as tkpendidikan'))
            ->where('status', 2)
            ->first();
        $tkependidikan = isset($fkependidikan->tkependidikan) ? isset($fkependidikan->tkependidikan) : 0;
        $perpresensi = '10';

        return view(
            $this->view . '.home',
            compact(
                'title',
                'perpresensi',
                'tsisiwa',
                'tkependidikan',
                'ttendik',
            )
        );
    }



    public function pieData($par, $tahun)
    {

    }
    public function barData()
    {

    }

    public function dashboard()
    {
    }

    // requre api
    public function all_site()
    {
        $all_site = Tmsurat_master::get()->count();
        return response()->json_encode($all_site);
    }

    public function percetage_all_site($cat)
    {
        if ($cat == 1) {
            $jenis = 'EASTERN JABOTABEK';
        } else if ($cat == 2) {
            $jenis = 'CENTRAL JABOTABEK';
        } else if ($cat == 3) {
            $jenis = 'WESTERN JABOTABEK';
        }
        $data = Tmsurat_master::select(\DB::raw('count(id) as jumlahny'))->from('tmsurat_master')->where('region', $jenis)->count();
        return response()->json([
            'cat_data' => $data,
        ]);
    }

    function landingpage()
    {
        $title = "Welcome Page";
        return view('landingpage', compact('title'));
    }

    function register()
    {
        $title = "Register";
        return view('register', compact('title'));
    }

    public function custom_number_format($n, $precision = 3)
    {
        if ($n < 1000000) {
            // Anything less than a million
            $n_format = number_format($n);
        } else if ($n < 1000000000) {
            // Anything less than a billion
            $n_format = number_format($n / 1000000, $precision) . 'M';
        } else {
            // At least a billion
            $n_format = number_format($n / 1000000000, $precision) . 'B';
        }

        return $n_format;
    }
    // show data from this page use this line
    public function table_data()
    {
        $jenis = $this->request->jenis;
        $tahun = $this->request->tahun;
        // dd($)
        $back = Tmsurat_master::join('tr_surat_master', 'tr_surat_master.site', '=', 'tmsurat_master.site_id')->where('tmsurat_master.tmtahun_id', $tahun);
        $periode = $this->request->periode;
        if ($periode == '1') {
            $fperiode = '3';
        } else
            if ($periode == '2') {
                $fperiode = '6';
            } else
                if ($periode == '3') {
                    $fperiode = '9';
                } else
                    if ($periode == '4') {
                        $fperiode = '12';
                    } else {
                        $fperiode = '12';
                    }

        $y = date('Y');
        if ($jenis == 'cos_saving') {
            if ($this->request->periode != 0) {

                $origin = Tmsurat_master::select(\DB::raw("sum(replace(harga_patokan,',','')) as fharga_patokan"))
                    ->join('tmp_surat', 'tmp_surat.site_id', '=', 'tmsurat_master.site_id')
                    ->join('tr_surat_master', 'tr_surat_master.site_id', '=', 'tmsurat_master.site_id')->where('tmsurat_master.tmtahun_id', $tahun);

                $compare = tmp_surat::select(\DB::raw("sum(replace(harga_sewa_baru,'.','')) as tharga_sewa_baru"))->where('tmsurat_master.tmtahun_id', $tahun)->join('tmsurat_master', 'tmp_surat.site_id', '=', 'tmsurat_master.site_id');
                if ($periode == '1') {
                    $origin->where("tmsurat_master.quartal", "Q1")->get();
                    $compare->where("tmsurat_master.quartal", "Q1")->get();
                } else
                    if ($periode == '2') {
                        // origin start
                        $origin->where("tmsurat_master.quartal", "Q2")->get();
                        $compare->where("tmsurat_master.quartal", "Q2")->get();
                    } else
                        if ($periode == '3') {
                            $origin->where("tmsurat_master.quartal", "Q3")->get();
                            $compare->where("tmsurat_master.quartal", "Q3")->get();
                        } else
                            if ($periode == '4') {
                                $origin->where("tmsurat_master.quartal", "Q4")->get();
                                $compare->where("tmsurat_master.quartal", "Q4")->get();
                            } else {
                                $origin->get();
                                $compare->get();
                            }
                $c_saving = ($origin->first()->fharga_patokan - $compare->first()->tharga_sewa_baru);
                $fharga_patokan = $origin->first()->fharga_patokan;
                if ($origin->first()->fharga_patokan < 0 || $origin->first()->fharga_patokan == null) {
                    $percetage = 0;
                } else {
                    $percetage = (($c_saving / $fharga_patokan) * 100);
                }
                $amount = number_format((int) $c_saving);
                $a = [
                    'percentage' => ($percetage) ? substr($percetage, 0, 5) . '%' : '0%',
                    'amount' => ($amount) ? $amount : 0,
                ];
            } else {
                $origin = Tmsurat_master::select(\DB::raw("sum(replace(harga_patokan,',','')) as fharga_patokan"))
                    ->join('tmp_surat', 'tmp_surat.site_id', '=', 'tmsurat_master.site_id')
                    ->join('tr_surat_master', 'tr_surat_master.site_id', '=', 'tmsurat_master.site_id')->where('tmsurat_master.tmtahun_id', $tahun)->get();

                $compare = tmp_surat::select(\DB::raw("sum(replace(harga_sewa_baru,'.','')) as tharga_sewa_baru"))->where('tmsurat_master.tmtahun_id', $tahun)->join('tmsurat_master', 'tmp_surat.site_id', '=', 'tmsurat_master.site_id')
                    ->get();

                // Show results of log
                $c_saving = ($origin->first()->fharga_patokan - $compare->first()->tharga_sewa_baru);
                if ($c_saving > 0) {
                    if ($compare->first()->tharga_sewa_baru > 0) {
                        $amount = number_format((int) $c_saving);
                        $percetage = (($c_saving / (int) $origin->first()->fharga_patokan) * 100);
                        $setpercentage = substr($percetage, 0, 5);
                    } else {
                        $amount = 0;
                        $setpercentage = 0;

                    }
                    $a = [
                        'percentage' => ($setpercentage) . '%',
                        'amount' => ($amount) ? $amount : 0,
                    ];
                } else {
                    $a = [
                        'percentage' => '0%',
                        'amount' => 0,
                    ];

                }
            }
        } else if ($jenis == 'ef_eficiency') {

            $eorigin = tmp_surat::select(\DB::raw("sum(replace(pemilik_1,'.','')) as penawaran_ttl"))->where('tmsurat_master.tmtahun_id', $tahun)->join('tmsurat_master', 'tmp_surat.site_id', '=', 'tmsurat_master.site_id');
            $ecompare = tmp_surat::select(\DB::raw("sum(replace(harga_sewa_baru,'.','')) as tharga_sewa_baru"))->where('tmsurat_master.tmtahun_id', $tahun)->join('tmsurat_master', 'tmp_surat.site_id', '=', 'tmsurat_master.site_id');

            if ($periode == '1') {

                $eorigin->where("tmsurat_master.quartal", "Q1")->get();
                $ecompare->where("tmsurat_master.quartal", "Q1")->get();
            } else if ($periode == '2') {

                $eorigin->where("tmsurat_master.quartal", "Q2")->get();
                $ecompare->where("tmsurat_master.quartal", "Q2")->get();
            } else if ($periode == '3') {

                $eorigin->where("tmsurat_master.quartal", "Q3")->get();
                $ecompare->where("tmsurat_master.quartal", "Q3")->get();
            } else if ($periode == '4') {
                $eorigin->where("tmsurat_master.quartal", "Q4")->get();
                $ecompare->where("tmsurat_master.quartal", "Q4")->get();
            } else {
                $eorigin->get();
                $ecompare->get();
            }

            $efficiency = ((int) $eorigin->first()->penawaran_ttl - (int) $ecompare->first()->tharga_sewa_baru);
            $hargaperatama = isset($eorigin->first()->penawaran_ttl) ? $eorigin->first()->penawaran_ttl : 1;
            if ($this->request->periode != 0) {
                if ($efficiency > 0) {
                    $percetage = (((int) $efficiency / (int) $hargaperatama) * 100);
                    $amount = number_format((int) $efficiency);
                    $a = [
                        'percentage' => ($percetage) ? substr($percetage, 0, 6) . '%' : '0%',
                        'amount' => ($amount) ? $amount : '0',
                    ];

                } else {
                    $percetage = 0;
                    $amount = number_format((int) $efficiency);
                    $a = [
                        'percentage' => ($percetage) ? substr($percetage, 0, 6) . '%' : '0%',
                        'amount' => ($amount) ? $amount : '0',
                    ];

                }
            } else {

                $eorigin = tmp_surat::select(\DB::raw("sum(replace(pemilik_1,'.','')) as penawaran_ttl"))->where('tmsurat_master.tmtahun_id', $tahun)->join('tmsurat_master', 'tmp_surat.site_id', '=', 'tmsurat_master.site_id')
                    ->get();

                $compare = tmp_surat::select(\DB::raw("sum(replace(harga_sewa_baru,'.','')) as tharga_sewa_baru"))->where('tmsurat_master.tmtahun_id', $tahun)->join('tmsurat_master', 'tmp_surat.site_id', '=', 'tmsurat_master.site_id')
                    ->get();

                $c_saving = ((int) $eorigin->first()->penawaran_ttl - (int) $compare->first()->tharga_sewa_baru);
                $amount = number_format($c_saving);
                if ($eorigin->first()->penawaran_ttl > 0) {

                    $percetage = (($c_saving / $eorigin->first()->penawaran_ttl) * 100);
                } else {
                    $percetage = 0;
                }
                $a = [
                    'percentage' => substr($percetage, 0, 6) . '%',
                    'amount' => ($amount) ? $amount : '0',
                ];
            }
        }

        return response()->json($a);
    }
    private function based_on_revenue()
    {
        if ($this->request->contract) {
            $site_jabodetabek = Tmsurat_master::where('tmtahun_id', $this->request->contract)->get()->count();
        } else {
            $site_jabodetabek = Tmsurat_master::get()->count();
        }

        return $site_jabodetabek;
    }

    public function cregion($par, $tahun)
    {

        if ($tahun != '') {
            $jumlah = Tmsurat_master::where('region', $par)
                ->where('tmtahun_id', $tahun)
                ->count();
        } else {
            $jumlah = Tmsurat_master::where('region', $par)
                ->count();
        }
        if ($this->based_on_revenue() > 0) {
            $nil = (intval($jumlah) / intval($this->based_on_revenue()) * 100);
        } else {
            $nil = 0;
        }
        return round($nil) . '%';
    }
    public function site_jabodetabek()
    {
        return $this->based_on_revenue();
    }
    public function pr_western_jabo()
    {
        $contract = $this->request->contract;
        return $this->cregion('WESTERN JABOTABEK', $contract);
    }
    public function pr_centeral_jabo()
    {
        $contract = $this->request->contract;

        return $this->cregion('CENTRAL JABOTABEK', $contract);
    }
    public function pr_eastern_jabo()
    {
        $contract = $this->request->contract;

        return $this->cregion('EASTERN JABOTABEK', $contract);
    }
    // left grafik
    function registerAct()
    {
        $name = $this->request->name;
        $username = $this->request->username;
        $email = $this->request->email;
        $password = trim($this->request->password);
        try {
            $checked = DB::table('users')->where(['username' => $username]);
            if ($checked->get()->count() > 0) {
                return response()->json([
                    'errors' => [
                        'data sudah terdaftar sebelumnya'
                    ],
                ], 400);
            } else {
                // dd($this->request->all());
                DB::table('users')->insert([
                    'name' => $name,
                    'username' => $username,
                    'password' => bcrypt($password),
                    'email' => $email,
                ]);
                return response()->json([
                    'messages' => 'success',
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'errors' => $e->getMessage(),
            ]);
        }

    }

    function forgotPassw()
    {
        $email = $this->request->email;
        $password = $this->request->password;
        $data = DB::table('users')->where('email', $email)->get();
        if ($data->count() > 0) {
            return response()->json([
                'data' => 'data',
                'errors' => 'data berhasil di updae'
            ]);
        } else {
            return response()->json([
                'data' => [],
                'errors' => 'data tidak tersedia'
            ]);
        }
    }

}
