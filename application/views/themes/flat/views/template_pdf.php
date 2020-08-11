<?php

defined('BASEPATH') or exit('No direct script access allowed');

$dimensions = $pdf->getPageDimensions();

$info_right_column = '';
$info_left_column = '';
$pdf->setHtmlVSpace(array(
    'li' => array(
        'h' => 0, // margin in mm
    )
));

$pdf->setListIndentWidth(1);

$tblhtml = '
<style>
    * {
        font-family: Arial;
    }

    .font-11 {
        font-size: 11px
    }

    .bgColor2 {
        background: #808080;
        padding: 8px
    }

    ul {
        padding: 0;
    }

    .ledttd td {
        line-height: 33px;
        height: 35px;
        border: 1px white solid !important;
    }

    .ledttd td {
        border-bottom: 1px white solid !important;
        padding-bottom: 1px !important;
    }

    .bgd {
        background: #CCFFFF;
    }
</style>';
$tblhtml .= '<h1 style="text-align: center"> Katzky Umzüge e. Kffr., Nah-Fernumzüge & Logistik</h1>
<p style="text-align: center; margin: 0">Bitterfelder Straße 12, 12681 Berlin, Tel. (030) 29 49 59 11 & (030) 55 49 38
    00, Fax (030) 55 49 38 02</p>
<table style="width: 100%; ">
    <tr>
        <td width="50%" class="font-11 ledttd">
            <table style="margin: 0">
                <tr>
                    <td bgcolor="#CCFFFF"><strong>Auftraggeber/Rechnungsempfänger:</strong> GEHAG Erste</td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF">Beteiligungs GmbH, c/o Deutsche Wohnen Constructions</td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF">& Facilities GmbH, Mecklenburgische Straße 57, 14197 Berlin</td>
                </tr>
                <tr>
                    <td width="40%"><strong>Name Mieter:</strong></td>
                    <td bgcolor="#CCFFFF" width="60%" bgcolor="#CCFFFF">Narin Ala</td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF" colspan="2"></td>
                </tr>
                <tr>
                    <td width="40%"><strong>Beladestelle:</strong></td>
                    <td bgcolor="#CCFFFF" width="60%"><strong>Borussiastr. 29/30</strong></td>
                </tr>
                <tr>
                    <td width="40%" bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF" width="60%"><strong>12099 Berlin</strong></td>
                </tr>
                <tr>
                    <td width="40%">Geschoß</td>
                    <td width="60%"><strong>2. OG</strong></td>
                </tr>
                <tr>
                    <td width="40%"><strong>Entladestelle:</strong></td>
                    <td bgcolor="#CCFFFF" width="60%">Fuhrmann 1</td>
                </tr>
                <tr>
                    <td width="40%"><strong></strong></td>
                    <td width="60%">12099 Berlin</td>
                </tr>
                <tr>
                    <td width="40%">Geschoß</td>
                    <td width="40%"></td>
                    <td width="20%"><img src="assets/images/phone-icon.png" style="margin-left: 5px" width="14"/></td>
                </tr>
                <tr>
                    <td width="40%"><strong>Entladestelle:</strong></td>
                    <td width="60%">Borussia 29/30</td>
                </tr>
                <tr>
                    <td width="40%"><strong></strong></td>
                    <td width="60%">12099 Berlin</td>
                </tr>
                <tr>
                    <td width="40%">Geschoß</td>
                    <td width="40%"></td>
                    <td width="20%"><img src="assets/images/phone-icon.png" style="margin-left: 5px" width="14"/></td>
                </tr>
            </table>
            <table width="100%" style="margin: 0" cellspacing="1">
                <tr>
                    <td></td>
                    <td>Datum</td>
                    <td>Uhrzeit <img src="assets/images/clock.png" style="margin-left: 5px" width="14"/></td>
                    <td>Abfahrt <img src="assets/images/clock.png" style="margin-left: 5px" width="14"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td>Transport AQ</td>
                    <td bgcolor="#CCFFFF">25/11/2019</td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td>Demontagen:</td>
                    <td bgcolor="#CCFFFF">25/11/2019</td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4">folgende Arbeit (Besonderheit):</td>
                </tr>
                <tr>
                    <td colspan="4" style="border-bottom: 0.4px solid #FFF" bgcolor="#CCFFFF">Transport aus
                        Ausweichquartier:
                    </td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF">Transportiert wurden:</td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF">De- und Montagen:</td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#CCFFFF"></td>
                </tr>
            </table>
            <br>
            <br>
            <table width="100%" cellspacing="0" cellpadding="1" border="1">
                <tr>
                    <td width="24%">Material</td>
                    <td width="13%">bereits ange-liefert</td>
                    <td width="11%">mitzu-nehmen</td>
                    <td width="14%">davon ge-braucht</td>
                    <td width="12%">davon zurück</td>
                    <td width="12%">noch dort</td>
                    <td width="14%">ungebr. zurück</td>
                </tr>
                <tr>
                    <td>Umzugskarton</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Bücherkarton</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Kleiderbox</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Packseide</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Stretchfolie</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Luftpolsterfolie</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Bauplanen</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Klebeband</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Matratzenhülle</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Bettensack</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Kreppband</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <br>
            <br>
            <table width="100%" cellspacing="1">
                <tr>
                    <td>Datum</td>
                    <td>Abfahrt <img src="assets/images/clock.png" style="margin-left: 5px" width="14"/></td>
                    <td>Rückkehr <img src="assets/images/clock.png" style="margin-left: 5px" width="14"/></td>
                    <td>Pause Std.</td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF">25/11/2019</td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF">25/11/2019</td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                    <td bgcolor="#CCFFFF"></td>
                </tr>
                <tr>
                    <td>Wartezeit:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sonderleistungen:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Einpacken:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Auspacken:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Datum:</td>
                    <td></td>
                    <td>Unterschrift:</td>
                    <td></td>
                </tr>
            </table>
        </td>
        ';
