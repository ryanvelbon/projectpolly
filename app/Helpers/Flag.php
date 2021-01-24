<?php


namespace App\Helpers;

class Flag
{
	public function getLanguageForCountry($country)
	{
		// might not be necessary
		// keep in mind countries:
		// 		i.   multilingual countries like Switzerland
		//		ii.  expats and tourists will not appreciate this


	}

	public static function getFlagForLanguage($lang)
	{
		/**
		 * 
		 *
		 *
		 * @param string $lang The language as an ISO 639-1 code
		 *
		 * @return string This string represents a flag. Typically the
		 *                returned string is a country code, however
		                  there are some exceptions.
		 *
		 * Here is why this function is necessary:
		 * http://www.flagsarenotlanguages.com/blog/iso-language-codes-and-country-codes-dont-mix/
		 */

		switch ($lang) {
			case 'ar':
				return 'ps';
			case 'en':
				return 'gb';
			case 'zh':
				return 'cn'; // Chinese = China
			case 'ja':
				return 'jp';
			case 'ko':
				return 'kr';
			case 'hi':
				return 'in';
			default:
				return $lang;
			// pending: afar afrikaans akan albania amharic etc.
		}
		//  https://www.unknown.nu/flags/


	}
}