<?php $instance = 'toggle_'.number_format(rand(0, 100), 0).'_'.time(); ?>
<?php if(count($tree) > 0): ?>
	
<ul class="tree" data-order-url="<?php echo site_url('admin/newsletters/lists/order'); ?>" data-click-url="<?php echo site_url('admin/newsletters/lists/ajax_load'); ?>" data-cookie="lists-nest">

	<?php foreach($tree as $item): ?>

			<li id="<?php echo $item['id']; ?>" data-id="<?php echo $item['id']; ?>">
				<div class="<?php echo (in_array($item['id'], $disabled) ? 'disabled' : (in_array($item['id'], $enabled) ? 'green' : NULL)); ?>">
					<a href="#" rel="<?php echo $item['id']; ?>" onclick="$(this).<?php echo $instance; ?>(); return false;"><?php echo $item[$title_column]; ?></a>
					<div class="hidden">
						<?php if(!in_array($item['id'], $disabled)): ?>
							<input type="checkbox" name="tree-item[]" value="<?php echo $item['id'] ;?>"<?php echo (in_array($item['id'], $enabled) ? ' checked="checked"' : NULL); ?> />
						<?php endif; ?>
					</div>
				</div>
		
			<?php if(isset($item['children'])): ?>
				<ul>
					<?php $controller->form_tree_builder($item, $enabled, $disabled, $title_column, $instance); ?>
				</ul>
			</li>
		
			<?php else: ?>
			
			</li>
		
		<?php endif; ?>
	<?php endforeach; ?>

</ul>

<?php else: ?>

	<?php echo lang('streams.nested_list_relationship.empty'); ?>

<?php endif; ?>

<?php echo form_hidden($field->field_slug, rand(0, 100)); ?>

<script type="text/javascript">
jQuery.fn.<?php echo $instance; ?> = function()
{
	// No red
	if($(this).parent('div').hasClass('disabled')) return false;

	// Toggle the green class
	$(this).parent('div').toggleClass('green');

	// Toggle the checkbox too
	if($(this).parent('div').hasClass('green'))
	{
		$(this).parent('div').find('input').attr('checked', 'checked');
	}
	else
	{
		$(this).parent('div').find('input').removeAttr('checked');
	}
}
</script>