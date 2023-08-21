<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class CalendarController extends BaseController
{

    public function index($month = null, $year = null)
    {
        $this->load->model('transaction/Project_model');
        $dashboardBox = [0, 0, 4, 0];
        $data['CounTable'] = $this->Project_model->Get(
            $dashboardBox
        );

        // Mendapatkan tanggal saat ini
        date_default_timezone_set("Asia/Bangkok");
        $current_date = date('Y-m-d');

        // Mendapatkan bulan dan tahun dari URL (jika ada) atau menggunakan bulan dan tahun saat ini
        $month = ($month != null) ? $month : date('m');
        $year = ($year != null) ? $year : date('Y');

        // Menampilkan view dengan data kalender
        $data['calendar'] = $this->generate_calendar($month, $year, $current_date);
        $data['month'] = $month;
        $data['year'] = $year;
        $data['days'] = array('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');

        $this->loadViews('dashboard', $data);
        // Menampilkan view dengan data kalender
        //$this->loadViews('dashboard', array('calendar' => $this->generate_calendar($month, $year, $current_date)));
    }

    private function generate_calendar($month, $year, $current_date)
    {
        // Mendapatkan jumlah hari dalam bulan
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Mendapatkan tanggal awal dan akhir bulan
        $first_day = date('N', strtotime("$year-$month-01"));
        $last_day = date('N', strtotime("$year-$month-$num_days"));

        // Mendapatkan tanggal awal sebelum tanggal 1
        $prev_month = ($month == 1) ? 12 : $month - 1;
        $prev_year = ($month == 1) ? $year - 1 : $year;
        $prev_month_days = cal_days_in_month(CAL_GREGORIAN, $prev_month, $prev_year);
        $start_date = $prev_month_days - ($first_day - 2);

        // Mendapatkan tanggal akhir setelah tanggal terakhir bulan
        $next_month = ($month == 12) ? 1 : $month + 1;
        $next_year = ($month == 12) ? $year + 1 : $year;
        $end_date = 7 - $last_day;

        // Menginisialisasi variabel
        $calendar = '';
        $day = 1;

        // Membangun kalender
        $calendar .= '<tr>';

        // Menampilkan tanggal dari bulan sebelumnya jika ada
        for ($i = $start_date; $i <= $prev_month_days; $i++) {
            $calendar .= '<td data-action="selectDay" class="day old">' . $i . '</td>';
            $day++;
        }

        // Menampilkan tanggal dari bulan saat ini
        for ($i = 1; $i <= $num_days; $i++) {
            $class = ($current_date == "$year-$month-$i") ? 'active' : '';
            $calendar .= '<td data-action="selectDay" class="day ' . $class . '">' . $i . '</td>';

            // Menambahkan baris baru setiap akhir minggu (7 hari)
            if ($day % 7 == 0) {
                $calendar .= '</tr><tr>';
            }

            $day++;
        }

        // Menampilkan tanggal dari bulan setelahnya jika ada
        for ($i = 1; $i <= $end_date; $i++) {
            $calendar .= '<td data-action="selectDay" class="day new">' . $i . '</td>';
            $day++;
        }

        $calendar .= '</tr>';

        return $calendar;
    }
}
