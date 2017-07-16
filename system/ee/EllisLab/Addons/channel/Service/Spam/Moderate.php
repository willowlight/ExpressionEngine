<?php

namespace EllisLab\Addons\Channel\Service\Spam;

/**
 * Moderate Spam for the Channel Form
 */
class Moderate {

	public function approve($entry, $post_data)
	{
		// save it
		$entry->set(unserialize($post_data));
		$entry->edit_date = ee()->localize->now;
		$entry->save();

		// ChannelEntry model handles all post-save actions: notifications, cache clearing, stats updates, etc.
	}

	public function reject($entry)
	{
		// Nothing was saved outside of the spam trap, so we don't need to do anything
		return;
	}
}
// END CLASS

// EOF
