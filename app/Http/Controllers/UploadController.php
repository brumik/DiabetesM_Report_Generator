<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpload;
use App\Http\Traits\Categories;
use DateTime;

class UploadController extends Controller
{
	use Categories;

	/**
	 * The landing page with the upload form.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		return view('index');
	}

	/**
	 * @param $date1 String The first date
	 * @param $date2 String The second date
	 * @return int The difference
	 */
	private function get_date_difference($date1, $date2)
	{
		$datetime1 = new DateTime($date1);
		$datetime2 = new DateTime($date2);
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%a');
	}

	/**
	 * @param StoreUpload $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function store(StoreUpload $request)
	{
		\Config::set('excel.import.startRow', 2);
		$reader = \Excel::load($request['csv_file']);

		// TODO: Better date checking... There may be more than 7 results for a day
		$rows = $reader
			->limitRows($request['max_days'] * 7)
			->select(['datetimeformatted', 'category', 'carb_bolus', 'glucose', 'basal', 'carbs'])
			->toObject();

		$days = [];
		foreach ($rows as $row) {
			$date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->datetimeformatted)->format('Y-m-d');

			// TODO: If solved the date difference at the read, remove
			if ( $this->get_date_difference(date("Y-m-d"), $date) > $request['max_days'] )
				break;

			$this->convert_entry($row);
			$days[$date][$row->category][] = $row;
		}

		return view('report')->with([
			'days' => $days,
		]);

	}
}
