<?php if (!defined('APPLICATION')) exit();

// Get the tab sort order from the user-prefs.
$SortOrder = FALSE;
$SortOrder = ArrayValue('ProfileTabOrder', $this->User->Preferences, FALSE);
// If not in the user prefs, get the sort order from the application prefs.
if ($SortOrder === FALSE)
	$SortOrder = Gdn::Config('Garden.ProfileTabOrder');

if (!is_array($SortOrder))
	$SortOrder = array();
	
// Make sure that all tabs are present in $SortOrder
foreach ($this->_ProfileTabs as $TabCode => $TabInfo) {
	if (!in_array($TabCode, $SortOrder))
		$SortOrder[] = $TabCode;
}
?>
<div class="Tabs ProfileTabs">
	<ul>
	<?php
	// Get sorted tabs
	foreach ($SortOrder as $TabCode) {
		$CssClass = $TabCode == $this->_CurrentTab ? 'Active ' : '';
		// array_key_exists: Just in case a method was removed but is still present in sortorder
		if (array_key_exists($TabCode, $this->_ProfileTabs)) {
			$TabInfo = GetValue($TabCode, $this->_ProfileTabs, array());
			$CssClass .= GetValue('CssClass', $TabInfo, '');
			echo '<li'.($CssClass == '' ? '' : ' class="'.$CssClass.'"').'>'.Anchor(GetValue('TabHtml', $TabInfo, $TabCode), GetValue('TabUrl', $TabInfo), array('class' => 'TabLink'))."</li>\r\n";
		}
	}
	$this->GetUserInfo($UserReference, $Username, $UserID);

	if ($this->User->UserID == Gdn::Session()->UserID)
		echo '<li class="EditProfileLink"><a class="TabLink btn-info" href="/profile/edit"><i class="icon-edit"></i> Edit profile</a></li>';
	?>
	<li class="ExcerptLink"><a class="TabLink ExcerptToggle active btn-primary" href="#"><i class="icon-eye-open"></i> Excerpts</a></li>
	</ul>
</div>