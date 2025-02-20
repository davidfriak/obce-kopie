<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Okres;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;
use App\Models\Obec;

class Main extends BaseController
{
    var $okres;
    var $data;
    var $obec;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->obec = new Obec();
        $this->okres = new Okres();
        $this->data["okresy"] = $okresy = $this->okres->where("kraj", 141)->findAll();
        


        
    }
    
    public function index(): string
    {
        return view('welcome_message');
    }
    public function zlinskykraj()
    {
        $this->data["obec"] = $this->obec->select("obec.nazev, Count(*) as pocet")->join("cast_obce", "obec.kod = cast_obce.obec", "inner")->join("ulice", "ulice.cast_obce = cast_obce.kod", "inner")->join("adresni_misto", "adresni_misto.ulice = ulice.kod", "inner")->join("okres", "okres.kod = obec.okres")->groupBy("obec.kod")->orderBy("pocet", "desc")->paginate(20);
        
        $pager = $this->obec->pager;
        $this->data["pager"] = $pager;
        echo view("zlinskykraj.php", $this->data);
    }

    public function okres($kod, $perPage){
        $this->data["obce"] = $this->obec->select("obec.nazev, Count(*) as pocet")->join("cast_obce", "obec.kod = cast_obce.obec", "inner")->join("ulice", "ulice.cast_obce = cast_obce.kod", "inner")->join("adresni_misto", "adresni_misto.ulice = ulice.kod", "inner")->join("okres", "okres.kod = obec.okres")->where("okres.kod", $kod)->groupBy("obec.kod")->orderBy("pocet", "desc")->paginate($perPage);
        $this->data["perPage"] = $perPage;
        $this->data["kod"] = $kod;
        $pager = $this->obec->pager;
        $this->data["pager"] = $pager;
        echo view ("okres", $this->data);
    }
}
