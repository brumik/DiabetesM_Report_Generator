<?php
namespace App\Http\Traits;

trait Categories
{
	private $categories = [
		'Snack' => 0,
		'BeforeBreakfast' => 1,
		'Breakfast' => 11,
		'AfterBreakfast' => 2,
		'BeforeLunch' => 3,
		'Lunch' => 12,
		'AfterLunch' => 4,
		'BeforeDinner' => 5,
		'Dinner' => 13,
		'AfterDinner' => 6,
		'BeforeBed' => 10,
		'Night' => 7,
		'Other' => 8,
		'FastingGlucose' => 9,
		'BeforeExercise' => 14,
		'AfterExercise' => 15,	
	];

	private $convert_rules = [
		'Breakfast' => ['BeforeBreakfast', 'Breakfast'],
		'Breakfast_Lunch' => ['AfterBreakfast', 'BeforeLunch'],
		'Lunch' => ['Lunch'],
		'Lunch_Dinner' => ['AfterLunch', 'BeforeDinner'],
		'Dinner' => ['Dinner'],
		'Dinner_Bedtime' => ['AfterDinner'],
		'Bedtime' => ['BeforeBed'],
		'Night' => ['Night'],
		'Other' => ['Snack', 'FastingGlucose', 'BeforeExercise', 'AfterExercise']
	];

	private $simplified_categories = [
		'Breakfast' => 0,
		'Breakfast_Lunch' => 1,
		'Lunch' => 2,
		'Lunch_Dinner' => 3,
		'Dinner' => 4,
		'Dinner_Bedtime' => 5,
		'Bedtime' => 6,
		'Night' => 7,
		'Other' => 8
	];

	/**
	 * @param $key String The key of the category
	 * @param $simplified Bool From which category to map
	 * @return float The number of the category
	 */
	public function map($key, $simplified=false)
	{
		return $simplified ? $this->simplified_categories[$key] : $this->categories[$key];
	}

	/**
	 * @param $entry object The entry
	 * @param $from_categories String[] The names of the default categories to convert from.
	 * @param $to_category String The name of the new simplified category.
	 * @return Bool If converted returns true, otherwise false.
	 */
	private function convert($entry, $from_categories, $to_category)
	{
		// Convert category strings to numbers
		$from_categories_num = [];
		foreach ($from_categories as $category)
			$from_categories_num[] = $this->map($category, false);

		if ( in_array($entry->category, $from_categories_num) ) {
			$entry['category'] = $this->map($to_category, true);
			return true;
		}

		return false;
	}

	/**
	 * Converts the entry category following the convert rules.
	 *
	 * @param $entry object The entry to convert.
	 */
	public function convert_entry($entry)
	{
		foreach ($this->convert_rules as $new => $old_arr) {
			if ( $this->convert($entry, $old_arr, $new) )
				return;
		}

	}
}