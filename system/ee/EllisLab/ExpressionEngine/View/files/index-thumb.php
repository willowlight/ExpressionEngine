<?php $this->extend('_templates/default-nav'); ?>

<div class="tbl-ctrls">
	<?=form_open($form_url)?>
		<div class="app-notice-wrap"><?=ee('CP/Alert')->getAllInlines()?></div>

		<div class="title-bar js-filters-collapsable">
			<h2 class="title-bar__title"><?=$cp_heading?></h2>
			<?php if (isset($filters)) echo $filters; ?>
		</div>

		<?php $this->embed('_shared/thumb', $files->toArray()); ?>
		<?=$pagination?>
		<?php if ( ! empty($table['columns']) && ! empty($table['data'])): ?>
		<fieldset class="bulk-action-bar hidden">
			<select name="bulk_action">
				<option value="">-- <?=lang('with_selected')?> --</option>
				<?php if (ee()->cp->allowed_group('can_delete_files')): ?>
				<option value="remove" data-confirm-trigger="selected" rel="modal-confirm-delete-file"><?=lang('delete')?></option>
				<?php endif; ?>
				<option value="download"><?=lang('download')?></option>
			</select>
			<button class="button button--primary" data-conditional-modal="confirm-trigger"><?=lang('submit')?></button>
		</fieldset>
		<?php endif; ?>
	<?=form_close()?>
</div>

<?php $this->embed('files/_delete_modal'); ?>