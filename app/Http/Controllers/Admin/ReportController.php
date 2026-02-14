<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $service
    ) {}

    public function index()
    {
        $data = $this->service->dashboard();

        return view('admin.reports.index', $data);
    }

}
