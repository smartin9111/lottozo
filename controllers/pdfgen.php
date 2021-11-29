<?php

class Pdfgen_Controller 
{

    public $baseName = "pdfgen";

    private function groupWins($wins) {
        $result_count = count($wins);
        for ($i = 0 ; $i < $result_count ; $i++) {
            $curr_year = $wins[$i]["ev"];
            $curr_week = $wins[$i]["het"];
            if ($i == 0 || end($grouped)["ev"] != $curr_year || end($grouped)["het"] != $curr_week) {
                $grouped[] = array(
                    "ev" => $curr_year,
                    "het" => $curr_week,
                    "talalat" => array()
                );
            }
            $grouped[count($grouped)-1]["talalat"][] = array("talalat" => $wins[$i]["talalat"], "ertek" => $wins[$i]["ertek"]);
        }

        return $grouped;
    }

	public function main(array $vars) 
	{
        try {
            $connection = Database::getConnection();
            $stmt = $connection->prepare("SELECT huzas.ev AS ev, huzas.het AS het, nyeremeny.ertek AS ertek, nyeremeny.talalat AS talalat " . 
                "FROM huzas JOIN nyeremeny ON nyeremeny.huzasid = huzas.id " . 
                "WHERE huzas.ev >= :ev AND huzas.id IN " . 
                    "(SELECT DISTINCT huzasid FROM huzott WHERE huzott.szam = :szam1 INTERSECT SELECT DISTINCT huzasid FROM huzott WHERE huzott.szam = :szam2)" .
                    "ORDER BY huzas.ev asc, huzas.het asc, nyeremeny.talalat DESC");
            $stmt->execute(Array(":ev" => $vars["ev"], ":szam1" => $vars["szam1"], ":szam2" => $vars["szam2"]));
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $eredmeny[] = array("ev" => $row['ev'], "het" => $row['het'], "talalat" => $row['talalat'], "ertek" => $row['ertek']);
            }
        } catch(PDOException $e) {
        }

        $grouped = $this->groupWins($eredmeny);

        // Include the main TCPDF library
        require_once('tcpdf/tcpdf.php');

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Hatoslotto Bt.');
        $pdf->SetTitle('NYEREMÉNYEK');
        $pdf->SetSubject('Nyeremények');
        $pdf->SetKeywords('számok, nyeremények');

        // set default header data
        $pdf->SetHeaderData(SITE_ROOT."css/hatos.jpg", 25, "Nyeremények listája", "Hatoslottó Tippadó Bt.\nStatisztika\n".date('Y.m.d',time()));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', '', 10);

        // add a page
        $pdf->AddPage();

        // create the HTML content
        $html  = '
        <html>
            <head>
                <style>
                    body {text-align: center;}
                    table {border-collapse: collapse; width: 50%; margin: 10px 20%;}
                    th {font-weight: border: 1px solid red; text-align: center;}
                    td {border: 1px solid blue; text-align: center; vertical-align: middle;}
                </style>
            </head>
            <body>
                <h1 style="text-align: center; color: blue; font-variant: small_caps;">Nyeremények</h1>
                <table>
                    <tr style="background-color: #0b4987; color: white; font-weight: bold;">
                    <th style="width: 20%;">Év</th>
                    <th style="width: 15%;">Hét</th>
                    <th style="width: 15%;">Találat</th>
                    <th style="width: 50%;">Nyeremény</th>
                    </tr>
        ';
        $i=1;
        foreach($grouped as $group) {
            if($i)
                $html .= '<tr style="background-color: rgb(255, 255, 255); color: #28619a;">';
            else					
                $html .= '<tr style="background-color: #28619a; color: rgb(255, 255, 255);">';

            //print_r($group);

            $talalat_szam = count($group["talalat"]);
            $html .= '<td style="text-align: right; vertical-align: bottom; width: 20%;" rowspan="'.$talalat_szam.'">'.$group["ev"]."</td>";
            $html .= '<td style="text-align: right; vertical-align: bottom; width: 15%;" rowspan="'.$talalat_szam.'">'.$group["het"]."</td>";

            $newLine = 0;
            foreach($group["talalat"] as $talalat) {
                if ($newLine) {
                    if($i)
                        $html .= '<tr style="background-color: rgb(255, 255, 255); color: #28619a;">';
                    else					
                        $html .= '<tr style="background-color: #28619a; color: rgb(255, 255, 255);">';
                }
                $newLine = 1;

                $html .= '<td style="text-align: right; width: 15%;">'.$talalat["talalat"]."</td>";
                $html .= '<td style="text-align: right; width: 50%;">'.$talalat["ertek"]." Ft</td>";
                $html .= '</tr>';
            }
            
            $i = !$i;
        }
        $html .= '
                </table>
            <body>
        </html>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('nyeremenyek.pdf', 'I');
	}
}



