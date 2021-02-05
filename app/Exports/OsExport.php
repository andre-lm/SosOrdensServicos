<?php

namespace App\Exports;

use App\Os;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Border;
  
class OsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Os::all();
    }

    public function map($os): array
    {
        $OSacompanhamento = [];
        $OSsolucao = [];
        if(isset($os->Acompanhamento[0])){
            foreach($os->Acompanhamento as $key => $acomp){
                $OSacompanhamento += [
                    'acomp_requerente'    => ($acomp->id_user) ? $acomp->userName($acomp->id_user) : $acomp->requerente,
                    'acomp_descricao'     => $acomp->descricao,
                    'acomp_created_at'    => dateToPTBR($acomp->created_at)
                ];
            }
        }
        if(isset($os->Solucao[0])){
            foreach($os->Solucao as $solucao){
                $OSsolucao = [
                    'sol_requerente'    => ($solucao->id_user) ? $solucao->userName($solucao->id_user) : $solucao->requerente,
                    'sol_descricao'     => $solucao->descricao,
                    'sol_created_at'    => dateToPTBR($solucao->created_at)
                ];
            }
        }
        return [
            'id' => $os->id,
            'autor' => $os->nome_autor,
            'titulo' => $os->titulo,
            'equipamento' => $os->equipamento,
            'descricao' => $os->descrição,
            'status' => $os->status->status,
            'tecnico' => $os->userName($os->id_user),
            'created_at' => dateToPTBR($os->created_at),
            
        ];
        
    }

    public function headings(): array
    {

        return [
            '#',
            'Autor',
            'Título',
            "Equipamento", 
            "Descrição", 
            "Situação/Status", 
            "Técnico", 
            "Data de criação",
        ];
        
    }

    public function styles(Worksheet $sheet)
    {
        
        return [
            1  => ['font' => ['size' => 11,'bold' => true]],
        ];
    }
}
