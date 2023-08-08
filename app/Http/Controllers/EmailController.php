<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Repositories\SalesRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

/**
 * Classe to download report
 */
class EmailController extends Controller
{
    private ?SalesRepository $salesRepository = null;
    public function __construct()
    {
        $this->salesRepository = new SalesRepository(new Sales());
    }

    /**
     * @return Response
     */
    public function reportTraditional(): \Illuminate\Http\Response
    {
        $salesBurgerTradicional = $this->salesRepository->BurgersTraditionalWithStatusFinished();
        $totalSales = array_sum(array_column($salesBurgerTradicional, 'price'));
        $pdf = Pdf::loadView('reports.report_traditional',
            ["data" => ["salesBurgerTradicional" => $salesBurgerTradicional, 'totalSales' => $totalSales]]);
        return $pdf->download('report-tradicional.pdf');

    }

    /**
     * @return Response
     */
    public function reportArtesanal(): \Illuminate\Http\Response
    {
        $salesBurgerArtesanal = $this->salesRepository->BurgersArtesanalWithStatusFinished();
        $totalSales = array_sum(array_column($salesBurgerArtesanal, 'price'));
        $pdf = Pdf::loadView('reports.report_traditional',
            ["data" => ["salesBurgerTradicional" => $salesBurgerArtesanal, 'totalSales' => $totalSales]]);
        return $pdf->download('report-artesanal.pdf');
    }
}