$tblhtml .= '
        <td width="50%">
            <table width="100%">
                <tr>
                    <td colspan="2">
                        <table width="100%">
                            <tr>
                                <td>WIE: 1120 - 0002
                                    <br>Projekt-Nr.: B.1120000201
                                </td>
                                <td>Auftrag: 3000012249</td>
                            </tr>
                            <tr>
                                <td colspan="2"><h1 style="padding-top: 8px; color: red">Arbeitsschein</h1></td>
                            </tr>
                        </table>
                        <table border="1" width="100%">
                            <tr bgcolor="#000" style="color: white; ">
                                <td>
                                <span style="padding: 4px 2px">
                                    Vom Kunden zu bestätigen:
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>Einsatzzeiten Personal und Möbelwagen <br>An- und Abfahrten sowie
                                        Transportzeiten werden zusätzlich berechnet.
                                    </div>
                                    <div class="font-11">
                                        <table width="100%" cellspacing="1" cellpadding="2">
                                            <tr>
                                                <td>Datum</td>
                                                <td>Von <img src="assets/images/clock.png" style="margin-left: 5px"
                                                             width="14"/>
                                                </td>
                                                <td>Bis <img src="assets/images/clock.png" style="margin-left: 5px"
                                                             width="14"/>
                                                </td>
                                                <td>./. Pausen Std.</td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF">25/11/2019</td>
                                                <td bgcolor="#CCFFFF"></td>
                                                <td bgcolor="#CCFFFF"></td>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                                <td bgcolor="#CCFFFF"></td>
                                                <td bgcolor="#CCFFFF"></td>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                                <td bgcolor="#CCFFFF"></td>
                                                <td bgcolor="#CCFFFF"></td>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <p>Zusätzlich zum Umzugsvertrag erbrachte Leistungen:</p>
                                        <table width="100%">
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <p>Anschluss: Waschmaschine und/oder Geschirrspüler. Probelauf?</p>
                                        <table width="100%" cellspacing="1">
                                            <tr>
                                                <td width="13%">
                                        <span><img src="assets/images/un-check.png" style="margin-right: 5px"
                                                   width="18"/> Ja </span>
                                                </td>
                                                <td width="17%">
                                        <span><img src="assets/images/un-check.png" style="margin-right: 5px"
                                                   width="18"/> Nien </span>
                                                </td>
                                                <td width="70%" bgcolor="#CCFFFF"></td>
                                            </tr>
                                        </table>
                                        <p><strong>Vorschäden am Umzugsgut -> vor Einlagerung</strong></p>
                                        <table width="100%">
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#CCFFFF"></td>
                                            </tr>
                                        </table>
                                        <p>Die Richtigkeit der vorstehenden Angaben wird bestätigt.</p>
                                        <p>07/10/2019</p>
                                        <table width="100%">
                                            <tr>
                                                <td>Datum:</td>
                                                <td>Unterschrift:</td>
                                            </tr>
                                        </table>
                                        <div style="background-color:#989590;color:#000;font-size: 22px; margin-bottom: 5px;margin-top: 12px; padding: 10px 20px !important;">
                                            Empfängerhinweis
                                        </div>
                                        <div style="padding-left: 5px">Die Beförderung von Umzugsgut ist gesetzlich
                                            geregelt
                                            im "Vierten Abschnitt - Frachtgeschäft" des HGB und hier speziell in den
                                            §§
                                            451
                                            bis 451h.
                                            <u>Schadensanzeige:</u> Um das Erlöschen von Ersatzansprüchen zu
                                            verhindern,
                                            ist
                                            folgendes zu beachten:
                                            <span style="text-align:justify; line-height: 14px;">
                                            <ul>
                                                <li style="margin:0 !important">Untersuchen Sie das Gut bei Ablieferung
                                                    auf äußerlich erkennbare Beschädigungen oder Verluste. Halten Sie
                                                    diese auf dem Ablieferungsbeleg oder einem Schadens-protokoll
                                                    spezifiziert fest oder zeigen Sie diese dem Mö-belspediteur
                                                    spätestens am Tag nach der Ablieferung an.
                                                </li>
                                                <li>Äußerlich nicht erkennbare Schäden oder Verluste, die Sie erst beim
                                                    Auspacken des Umzugsgutes feststellen, müssen dem Möbelspediteur
                                                    innerhalb von 14 Tagen nach Ablieferung spezifiziert angezeigt
                                                    werden.
                                                </li>
                                                <li>Pauschale Schadensanzeigen genügen in keinem Fall.</li>
                                                <li>Ansprüche wegen Überschreitung der Lieferfristen erlöschen, wenn der
                                                    Empfänger dem Möbelspediteur die Überschreitung nicht innerhalb von
                                                    21 Tagen nach Ablieferung anzeigt.
                                                </li>
                                                <li>Wird die Anzeige nach Ablieferung erstattet, muß sie - um den
                                                    An-spruchsverlust zu verhindern - in jedem Fall in schriftlicher
                                                    Form und innerhalb der vorgesehenen Fristen erfolgen. Die
                                                    Übermittlung der Schadensanzeige kann auch mit Hilfe einer
                                                    telekommunikativen Einrichtung erfolgen. Einer Unterschrift bedarf
                                                    es nicht, wenn der Aus-steller in anderer Weise erkennbar ist.
                                                </li>
                                                <li>Zur Wahrung der Fristen genügt die rechtzeitige Absendung.</li>
                                            </ul>
                                        </span>
                                            Der Empfang des Transportgutes wird hiermit bescheinigt. Vom
                                            Empfänger-hinweis
                                            habe ich Kenntnis genommen.
                                            <br>
                                            <br>
                                            Datum: Unterschrift:
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<style>
    table th,
    table td {
        padding: 10px !important;
    }

</style>';
$pdf->writeHTML($tblhtml, true, 0, true, true);
$pdf->AddPage();
$tblhtml = '<table>
    <tr>
        <td><h1>Schadensprotokoll</h1></td>
    </tr>
<tr><td>Welches Gut fehlt oder ist beschädigt?</td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td>Waren Vorschäden am beschädigten Gut vorhanden?
                                                <span style="margin-left: 60px">
                                                <img src="assets/images/un-check.png" style="margin-right: 5px"
                                                           width="18"/> Ja </span>
                                                <span style="margin-left: 80px">
                                                <img src="assets/images/un-check.png" style="margin-right: 5px"
                                                           width="18"/> Nien </span>
                                                        </td>
                                                </tr>
<tr><td></td></tr>
</table>';
$pdf->writeHTML($tblhtml, true, 0, true, true);