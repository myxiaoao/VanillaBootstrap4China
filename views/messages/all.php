<?php if (!defined('APPLICATION')) exit();
?>
<div class="Box">
<div class="Tabs ConversationsTabs">
	<ul>
		<li class="Active"><?php echo Anchor(T('Inbox'), '/messages/inbox', array('class' => 'TabLink')); ?></li>
	</ul>
</div>
<?php
if ($this->ConversationData->NumRows() > 0) {
?>
<ul class="Condensed DataList Conversations">
	<?php
	$ViewLocation = $this->FetchViewLocation('conversations');
	include($ViewLocation);
	?>
</ul>
<?php
echo $this->Pager->ToString();
} else {
	echo '<div class="Empty">'.T('You do not have any conversations.').'</div>';
}
echo '</div>';