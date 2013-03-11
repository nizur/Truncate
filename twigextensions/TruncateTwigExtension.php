<?php
namespace Craft;

class TruncateTwigExtension extends \Twig_Extension
{

	public function getName()
	{
		return Craft::t('Truncate');
	}

	public function getFilters()
	{
		return array(
			'truncate' => new \Twig_Filter_Method($this, 'truncateFilter')
		);
	}

	public function truncateFilter($str, $delimiter='chars', $limit='150', $ending='')
	{
		// Can we handle multibyte strings?
		$mb_ok = function_exists('mb_get_info');

		// Get our Twig charset
		$charset = craft()->templates->getTwig()->getCharset();

		// Work with the text
		switch ($delimiter)
		{
			// Are we counting by words?
			case 'words':
				if (str_word_count($str, 0) > $limit)
				{
					$words = str_word_count($str, 2);
					$pos   = array_keys($words);
					$str   = ($mb_ok) ? mb_substr($str, 0, $pos[$limit], $charset) : substr($str, 0, $pos[$limit]);
				}
				break;

			// Default to counting by chars
			default:
				$str = ($mb_ok) ? mb_substr($str, 0, $limit, $charset) : substr($str, 0, $limit);
				break;
		}

		return rtrim($str).$ending;
	}

}
